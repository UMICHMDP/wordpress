<?php
/*
Plugin Name: LearnPress WooCommerce Payment Methods
Plugin URI: http://thimpress.com/learnpress
Description: Using the payment system provided by WooCommerce
Author: ThimPress
Version: 1.0.1
Author URI: http://thimpress.com
Tags: learnpress,woocommerce
Text Domain: learnpress-woo-payment
Domain Path: /languages/
Requires at least: 3.8  
Tested up to: 4.5.2
Last updated: 2015-12-01 3:29pm GMT
*/
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
define( 'LP_ADDON_WOOCOMMERCE_PAYMENT_FILE', __FILE__ );
define( 'LP_ADDON_WOOCOMMERCE_PAYMENT_PATH', dirname( __FILE__ ) );
/**
 * Register WooCommerce addon
 */
function learn_press_register_woocommerce_payment() {
	require_once( LP_ADDON_WOOCOMMERCE_PAYMENT_PATH . '/incs/class-lp-woocommerce-payment-gateways.php' );
}

add_action( 'learn_press_ready', 'learn_press_register_woocommerce_payment' );
