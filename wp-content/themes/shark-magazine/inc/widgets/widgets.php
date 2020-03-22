<?php
/**
 * Register Widgets
 *
 * @package shark_magazine
 */

/**
 * Load dynamic logic for the widgets.
 */
function shark_magazine_widget_js( $hook ) {
	if ( 'widgets.php' === $hook ) :
		wp_enqueue_script( 'media-upload' );
	   	wp_enqueue_media();
	   	
		// Choose from select jquery.
		wp_enqueue_style( 'shark-magazine-admin-css', get_template_directory_uri() . '/assets/css/admin' . shark_magazine_min() . '.css' );
		wp_enqueue_style( 'jquery-chosen-css', get_template_directory_uri() . '/assets/css/chosen' . shark_magazine_min() . '.css' );
		wp_enqueue_script( 'jquery-chosen', get_template_directory_uri() . '/assets/js/chosen' . shark_magazine_min() . '.js', array( 'jquery' ), '1.4.2', true );
		wp_enqueue_script( 'shark-magazine-admin-script', get_template_directory_uri() . '/assets/js/admin' . shark_magazine_min() . '.js', array( 'jquery', 'jquery-chosen' ), '1.0.0', true );
	endif;

}
add_action( 'admin_enqueue_scripts', 'shark_magazine_widget_js' );


/*
 * Add featured widget
 */
require get_template_directory() . '/inc/widgets/featured-widget.php';

/*
 * Add category widget
 */
require get_template_directory() . '/inc/widgets/category-widget.php';

/*
 * Add recent widget
 */
require get_template_directory() . '/inc/widgets/recent-widget.php';

/*
 * Add latest posts widget
 */
require get_template_directory() . '/inc/widgets/latest-post-widget.php';

/*
 * Add introduction widget
 */
require get_template_directory() . '/inc/widgets/introduction-widget.php';

/**
 * Register widgets
 */
function shark_magazine_register_widgets() {
	
	register_widget( 'Shark_Magazine_Featured_Widget' );

	register_widget( 'Shark_Magazine_Category_Widget' );

	register_widget( 'Shark_Magazine_Recent_Widget' );

	register_widget( 'Shark_Magazine_Latest_Post_Widget' );

	register_widget( 'Shark_Magazine_Introduction_Widget' );

}
add_action( 'widgets_init', 'shark_magazine_register_widgets' );