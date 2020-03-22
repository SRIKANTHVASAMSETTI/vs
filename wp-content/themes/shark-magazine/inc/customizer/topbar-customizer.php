<?php
/**
 * Topbar Customizer Options
 *
 * @package shark_magazine
 */

// Add topbar section
$wp_customize->add_section( 'shark_magazine_topbar_section', array(
	'title'             => esc_html__( 'Top Bar Section','shark-magazine' ),
	'description'       => sprintf( '%1$s <a class="menu_locations" href="#"> %2$s </a> %3$s', esc_html__( 'Note: To show topbar menu.', 'shark-magazine' ), esc_html__( 'Click Here', 'shark-magazine' ), esc_html__( 'to create menu.', 'shark-magazine' ) ),
	'panel'             => 'shark_magazine_theme_options_panel',
) );

// topbar menu enable setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[show_topbar_menu]', array(
	'default'           => shark_magazine_theme_option('show_topbar_menu'),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[show_topbar_menu]', array(
	'label'             => esc_html__( 'Show Top Bar Menu', 'shark-magazine' ),
	'section'           => 'shark_magazine_topbar_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// topbar social menu enable setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[show_social_menu]', array(
	'default'           => shark_magazine_theme_option('show_social_menu'),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[show_social_menu]', array(
	'label'             => esc_html__( 'Show Social Menu', 'shark-magazine' ),
	'section'           => 'shark_magazine_topbar_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// topbar social menu date enable setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[show_menu_date]', array(
	'default'           => shark_magazine_theme_option('show_menu_date'),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[show_menu_date]', array(
	'label'             => esc_html__( 'Show Date', 'shark-magazine' ),
	'section'           => 'shark_magazine_topbar_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );
