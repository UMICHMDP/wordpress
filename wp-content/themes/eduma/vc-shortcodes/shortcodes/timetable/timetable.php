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
function thim_shortcode_timetable( $atts ) {

	$instance = shortcode_atts( array(
		'title'        => '',
		'panel'       => ''
	), $atts );
	
	$instance['panel'] = (array) vc_param_group_parse_atts($instance['panel']);
	
	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-timetable">';
	include( THIM_DIR . 'inc/widgets/timetable/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-timetable', 'thim_shortcode_timetable' );


