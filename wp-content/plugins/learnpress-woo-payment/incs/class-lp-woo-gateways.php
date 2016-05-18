<?php

/**
 * Cash on Delivery Gateway
 *
 * Provides a Cash on Delivery Payment Gateway.
 *
 */
class LP_Woo_Gateways extends LP_Gateway_Abstract {

	/**
	 * Constructor for the gateway.
	 */
	public function __construct() {
		$this->id                 = 'woo';
		$this->icon               = apply_filters( 'learn_press_woo_icon', '' );
		$this->method_title       = __( 'WooCommerce Payment', 'learnpress-woo-payment' );
		$this->method_description = __( 'Make a payment with WooCommerce payment methods.', 'learnpress-woo-payment' );

		add_action( 'learn_press_section_payments_cod', array( $this, 'payment_settings' ) );
		add_action( 'learn_press_order_received', array( $this, 'instructions' ), 99 );
		add_filter( 'learn_press_take_course_' . $this->id, array( $this, 'take_course' ) );

	}

	function take_course() {
		if ( $transaction_object = learn_press_generate_transaction_object() ) {
			$user = learn_press_get_current_user();

			$order_id = learn_press_add_transaction(
				array(
					'order_id'           => 0,
					'method'             => $this->slug,
					'method_id'          => 0,
					'status'             => 'Pending',
					'user_id'            => $user->ID,
					'transaction_object' => $transaction_object
				)
			);
			learn_press_add_message( 'success', __( 'Thank you! Your order has been completed!' ) );
			learn_press_send_json(
				array(
					'result'   => 'success',
					'redirect' => learn_press_get_order_confirm_url( $order_id )
				)
			);

		}
		return array(
			'result'   => 'error',
			'redirect' => ''
		);
	}

	/**
	 * Process the payment and return the result
	 *
	 * @param int $order_id
	 *
	 * @return array
	 */
	public function process_payment( $order_id ) {

		$order = learn_press_get_order( $order_id );

		$order->update_status( 'processing', __( 'Order placed.', 'learnpress-woo-payment' ) );


		// Remove cart
		LP()->cart->empty_cart();

		// Return thankyou redirect
		return array(
			'result'   => 'success',
			'redirect' => $this->get_return_url( $order )
		);
	}

	/**
	 * Output for the order received page.
	 */
	public function instructions( $order ) {
		if ( $order && ( $this->id == $order->payment_method ) && $this->instructions ) {
			echo stripcslashes( wpautop( wptexturize( $this->instructions ) ) );
		}
	}

	function get_settings() {
		$settings = new LP_Settings_Base();
		return
			array(
				array(
					'title'   => __( 'Enable', 'learnpress-woo-payment' ),
					'id'      => $settings->get_field_name( 'cod[enable]' ),
					'default' => 'no',
					'type'    => 'checkbox'
				),
				array(
					'title'   => __( 'Title', 'learnpress-woo-payment' ),
					'id'      => $settings->get_field_name( 'cod[title]' ),
					'default' => $this->title,
					'type'    => 'text',
					'class'   => 'regular-text'
				),
				array(
					'title'   => __( 'Description', 'learnpress-woo-payment' ),
					'id'      => $settings->get_field_name( 'cod[description]' ),
					'default' => $this->description,
					'type'    => 'textarea',
					'css'     => 'width: 100%; height: 100px;'
				),
				array(
					'title'   => __( 'Instructions', 'learnpress-woo-payment' ),
					'id'      => $settings->get_field_name( 'cod[instructions]' ),
					'default' => '',
					'type'    => 'textarea',
					'css'     => 'width: 100%; height: 100px;',
					'editor'  => true,
					'desc'=> __( 'Some instructions to user, e.g: What need to do next in order to complete the order.', 'learnpress-woo-payment' )
				),
			);
	}

	function get_title() {
		return LP_Settings::instance()->get( 'cod_title' );
	}

	function payment_settings() {
		$settings = new LP_Settings_Base();
		foreach ( $this->get_settings() as $field ) {
			$settings->output_field( $field );
		}
	}

	function get_payment_form() {
		return LP_Settings::instance()->get( 'cod_description' );
	}

	static function add_payment( $gateways ) {
		$gateways['cod'] = 'LP_Gateway_COD';
		return $gateways;
	}
}