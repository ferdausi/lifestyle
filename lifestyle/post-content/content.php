
<article xmlns="http://www.w3.org/1999/html" class="article-space">

                <div class="entry-thumbnail">
                <a href="<?php echo esc_url(get_the_permalink());?>"><?php the_post_thumbnail('lifestyle-blog-thumbnail');?></a>
                </div>
                <div class="entry-post-title">
                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" >', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </div>
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
                the_excerpt();
                ?>
                </div>

</article>
