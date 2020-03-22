<?php
/**
 * Slider Customizer Options
 *
 * @package shark_magazine
 */

// Add slider section
$wp_customize->add_section( 'shark_magazine_slider_section', array(
	'title'             => esc_html__( 'Featured Slider Section','shark-magazine' ),
	'description'       => esc_html__( 'Featured Slider Setting Options', 'shark-magazine' ),
	'panel'             => 'shark_magazine_theme_options_panel',
) );

// slider menu enable setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[enable_slider]', array(
	'default'           => shark_magazine_theme_option('enable_slider'),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[enable_slider]', array(
	'label'             => esc_html__( 'Enable Slider', 'shark-magazine' ),
	'section'           => 'shark_magazine_slider_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// slider social menu enable setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[slider_entire_site]', array(
	'default'           => shark_magazine_theme_option('slider_entire_site'),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[slider_entire_site]', array(
	'label'             => esc_html__( 'Show Entire Site', 'shark-magazine' ),
	'section'           => 'shark_magazine_slider_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// slider arrow control enable setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[slider_arrow]', array(
	'default'           => shark_magazine_theme_option('slider_arrow'),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[slider_arrow]', array(
	'label'             => esc_html__( 'Show Arrow Controller', 'shark-magazine' ),
	'section'           => 'shark_magazine_slider_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// slider auto slide control enable setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[slider_auto_slide]', array(
	'default'           => shark_magazine_theme_option('slider_auto_slide'),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[slider_auto_slide]', array(
	'label'             => esc_html__( 'Enable Auto Slide', 'shark-magazine' ),
	'section'           => 'shark_magazine_slider_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// slider category drop down chooser control and setting
$wp_customize->add_setting( 'shark_magazine_theme_options[slider_content_category]', array(
	'sanitize_callback' => 'shark_magazine_sanitize_category',
) );

$wp_customize->add_control( new Shark_Magazine_Dropdown_Chosen_Control( $wp_customize, 'shark_magazine_theme_options[slider_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'shark-magazine' ),
	'description'       => esc_html__( 'Note: Four latest posts from the selected category will be shown.', 'shark-magazine' ),
	'section'           => 'shark_magazine_slider_section',
	'choices'			=> shark_magazine_category_choices(),
) ) );
