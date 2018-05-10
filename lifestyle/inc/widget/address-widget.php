<?php

class lifestyle_Widget_Address extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_address_entries',
            'description' => __( 'Your site&#8217;s information.' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'lifestyle-address', __( 'Lifestyle Address' ), $widget_ops );
        $this->alt_option_name = 'widget_address_entries';
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
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Lifestyle Address' );

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $address = ! empty( $instance['address'] ) ? $instance['address'] : '';
        $address = apply_filters( 'widget_text', $address, $instance, $this );

        $email = ! empty( $instance['email'] ) ? $instance['email'] : '';
        $email = apply_filters( 'widget_text', $email, $instance, $this );

        $contact = ! empty( $instance['contact'] ) ? $instance['contact'] : '';
        $contact = apply_filters( 'widget_text', $contact, $instance, $this );

        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        ?>


        <ul class="address-style">
            <?php if (!empty($address)) { ?>
                <li><span class="address-icon"><i
                            class="fa fa-map-marker address-icon"></i></span><?php echo $address; ?>
                </li>
            <?php } ?>
            <?php if (!empty($email)) { ?>
                <li><span class="address-icon"><i
                            class="fa fa-envelope address-icon"></i></span><?php echo $email; ?></li>
            <?php } ?>
            <?php if (!empty($contact)) { ?>
                <li><span class="address-icon"><i
                            class="fa fa-phone address-icon"></i></span><?php echo $contact; ?></li>
            <?php } ?>
        </ul>

        <?php
        echo $args['after_widget'];

        /**
         * Filters the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */

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
        $instance['address'] = sanitize_text_field( $new_instance['address'] );
        $instance['email'] = sanitize_text_field( $new_instance['email'] );
        $instance['contact'] = sanitize_text_field( $new_instance['contact'] );
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
        $address     = isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';
        $email     = isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
        $contact     = isset( $instance['contact'] ) ? esc_attr( $instance['contact'] ) : '';

        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

         <p>   <label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:' ); ?></label>
            <input class="" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo $address; ?>" /></p>

         <p>   <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:' ); ?></label>
            <input class="" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="email" value="<?php echo $email; ?>" /></p>

          <p>  <label for="<?php echo $this->get_field_id( 'contact' ); ?>"><?php _e( 'Contact :' ); ?></label>
            <input class="" id="<?php echo $this->get_field_id( 'contact' ); ?>" name="<?php echo $this->get_field_name( 'contact' ); ?>" type="text" value="<?php echo $contact ; ?>" /></p>


        <?php
    }
}

add_action( 'widgets_init', create_function( '', 'register_widget( "lifestyle_Widget_Address" );' ) );