<?php
/**
 * Category Widget
 *
 * @package shark_magazine
 */

if ( ! class_exists( 'Shark_Magazine_Category_Widget' ) ) :

     
    class Shark_Magazine_Category_Widget extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            $st_widget_category = array(
                'classname'   => 'category_widget',
                'description' => esc_html__( 'Compatible Area: Homepage, Sidebar, Footer', 'shark-magazine' ),
            );
            parent::__construct( 'shark_magazine_category_widget', esc_html__( 'ST: Category Widget', 'shark-magazine' ), $st_widget_category );
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
            $cat_ids = ! empty( $instance['cat_ids'] ) ? $instance['cat_ids'] : array();
            $content_details = array();

            echo $args['before_widget'];
            ?>
                <div class="featured-categories page-section relative column-2">
                    <?php if ( ! empty( $title ) ) : ?>
                        <div class="section-header align-center add-separator">
                            <?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
                        </div><!-- .section-header -->
                    <?php endif; ?>

                    <div class="content-wrapper">

                        <?php foreach ( $cat_ids as $cat_id ) : ?>
                            <div class="featured-categories-wrapper section-content">

                                <?php $query_args = array(
                                    'post_type'         => 'post',
                                    'posts_per_page'    => 4,
                                    'cat'               => absint( $cat_id ),
                                    'ignore_sticky_posts' => true,
                                    ); ?>

                                <div class="category-header">
                                    <div class="category-title"><?php echo esc_html( get_cat_name( $cat_id ) ); ?></div>
                                </div>

                                <?php $query = new WP_Query( $query_args );
                                if ( $query -> have_posts() ) : 
                                    $i = 1;
                                    while ( $query -> have_posts() ) : $query -> the_post(); ?>
                                        <article class="hentry <?php echo $i == 1 ? 'full-width' : 'half-width'; ?>">
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
                                                    <header class="entry-header">
                                                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                                                        <?php if ( 1 !== $i ) :
                                                            shark_magazine_human_time(); 
                                                        endif; ?>
                                                    </header>

                                                    <?php if ( 1 == $i ) : ?>
                                                        <div class="entry-content">
                                                            <?php echo esc_html( shark_magazine_trim_content( absint( 15 ) ) ); ?>
                                                        </div><!-- .entry-content -->
                                                    <?php endif; ?>
                                                </div><!-- .entry-container -->
                                            </div><!-- .post-wrapper -->
                                        </article>
                                    <?php $i++; endwhile; 
                                endif;
                                wp_reset_postdata(); ?>

                            </div><!-- .section-content -->
                        <?php endforeach; ?>
                    </div><!-- .content-wrapper -->
                </div><!-- .featured-categories -->

            <?php echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {
            $title      = isset( $instance['title'] ) ? ( $instance['title'] ) : esc_html__( 'Categories', 'shark-magazine' );
            $cat_ids     = isset( $instance['cat_ids'] ) ? $instance['cat_ids'] : array();
            $category_options = shark_magazine_category_choices();
            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'shark-magazine' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'cat_ids' ) ); ?>"><?php echo esc_html__( 'Select Categories', 'shark-magazine' ); ?></label>
                <select multiple class="shark-magazine-widget-chosen-select widfat" id="<?php echo esc_attr( $this->get_field_id( 'cat_ids' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cat_ids[]' ) ); ?>">
                    <?php $i = 0; foreach ( $category_options as $category_option => $value ) : ?>
                        <option value="<?php echo absint( $category_option ); ?>" <?php echo in_array( $category_option, $cat_ids ) ? 'selected' : ''; ?> ><?php echo esc_html( $value ); ?></option>
                    <?php $i++; endforeach; ?>
                </select>
                <small><?php esc_html_e( 'Note: Only two categories are allowed. Latest four posts will be shown from selected categories.', 'shark-magazine' ); ?></small>
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
            $new_instance['cat_ids']    = array_slice( $new_instance['cat_ids'], 0, 2 );
            $instance['cat_ids']        = shark_magazine_sanitize_category_list( $new_instance['cat_ids'] );
           
            return $instance;
        }
    }
endif;
