<?php

vc_map( array(
	'name'        => esc_html__( 'Thim: Video', 'eduma' ),
	'base'        => 'thim-video',
	'category'    => esc_html__( 'Thim Shortcodes', 'eduma' ),
	'description' => esc_html__( 'Display video youtube or vimeo.', 'eduma' ),
	'params'      => array(
		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Width video', 'eduma' ),
			'param_name'  => 'video_width',
			'value'       => '',
			'description' => esc_html__( 'Enter width of video. Example 100% or 600. ', 'eduma' )
		),

		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Height video', 'eduma' ),
			'param_name'  => 'video_height',
			'value'       => '',
			'description' => esc_html__( 'Enter height of video. Example 100% or 600.', 'eduma' )
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Video Source', 'eduma' ),
			'param_name'  => 'video_type',
			'value'       => array(
				esc_html__( 'Vimeo', 'eduma' )   => 'vimeo',
				esc_html__( 'Youtube', 'eduma' ) => 'youtube',
			),
			'std'         => 'vimeo',
		),

		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Vimeo Video ID', 'eduma' ),
			'param_name'  => 'external_video',
			'std'         => '61389324',
			'description' => esc_html__( 'Enter vimeo video ID . Example if link video https://player.vimeo.com/video/61389324 then video ID is 61389324 ', 'eduma' ),
			'dependency'  => array(
				'element' => 'video_type',
				'value'   => 'vimeo',
			),
		),

		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Youtube Video ID', 'eduma' ),
			'param_name'  => 'youtube_id',
			'std'         => 'orl1nVy4I6s',
			'description' => esc_html__( 'Enter Youtube video ID . Example if link video https://www.youtube.com/watch?v=orl1nVy4I6s then video ID is orl1nVy4I6s ', 'eduma' ),
			'dependency'  => array(
				'element' => 'video_type',
				'value'   => 'youtube',
			),
		),
	)
) );