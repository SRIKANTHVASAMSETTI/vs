<?php
/**
 * Footer Customizer Options
 *
 * @package shark_magazine
 */

// theme color content type control and setting
$wp_customize->add_setting( 'shark_magazine_theme_options[theme_color]', array(
	'default'          	=> shark_magazine_theme_option('theme_color'),
	'sanitize_callback' => 'shark_magazine_sanitize_select',
) );

$wp_customize->add_control( 'shark_magazine_theme_options[theme_color]', array(
	'label'             => esc_html__( 'Theme Color Options', 'shark-magazine' ),
	'section'           => 'colors',
	'type'				=> 'radio',
	'choices'			=> array( 
		'default' 	=> esc_html__( 'Default', 'shark-magazine' ),
		'info-tech' => esc_html__( 'Information Technology', 'shark-magazine' ),
	),
) );
