<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'THIM_Our_Team' ) ) {
	return;
}

/**
 * Shortcode Heading
 *
 * @param $atts
 *
 * @return string
 */
function thim_shortcode_our_team( $atts ) {

	$instance = shortcode_atts( array(
		'cat_id'        => 'all',
		'number_post'   => '5',
		'text_link'     => '',
		'link'          => '',
		'link_member'   => false,
		'columns'       => '4',
		'css_animation' => '',
	), $atts );


	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-our-team">';
	include( THIM_DIR . 'inc/widgets/our-team/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-our-team', 'thim_shortcode_our_team' );


