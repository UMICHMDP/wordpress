<?php
$courses->addSubSection( array(
	'name'     => esc_html__( 'Features', 'eduma' ),
	'id'       => 'learnpress_features',
	'position' => 5,
) );

$courses->createOption( array(
	'name'    => esc_html__( 'One Course ID', 'eduma' ),
	'id'      => 'learnpress_one_course_id',
	'type'    => 'text',
	'desc'    => esc_html__( 'Only use for Demo One Course.', 'eduma' ),
	'default' => '',
) );

$courses->createOption( array(
	'name'    => esc_html__( 'Contact Form 7 Shortcode', 'eduma' ),
	'id'      => 'learnpress_shortcode_contact',
	'type'    => 'text',
	'desc'    => esc_html__( 'Only use for Demo Kindergarten', 'eduma' ),
	'default' => '',
) );

$courses->createOption( array(
	'name'    => esc_html__( 'Timetable Link', 'eduma' ),
	'id'      => 'learnpress_timetable_link',
	'type'    => 'text',
	'desc'    => esc_html__( 'Only use for Demo Kindergarten', 'eduma' ),
	'default' => '',
) );