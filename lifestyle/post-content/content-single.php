
<article xmlns="http://www.w3.org/1999/html">

    <a href="<?php echo esc_url(get_the_permalink());?>"><?php the_post_thumbnail('lifestyle-blog-thumbnail');?></a>

    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" >', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

    <div class="entry-cat">
        <?php
        if( has_category()){
            the_category( ', ' );
        }

        ?>
    </div>
    <div class="entry-meta">
        <?php get_template_part( 'template-parts/post-entry-meta' );?>
    </div>
    <div class="entry-content clearfix">
        <?php

        if ( have_posts() ) : while ( have_posts() ) : the_post();
            the_content();
            wpb_set_post_views(get_the_ID());

        endwhile;
        endif;

        ?>
    </div>
    <div class="entry-tag">
        <div class="row">
            <div class="col-md-9 single-page-tag">
                <?php if(has_tag())  the_tags('',' ',''); ?>
            </div>
            <div class="col-md-3 single-share">
                <span class="pull-right">
                <a href=' http://www.facebook.com/sharer.php?url=" . <?php  the_permalink()?>. " ' target='_blank' ><i class="fa fa-facebook "></i></a>
                <a href='https://twitter.com/share?url=" . <?php  the_permalink()?>. " ' target='_blank' ><i class="fa fa-twitter "></i></a>
                <a href='https://plus.google.com/share?url=" . <?php  the_permalink()?>. "' target='_blank'  ><i class="fa fa-google-plus "></i></a>
                <a href='http://www.tumblr.com/share/link?url=" . <?php  the_permalink()?>. "' target='_blank'  ><i class="fa fa-tumblr "></i></a>
                </span>
            </div>
        </div>


    </div>
    <div class="post-navigation">
        <?php if(is_single())
            lifestyle_post_navigation();
        ?>

    </div>



</article>
