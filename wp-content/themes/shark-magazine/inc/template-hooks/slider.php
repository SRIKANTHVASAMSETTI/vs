<?php
/**
 * Slider hook
 *
 * @package shark_magazine
 */

if ( ! function_exists( 'shark_magazine_add_slider_section' ) ) :
    /**
    * Add slider section
    *
    *@since Shark Magazine 1.0.0
    */
    function shark_magazine_add_slider_section() {

        // Check if slider is enabled on frontpage
        $slider_enable = apply_filters( 'shark_magazine_section_status', 'enable_slider', 'slider_entire_site' );

        if ( ! $slider_enable )
            return false;

        // Get slider section details
        $section_details = array();
        $section_details = apply_filters( 'shark_magazine_filter_slider_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render slider section now.
        shark_magazine_render_slider_section( $section_details );
    }
endif;
add_action( 'shark_magazine_primary_content_action', 'shark_magazine_add_slider_section', 10 );


if ( ! function_exists( 'shark_magazine_get_slider_section_details' ) ) :
    /**
    * slider section details.
    *
    * @since Shark Magazine 1.0.0
    * @param array $input slider section details.
    */
    function shark_magazine_get_slider_section_details( $input ) {

        $content = array();
        $cat_id = shark_magazine_theme_option( 'slider_content_category' );
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 4,
            'cat'               => absint( $cat_id ),
            'ignore_sticky_posts' => true,
            ); 

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();
            
        if ( ! empty( $content ) )
            $input = $content;
       
        return $input;
    }
endif;
// slider section content details.
add_filter( 'shark_magazine_filter_slider_section_details', 'shark_magazine_get_slider_section_details' );


if ( ! function_exists( 'shark_magazine_render_slider_section' ) ) :
  /**
   * Start slider section
   *
   * @return string slider content
   * @since Shark Magazine 1.0.0
   *
   */
   function shark_magazine_render_slider_section( $content_details = array() ) {
        if ( empty( $content_details ) )
            return;

        $column = shark_magazine_theme_option( 'slider_column_layout', 4 );
        $slider_control = shark_magazine_theme_option( 'slider_arrow' );
        $auto_slide = shark_magazine_theme_option( 'slider_auto_slide', false );
        ?>
    	<div id="custom-header">
            <div class="wrapper">
                <div class="section-content banner-slider" data-slick='{"slidesToShow": <?php echo absint( $column ); ?>, "slidesToScroll": 1, "infinite": true, "speed": 1200, "dots": false, "arrows":<?php echo $slider_control ? 'true' : 'false'; ?>, "autoplay": <?php echo $auto_slide ? 'true' : 'false'; ?>, "fade": false, "draggable": true }'>
                    <?php foreach ( $content_details as $content ) : ?>
                        <div class="custom-header-content-wrapper slide-item">

                            <?php if ( ! empty( $content['image'] ) ) : ?>
                                <img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>">
                            <?php endif; ?>

                            <div class="custom-header-content">

                                <?php 
                                the_category( '', '', $content['id'] );

                                if ( ! empty( $content['title'] ) ) : ?>
                                    <h2><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                <?php endif; ?>
                                
                                <p><?php shark_magazine_human_time( $content['id'] ); ?></p>
                            </div><!-- .custom-header-content -->

                        </div><!-- .custom-header-content-wrapper -->
                    <?php endforeach; ?>
                </div><!-- .wrapper -->
            </div><!-- .banner-slider -->
        </div><!-- #custom-header -->
    <?php 
    }
endif;