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
function thim_shortcode_course_categories( $atts ) {

	$instance = shortcode_atts( array(
		'title'                  => '',
		'layout'                 => 'list',
		'slider_limit'           => '15',
		'slider_show_pagination' => false,
		'slider_show_navigation' => true,
		'slider_item_visible'    => '7',
		'slider_auto_play'       => '0',
		'list_show_counts'       => false,
		'list_hierarchical'      => false,
	), $atts );


	$instance['slider-options']['limit'] = $instance['slider_limit'];
	$instance['slider-options']['show_pagination'] = $instance['slider_show_pagination'];
	$instance['slider-options']['show_navigation'] = $instance['slider_show_navigation'];
	$instance['slider-options']['auto_play'] = $instance['slider_auto_play'];
	$instance['list-options']['show_counts'] = $instance['list_show_counts'];
	$instance['list-options']['hierarchical'] = $instance['list_hierarchical'];

	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-course-categories">';
	include( THIM_DIR . 'inc/widgets/course-categories/tpl/' . $instance['layout'] . '-v1.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-course-categories', 'thim_shortcode_course_categories' );


