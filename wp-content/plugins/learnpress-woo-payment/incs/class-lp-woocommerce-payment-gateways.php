<?php

if ( !function_exists( 'learn_press_woo_is_active' ) ) {
	/**
	 * Check WooCommerce is active
	 *
	 * @return bool
	 */
	function learn_press_woo_is_active() {
		if ( !function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		return class_exists( 'WC_Install' ) && is_plugin_active( 'woocommerce/woocommerce.php' );
	}

}
add_action( 'plugins_loaded', 'learn_press_woocommerce_course' );
function learn_press_woocommerce_course() {
	if ( !learn_press_woo_is_active() ) {
		return;
	}

	/**
	 * Class WC_Product_LPR_Course
	 */
	class WC_Product_LPR_Course extends WC_Product_Simple {

		/**
		 * Get Price Description
		 */
		function get_price() {
			$course = LP_Course::get_course( $this->post->ID );
			return $course ? $course->get_price() : 0;
		}

		/**
		 * Check if a product is purchasable
		 */
		function is_purchasable() {
			return $course = LP_Course::get_course( $this->post->ID );
			return $course ? $course->is( 'purchasable' ) : false;
		}
	}
}

/**
 * Class LP_Payment_Gateway_Woo
 */
class LP_WooCommerce_Payment_Gateways extends LP_Gateway_Abstract {

	/**
	 * @var null
	 */
	protected static $_instance = null;

	/**
	 * Construct function
	 */
	function __construct() {

		$this->id                 = 'woocommerce';
		$this->icon               = apply_filters( 'learn_press_woo_icon', '' );
		$this->method_title       = __( 'WooCommerce', 'learnpress-woo-payment' );
		$this->method_description = __( 'Make a payment with WooCommerce payment methods.', 'learnpress-woo-payment' );

		if ( did_action( __CLASS__ ) ) {
			return;
		}

		add_filter( 'learn_press_payment_method', array( $this, 'add_payment' ) );
		add_action( 'learn_press_section_payments_woocommerce', array( $this, 'payment_settings' ) );
		add_filter( 'learn_press_payment_gateway_available_woocommerce', array( $this, 'is_available' ), 10, 2 );
		add_filter( 'learn_press_display_payment_method', array( $this, 'display_payment_method' ), 10, 2 );
		add_filter( 'woocommerce_product_class', array( $this, 'product_class' ), 10, 4 );
		add_action( 'woocommerce_order_status_changed', array( $this, 'order_status_changed' ), 10, 3 );
		add_action( 'woocommerce_checkout_order_processed', array( $this, 'checkout_order_processed' ), 10, 2 );
		add_filter( 'learn_press_display_payment_method_title', array( $this, 'method_title' ), 10, 2 );

		add_filter( 'learn_press_payment_method_from_slug_woocommerce-payment', array( $this, 'payment_name' ) );


		/*add_filter( 'woocommerce_add_to_cart_handler', array( $this, 'add_to_cart_handler' ), 10, 2 );
		add_action( 'woocommerce_add_to_cart_handler_WC_Product_LPR_Course', array( $this, 'add_to_cart_handler_course' ) );*/


//		add_filter( 'learn_press_take_course_woocommerce', array( $this, 'take_course' ) );
//		add_filter( 'learn_press_payment_method_from_slug_woocommerce-payment', array( $this, 'payment_name' ) );
//		add_filter( 'learn_press_print_payment_woocommerce', array( $this, 'print_form' ) );
//
//
//		add_action( 'learn_press_save_payment_woo', array( $this, 'save_payment_woo' ) );
//		add_action( 'learn_press_payment_gateway_form_woo', array( $this, 'woo_payment_form' ) );
//		add_action( 'woocommerce_new_order', array( $this, 'add_order' ) );
//		add_action( 'learn_press_before_payment_loop', array( $this, 'print_payment_methods' ) );
//
//		add_filter( 'learn_press_available_payment_gateways', array( $this, 'get_woocommerce_payments' ) );
//		add_filter( 'learn_press_loop_payment_method_form', array( $this, 'payment_method_form' ) );

		learn_press_enqueue_script( $this->get_script() );

		$this->load_text_domain();
		do_action( __CLASS__ );
	}

	function method_title( $title, $id ) {
		if ( $id == $this->id ) {
			$title = "WooCommerce - {$title}";
		}
		return $title;
	}

	function checkout_order_processed( $order_id, $posted ) {
		if ( ( $lp_order_id = LP()->session->order_awaiting_payment ) ) {
			// map LP order key with WC order key
			$map_keys = array(
				'_order_currency'       => '_order_currency',
				'_user_id'              => '_customer_user',
				'_order_subtotal'       => '_order_total',
				'_order_total'          => '_order_total',
				'_payment_method_id'    => '_payment_method',
				'_payment_method_title' => '_payment_method_title'
			);

			foreach ( $map_keys as $k => $v ) {
				update_post_meta( $lp_order_id, $k, get_post_meta( $order_id, $v, true ) );
			}
			update_post_meta( $order_id, '_learn_press_order_id', $lp_order_id );
		}
	}

	function display_payment_method( $display, $id ) {
		if ( $id == $this->id ) {

			$this->print_form();

			$display = false;
		}
		return $display;
	}

	function get_woocommerce_payments( $p ) {

		return $p;
	}

	function __get( $key ) {
		switch ( $key ) {
			case 'title':
				return 'xxx';
			case
			'description':
				return 'yyy';
			default:
				return parent::_get( $key );
		}
	}

	/**
	 * Get Script
	 */
	function get_script() {
		ob_start();
		?>
		<script>
			;
			(function () {
				var $form = $('#learn-press-checkout');
				$form.on('learn_press_checkout_place_order', function () {
					var chosen = $('input[type="radio"]:checked', $form);
					$form.find('input[name="woocommerce_chosen_method"]').remove();
					if (chosen.val() == 'woocommerce') {
						$form.append('<input type="hidden" name="woocommerce_chosen_method" value="' + chosen.data('method') + '"/>');
					}
				});
			})();
		</script>
		<?php
		$script = ob_get_clean();
		return preg_replace( '!</?script>!', '', $script );
	}

	/**
	 * Print form
	 */
	function print_form() {
		$payment_gateways = WC()->payment_gateways()->get_available_payment_gateways();
		if ( $payment_gateways ) foreach ( $payment_gateways as $payment_gateway ) {
			$slug    = "woo";
			$checked = checked( WC()->session->get( 'chosen_payment_method' ) == $payment_gateway->id ? true : false, true, false );
			?>
			<li class="learn_press_woo_payment_methods">
				<label>
					<input id="payment_method_<?php echo $payment_gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="woocommerce" data-method="<?php echo esc_attr( $payment_gateway->id ); ?>" <?php checked( LP()->session->get( 'chosen_payment_method' ) == $payment_gateway->id, true ); ?> data-order_button_text="<?php echo esc_attr( $payment_gateway->order_button_text ); ?>" />
					<?php echo( $payment_gateway->get_title() ); ?>
				</label>
				<?php if ( $payment_form = $payment_gateway->get_description() ) { ?>
					<div class="payment-method-form payment_method_<?php echo $payment_gateway->id; ?>"><?php echo $payment_form; ?></div>
				<?php } ?>
			</li>

			<?php
		}
		return false;
	}

	function print_payment_methods() {

	}

	/**
	 * Payment Name
	 */
	function payment_name( $slug ) {
		return 'WooCommerce Payment';
	}

	/**
	 * Add Woo payment
	 */
	function add_payment( $methods ) {
		$methods['woocommerce'] = 'LP_WooCommerce_Payment_Gateways';
		return $methods;
	}

	/**
	 * Enable Woo Payment
	 */
	function is_available( $available, $gateway ) {
		return LP()->settings->get( 'woocommerce.enable' ) == 'yes' && sizeof( WC()->payment_gateways()->get_available_payment_gateways() );
	}

	/**
	 * Woo Payment output
	 */
	function payment_settings() {
		$settings = new LP_Settings_Base();
		foreach ( $this->get_settings() as $field ) {
			$settings->output_field( $field );
		}
	}

	/**
	 * Save payment
	 */
	function save_payment_woo() {
		$settings = LPR_Admin_Settings::instance( 'payment' );

		$post_data = !empty( $_POST['lpr_settings'] ) ? $_POST['lpr_settings']['woo'] : array();
		$settings->set( 'woo', $post_data );
		$settings->update();
	}

	/**
	 * Add to cart
	 *
	 * @param string - product type
	 * @param object - product object
	 *
	 * @return string
	 */
	function add_to_cart_handler( $type, $product ) {
		if ( get_post_type( $product->id ) == 'lp_course' ) {
			$type = 'WC_Product_LPR_Course';
		}
		return $type;
	}

	function validate_fields() {
		return true;
	}

	/**
	 * Woo Payment Form
	 */
	function woo_payment_form() {
		_e( 'Pay with WooCommerce payment system', 'learnpress_woo_payment' );
	}

	private function _get_payment_method() {
		$method             = !empty( $_REQUEST['payment_method'] ) ? $_REQUEST['payment_method'] : '';
		$woocommerce_method = !empty( $_REQUEST['woocommerce_chosen_method'] ) ? $_REQUEST['woocommerce_chosen_method'] : '';
		if ( ( $method != 'woocommerce' ) || !$woocommerce_method ) {
			return false;
		}
		return $woocommerce_method;
	}

	/**
	 * Take course
	 */
	function take_course( $order ) {

		$method = $this->_get_payment_method();
		if ( !$method ) {
			return false;
		}

		WC()->session->set( 'chosen_payment_method', $method );

		$this->add_to_cart_handler_course();

		$url = false;
		$url = apply_filters( 'woocommerce_add_to_cart_redirect', $url );

		// If has custom URL redirect there
		if ( !$url ) {
			$url = WC()->cart->get_checkout_url();
		}
		if ( $url ) {
			$json = array(
				'result'   => 'success',
				'redirect' => $url
			);
		} else {
			$json = array(
				'result'  => 'fail',
				'message' => __( 'WooCommerce checkout page is not setting up!', 'learnpress_woo_payment' )
			);
		}

		return $json;
	}

	/**
	 * Add course cart handler
	 */
	function add_to_cart_handler_course() {

		$items = LP()->cart->get_items();
		if ( $items ) {
			WC()->cart->empty_cart( true );
			foreach ( $items as $product_id => $item ) {
				if ( $product_id && get_post_type( $product_id ) == 'lp_course' ) {
					if ( WC()->cart->add_to_cart( $product_id, 1 ) ) {
					}
				}
			}
			//learn_press_debug($items);
		}
	}

	/**
	 * Process the payment and return the result
	 *
	 * @param int $order_id
	 *
	 * @return array
	 */
	public function process_payment( $order_id ) {

		$method = $this->_get_payment_method();
		if ( !$method ) {
			return false;
		}

		WC()->session->set( 'chosen_payment_method', $method );

		$this->add_to_cart_handler_course();

		$url = false;
		$url = apply_filters( 'woocommerce_add_to_cart_redirect', $url );

		// If has custom URL redirect there
		if ( !$url ) {
			$url = WC()->cart->get_checkout_url();
		}
		if ( $url ) {
			$json = array(
				'result'   => 'success',
				'redirect' => $url
			);
		} else {
			$json = array(
				'result'  => 'fail',
				'message' => __( 'WooCommerce checkout page is not setting up!', 'learnpress_woo_payment' )
			);
		}
		return $json;

		$order = learn_press_get_order( $order_id );


		// Return thankyou redirect
		return array(
			'result'   => 'success',
			'redirect' => $this->get_return_url( $order )
		);
	}

	/**
	 * Check if a course is purchasable
	 *
	 * @param  bool   $is_purchasable
	 * @param  string $product
	 *
	 * @return bool
	 */
	function is_purchasable_course( $is_purchasable, $product ) {
		if ( 'lpr_course' == get_post_type( $product->post->ID ) ) {
			$is_purchasable = true;
		}
		return $is_purchasable;
	}

	/**
	 * Change product class
	 *
	 * @param  string $classname
	 * @param  string $product_type
	 * @param  string $post_type
	 * @param  string $product_id
	 *
	 * @return string
	 */
	function product_class( $classname, $product_type, $post_type, $product_id ) {
		if ( 'lp_course' == $post_type ) {
			$classname = 'WC_Product_LPR_Course';
		}
		return $classname;
	}

	/**
	 * Add new order
	 *
	 * @param int $order_id
	 */
	function add_order( $order_id ) {
		$order          = wc_get_order( $order_id );
		$transaction_id = $order->get_transaction_id();
		$user_id        = $order->customer_user;
		$status         = $order->get_status();
		$lpr_order_id   = get_post_meta( $order_id, '_learn_press_order_id', true );
		$lpr_order_id   = learn_press_add_transaction(
			array(
				'order_id'           => $lpr_order_id,
				'method'             => 'woocommerce-payment',
				'method_id'          => $transaction_id,
				'status'             => '',
				'user_id'            => $user_id,
				'transaction_object' => learn_press_generate_transaction_object()
			)
		);
		if ( $lpr_order_id ) {
			update_post_meta( $order_id, '_learn_press_order_id', $lpr_order_id );
			update_post_meta( $lpr_order_id, '_wc_order_id', $order_id );
		}
	}

	/**
	 * Update order status
	 *
	 * @param  int  $order_id
	 * @param  char $old_status
	 * @param  char $new_status
	 */
	function order_status_changed( $order_id, $old_status, $new_status ) {
		$wc_order = wc_get_order( $order_id );
		if ( $lp_order_id = get_post_meta( $order_id, '_learn_press_order_id', true ) ) {
			$order = LP_Order::instance( $lp_order_id );
			if ( $order ) {
				$order->update_status( $new_status );
			}
		}
	}

	function get_settings() {
		$settings               = new LP_Settings_Base();
		$available_payment_html = '';

		$available_gateways = (array) WC()->payment_gateways()->get_available_payment_gateways();
		$payment_gateways   = WC()->payment_gateways()->payment_gateways();

		ob_start();

		if ( $payment_gateways ) foreach ( $payment_gateways as $payment_gateway ) {
			?>
			<li class="learn_press_woo_payment_methods">
				<label>
					<input type="checkbox" disabled="disabled" class="input-radio" name="woocommerce_available_payment_method" <?php checked( isset( $available_gateways[$payment_gateway->id] ), true ); ?> />
					<a href="<?php echo admin_url( 'admin.php?page=wc-settings&tab=checkout&section=wc_gateway_' . $payment_gateway->id ); ?>" target="_blank"> <?php echo( $payment_gateway->method_title ); ?> </a>
				</label>
			</li>
			<?php
		}
		$available_payment_html .= ob_get_clean();

		return
			array(
				array(
					'title'   => __( 'Enable', 'learnpress-woo-payment' ),
					'id'      => $settings->get_field_name( 'woocommerce[enable]' ),
					'default' => 'no',
					'type'    => 'checkbox'
				),
				array(
					'title'   => __( 'WooCommerce Payments', 'learnpress-woo-payment' ),
					'id'      => $settings->get_field_name( 'woocommerce[available_payments]' ),
					'default' => '',
					'type'    => 'html',
					'desc'    => __( 'Click on a payment method to go to WooCommerce Payment settings', 'learnpress-woo-payment' ),
					'html'    => $available_payment_html ? sprintf( '<ul>%s</ul>', $available_payment_html ) : ''
				)
			);
	}

	static function instance() {
		if ( !self::$_instance ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function load_text_domain() {
		if ( function_exists( 'learn_press_load_plugin_text_domain' ) ) {
			learn_press_load_plugin_text_domain( LP_ADDON_WOOCOMMERCE_PAYMENT_PATH, true );
		}
	}

	static function init() {
		add_action( 'init', array( __CLASS__, 'instance' ) );
	}
}

LP_WooCommerce_Payment_Gateways::init();

