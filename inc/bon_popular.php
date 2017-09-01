<?php
/*
* Plugin Name: bon_appetit_popular_post
* Plugin URI:
* Description: widget that shows the popular posts depending on likes
* Version: 1.0
* Author: Mushrit Shabnam
* Author URI:
* License: A "Slug" license name e.g. GPL12
*/

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class bon_popular_posts extends WP_Widget {

    /**
     * Sets up a new Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_popular_posts',
            'description' => __( 'Your site&#8217;s most popular Posts.' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'popular-posts', __( 'Popular Posts' ), $widget_ops );
        $this->alt_option_name = 'widget_popular_posts';
    }

    /**
     * Outputs the content for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    public function widget( $args, $instance )
    {
        global $post;

        if (!isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }
        echo $args['before_widget'];
        $title = (!empty($instance['title'])) ? $instance['title'] : __('Popular Posts');

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
        if (!$number)
            $number = 5;

        /**
         * Filters the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */

        $post_args = array(
            'post_type' => 'post',
            'meta_key' =>'votes_count',
            'orderby' => 'meta_value meta_value_num',
            'order' => 'DESC',
            'posts_per_page' => $number,
            'ignore_sticky_posts' => true,
            'post_status' => 'publish'
        );


        $pop_posts = new WP_Query( $post_args );
           if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		   }
            while ( $pop_posts->have_posts()) {

                    $pop_posts->the_post();
                ?>
                <div class="bon-popular-post clearfix">
                            <div class = "post-image">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </div>


                            <div class = "post-data">
                                <div class = "post-cat">
                                    <?php the_category(', ') ?>
                                </div>
                               <div class = "post-title">
                                   <a href=" <?php get_permalink($post->ID); ?>"><?php get_the_title() ? the_title() : the_ID(); ?> </a>
                               </div>
                                <div class = "post-date-like">
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
                                    <span class = "bon-post-like"><?php echo getPostLikeLink(get_the_ID());?> </span>
                                </div>
                            </div>
                </div>

                <?php


            }

            echo $args['after_widget'];

        wp_reset_postdata();
    }

    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

        <?php
    }
}

add_action('widgets_init', function(){
    register_widget('bon_popular_posts');
});