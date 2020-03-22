<?php
/**
 * Template Name: Home Page
 * The template for displaying home page.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shark_magazine
 */

get_header(); ?>

<div class="single-template-wrapper wrapper page-section">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php if ( is_active_sidebar( 'home-page-area' ) ) :
				dynamic_sidebar( 'home-page-area' );
			else : ?>
				<div class="wrapper center">
					<?php the_widget( 'WP_Widget_Text', $instance = array( 'title' => esc_html__( 'Welcome to Shark Magazine Theme', 'shark-magazine' ), 'text' => esc_html__( 'Customize Slider from Customizer Theme Options. Customize Home Page by adding widgets that are compatible for home page. Add Widgets that are prefixed by ST.', 'shark-magazine' ) ) ); ?>
				</div>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div>

<?php
get_footer();
