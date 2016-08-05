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
function thim_shortcode_list_events( $atts ) {

	//var_dump($atts);

	$instance = shortcode_atts( array(
		'title'        => '',
		'layout'       => 'base',
		'number_posts' => '2',
		'text_link'    => '',
	), $atts );

	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	//var_dump($instance);

	if ( $instance['layout'] ) {
		ob_start();
		include( THIM_DIR . 'inc/widgets/list-event/tpl/' . $instance['layout'] . '.php' );
		$html_output = ob_get_contents();
		ob_end_clean();
	} else {
		$html_output = 'This shortcode is missing';
	}

	return $html_output;
}

add_shortcode( 'thim-list-events', 'thim_shortcode_list_events' );


