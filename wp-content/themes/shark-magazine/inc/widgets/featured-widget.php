<?php
/**
 * Featured Widget
 *
 * @package shark_magazine
 */

if ( ! class_exists( 'Shark_Magazine_Featured_Widget' ) ) :

     
    class Shark_Magazine_Featured_Widget extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            $st_widget_featured = array(
                'classname'   => 'featured_widget',
                'description' => esc_html__( 'Compatible Area: Homepage, Sidebar, Footer', 'shark-magazine' ),
            );
            parent::__construct( 'shark_magazine_featured_widget', esc_html__( 'ST: Featured Widget', 'shark-magazine' ), $st_widget_featured );
        }

        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget( $args, $instance ) {
            // outputs the content of the widget
            if ( ! isset( $args['widget_id'] ) ) {
                $args['widget_id'] = $this->id;
            }

            $title   = ( ! empty( $instance['title'] ) ) ? ( $instance['title'] ) : '';
            $title   = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $column  = isset( $instance['column'] ) ? $instance['column'] : 'column-3';
            $excerpt_length  = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 20;
            $content_details = array();

            $post_ids = array();
            for ( $i = 1; $i <= 6; $i++ ) :
                if ( ! empty( $instance['post_id_' . $i] ) ) :
                    $post_ids[]  = $instance['post_id_' . $i];
                endif;
            endfor;
            $query_args = array(
            'post_type'         => 'post',
            'post__in'          => ( array ) $post_ids,
            'posts_per_page'    => 6,
            'orderby'           => 'post__in',
            'ignore_sticky_posts' => true,
            ); 

            $query = new WP_Query( $query_args );

            echo $args['before_widget'];
            ?>

                <div id="featured-posts" class="page-section relative">
                    <?php if ( ! empty( $title ) ) : ?>
                        <div class="section-header align-center add-separator">
                            <?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
                        </div><!-- .section-header -->
                    <?php endif; ?>

                    <div class="section-content column-3">
                        <?php if ( $query -> have_posts() ) : 
                            while ( $query -> have_posts() ) : $query -> the_post(); ?>
                                <article class="hentry">
                                    <div class="post-wrapper">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <div class="featured-image">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                                                </a>
                                                <?php shark_magazine_human_time(); ?>
                                            </div><!-- .featured-image -->
                                        <?php endif; ?>
                                                
                                        <?php the_category(); ?>

                                        <div class="entry-container">
                                            <header class="entry-header">
                                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            </header>
                                            <div class="entry-content">
                                                <?php echo esc_html( shark_magazine_trim_content( absint( $excerpt_length ) ) ); ?>
                                            </div><!-- .entry-content -->
                                        </div><!-- .entry-container -->
                                    </div><!-- .post-wrapper -->
                                </article>
                            <?php endwhile; 
                        endif;
                        wp_reset_postdata(); ?>
                    </div><!-- .section-content -->
                </div><!-- #featured-posts -->

            <?php
            echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {
            $title      = isset( $instance['title'] ) ? ( $instance['title'] ) : esc_html__( 'Featured', 'shark-magazine' );
            $excerpt_length = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 20;
            $post_options = shark_magazine_post_choices();
            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'shark-magazine' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>"><?php esc_html_e( 'Excerpt Length:', 'shark-magazine' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('excerpt_length') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt_length' ) ); ?>" type="number" min="5" max="50" value="<?php echo absint( $excerpt_length ); ?>" />
                <small><?php esc_html_e( 'Note: Min 5 & Max 50.', 'shark-magazine' ); ?></small>
            </p>
            
            <div class="post block" >
               <?php for ( $i = 1; $i <= 6; $i++ ) : 
                    $post_id = isset( $instance['post_id_' . $i] ) ? $instance['post_id_' . $i] : ''; ?>
                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'post_id_' . $i ) ); ?>"><?php printf( esc_html__( 'Select Post %d', 'shark-magazine' ), $i ); ?></label>
                        <select class="shark-magazine-widget-chosen-select widfat" id="<?php echo esc_attr( $this->get_field_id( 'post_id_' . $i ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_id_' . $i ) ); ?>">
                            <?php foreach ( $post_options as $post_option => $value ) : ?>
                                <option value="<?php echo absint( $post_option ); ?>" <?php selected( $post_id, $post_option, $echo = true ) ?> ><?php echo esc_html( $value ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                <?php endfor; ?>
            </div>

        <?php }

        /**
        * Processing widget options on save
        *
        * @param array $new_instance The new options
        * @param array $old_instance The previous options
        */
        public function update( $new_instance, $old_instance ) {
            // processes widget options to be saved
            $instance                   = $old_instance;
            $instance['title']          = sanitize_text_field( $new_instance['title'] );
            $instance['excerpt_length'] = absint( $new_instance['excerpt_length'] );
            $instance['content_type']   = sanitize_key( $new_instance['content_type'] );
            for ( $i = 1; $i <= 6; $i++ ) :
                $instance['post_id_' . $i]   = shark_magazine_sanitize_page_post( $new_instance['post_id_' . $i] );
            endfor;
           
            return $instance;
        }
    }
endif;
