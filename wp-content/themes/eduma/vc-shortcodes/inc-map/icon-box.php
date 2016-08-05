<?php

vc_map( array(

	'name'        => esc_html__( 'Thim: Icon Box', 'eduma' ),
	'base'        => 'thim-icon-box',
	'category'    => esc_html__( 'Thim Shortcodes', 'eduma' ),
	'description' => esc_html__( 'Add icon box', 'eduma' ),
	'params'      => array(
		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Title', 'eduma' ),
			'param_name'  => 'title',
			'description' => esc_html__( 'Provide the title for this icon box.', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Title Color', 'eduma' ),
			'param_name'  => 'title_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select the title color.', 'eduma' ),
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Size Heading', 'eduma' ),
			'param_name'  => 'title_size',
			'value'       => array(
				esc_html__( 'h2', 'eduma' ) => 'h2',
				esc_html__( 'h3', 'eduma' ) => 'h3',
				esc_html__( 'h4', 'eduma' ) => 'h4',
				esc_html__( 'h5', 'eduma' ) => 'h5',
				esc_html__( 'h6', 'eduma' ) => 'h6',
			),
			'std'         => 'h3',
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Custom title heading', 'eduma' ),
			'param_name'  => 'title_font_heading',
			'value'       => array(
				esc_html__( 'Default', 'eduma' ) => 'default',
				esc_html__( 'Custom', 'eduma' )  => 'custom',
			),

		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Title Font Size', 'eduma' ),
			'param_name'  => 'title_custom_font_size',
			'std'         => '14',
			'description' => esc_html__( 'Custom title font size. Unit is pixel', 'eduma' ),
			'dependency'  => array(
				'element' => 'title_font_heading',
				'value'   => 'custom',
			),
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Custom Title Font Weight', 'eduma' ),
			'param_name'  => 'title_custom_font_weight',
			'description' => esc_html__( 'Select Custom Title Font Weight', 'eduma' ),
			'value'       => array(
				esc_html__( 'Select', 'eduma' ) => '',
				esc_html__( 'Normal', 'eduma' ) => 'normal',
				esc_html__( 'Bold', 'eduma' )   => 'bold',
				esc_html__( '100', 'eduma' )    => '100',
				esc_html__( '200', 'eduma' )    => '200',
				esc_html__( '300', 'eduma' )    => '300',
				esc_html__( '400', 'eduma' )    => '400',
				esc_html__( '500', 'eduma' )    => '500',
				esc_html__( '600', 'eduma' )    => '600',
				esc_html__( '700', 'eduma' )    => '700',
				esc_html__( '800', 'eduma' )    => '800',
				esc_html__( '900', 'eduma' )    => '900',
			),
			'dependency'  => array(
				'element' => 'title_font_heading',
				'value'   => 'custom',
			),
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Title Margin Top', 'eduma' ),
			'param_name'  => 'title_custom_mg_top',
			'std'         => '0',
			'dependency'  => array(
				'element' => 'title_font_heading',
				'value'   => 'custom',
			),
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Title Margin Bottom', 'eduma' ),
			'param_name'  => 'title_custom_mg_bt',
			'std'         => '0',
			'dependency'  => array(
				'element' => 'title_font_heading',
				'value'   => 'custom',
			),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Show Separator', 'eduma' ),
			'param_name'  => 'line_after_title',
			'std'         => false,
		),

		array(
			'type'        => 'textarea',
			'admin_label' => true,
			'heading'     => esc_html__( 'Description content.', 'eduma' ),
			'param_name'  => 'desc_content',
			'std'         => esc_html__( "Write a short description, that will describe the title or something informational and useful.", 'eduma' ),
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Description Font Size', 'eduma' ),
			'param_name'  => 'custom_font_size_desc',
			'description' => esc_html__( 'Custom description font size. Unit is pixel', 'eduma' ),
			'std'         => '14'
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Custom Title Font Weight', 'eduma' ),
			'param_name'  => 'custom_font_weight_desc',
			'description' => esc_html__( 'Select Custom Title Font Weight', 'eduma' ),
			'value'       => array(
				esc_html__( 'Select', 'eduma' ) => '',
				esc_html__( 'Normal', 'eduma' ) => 'normal',
				esc_html__( 'Bold', 'eduma' )   => 'bold',
				esc_html__( '100', 'eduma' )    => '100',
				esc_html__( '200', 'eduma' )    => '200',
				esc_html__( '300', 'eduma' )    => '300',
				esc_html__( '400', 'eduma' )    => '400',
				esc_html__( '500', 'eduma' )    => '500',
				esc_html__( '600', 'eduma' )    => '600',
				esc_html__( '700', 'eduma' )    => '700',
				esc_html__( '800', 'eduma' )    => '800',
				esc_html__( '900', 'eduma' )    => '900',
			),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Description Color', 'eduma' ),
			'param_name'  => 'color_desc',
			'description' => esc_html__( 'Select the description color.', 'eduma' ),
		),

		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Read more link', 'eduma' ),
			'param_name'  => 'read_more_link',
			'value'       => '',
			'description' => esc_html__( 'Provide the link that will be applied to this icon box.', 'eduma' ),
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Apply read more link to:', 'eduma' ),
			'param_name'  => 'read_more_link_to',
			'description' => esc_html__( 'Select Custom Title Font Weight', 'eduma' ),
			'value'       => array(
				esc_html__( 'Select', 'eduma' ) => '',
				esc_html__( 'Complete Box', 'eduma' )      => 'complete_box',
				esc_html__( 'Box Title', 'eduma' )         => 'title',
				esc_html__( 'Display Read More', 'eduma' ) => 'more',
			),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Show Link To Icon', 'eduma' ),
			'param_name'  => 'link_to_icon',
			'std'         => false,
		),

		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Read more text', 'eduma' ),
			'param_name'  => 'read_more_text',
			'value'       => '',
			'description' => esc_html__( 'Provide text read more.', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Read More Color', 'eduma' ),
			'param_name'  => 'read_more_text_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select the read more color.', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Read More Border Color', 'eduma' ),
			'param_name'  => 'read_more_border_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select the read more border color.', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Read More Background Color', 'eduma' ),
			'param_name'  => 'read_more_bg_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select the read more background color.', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Read more text hover color', 'eduma' ),
			'param_name'  => 'read_more_text_hover_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select the read more text hover color.', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Read More Background Hover Color', 'eduma' ),
			'param_name'  => 'read_more_bg_hover_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select the read more background hover color.', 'eduma' ),
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Icon type', 'eduma' ),
			'param_name'  => 'icon_type',
			'description' => esc_html__( 'Select icon type to display', 'eduma' ),
			'value'       => array(
				esc_html__( 'Select', 'eduma' ) => '',
				esc_html__( 'Font Awesome', 'eduma' ) => 'font-awesome',
				esc_html__( 'Custom Image', 'eduma' ) => 'custom',
			),
		),

		array(
			'type'        => 'iconpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Font Awesome Icon', 'eduma' ),
			'param_name'  => 'font_awesome_icon',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select icon', 'eduma' ),
			'dependency'  => array(
				'element' => 'icon_type',
				'value'   => 'font-awesome',
			),
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Icon Font Size', 'eduma' ),
			'param_name'  => 'font_awesome_icon_size',
			'std'         => '14',
			'description' => esc_html__( 'Custom icon font size. Unit is pixel', 'eduma' ),
			'dependency'  => array(
				'element' => 'icon_type',
				'value'   => 'font-awesome',
			),
		),

		array(
			'type'        => 'attach_image',
			'admin_label' => true,
			'heading'     => esc_html__( 'Image Icon', 'eduma' ),
			'param_name'  => 'custom_image_icon',
			'std'         => '14',
			'description' => esc_html__( 'Select custom image icon', 'eduma' ),
			'dependency'  => array(
				'element' => 'icon_type',
				'value'   => 'custom',
			),
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Width box icon', 'eduma' ),
			'param_name'  => 'width_icon_box',
			'std'         => '100',
			'description' => esc_html__( 'Custom width box icon. Unit is pixel', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Icon color', 'eduma' ),
			'param_name'  => 'icon_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select the icon color.', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Icon border color', 'eduma' ),
			'param_name'  => 'icon_border_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select the icon border color.', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Icon background color', 'eduma' ),
			'param_name'  => 'icon_bg_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select the icon background color.', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Icon hover color', 'eduma' ),
			'param_name'  => 'icon_hover_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select the icon hover color.', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Icon border hover color', 'eduma' ),
			'param_name'  => 'icon_border_hover_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select icon border hover color.', 'eduma' ),
		),

		array(
			'type'        => 'colorpicker',
			'admin_label' => true,
			'heading'     => esc_html__( 'Icon background hover color', 'eduma' ),
			'param_name'  => 'icon_bg_hover_color',
			'value'       => esc_html__( '', 'eduma' ),
			'description' => esc_html__( 'Select the icon background hover color.', 'eduma' ),
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Icon shape', 'eduma' ),
			'param_name'  => 'layout_box_icon_style',
			'value'       => array(
				esc_html__( 'None', 'eduma' )   => '',
				esc_html__( 'Circle', 'eduma' ) => 'circle',
			),
			'std'         => 'circle',
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Box style', 'eduma' ),
			'param_name'  => 'layout_pos',
			'value'       => array(
				esc_html__( 'Select', 'eduma' )        => '',
				esc_html__( 'Icon at Left', 'eduma' )  => 'left',
				esc_html__( 'Icon at Right', 'eduma' ) => 'right',
				esc_html__( 'Icon at Top', 'eduma' )   => 'top',
			),
			'std'         => 'top',
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Text alignment', 'eduma' ),
			'param_name'  => 'layout_text_align_sc',
			'value'       => array(
				esc_html__( 'Select', 'eduma' )         => '',
				esc_html__( 'Text at left', 'eduma' )   => 'text-left',
				esc_html__( 'Text at center', 'eduma' ) => 'text-center',
				esc_html__( 'Text at right', 'eduma' )  => 'text-right',
			),
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Type icon box', 'eduma' ),
			'param_name'  => 'layout_style_box',
			'value'       => array(
				esc_html__( 'Default', 'eduma' )      => '',
				esc_html__( 'Overlay', 'eduma' )      => 'overlay',
				esc_html__( 'Contact Info', 'eduma' ) => 'contact_info',
			),
		),

	)
) );