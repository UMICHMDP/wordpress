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
function thim_shortcode_courses_collection( $atts ) {

	$instance = shortcode_atts( array(
		'title'         => '',
		'limit'         => '8',
		'columns'       => '3',
		'feature_items' => '2',
	), $atts );


	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-courses-collection">';
	include( THIM_DIR . 'inc/widgets/courses-collection/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-courses-collection', 'thim_shortcode_courses_collection' );


