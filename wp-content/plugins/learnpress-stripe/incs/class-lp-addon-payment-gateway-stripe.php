<?php

function learn_press_addon_stripe_template( $name, $args = null ) {
	learn_press_get_template( $name, $args, LP_ADDON_STRIPE_THEME_TMPL, LP_ADDON_STRIPE_TMPL );
}

if ( !class_exists( 'LP_Addon_Payment_Gateway_Stripe' ) ) {
	/**
	 * Class LP_Addon_Payment_Gateway_Stripe
	 *
	 * Make payment with Stripe
	 */
	class LP_Addon_Payment_Gateway_Stripe extends LP_Gateway_Abstract {

		/**
		 * @var array
		 */
		private $form_data = array();

		/**
		 * @var string
		 */
		private $api_endpoint = 'https://api.stripe.com/v1/';

		/**
		 * @var object
		 */
		private $charge = null;

		/**
		 * @var null
		 */
		protected static $_instance = null;

		/**
		 * @var array|null
		 */
		protected $settings = null;

		/**
		 * @var null
		 */
		protected $order = null;

		/**
		 * @var null
		 */
		protected $posted = null;

		/**
		 * Constructor
		 */
		function __construct() {

			$this->id                 = 'stripe';
			$this->icon               = apply_filters( 'learn_press_stripe_icon', '' );
			$this->method_title       = __( 'Stripe', 'learnpress-stripe' );
			$this->method_description = __( 'Make a payment with Credit Card.', 'learnpress-stripe' );

			// Get settings
			$this->title       = LP()->settings->get( "{$this->id}.title", $this->method_title );
			$this->description = LP()->settings->get( "{$this->id}.description", $this->method_description );

			$settings = LP()->settings;
			// Add default values for fresh installs

			if ( $settings->get( "{$this->id}.enable" ) ) {
				$this->settings                     = array();
				$this->settings['test_mode']        = $settings->get( "{$this->id}.test_mode" );
				$this->settings['test_publish_key'] = $settings->get( "{$this->id}.test_publish_key" );
				$this->settings['test_secret_key']  = $settings->get( "{$this->id}.test_secret_key" );
				$this->settings['live_publish_key'] = $settings->get( "{$this->id}.live_publish_key" );
				$this->settings['live_secret_key']  = $settings->get( "{$this->id}.live_secret_key" );
				$this->settings['capture']          = $settings->get( "{$this->id}.capture" );

				// API Info
				$this->settings['publish_key'] = $this->settings['test_mode'] ? $this->settings['test_publish_key'] : $this->settings['live_publish_key'];
				$this->settings['secret_key']  = $this->settings['test_mode'] ? $this->settings['test_secret_key'] : $this->settings['live_secret_key'];
			}

			if ( did_action( 'learn_press_addon_stripe_loaded' ) ) {
				return;
			}

			define( 'LP_ADDON_STRIPE_THEME_TMPL', learn_press_template_path() . '/addons/stripe/' );

			add_filter( 'learn_press_payment_method', array( $this, 'add_payment' ) );

			add_action( 'learn_press_section_payments_' . $this->id, array( $this, 'output_settings' ) );
			add_filter( 'learn_press_payment_gateway_available_' . $this->id, array( $this, 'is_available' ), 10, 2 );
			add_action( 'wp_enqueue_scripts', array( $this, 'load_script' ) );

			//add_action( 'learn_press_payment_gateway_form_' . $this->id, array( $this, 'payment_form' ) );

			//add_action( 'learn_press_save_payment_' . $this->id, array( $this, 'save_settings' ) );

			//add_action( 'learn_press_payment_gateway_form_' . $this->id, array( $this, 'payment_form' ) );
			//add_filter( 'learn_press_take_course_' . $this->id, array( $this, 'take_course' ) );

			//add_filter( 'learn_press_payment_method_from_slug_stripe', array( $this, 'stripe_name' ) );
			//

			//add_action( 'wp_enqueue_scripts', array( $this, 'load_script' ) );
			add_action( 'init', array( $this, 'load_text_domain' ) );


			do_action( 'learn_press_addon_stripe_loaded' );
		}

		/**
		 * Stripe name
		 */
		function stripe_name() {
			return $this->name;
		}

		/**
		 * Enable stripe
		 *
		 * @param  string $available
		 * @param  string $gateway
		 *
		 * @return boolean
		 */
		function is_available( $available, $gateway ) {
			if ( LP()->settings->get( "{$this->id}.enable" ) != 'yes' ) {
				return false;
			}

			// Stripe won't work without keys
			if ( !$this->settings['publish_key'] && !$this->settings['secret_key'] ) {
				return false;
			}

			if ( !is_ssl() && !$this->settings['test_mode'] ) {
				return false;
			}

			return true;
		}

		/**
		 * Load script
		 */
		function load_script() {
			if ( learn_press_is_checkout() ) {

				wp_enqueue_script( 'stripe', 'https://js.stripe.com/v2/', false, '2.0', true );
				wp_enqueue_script( 'learn-press-stripe', plugins_url( '/assets/js/stripe.js', LP_ADDON_STRIPE_FILE ) );

				$data = array(
					'publish_key' => $this->settings['publish_key'],
					'plugin_url'  => plugins_url( '', LP_ADDON_STRIPE_FILE ),
					'test_mode'   => $this->settings['test_mode']
				);
				wp_localize_script( 'learn-press-stripe', 'learn_press_stripe_info', $data );
			}
		}

		function process_payment( $order ) {
			$this->order = LP_Order::instance( $order );
			$stripe      = $this->send_to_stripe();
			if ( !empty( $stripe->error->message ) ) {
				learn_press_add_notice( $stripe->error->message, 'error' );
				$result = array(
					'result' => 'fail'
				);
			} else {
				$this->order_complete();

				update_post_meta( $this->order->id, '_lp_transaction_id', $stripe->id );
				update_post_meta( $this->order->id, '_lp_key', $this->settings['secret_key'] );
				update_post_meta( $this->order->id, '_lp_auth_capture', $this->settings['capture'] );

				$result = array(
					'result'   => 'success',
					'redirect' => $this->get_return_url( $this->order )
				);
			}
			return $result;
		}

		function order_complete() {

			if ( $this->order->status == 'completed' )
				return;

			$this->order->payment_complete();
			LP()->cart->empty_cart();

			$this->order->add_note(
				sprintf(
					"%s payment completed with Transaction Id of '%s'",
					$this->title,
					$this->charge->id
				)
			);

			LP()->session->order_awaiting_payment = null;
		}

		/**
		 * add Stripe to payment system
		 *
		 * @param $methods
		 *
		 * @return mixed
		 */
		function add_payment( $methods ) {
			$methods[$this->id] = __CLASS__;
			return $methods;
		}

		function get_settings() {
			$settings = new LP_Settings_Base();

			return array(
				array(
					'title'   => __( 'Enable', 'learnpress-stripe' ),
					'id'      => $settings->get_field_name( "{$this->id}[enable]" ),
					'default' => 'no',
					'type'    => 'checkbox'
				),
				array(
					'type'    => 'text',
					'title'   => __( 'Title', 'learnpress-stripe' ),
					'default' => __( 'Stripe', 'learnpress-stripe' ),
					'id'      => $settings->get_field_name( "{$this->id}[title]" ),
					'class'   => 'regular-text'
				),
				array(
					'type'    => 'textarea',
					'title'   => __( 'Description', 'learnpress-stripe' ),
					'default' => __( 'Pay with Credit Card', 'learnpress-stripe' ),
					'id'      => $settings->get_field_name( "{$this->id}[description]" ),
					'editor'  => array(
						'textarea_rows' => 5
					),
					'css'     => 'height: 100px;'
				),
				array(
					'type'    => 'text',
					'title'   => __( 'Live secret key', 'learnpress-stripe' ),
					'default' => '',
					'id'      => $settings->get_field_name( "{$this->id}[live_secret_key]" ),
					'class'   => 'regular-text'
				),
				array(
					'type'    => 'text',
					'title'   => __( 'Live publish key', 'learnpress-stripe' ),
					'default' => '',
					'id'      => $settings->get_field_name( "{$this->id}[live_publish_key]" ),
					'class'   => 'regular-text'
				),
				array(
					'title'   => __( 'Enable test mode', 'learnpress-stripe' ),
					'id'      => $settings->get_field_name( "{$this->id}[test_mode]" ),
					'default' => 'no',
					'type'    => 'checkbox'
				),
				array(
					'type'    => 'text',
					'title'   => __( 'Test secret key', 'learnpress-stripe' ),
					'default' => '',
					'id'      => $settings->get_field_name( "{$this->id}[test_secret_key]" ),
					'class'   => 'regular-text'
				),
				array(
					'type'    => 'text',
					'title'   => __( 'Test publish key', 'learnpress-stripe' ),
					'default' => '',
					'id'      => $settings->get_field_name( "{$this->id}[test_publish_key]" ),
					'class'   => 'regular-text'
				)
			);
		}

		function validate_fields() {
			$posted        = learn_press_get_request( 'learn-press-stripe' );
			$card_number   = !empty( $posted['card_number'] ) ? $posted['card_number'] : null;
			$card_expiry   = !empty( $posted['card_expiry'] ) ? $posted['card_expiry'] : null;
			$card_code     = !empty( $posted['card_code'] ) ? $posted['card_code'] : null;
			$error_message = array();
			if ( empty( $card_number ) ) {
				$error_message[] = __( 'Card number is empty.', 'learnpress-stripe' );
			}
			if ( empty( $card_expiry ) ) {
				$error_message[] = __( 'Card expiry is empty.', 'learnpress-stripe' );
			}
			if ( empty( $card_code ) ) {
				$error_message[] = __( 'Card code is empty.', 'learnpress-stripe' );
			}
			if ( $error = sizeof( $error_message ) ) {
				learn_press_add_notice( sprintf( '<div>%s</div>', join( '</div><div>', $error_message ) ), 'error' );
			}
			$this->posted = $posted;
			return $error ? false : true;
		}

		/**
		 * admin settings page
		 */
		function output_settings() {

			$settings = new LP_Settings_Base();
			foreach ( $this->get_settings() as $field ) {
				$settings->output_field( $field );
			}
		}

		/**
		 * Payment form
		 */
		function get_payment_form() {
			ob_start();
			learn_press_addon_stripe_template( 'form.php' );
			return ob_get_clean();
		}

		/**
		 * Take course
		 *
		 * @param  string $order
		 *
		 * @return object
		 */
		function take_course( $order ) {

		}

		/**
		 * Create order
		 */
		function create_order() {
			_deprecated_function( __FUNCTION__, '1.0' );
			if ( $transaction_object = learn_press_generate_transaction_object() ) {
				$user = learn_press_get_current_user();
				learn_press_delete_transient_transaction( 'lpstripe', $this->charge->id );
				$order_id = learn_press_add_transaction(
					array(
						'order_id'           => 0,
						'method'             => 'stripe',
						'method_id'          => $this->charge->id,
						'status'             => $this->charge->paid ? 'Completed' : 'Pending',
						'user_id'            => $user->ID,
						'transaction_object' => $transaction_object
					)
				);
				return $order_id;
			}
			return false;
		}

		/**
		 * Send to Stripe
		 */
		function send_to_stripe() {
			if ( $this->get_form_data() ) {
				$stripe_charge_data['amount']      = $this->form_data['amount']; // amount in cents
				$stripe_charge_data['currency']    = $this->form_data['currency'];
				$stripe_charge_data['capture']     = 'true';//( $this->settings['charge_type'] == 'capture' ) ? 'true' : 'false';
				$stripe_charge_data['expand[]']    = 'balance_transaction';
				$stripe_charge_data['card']        = $this->form_data['token'];
				$stripe_charge_data['description'] = $this->form_data['description'];

				$charge       = $this->post_data( $stripe_charge_data );
				$this->charge = $charge;
				return $charge;
			}
			return false;
		}

		/**
		 * Get form data
		 */
		function get_form_data() {
			if ( $this->order ) {
				$user            = learn_press_get_current_user();
				$this->form_data = array(
					'amount'      => (float) $this->order->order_total * 100,
					'currency'    => strtolower( learn_press_get_currency() ),
					'token'       => isset( $this->posted['token'] ) ? $this->posted['token'] : '',
					//'chosen_card' => isset( $this->posted[['s4wc_card'] ) ? $_POST['s4wc_card'] : 'new',
					'description' => sprintf( "Charge for %s", $user->user_email ),
					'customer'    => array(
						'name'          => $user->display_name,
						'billing_email' => $user->user_email,
					),
					'errors'      => isset( $this->posted['form_errors'] ) ? $this->posted['form_errors'] : ''
				);
			}
			return $this->form_data;
		}

		/**
		 * Post data and get json
		 *
		 * @param  string $post_data
		 * @param  string $post_location
		 *
		 * @return object
		 */
		function post_data( $post_data, $post_location = 'charges' ) {

			$response = wp_remote_post( $this->api_endpoint . $post_location, array(
				'method'     => 'POST',
				'headers'    => array(
					'Authorization' => 'Basic ' . base64_encode( $this->settings['secret_key'] . ':' ),
				),
				'body'       => $post_data,
				'timeout'    => 70,
				'sslverify'  => false,
				'user-agent' => 'LearnPress Stripe',
			) );
			return $this->parse_response( $response );
		}

		/**
		 * Parse response
		 *
		 * @param  string $response
		 *
		 * @return object
		 * @throws string
		 */
		function parse_response( $response ) {
			if ( is_wp_error( $response ) ) {
				throw new Exception( 'error' );
			}

			if ( empty( $response['body'] ) ) {
				throw new Exception( 'error' );
			}

			$parsed_response = json_decode( $response['body'] );

			/*
			// Handle response
			if ( !empty( $parsed_response->error ) && !empty( $parsed_response->error->code ) ) {
				return false;//throw new Exception( $parsed_response->error->code );
			} elseif ( empty( $parsed_response->id ) ) {
				//throw new Exception( 'error' );
				return false;
			}*/

			return $parsed_response;
		}

		static function instance() {
			if ( !self::$_instance ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		function load_text_domain() {
			if ( function_exists( 'learn_press_load_plugin_text_domain' ) ) {
				learn_press_load_plugin_text_domain( LP_ADDON_STRIPE_PATH, true );
			}
		}
	} // end of class
}
LP_Addon_Payment_Gateway_Stripe::instance();
