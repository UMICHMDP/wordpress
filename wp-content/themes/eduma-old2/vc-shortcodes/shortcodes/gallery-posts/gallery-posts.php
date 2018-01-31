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
function thim_shortcode_gallery_posts( $atts ) {

	$instance = shortcode_atts( array(
		'cat'   => '',
		'columns'   => '4',
		'filter'   => true,
	), $atts );


	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-gallery-posts">';
	include( THIM_DIR . 'inc/widgets/gallery-posts/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-gallery-posts', 'thim_shortcode_gallery_posts' );


