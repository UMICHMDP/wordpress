<?php
/*
Plugin Name: LearnPress Stripe Payment
Plugin URI: http://thimpress.com/learnpress
Description: Stripe payment gateway for LearnPress
Author: ThimPress
Version: 1.0
Author URI: http://thimpress.com
Tags: learnpress
Text Domain: learnpress-stripe
Domain Path: /languages/
*/

define( 'LP_ADDON_STRIPE_FILE', __FILE__ );
define( 'LP_ADDON_STRIPE_PATH', dirname( __FILE__ ) );
define( 'LP_ADDON_STRIPE_TMPL', LP_ADDON_STRIPE_PATH . '/templates/' );

function learn_press_addon_payment_gateway_stripe_load() {
	require_once( LP_ADDON_STRIPE_PATH . '/incs/class-lp-addon-payment-gateway-stripe.php' );
}
add_action( 'learn_press_ready', 'learn_press_addon_payment_gateway_stripe_load' );

