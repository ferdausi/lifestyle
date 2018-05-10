

<?php

//----------------------------------------------------------------------
// Comments list
//----------------------------------------------------------------------


function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<div id="comment-<?php comment_ID(); ?>" >

    <div class="row">
        <div class="col-md-2">
            <?php echo get_avatar($comment,$size='100',$default='<path_to_url>' ); ?>
            <?php //printf(__('<cite>%s</cite> <span>says:</span>'), get_comment_author_link()) ?>
        </div>
            <?php if ($comment->comment_approved == '0') : ?>
                <em><?php _e('Your comment is awaiting moderation.') ?></em>
                <br />
                <?php endif; ?>

<!--        <div>-->
<!--        <a href="--><?php //echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?><!--">--><?php //printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?><!--</a>--><?php //edit_comment_link(__('(Edit)'),'  ',"") ?>
<!--        </div>-->
        <div class="col-md-10">
        <?php comment_text() ?>
        </div>


<!--        <div>--><?php //comment_reply_link (array_merge( $args, array(
//                'depth' => $depth,
//                'max_depth' => $args['max_depth']
//                 )));?>
<!--        </div>-->



    </div>
    <div>
        <ul class="list-inline">
            <li><?php echo get_comment_author_link() ?></li>
            <li>

                <?php
                    echo '<div class="post-info"> ' . human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' .__( 'ago' ) . '</div>';

                ?>
            </li>
            <li>
                <?php comment_reply_link (array_merge( $args, array(
                                'depth' => $depth,
                                'max_depth' => $args['max_depth']
                                 )));?>
            </li>
        </ul>
    </div>

</div>

<?php
}

//----------------------------------------------------------------------
// Comments list end
//----------------------------------------------------------------------