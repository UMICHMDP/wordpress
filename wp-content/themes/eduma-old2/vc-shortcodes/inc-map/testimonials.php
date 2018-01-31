<?php

vc_map( array(
	'name'        => esc_html__( 'Thim: Testimonial', 'eduma' ),
	'base'        => 'thim-testimonials',
	'category'    => esc_html__( 'Thim Shortcodes', 'eduma' ),
	'description' => esc_html__( 'Display testimonials.', 'eduma' ),
	'params'      => array(
		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Title', 'eduma' ),
			'param_name'  => 'title',
			'value'       => '',
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Layout', 'eduma' ),
			'param_name'  => 'layout',
			'value'       => array(
				esc_html__( 'Default', 'eduma' )  => 'default',
				esc_html__( 'Carousel', 'eduma' ) => 'carousel',
			),
			'std'         => 'default',
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Limit Posts', 'eduma' ),
			'param_name'  => 'limit',
			'std'         => '7',
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Items visible', 'eduma' ),
			'param_name'  => 'item_visible',
			'std'         => '5',
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Auto play', 'eduma' ),
			'param_name'  => 'autoplay',
			'value'       => array( esc_html__( '', 'eduma' ) => 'yes' ),
			'std'         => false,
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'default',
			),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Mousewheel Scroll', 'eduma' ),
			'param_name'  => 'mousewheel',
			'value'       => array( esc_html__( '', 'eduma' ) => 'yes' ),
			'std'         => false,
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'default',
			),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Show Pagination', 'eduma' ),
			'param_name'  => 'show_pagination',
			'value'       => array( esc_html__( '', 'eduma' ) => 'yes' ),
			'std'         => false,
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'carousel',
			),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Show Navigation', 'eduma' ),
			'param_name'  => 'show_navigation',
			'value'       => array( esc_html__( '', 'eduma' ) => 'yes' ),
			'std'         => true,
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'carousel',
			),
		),

		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Auto Play Speed (in ms)', 'eduma' ),
			'param_name'  => 'carousel_autoplay',
			'value'       => '',
			'description' => esc_html__( 'Set 0 to disable auto play.', 'eduma' ),
			'std'         => '0',
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'carousel',
			),
		),
	)
) );