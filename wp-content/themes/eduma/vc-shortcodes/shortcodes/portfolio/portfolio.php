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
function thim_shortcode_portfolio( $atts ) {

	$instance = shortcode_atts( array(
		'portfolio_category' => '',
		'filter_hiden'       => false,
		'filter_position'    => 'center',
		'column'             => '',
		'gutter'             => false,
		'item_size'          => '',
		'paging'             => '0',
		'style-item'         => 'style01',
		'num_per_view'       => '',
		'show_readmore'      => false,
	), $atts );


	$args                 = array();
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';

	ob_start();
	echo '<div class="thim-widget-portfolio">';
	include( THIM_DIR . 'inc/widgets/portfolio/tpl/base.php' );
	echo '</div>';
	$html_output = ob_get_contents();
	ob_end_clean();

	return $html_output;
}

add_shortcode( 'thim-portfolio', 'thim_shortcode_portfolio' );


