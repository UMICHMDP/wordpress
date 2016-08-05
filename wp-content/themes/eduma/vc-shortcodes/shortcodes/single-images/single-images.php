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
function thim_shortcode_single_images( $atts ) {

	$instance = shortcode_atts( array(
		'image'        => '',
		'image_size'       => 'full',
		'image_link' => '',
		'link_target' => '_self',
		'image_alignment'    => '',
		'css_animation'    => '',
	), $atts );
	

	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-single-images">';
	include( THIM_DIR . 'inc/widgets/single-images/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-single-images', 'thim_shortcode_single_images' );


