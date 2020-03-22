<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shark_magazine
 */

/**
 * shark_magazine_site_content_ends_action hook
 *
 * @hooked shark_magazine_site_content_ends -  10
 *
 */
do_action( 'shark_magazine_site_content_ends_action' );

/**
 * shark_magazine_footer_start_action hook
 *
 * @hooked shark_magazine_footer_start -  10
 *
 */
do_action( 'shark_magazine_footer_start_action' );

/**
 * shark_magazine_site_info_action hook
 *
 * @hooked shark_magazine_site_info -  10
 *
 */
do_action( 'shark_magazine_site_info_action' );

/**
 * shark_magazine_footer_ends_action hook
 *
 * @hooked shark_magazine_footer_ends -  10
 * @hooked shark_magazine_slide_to_top -  20
 *
 */
do_action( 'shark_magazine_footer_ends_action' );

/**
 * shark_magazine_page_ends_action hook
 *
 * @hooked shark_magazine_page_ends -  10
 *
 */
do_action( 'shark_magazine_page_ends_action' );

wp_footer();

/**
 * shark_magazine_body_html_ends_action hook
 *
 * @hooked shark_magazine_body_html_ends -  10
 *
 */
do_action( 'shark_magazine_body_html_ends_action' );
