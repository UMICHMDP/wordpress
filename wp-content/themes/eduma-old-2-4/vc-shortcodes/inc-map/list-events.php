<?php

vc_map( array(

	'name'        => esc_html__( 'Thim: List Events', 'eduma' ),
	'base'        => 'thim-list-events',
	'category'    => esc_html__( 'Thim Shortcodes', 'eduma' ),
	'description' => esc_html__( 'Display List Events.', 'eduma' ),
	'params'      => array(
		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Title', 'eduma' ),
			'param_name'  => 'title',
			'value'       => '',
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Number events display', 'eduma' ),
			'param_name'  => 'number_posts',
			'std'         => '2',
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Layout', 'eduma' ),
			'param_name'  => 'layout',
			'value'       => array(
				__( 'Default', 'eduma' )  => 'base',
				__( 'Layout 2', 'eduma' ) => 'layout-2',
			),
			'std'         => 'base',
		),

		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Text View All', 'eduma' ),
			'param_name'  => 'text_link',
			'std'         => esc_html__( 'View All', 'eduma' ),
		),

	)
) );