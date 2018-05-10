<?php


add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');

function post_like()
{

// Check for nonce security
    $nonce = $_POST['nonce'];
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Not Secured!');
    if(isset($_POST['post_like']))
    {
        $post_id = $_POST['post_id'];
        $uesr_id = get_current_user_id();
        $meta_user_ID = $uesr_id;
        $meta_count =  get_post_meta($post_id, "votes_count", true);
        if(!hasAlreadyVoted($post_id))
        {
//	$voted_IP[$ip] = time();

// Save IP and increase votes count
            update_post_meta($post_id, "user_ID", $meta_user_ID);
            update_post_meta($post_id, "votes_count", ++$meta_count);

// Display count (ie jQuery return value)
            die( $meta_count);
//print_r($meta_count);
        }
//        else
//            echo get_post_meta($post_id, "votes_count", true);
    }
    exit;
}
function hasAlreadyVoted($post_id)
{
// Retrieve post votes IPs
    $uesr_id = get_current_user_id();
    $current_user_id = $uesr_id;



//$vote_count = get_post_meta($post_id, "votes_count");
    $meta_user_ID = get_post_meta($post_id, "user_ID");

// If user has already voted
    if(in_array($current_user_id, $meta_user_ID))
    {
        return true;
    }
    else
    {
        return false;
    }
}
function getPostLikeLink($post_id){
    $themename = "lifestyle";
    $vote_count = get_post_meta($post_id, "votes_count", true);
    $output = '<p class="post-like ">';
    if(hasAlreadyVoted($post_id))
        $output .= ' <span title="'.__('I liked this article', $themename).'" class="voted alreadyvoted like"><i class="fa fa-heart heart-1" aria-hidden="true"></i></span>';
    else{
        $vote_count = 0;
        $output .= $vote_count>
            $output .= '<a href="#" data-post_id="'.$post_id.'">
        <span  title="'.__('I like this article', $themename).'"class=" like"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
        </a>';}
    $output .= '<span class="count">'.$vote_count.'</span></p>';
    return $output;
}