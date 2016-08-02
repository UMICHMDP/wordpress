<?php
$courses->addSubSection( array(
	'name'     => esc_html__( 'Single', 'eduma' ),
	'id'       => 'display_event',
	'position' => 2,
) );

$courses->createOption( array(
	'name'    => esc_html__( 'Layout', 'eduma' ),
	'id'      => 'event_single_layout',
	'type'    => 'radio-image',
	'options' => array(
		'full-content'  => THIM_URI . 'images/admin/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'images/admin/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'images/admin/layout/sidebar-right.png'
	),
	'default' => 'sidebar-right'
) );
