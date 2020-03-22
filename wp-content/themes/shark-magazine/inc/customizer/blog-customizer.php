<?php
/**
 * Blog / Archive / Search Customizer Options
 *
 * @package shark_magazine
 */

// Add blog section
$wp_customize->add_section( 'shark_magazine_blog_section', array(
	'title'             => esc_html__( 'Blog/Archive Page Setting','shark-magazine' ),
	'description'       => esc_html__( 'Blog/Archive/Search Page Setting Options', 'shark-magazine' ),
	'panel'             => 'shark_magazine_theme_options_panel',
) );

// latest blog title drop down chooser control and setting
$wp_customize->add_setting( 'shark_magazine_theme_options[latest_blog_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> shark_magazine_theme_option( 'latest_blog_title' ),
) );

$wp_customize->add_control( 'shark_magazine_theme_options[latest_blog_title]', array(
	'label'             => esc_html__( 'Latest Blog Title', 'shark-magazine' ),
	'description'       => esc_html__( 'Note: This title is displayed when your homepage displays option is set to latest posts.', 'shark-magazine' ),
	'section'           => 'shark_magazine_blog_section',
	'type'				=> 'text',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[sidebar_layout]', array(
	'sanitize_callback'   => 'shark_magazine_sanitize_select',
	'default'             => shark_magazine_theme_option('sidebar_layout'),
) );

$wp_customize->add_control(  new Shark_Magazine_Radio_Image_Control ( $wp_customize, 'shark_magazine_theme_options[sidebar_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'shark-magazine' ),
	'section'             => 'shark_magazine_blog_section',
	'choices'			  => shark_magazine_sidebar_position(),
) ) );

// column control and setting
$wp_customize->add_setting( 'shark_magazine_theme_options[column_type]', array(
	'default'          	=> shark_magazine_theme_option('column_type'),
	'sanitize_callback' => 'shark_magazine_sanitize_select',
) );

$wp_customize->add_control( 'shark_magazine_theme_options[column_type]', array(
	'label'             => esc_html__( 'Column Layout', 'shark-magazine' ),
	'section'           => 'shark_magazine_blog_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'column-1' 		=> esc_html__( 'One Column', 'shark-magazine' ),
		'column-2' 		=> esc_html__( 'Two Column', 'shark-magazine' ),
	),
) );

// excerpt count control and setting
$wp_customize->add_setting( 'shark_magazine_theme_options[excerpt_count]', array(
	'default'          	=> shark_magazine_theme_option('excerpt_count'),
	'sanitize_callback' => 'shark_magazine_sanitize_number_range',
	'validate_callback' => 'shark_magazine_validate_excerpt_count',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'shark_magazine_theme_options[excerpt_count]', array(
	'label'             => esc_html__( 'Excerpt Length', 'shark-magazine' ),
	'description'       => esc_html__( 'Note: Min 1 & Max 50.', 'shark-magazine' ),
	'section'           => 'shark_magazine_blog_section',
	'type'				=> 'number',
	'input_attrs'		=> array(
		'min'	=> 1,
		'max'	=> 50,
		),
) );

// pagination control and setting
$wp_customize->add_setting( 'shark_magazine_theme_options[pagination_type]', array(
	'default'          	=> shark_magazine_theme_option('pagination_type'),
	'sanitize_callback' => 'shark_magazine_sanitize_select',
) );

$wp_customize->add_control( 'shark_magazine_theme_options[pagination_type]', array(
	'label'             => esc_html__( 'Pagination Type', 'shark-magazine' ),
	'section'           => 'shark_magazine_blog_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'default' 		=> esc_html__( 'Default', 'shark-magazine' ),
		'numeric' 		=> esc_html__( 'Numeric', 'shark-magazine' ),
	),
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[show_date]', array(
	'default'           => shark_magazine_theme_option( 'show_date' ),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[show_date]', array(
	'label'             => esc_html__( 'Show Date', 'shark-magazine' ),
	'section'           => 'shark_magazine_blog_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[show_category]', array(
	'default'           => shark_magazine_theme_option( 'show_category' ),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[show_category]', array(
	'label'             => esc_html__( 'Show Category', 'shark-magazine' ),
	'section'           => 'shark_magazine_blog_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[show_author]', array(
	'default'           => shark_magazine_theme_option( 'show_author' ),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[show_author]', array(
	'label'             => esc_html__( 'Show Author', 'shark-magazine' ),
	'section'           => 'shark_magazine_blog_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );

// Archive comment meta setting and control.
$wp_customize->add_setting( 'shark_magazine_theme_options[show_comment]', array(
	'default'           => shark_magazine_theme_option( 'show_comment' ),
	'sanitize_callback' => 'shark_magazine_sanitize_switch',
) );

$wp_customize->add_control( new Shark_Magazine_Switch_Control( $wp_customize, 'shark_magazine_theme_options[show_comment]', array(
	'label'             => esc_html__( 'Show Comment', 'shark-magazine' ),
	'section'           => 'shark_magazine_blog_section',
	'on_off_label' 		=> shark_magazine_show_options(),
) ) );