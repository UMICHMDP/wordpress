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
function thim_shortcode_counters_box( $atts ) {

	$instance = shortcode_atts( array(
		'counters_label'   => 'Counters Box',
		'counters_value'   => '20',
		'view_more_text'   => '',
		'view_more_link'   => '',
		'background_color' => '',
		'icon'             => '',
		'border_color'     => '',
		'counter_color'    => '',
		'style'            => 'home-page',
		'css_animation'    => '',
	), $atts );


	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-counters-box">';
	include( THIM_DIR . 'inc/widgets/counters-box/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-counters-box', 'thim_shortcode_counters_box' );


