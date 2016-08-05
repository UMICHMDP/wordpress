<?php

vc_map( array(
	'name'        => esc_html__( 'Thim: Our Team', 'eduma' ),
	'base'        => 'thim-our-team',
	'category'    => esc_html__( 'Thim Shortcodes', 'eduma' ),
	'description' => esc_html__( 'Display Our Team.', 'eduma' ),
	'params'      => array(

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Select Category', 'eduma' ),
			'param_name'  => 'cat_id',
			'value'       => thim_sc_get_team_categories(),
			'std'         => 'all',
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Number Posts', 'eduma' ),
			'param_name'  => 'number_post',
			'std'         => '5',
		),


		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Text Link', 'eduma' ),
			'param_name'  => 'text_link',
			'value'       => '',
			'description' => esc_html__( 'Provide the text link that will be applied to box our team.', 'eduma' ),
			'std'         => '',
		),

		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Link Join Team', 'eduma' ),
			'param_name'  => 'link',
			'value'       => '',
			'description' => esc_html__( 'Provide the link that will be applied to box our team', 'eduma' ),
			'std'         => '',
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Enable Link To Member', 'eduma' ),
			'param_name'  => 'link_member',
			'value'       => array( esc_html__( '', 'eduma' ) => 'yes' ),
			'std'         => false,
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Columns', 'eduma' ),
			'param_name'  => 'columns',
			'value'       => array(
				esc_html__( '2', 'eduma' ) => '2',
				esc_html__( '3', 'eduma' ) => '3',
				esc_html__( '4', 'eduma' ) => '4',
			),
			'std'         => '4',
		),

		//Animation
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Animation', 'eduma' ),
			'param_name'  => 'css_animation',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'No', 'eduma' )                 => '',
				esc_html__( 'Top to bottom', 'eduma' )      => 'top-to-bottom',
				esc_html__( 'Bottom to top', 'eduma' )      => 'bottom-to-top',
				esc_html__( 'Left to right', 'eduma' )      => 'left-to-right',
				esc_html__( 'Right to left', 'eduma' )      => 'right-to-left',
				esc_html__( 'Appear from center', 'eduma' ) => 'appear'
			),
			'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'eduma' )
		),
	)
) );