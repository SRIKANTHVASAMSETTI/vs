<?php
/**
 * Global Customizer Options
 *
 * @package shark_magazine
 */

// Add Global section
$wp_customize->add_section( 'shark_magazine_global_section', array(
	'title'             => esc_html__( 'Global Setting','shark-magazine' ),
	'description'       => esc_html__( 'Global Setting Options', 'shark-magazine' ),
	'panel'             => 'shark_magazine_theme_options_panel',
) );

// site layout setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[site_layout]', array(
	'sanitize_callback'   => 'shark_magazine_sanitize_select',
	'default'             => shark_magazine_theme_option('site_layout'),
) );

$wp_customize->add_control(  new Shark_Magazine_Radio_Image_Control ( $wp_customize, 'shark_magazine_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'shark-magazine' ),
	'section'             => 'shark_magazine_global_section',
	'choices'			  => shark_magazine_site_layout(),
) ) );

// loader setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[enable_loader]', array(
	'default'           => shark_magazine_theme_option( 'enable_loader' ),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[enable_loader]', array(
	'label'             => esc_html__( 'Enable Loader', 'shark-magazine' ),
	'section'           => 'shark_magazine_global_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// loader type control and setting
$wp_customize->add_setting( 'shark_magazine_theme_options[loader_type]', array(
	'default'          	=> shark_magazine_theme_option('loader_type'),
	'sanitize_callback' => 'shark_magazine_sanitize_select',
) );

$wp_customize->add_control( 'shark_magazine_theme_options[loader_type]', array(
	'label'             => esc_html__( 'Loader Type', 'shark-magazine' ),
	'section'           => 'shark_magazine_global_section',
	'type'				=> 'select',
	'choices'			=> shark_magazine_get_spinner_list(),
) );

// Date Format in homepage setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[homepage_date_format]', array(
	'default'          	=> shark_magazine_theme_option('homepage_date_format'),
	'sanitize_callback' => 'shark_magazine_sanitize_select',
) );

$wp_customize->add_control( 'shark_magazine_theme_options[homepage_date_format]', array(
	'label'             => esc_html__( 'Homepage/Widgets Date Format', 'shark-magazine' ),
	'section'           => 'shark_magazine_global_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'human_time_diff' 	=> esc_html__( 'Human Time Difference', 'shark-magazine' ),
		'normal_date' 		=> esc_html__( 'Normal Date', 'shark-magazine' ),
	),
) );
