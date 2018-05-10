<?php
/**
 * The template part for displaying content of video type post
 *
 * @package WordPress
 * @subpackage Life_Style
 * @since Life Style 1.0
 */
?>

<?php
/* translators: %s: Name of current post */
$content_text = sprintf(
    wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'lifestyle' ), array( 'span' => array( 'class' => array() ) ) ),
    the_title( '<span class="screen-reader-text">"', '"</span>', false )
);


$content = apply_filters( 'the_content', get_the_content( $content_text ) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="post-image">
        <!--        --><?php
        //        if ( has_post_thumbnail() ) {
        //            the_post_thumbnail( 'lifestyle-blog-thumbnail' );
        //        }
        //        ?>
    </div><!--.post-image-->
    <?php

    $audio = get_media_embedded_in_content( $content, array( 'audio' ) );

    if ( ! empty( $audio ) ) {
        foreach ( $audio as $audio_html ) {
            $content = str_replace( $audio_html, '', $content );
            echo '<div class="entry-audio">';
            echo $audio_html;
            echo '</div><!-- .entry-audio -->';
        }
    };

//    if ( ! empty( $audio ) ) {
//        foreach ( $audio as $audio_html ) {
//            $content = str_replace( $audio_html, '', $content );
//            ?>
<!--            <div class="entry-aideo ">-->
<!--                --><?php //echo $audio_html; ?>
<!--            </div><!-- .entry-video.jetpack-video-wrapper -->-->
<!--            --><?php
//        } // endforeach
//    } // endif !empty ( $media )
    ?>


    <div class="post-title">
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" >', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

    </div><!-- .post-title -->

    <!--    --><?php //lifestyle_excerpt(); ?>

    <div class="entry-cat">
        <?php
        //                if(has_tag()) {
        //                    the_tags('',',','');
        //                }
        if( has_category()){
            the_category( ', ' );
        }

        ?>
    </div>
    <div class="entry-meta">
        <?php get_template_part( 'template-parts/post-entry-meta' );?>
    </div>


    <div class="post-content">
        <?php
        /* translators: %s: Name of current post */
        /* only text content*/

        $content = get_the_content();
        $content = preg_replace('/([)([audio])(\w+)([^>]*])/', "", $content);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);?>


        <div class="entry-content clearfix">

            <?php

            the_excerpt('$content');


            ?>
            <div>
                <a href = "<?php the_permalink()?>" ><button type = "button" class="btn btn-default text-uppercase" > Read more </button > </a >
            </div>



        </div>

    </div><!-- .post-content -->

</article><!-- #post-## -->