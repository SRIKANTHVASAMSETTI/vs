<?php
/**
 * Default Theme Customizer Values
 *
 * @package shark_magazine
 */

function shark_magazine_get_default_theme_options() {
	$shark_magazine_default_options = array(
		// default options

		// Top Bar
		'show_topbar_menu'		=> false,
		'show_social_menu'		=> false,
		'show_menu_date'		=> true,

		// Header 
		'show_menu_search'		=> true,
		'menu_sticky'			=> false,

		// Slider
		'enable_slider'			=> true,
		'slider_entire_site'	=> false,
		'slider_auto_slide'		=> false,
		'slider_arrow'			=> true,
		'slider_column_layout'	=> 4,

		// Footer
		'slide_to_top'			=> true,
		'copyright_text'		=> esc_html__( 'Copyright &copy; 2019 | All Rights Reserved', 'shark-magazine' ),

		// blog / archive
		'latest_blog_title'		=> esc_html__( 'Blogs', 'shark-magazine' ),
		'excerpt_count'			=> 25,
		'pagination_type'		=> 'numeric',
		'sidebar_layout'		=> 'right-sidebar',
		'column_type'			=> 'column-2',
		'show_date'				=> true,
		'show_category'			=> true,
		'show_author'			=> true,
		'show_comment'			=> true,

		// single post
		'sidebar_single_layout'	=> 'right-sidebar',
		'show_single_date'		=> true,
		'show_single_category'	=> true,
		'show_single_tags'		=> true,
		'show_single_author'	=> true,

		// page
		'sidebar_page_layout'	=> 'right-sidebar',

		// global
		'enable_loader'			=> true,
		'loader_type'			=> 'spinner-dots',
		'site_layout'			=> 'full',
		'homepage_date_format'	=> 'human_time_diff',

		// theme color
		'theme_color'			=> 'default',
	);

	$output = apply_filters( 'shark_magazine_default_theme_options', $shark_magazine_default_options );
	return $output;
}