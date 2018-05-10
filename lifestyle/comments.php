<?php

if ( post_password_required() ) {
    return;
}
?>


<div class="post-comment">
    <?php if ( have_comments() ) : ?>
    <h3 class="comments-title">
        <?php
        printf( _nx( 'One comment', '<span>%s</span> comments', get_comments_number(), 'comments title', 'lifestyle' ),
            number_format_i18n( get_comments_number() ) );
        ?>
    </h3>
        <ul class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'       => 'li',
                    'avatar_size' => 80,
                    'callback'=>'mytheme_comment'
                ) );
            ?>
        </ul><!-- .comment-list -->
        <?php
    endif; // have_comments() ?>
</div>