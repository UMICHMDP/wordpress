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
function thim_shortcode_gallery_images( $atts ) {

	$instance = shortcode_atts( array(
		'image'           => '',
		'image_size'      => '',
		'image_link'      => '',
		'number'          => '4',
		'item_tablet'     => '2',
		'item_mobile'     => '1',
		'show_pagination' => '',
		'link_target'     => '',
		'css_animation'   => '',
	), $atts );


	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-gallery-images">';
	include( THIM_DIR . 'inc/widgets/gallery-images/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-gallery-images', 'thim_shortcode_gallery_images' );


