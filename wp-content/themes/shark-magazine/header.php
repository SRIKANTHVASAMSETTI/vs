<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shark_magazine
 */

/**
 * shark_magazine_doctype_action hook
 *
 * @hooked shark_magazine_doctype -  10
 *
 */
do_action( 'shark_magazine_doctype_action' );

/**
 * shark_magazine_head_action hook
 *
 * @hooked shark_magazine_head -  10
 *
 */
do_action( 'shark_magazine_head_action' );

/**
 * shark_magazine_body_start_action hook
 *
 * @hooked shark_magazine_body_start -  10
 *
 */
do_action( 'shark_magazine_body_start_action' );
 
/**
 * shark_magazine_page_start_action hook
 *
 * @hooked shark_magazine_page_start -  10
 * @hooked shark_magazine_loader -  20
 *
 */
do_action( 'shark_magazine_page_start_action' );

/**
 * shark_magazine_header_start_action hook
 *
 * @hooked shark_magazine_header_start -  10
 *
 */
do_action( 'shark_magazine_header_start_action' );

/**
 * shark_magazine_site_branding_action hook
 *
 * @hooked shark_magazine_site_branding -  10
 *
 */
do_action( 'shark_magazine_site_branding_action' );

/**
 * shark_magazine_primary_nav_action hook
 *
 * @hooked shark_magazine_primary_nav -  10
 *
 */
do_action( 'shark_magazine_primary_nav_action' );

/**
 * shark_magazine_header_ends_action hook
 *
 * @hooked shark_magazine_header_ends -  20
 *
 */
do_action( 'shark_magazine_header_ends_action' );

/**
 * shark_magazine_site_content_start_action hook
 *
 * @hooked shark_magazine_site_content_start -  10
 *
 */
do_action( 'shark_magazine_site_content_start_action' );

/**
 * shark_magazine_primary_content_action hook
 *
 * @hooked shark_magazine_add_slider_section -  10
 *
 */
do_action( 'shark_magazine_primary_content_action' );