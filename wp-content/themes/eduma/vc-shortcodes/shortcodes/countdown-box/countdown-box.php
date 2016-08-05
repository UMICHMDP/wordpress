<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shortcode Heading
 *
 * @param $atts
 *
 * @return string
 */
function thim_shortcode_countdown_box( $atts ) {

	$instance = shortcode_atts( array(
		'text_days'    => esc_html__( 'days', 'eduma' ),
		'text_hours'   => esc_html__( 'hours', 'eduma' ),
		'text_minutes' => esc_html__( 'minutes', 'eduma' ),
		'text_seconds' => esc_html__( 'seconds', 'eduma' ),
		'time_year'    => '',
		'time_month'   => '',
		'time_day'     => '',
		'time_hour'    => '',
		'style_color'  => '',
		'text_align'   => '',
	), $atts );


	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-countdown-box">';
	include( THIM_DIR . 'inc/widgets/countdown-box/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-countdown-box', 'thim_shortcode_countdown_box' );


