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
function thim_shortcode_video( $atts ) {

	$instance = shortcode_atts( array(
		'video_width'    => '',
		'video_height'   => '',
		'video_type'     => 'vimeo',
		'external_video' => '',
		'youtube_id'     => '',
	), $atts );


	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-video">';
	include( THIM_DIR . 'inc/widgets/video/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-video', 'thim_shortcode_video' );


