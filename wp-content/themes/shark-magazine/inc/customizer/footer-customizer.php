<?php
/**
 * Footer Customizer Options
 *
 * @package shark_magazine
 */

// Add footer section
$wp_customize->add_section( 'shark_magazine_footer_section', array(
	'title'             => esc_html__( 'Footer Section','shark-magazine' ),
	'description'       => esc_html__( 'Footer Setting Options', 'shark-magazine' ),
	'panel'             => 'shark_magazine_theme_options_panel',
) );

// slide to top enable setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[slide_to_top]', array(
	'default'           => shark_magazine_theme_option('slide_to_top'),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[slide_to_top]', array(
	'label'             => esc_html__( 'Show Slide to Top', 'shark-magazine' ),
	'section'           => 'shark_magazine_footer_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// copyright text
$wp_customize->add_setting( 'shark_magazine_theme_options[copyright_text]',
	array(
		'default'       		=> shark_magazine_theme_option('copyright_text'),
		'sanitize_callback'		=> 'shark_magazine_santize_allow_tags',
	)
);
$wp_customize->add_control( 'shark_magazine_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'shark-magazine' ),
		'section'    			=> 'shark_magazine_footer_section',
		'type'		 			=> 'textarea',
    )
);
