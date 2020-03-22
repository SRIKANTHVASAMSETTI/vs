<?php
/**
 * Header Customizer Options
 *
 * @package shark_magazine
 */

// Add header section
$wp_customize->add_section( 'shark_magazine_header_section', array(
	'title'             => esc_html__( 'Header Section','shark-magazine' ),
	'panel'             => 'shark_magazine_theme_options_panel',
) );

// header menu enable setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[show_menu_search]', array(
	'default'           => shark_magazine_theme_option('show_menu_search'),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[show_menu_search]', array(
	'label'             => esc_html__( 'Show Search Form', 'shark-magazine' ),
	'section'           => 'shark_magazine_header_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// header menu sticky enable setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[menu_sticky]', array(
	'default'           => shark_magazine_theme_option('menu_sticky'),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[menu_sticky]', array(
	'label'             => esc_html__( 'Primary Menu Sticky', 'shark-magazine' ),
	'section'           => 'shark_magazine_header_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );
