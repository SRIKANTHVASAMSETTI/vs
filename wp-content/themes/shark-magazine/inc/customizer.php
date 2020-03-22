<?php
/**
 * Shark Magazine Theme Customizer
 *
 * @package shark_magazine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shark_magazine_customize_register( $wp_customize ) {
	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/controls.php';

	// Load validation functions.
	require get_template_directory() . '/inc/customizer/validate.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'shark_magazine_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'shark_magazine_customize_partial_blogdescription',
		) );
	}

	// Register custom section types.
	$wp_customize->register_section_type( 'Shark_Magazine_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Shark_Magazine_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Shark Magazine Pro', 'shark-magazine' ),
				'pro_text' => esc_html__( 'Buy Pro', 'shark-magazine' ),
				'pro_url'  => 'http://www.sharkthemes.com/downloads/shark-magazine-pro/',
				'priority'  => 10,
			)
		)
	);

	// Add panel for common Home Page Settings
	$wp_customize->add_panel( 'shark_magazine_theme_options_panel' , array(
	    'title'      => esc_html__( 'Theme Options','shark-magazine' ),
	    'description'=> esc_html__( 'Shark Magazine Theme Options.', 'shark-magazine' ),
	    'priority'   => 100,
	) );

	// topbar settings
	require get_template_directory() . '/inc/customizer/topbar-customizer.php';

	// header settings
	require get_template_directory() . '/inc/customizer/header-customizer.php';

	// slider settings
	require get_template_directory() . '/inc/customizer/slider-customizer.php';

	// footer settings
	require get_template_directory() . '/inc/customizer/footer-customizer.php';
	
	// blog/archive settings
	require get_template_directory() . '/inc/customizer/blog-customizer.php';

	// single settings
	require get_template_directory() . '/inc/customizer/single-customizer.php';

	// page settings
	require get_template_directory() . '/inc/customizer/page-customizer.php';

	// global settings
	require get_template_directory() . '/inc/customizer/global-customizer.php';

	// color settings
	require get_template_directory() . '/inc/customizer/color-customizer.php';

}
add_action( 'customize_register', 'shark_magazine_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function shark_magazine_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function shark_magazine_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function shark_magazine_customize_preview_js() {
	wp_enqueue_script( 'shark-magazine-customizer', get_template_directory_uri() . '/assets/js/customizer' . shark_magazine_min() . '.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'shark_magazine_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function shark_magazine_customize_control_js() {
	// Choose from select jquery.
	wp_enqueue_style( 'jquery-chosen', get_template_directory_uri() . '/assets/css/chosen' . shark_magazine_min() . '.css' );
	wp_enqueue_script( 'jquery-chosen', get_template_directory_uri() . '/assets/js/chosen' . shark_magazine_min() . '.js', array( 'jquery' ), '1.4.2', true );

	// admin script
	wp_enqueue_style( 'shark-magazine-admin-style', get_template_directory_uri() . '/assets/css/admin' . shark_magazine_min() . '.css' );
	wp_enqueue_script( 'shark-magazine-admin-script', get_template_directory_uri() . '/assets/js/admin' . shark_magazine_min() . '.js', array( 'jquery', 'jquery-chosen' ), '1.0.0', true );

	wp_enqueue_style( 'shark-magazine-customizer-style', get_template_directory_uri() . '/assets/css/customizer' . shark_magazine_min() . '.css' );
	wp_enqueue_script( 'shark-magazine-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls' . shark_magazine_min() . '.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'shark_magazine_customize_control_js' );
