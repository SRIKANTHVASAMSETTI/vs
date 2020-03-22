<?php
/**
 * demo import
 *
 * @package shark_magazine
 */

/**
 * Imports predefine demos.
 * @return [type] [description]
 */
function shark_magazine_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Demo content files for Shark Magazine Theme.', 'shark-magazine' ),
    esc_url( 'https://sharkthemes.com/downloads/shark-magazine' ), esc_html__( 'Click here', 'shark-magazine' ) );

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'shark_magazine_intro_text' );