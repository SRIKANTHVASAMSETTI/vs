<?php
/**
 * Recent Widget
 *
 * @package shark_magazine
 */

if ( ! class_exists( 'Shark_Magazine_Recent_Widget' ) ) :

     
    class Shark_Magazine_Recent_Widget extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            $st_widget_recent = array(
                'classname'   => 'recent_widget',
                'description' => esc_html__( 'Compatible Area: Homepage', 'shark-magazine' ),
            );
            parent::__construct( 'shark_magazine_recent_widget', esc_html__( 'ST: Recent Widget', 'shark-magazine' ), $st_widget_recent );
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
            $excerpt_length  = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 20;
            $content_type  = isset( $instance['content_type'] ) ? $instance['content_type'] : 'recent';
            $content_details = array();

            switch ($content_type) {
                case 'recent':
                    $query_args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => 5,
                    'ignore_sticky_posts' => true,
                    ); 
                break;

                case 'category':
                    $cat_id = ! empty( $instance['cat_id'] ) ? $instance['cat_id'] : '';
                    $query_args = array(
                        'post_type'         => 'post',
                        'posts_per_page'    => 5,
                        'cat'               => absint( $cat_id ),
                        'ignore_sticky_posts' => true,
                        ); 
                break;
                
                default:
                break;
            }

            $query = new WP_Query( $query_args );

            echo $args['before_widget'];
            ?>

                <div id="popular-posts" class="page-section relative">
                    <?php if ( ! empty( $title ) ) : ?>
                        <div class="section-header align-center add-separator">
                            <?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
                        </div><!-- .section-header -->
                    <?php endif; ?>

                    <div class="section-content">
                        <?php if ( $query -> have_posts() ) : 
                            $i = 1;
                            $count = count( ( array ) $query );
                            while ( $query -> have_posts() ) : $query -> the_post(); 
                                if ( in_array( $i, array( 1, 2 ) ) ) : ?>
                                    <div class="popular-post-wrapper">
                                <?php endif; ?>
                                    <article class="hentry <?php echo ( 1 == $i ) ? 'full-width' : 'half-width'; ?>">
                                        <div class="post-wrapper">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <div class="featured-image">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                                                    </a>
                                                    <?php if ( 1 == $i ) : 
                                                        shark_magazine_human_time(); 
                                                    endif; ?>
                                                </div><!-- .recent-image -->
                                            <?php endif; ?>

                                            <div class="entry-container">
                                                <?php the_category(); ?>

                                                <header class="entry-header">
                                                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                                                    <?php if ( 1 !== $i ) :
                                                        shark_magazine_human_time(); 
                                                    endif; ?>
                                                </header>

                                                <?php if ( 1 == $i ) : ?>
                                                    <div class="entry-content">
                                                        <?php echo esc_html( shark_magazine_trim_content( absint( $excerpt_length ) ) ); ?>
                                                    </div><!-- .entry-content -->
                                                <?php endif; ?>
                                            </div><!-- .entry-container -->
                                        </div><!-- .post-wrapper -->
                                    </article>
                                <?php if ( 1 == $i || $i == $count ) : ?>
                                    </div><!-- .popular-post-wrapper -->
                                <?php endif; 
                            $i++; endwhile; 
                        endif;
                        wp_reset_postdata(); ?>
                    </div><!-- .section-content -->
                </div><!-- #popular-posts -->

            <?php
            echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {
            $title      = isset( $instance['title'] ) ? ( $instance['title'] ) : esc_html__( 'Recent Posts', 'shark-magazine' );
            $excerpt_length = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 20;
            $content_type   = isset( $instance['content_type'] ) ? $instance['content_type'] : 'recent';
            $cat_id     = isset( $instance['cat_id'] ) ? $instance['cat_id'] : '';

            $category_options = shark_magazine_category_choices();
            $content_type_options = array(
                'recent'    => esc_html__( 'Recent Posts', 'shark-magazine' ),
                'category'  => esc_html__( 'Category', 'shark-magazine' ),
            );
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

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'content_type' ) ); ?>"><?php esc_html_e( 'Content Type', 'shark-magazine' ); ?></label>
                <select class="content-type widfat" id="<?php echo esc_attr( $this->get_field_id( 'content_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content_type' ) ); ?>" style="width:100%">
                    <?php foreach ( $content_type_options as $key => $value ) : ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $content_type, $key, $echo = true ) ?> ><?php echo esc_html( $value ); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>

            <p><?php esc_html_e( 'Note: Latest five posts will be shown.', 'shark-magazine' ); ?></p>

            <div class="category <?php echo ( 'category' == $content_type ) ? 'block' : 'none' ?>" >
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>"><?php echo esc_html__( 'Select Category', 'shark-magazine' ); ?></label>
                    <select class="shark-magazine-widget-chosen-select widfat" id="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cat_id' ) ); ?>">
                        <?php foreach ( $category_options as $category_option => $value ) : ?>
                            <option value="<?php echo absint( $category_option ); ?>" <?php selected( $cat_id, $category_option, $echo = true ) ?> ><?php echo esc_html( $value ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
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
            $instance['cat_id']         = shark_magazine_sanitize_category( $new_instance['cat_id'] );
           
            return $instance;
        }
    }
endif;
