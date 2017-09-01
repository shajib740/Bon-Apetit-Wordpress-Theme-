
<?php
class author_widget extends WP_Widget{

    /*step 1, creating the widget in dasboard's appearance>widget section */
    function __construct() {

        

        parent::__construct(
            'our_widget', // Base ID
            __( 'Author Bio', 'bon-appetit' ), // Name
            array( 'description' => __( 'ADD Author Info Box To Your Sidebars', 'bon-appetit' ), ) // Args
        );
    }


    /*step 4, backend display of widget*/

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Add title', 'bon-appetit' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
       </p>
     <?php
    }
    /*step 3, front-end display of widget part*/

    public function widget( $args, $instance ) {
        // Our variables from the widget settings
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Default title', 'text_domain' ) : $instance['title'] );
        ob_start();
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>
        <?php
            do_action("add_author_bio");
        ?>
        <?php
        echo $args['after_widget'];
        ob_end_flush();
    }
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }
}
/*step2 , hooking up the widget*/
add_action('widgets_init',function(){
    register_widget('author_widget'); /*holds the class name */
});

