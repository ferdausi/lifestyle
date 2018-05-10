<?php

class lifestyle_Widget_popular_Posts extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_popular_entries',
            'description' => __( 'Your site&#8217;s most popular Posts.' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'lifestyle-popular-posts', __( 'Lifestyle Popular Posts' ), $widget_ops );
        $this->alt_option_name = 'widget_popular_entries';
    }

    /**
     * Outputs the content for the current popular Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current popular Posts widget instance.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Lifestyle Latest Posts' );

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 4;
        if ( ! $number )
            $number = 4;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;


         echo $args['before_widget'];
            if ( $title ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }

    $popularpost = new WP_Query(  apply_filters( 'widget_posts_args',array(
        'posts_per_page' => $number,
        'meta_key' => 'wpb_post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    )) );

    while ( $popularpost->have_posts() ) : $popularpost->the_post();?>
        <div class="row recent-margin latest-post-widget" >
                        <div class="col-md-3 space">
                            <a href="<?php the_permalink(); ?>">
                            <?php
                            if(has_post_thumbnail())
                                the_post_thumbnail(array(80, 80) );


                            ?>
                            </a>
                        </div>
                        <div class="col-md-9 recent-div">
                            <li>
                                <p>
                                    <a href="<?php the_permalink(); ?>"><h2 class="recent-post-title"><?php echo wp_trim_words(get_the_title(),5,'')  ?></h2></a>
                                </p >
                                <p class="hide-linebreak">
                                    <span class="widget-entry-cat"> <?php the_category(','); ?></span><br>
                                    <?php if (!empty($show_date))?>
                                    <span class="post-date"><a href="<?php the_permalink()?>"><i class="fa fa-clock-o"></i><?php  the_time('j F, Y'); ?></a></span>
                                </p>
                            </li>

                        </div>
                    </div>

      <?php
    endwhile;

        echo $args['after_widget'];

    }

    /**
     * Handles updating the settings for the current popular Posts widget instance.
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
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        return $instance;
    }

    /**
     * Outputs the settings form for the popular Posts widget.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
        <?php
    }
}

add_action( 'widgets_init', create_function( '', 'register_widget( "lifestyle_Widget_popular_Posts" );' ) );