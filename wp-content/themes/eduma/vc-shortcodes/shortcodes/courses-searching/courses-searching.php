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
function thim_shortcode_courses_searching( $atts ) {

	$instance = shortcode_atts( array(
		'layout'      => 'base',
		'title'       => esc_html__( 'Search Courses', 'eduma' ),
		'description' => esc_html__( 'Description for search course.', 'eduma' ),
		'placeholder' => esc_html__( 'What do you want to learn today?', 'eduma' ),
	), $atts );


	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-courses-searching">';
	include( THIM_DIR . 'inc/widgets/courses-searching/tpl/' . $instance['layout'] . '-v1.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-courses-searching', 'thim_shortcode_courses_searching' );


