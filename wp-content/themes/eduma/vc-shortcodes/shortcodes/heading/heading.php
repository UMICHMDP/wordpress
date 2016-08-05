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
function thim_shortcode_heading( $atts ) {
	$instance       = shortcode_atts( array(
		'title'             => '',
		'size'              => 'h3',
		'textcolor'         => '',
		'font_size'         => '',
		'font_weight'       => '',
		'font_style'        => '',
		'title_custom'      => '',
		'sub_heading'       => '',
		'sub_heading_color' => '',
		'line'              => '',
		'bg_line'           => '',
		'css_animation'     => '',
		'text_align'        => '',
	), $atts );

	$instance['font_heading'] = $instance['title_custom'];
	$instance['custom_font_heading'] = array(
		'custom_font_size' => $instance['font_size'],
		'custom_font_weight' => $instance['font_weight'],
		'custom_font_style' => $instance['font_style'],
	);

	ob_start();
	echo '<div class="thim-widget-heading">';
	include( THIM_DIR . 'inc/widgets/heading/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-heading', 'thim_shortcode_heading' );


