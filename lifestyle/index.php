<?php get_header(); ?>


<?php
$lifestyle_all_query = new WP_Query(array(
    'post_type'=>'post',
    'post_status'=>'publish',

    'paged'=> get_query_var( 'paged' )

));
?>

<!--Post SlideShow Widget Area-->
<div class="post-slider">

            <?php dynamic_sidebar('lifestyle-carousel-sidebar'); ?>


</div>



<div class="container">
    <div class="row">
        <div id="primary" class="content-area col-md-8">
                <main id="main" class="site-main" role="main">

        <?php
        if ($lifestyle_all_query-> have_posts() ) :

            while ( $lifestyle_all_query->have_posts() ) : $lifestyle_all_query->the_post();?>

                        <?php
                            get_template_part( 'post-content/content', get_post_format() );

            endwhile;
        endif;
            lifestyle_posts_pagination();

        wp_reset_query();
         ?>

                </main><!-- .site-main -->





        </div><!-- .content-area -->

        <div class="col-md-4">

        <?php get_sidebar()?>

        </div>
    </div>
</div>

<?php get_footer();?>