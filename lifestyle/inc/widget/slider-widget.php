<?php

class lifestyle_Widget_Carousel extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_slider',
            'description' => __( 'Your site&#8217;s most recent Posts in Slide Show.' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'lifestyle-slide-show', __( 'Lifestyle Slide Show' ), $widget_ops );
        $this->alt_option_name = 'widget_slider';
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

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( '' );

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 4;
        if ( ! $number )
            $number = 4;
        /**
         * Filters the arguments for the Recent Posts Slideshow widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */


        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>

        <!--            carousel-->
        <div id="lifestyle-carousel" class="carousel slide " data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

                <?php


                $categories = get_categories();
                $count = $number;
                $indi = '';
                foreach ($categories as $category):
                    $args = array(
                        'post_type' => 'post',

                        'posts_per_page' => 1,
                        'category__in' => $category->term_id,
                        'category__not_in' => array(),
                    );
                    $lastBlog = new wp_Query($args);


                    if ($lastBlog->have_posts() && $count>0) :
                        while ($lastBlog->have_posts()) : $lastBlog->the_post();?>



                            <div class="item <?php if ($count == $number):echo 'active'; endif ?>">
                                <?php if(has_post_thumbnail())
                                the_post_thumbnail();

                                ?>


                                <div class="carousel-caption">
                                    <p class="slide-cat text-uppercase"> <?php the_category(' & ') ?> </p>
                                    <div>
                                        <a href="<?php the_permalink(); ?>"><h2 class="slide-title"><?php echo wp_trim_words(get_the_title(),4,'')  ?></h2></a>
                                    </div>
                                    <div class="carousel-meta">
                                        <ul class="list-inline slider-post-entry-meta">
                                            <li class="posted-on">
                                                <i class="fa fa-clock-o"></i> <?php  the_time('j F, Y')?>
                                            </li>
                                            <li class="posted-by">
                                                <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user-circle-o"></i> <?php the_author(); ?></a>
                                            </li>



                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php $indi .= '<li data-target="#lifestyle-carousel" data-slide-to="' . $count . '"
                                class="'; ?>
                            <?php if ($count == $number):$indi .= 'active'; endif ?>
                            <?php $indi .= '"></li>' ?>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    $count--;
                endforeach;
                ?>




            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#lifestyle-carousel" role="button" data-slide="prev">
                <span class="fa fa-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#lifestyle-carousel" role="button" data-slide="next">
                <span class="fa fa-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!--carousel-->

        <?php
        // Reset the global $the_post as this query will have stomped on it
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
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;

        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
        <?php
    }
}

add_action( 'widgets_init', create_function( '', 'register_widget( "lifestyle_Widget_Carousel" );' ) );