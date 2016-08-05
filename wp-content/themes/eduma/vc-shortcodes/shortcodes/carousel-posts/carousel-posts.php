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
function thim_shortcode_carousel_posts( $atts ) {

	$instance = shortcode_atts( array(
		'title'        => '',
		'cat_id'       => 'base',
		'visible_post' => '3',
		'number_posts' => '6',
		'show_nav'    => 'yes',
		'show_pagination'    => 'no',
		'auto_play'    => '0',
		'orderby'    => '',
		'order'    => '',
	), $atts );
	

	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-carousel-post">';
	include( THIM_DIR . 'inc/widgets/carousel-post/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-carousel-posts', 'thim_shortcode_carousel_posts' );


