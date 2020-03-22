<?php
/**
 * Introduction Widget
 *
 * @package shark_magazine
 */

if ( ! class_exists( 'Shark_Magazine_Introduction_Widget' ) ) :

     
    class Shark_Magazine_Introduction_Widget extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            $st_widget_introduction = array(
                'classname'   => 'introduction_widget',
                'description' => esc_html__( 'Compatible Area: Homepage, Sidebar, Footer', 'shark-magazine' ),
            );
            parent::__construct( 'shark_magazine_introduction_widget', esc_html__( 'ST: Introduction Widget', 'shark-magazine' ), $st_widget_introduction );
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
            $read_more  = isset( $instance['read_more'] ) ? $instance['read_more'] : esc_html__( 'Read More', 'shark-magazine' );
            $content_details = array();

            $page_id  = isset( $instance['page_id'] ) ? $instance['page_id'] : '';
            $query_args = array(
                'post_type' => 'page',
                'page_id' => absint( $page_id ),
                'posts_per_page' => 1,
            );

            $query = new WP_Query( $query_args );
            if ( $query -> have_posts() ) : while ( $query -> have_posts() ) : $query -> the_post();
                $details['title']  = get_the_title();
                $details['url']    = get_the_permalink();
                $details['content'] = shark_magazine_trim_content( 30 );
                $details['image']  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';
                array_push( $content_details , $details );
            endwhile; endif;
            wp_reset_postdata();

            if ( empty( $content_details ) )
                return;

            echo $args['before_widget'];
            ?>

                <div id="introduction" class="page-section relative left-align">
                    <?php if ( ! empty( $title ) ) : ?>
                        <div class="section-header align-center add-separator">
                            <?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
                        </div><!-- .section-header -->
                    <?php endif; 

                    foreach ( $content_details as $content ) : ?>
                        <article class="hentry">
                            <div class="post-wrapper">
                                <div class="entry-container">
                                    <?php if ( ! empty( $content['title'] ) ) : ?>
                                        <header class="entry-header">
                                            <h2 class="entry-title">
                                                <a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a>
                                            </h2>
                                        </header>
                                    <?php endif; 

                                    if ( ! empty( $content['content'] ) ) : ?>
                                        <div class="entry-content">
                                            <?php echo wp_kses_post( $content['content'] ); ?>
                                        </div><!-- .entry-content -->
                                    <?php endif; ?>
                                    <div class="read-more">
                                        <a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $read_more ); ?></a>
                                    </div>
                                </div><!-- .entry-container -->
                                <?php if ( ! empty( $content['image'] ) ) : ?>
                                    <div class="featured-image">
                                        <a href="<?php echo esc_url( $content['url'] ) ?>"><img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>"></a>
                                    </div><!-- .featured-image -->
                                <?php endif; ?>
                            </div><!-- .post-wrapper -->
                        </article>
                    <?php endforeach; ?>
                </div><!-- #introduction -->

            <?php
            echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {
            $title       = isset( $instance['title'] ) ? ( $instance['title'] ) : esc_html__( 'Introduction', 'shark-magazine' );
            $image_align    = isset( $instance['image_align'] ) ? $instance['image_align'] : 'right';
            $content_type   = isset( $instance['content_type'] ) ? $instance['content_type'] : 'page';
            $page_id        = isset( $instance['page_id'] ) ? $instance['page_id'] : '';
            $read_more  = isset( $instance['read_more'] ) ? $instance['read_more'] : esc_html__( 'Read More', 'shark-magazine' );

            $page_options = shark_magazine_page_choices();
            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'shark-magazine' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <div class="page block">
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>"><?php esc_html_e( 'Select Page', 'shark-magazine' ); ?></label>
                    <select class="shark-magazine-widget-chosen-select widfat" id="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'page_id' ) ); ?>">
                        <?php foreach ( $page_options as $page_option => $value ) : ?>
                            <option value="<?php echo absint( $page_option ); ?>" <?php selected( $page_id, $page_option, $echo = true ) ?> ><?php echo esc_html( $value ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
            </div>
            

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'read_more' ) ); ?>"><?php esc_html_e( 'Read More Text:', 'shark-magazine' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('read_more') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'read_more' ) ); ?>" type="text" value="<?php echo esc_attr( $read_more ); ?>" />
            </p>

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
            $instance['page_id']        = shark_magazine_sanitize_page_post( $new_instance['page_id'] );
            $instance['read_more']      = sanitize_text_field( $new_instance['read_more'] );
           
            return $instance;
        }
    }
endif;
