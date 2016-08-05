<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'THIM_Testimonials' ) ) {
	return;
}

/**
 * Shortcode Heading
 *
 * @param $atts
 *
 * @return string
 */
function thim_shortcode_testimonials( $atts ) {

	$instance = shortcode_atts( array(
		'title'             => '',
		'layout'            => 'default',
		'limit'             => '7',
		'item_visible'      => '5',
		'autoplay'          => false,
		'mousewheel'        => false,
		'show_pagination'   => false,
		'show_navigation'   => true,
		'carousel_autoplay' => '0',
	), $atts );


	$instance['carousel-options']['auto_play']       = $instance['carousel_autoplay'];
	$instance['carousel-options']['show_pagination'] = $instance['show_pagination'];
	$instance['carousel-options']['show_navigation'] = $instance['show_navigation'];

	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-testimonials">';
	if ( !empty( $instance['layout'] ) && $instance['layout'] === 'carousel' ) {
		include( THIM_DIR . 'inc/widgets/testimonials/tpl/carousel.php' );
	} else {
		include( THIM_DIR . 'inc/widgets/testimonials/tpl/base.php' );
	}

	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-testimonials', 'thim_shortcode_testimonials' );


