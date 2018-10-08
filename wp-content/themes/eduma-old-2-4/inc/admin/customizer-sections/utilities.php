<?php
$support = $titan->createThimCustomizerSection( array(
	'name'     => esc_html__('Utilities','eduma'),
	'position' => 99,
) );

$support->createOption( array(
	'name'    => esc_html__( 'Import Demo Data', 'eduma' ),
	'id'      => 'enable_import_demo',
	'type'    => 'checkbox',
	"desc"    => esc_html__( 'Enable/Disable', 'eduma' ),
	'default' => true,
) );

$support->createOption( array(
		'name'    => esc_html__( 'Icomoon Icon', 'eduma' ),
		'id'      => 'support_icomoon',
		'type'    => 'checkbox',
		"desc"    => esc_html__( 'Use Icomoon Icon in theme', 'eduma' ),
		'default' => false,
) );