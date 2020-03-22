<?php
/**
 * Page Customizer Options
 *
 * @package shark_magazine
 */

// Add excerpt section
$wp_customize->add_section( 'shark_magazine_page_section', array(
	'title'             => esc_html__( 'Page Setting','shark-magazine' ),
	'description'       => esc_html__( 'Page Setting Options', 'shark-magazine' ),
	'panel'             => 'shark_magazine_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[sidebar_page_layout]', array(
	'sanitize_callback'   => 'shark_magazine_sanitize_select',
	'default'             => shark_magazine_theme_option('sidebar_page_layout'),
) );

$wp_customize->add_control(  new Shark_Magazine_Radio_Image_Control ( $wp_customize, 'shark_magazine_theme_options[sidebar_page_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'shark-magazine' ),
	'section'             => 'shark_magazine_page_section',
	'choices'			  => shark_magazine_sidebar_position(),
) ) );
