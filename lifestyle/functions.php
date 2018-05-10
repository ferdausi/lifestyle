<?php
function lifestyle_script_enqueue(){
//  //Google fonts
//    wp_enqueue_style( 'google-fonts-lora', 'https://fonts.googleapis.com/css?family=Lora', false );

// Twitter BootStrap.

    wp_enqueue_style( 'lifestyle-fonts', lifestyle_fonts_url(), array(), null );

    wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css', array(), '3.3.5' );

    // Material-design-icons
    wp_enqueue_style( 'material-design-iconic-font', get_template_directory_uri() . '/css/material-design-iconic-font.min.css', array(), '2.1.2' );
    // Font Awesome Icons
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');

    wp_enqueue_style('my-style',get_template_directory_uri(). '/css/lifestyle.css');

    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri(). '/js/bootstrap.min.js', array('jquery'), '3.3.5' );
    // JS Plugin
    wp_enqueue_script( 'lifestyle-script', get_template_directory_uri() . '/js/script.js', array('jquery',),  TRUE );

    wp_enqueue_script( 'min-lifestyle-jquery-min', get_template_directory_uri() . '/js/jquery.min.js', array('jquery',), TRUE );

    wp_enqueue_script( 'top-scroll', get_template_directory_uri() . '/js/topbutton.js', array('jquery',), TRUE );

    // JS Post-share

    wp_enqueue_script('share_post', get_template_directory_uri().'/js/post-share.js', array('jquery'), true );

    // JS Post-like

    wp_enqueue_script('like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), true );
    wp_localize_script('like_post', 'ajax_var', array(
        'url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-nonce')
    ));



}



function lifestyle_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';

    /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */

    if ( 'off' !== _x( 'on', 'Lora font: on or off', 'lifestyle' ) ) {
        $fonts[] = 'Lora:400,700';
    }


    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts ) ),
            'subset' => urlencode( $subsets ),
        ), 'https://fonts.googleapis.com/css' );
    }

    return $fonts_url;
}


add_action('wp_enqueue_scripts','lifestyle_script_enqueue');



function lifestyle_theme_setup(){
    add_theme_support('menus');
    add_theme_support( 'post-thumbnails' );

    add_image_size( 'lifestyle-blog-thumbnail', 750, 384, TRUE );


    register_nav_menu('primary','Primary Header navigation');
    register_nav_menu('secondary','Footer navigation');


    //-------------------------------------------------------------------------------
    // Switch default core markup for search form, comment form, and comments
    // to output valid HTML5.
    //-------------------------------------------------------------------------------
    add_theme_support( 'html5',
        apply_filters( 'lifestyle_html5_theme_support', array(
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'caption'
        ) ) );


    //-------------------------------------------------------------------------------
    // Enable support for Post Formats.
    // See http://codex.wordpress.org/Post_Formats
    //-------------------------------------------------------------------------------
    add_theme_support( 'post-formats', apply_filters( 'lifestyle_post_formats_theme_support', array(
        'status',
        'image',
        'audio',
        'video',
        'gallery',

    ) ) );


}
add_action('init','lifestyle_theme_setup');

/*for deleting extra views in wp_head*/
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');



function lifestyle_widgets_init() {


    register_sidebar( apply_filters( 'lifestyle_carousel_sidebar', array(
        'name'          => esc_html__( 'Header Sidebar', 'lifestyle' ),
        'id'            => 'lifestyle-carousel-sidebar',
        'description'   => esc_html__( 'Appears in the carousel sidebar.', 'lifestyle' ),
        'before_widget' => '<div id="%1$s" class=" widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="">',
        'after_title'   => '</h2>',
    ) ) );

    register_sidebar( apply_filters( 'lifestyle_blog_sidebar', array(
        'name'          => esc_html__( 'Blog Sidebar', 'lifestyle' ),
        'id'            => 'lifestyle-blog-sidebar',
        'description'   => esc_html__( 'Appears in the blog sidebar.', 'lifestyle' ),
        'before_widget' => '<aside id="%1$s" class=" widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) ) );

    register_sidebar( apply_filters( 'lifestyle_footer_sidebar_1', array(
        'name'          => esc_html__( 'Footer 1', 'lifestyle' ),
        'id'            => 'lifestyle-footer-widget-1',
        'description'   => esc_html__( 'Appears in the footer.', 'lifestyle' ),
        'before_widget' => '<div class=" footer-widget-1 widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) ) );

    register_sidebar( apply_filters( 'lifestyle_footer_sidebar_2', array(
        'name'          => esc_html__( 'Footer 2', 'lifestyle' ),
        'id'            => 'lifestyle-footer-widget-2',
        'description'   => esc_html__( 'Appears in the footer.', 'lifestyle' ),
        'before_widget' => '<div class=" footer-widget-2 widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) ) );
    register_sidebar( apply_filters( 'lifestyle_footer_sidebar_3', array(
        'name'          => esc_html__( 'Footer 3', 'lifestyle' ),
        'id'            => 'lifestyle-footer-widget-3',
        'description'   => esc_html__( 'Appears in the footer.', 'lifestyle' ),
        'before_widget' => '<div class=" footer-widget-3 widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) ) );
    register_sidebar( apply_filters( 'lifestyle_footer_sidebar_4', array(
        'name'          => esc_html__( 'Footer 4', 'lifestyle' ),
        'id'            => 'lifestyle-footer-widget-4',
        'description'   => esc_html__( 'Appears in the footer.', 'lifestyle' ),
        'before_widget' => '<div class="footer-widget-4 widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) ) );
}

add_action( 'widgets_init', 'lifestyle_widgets_init' );

if ( ! function_exists( 'lifestyle_posts_pagination' ) ) :
    function lifestyle_posts_pagination() {

        if ( $GLOBALS[ 'wp_query' ]->max_num_pages > 1 ) {
            $big   = 999999999; // need an unlikely integer
            $items = paginate_links( apply_filters( 'lifestyle_posts_pagination_paginate_links', array(
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => '?paged=%#%',
                'prev_next' => TRUE,
                'current'   => max( 1, get_query_var( 'paged' ) ),
                'total'     => $GLOBALS[ 'wp_query' ]->max_num_pages,
                'type'      => 'array',
                'prev_text' => '<i class="fa  fa-angle-double-left"></i>  <span>Previous</span>',
                'next_text' => '<span>Next Page</span><i class="fa  fa-angle-double-right"></i>  ',
                'end_size'  => 1,
                'mid_size'  => 1
            ) ) );

            $pagination = "<div class=\"pagination-wrap clearfix\"><ul class=\"pagination navigation\"><li>";
            $pagination .= join( "</li><li>", (array) $items );
            $pagination .= "</li></ul></div>";

            echo apply_filters( 'lifestyle_posts_pagination', $pagination, $items, $GLOBALS[ 'wp_query' ] );
        }
    }
endif;


//Excert more

function new_excerpt_more( $more ) {

    return '<div>
                 <a href = "'.get_permalink().'"> <button type = "button" class="btn btn-default text-uppercase" > Read more </button > </a >
             </div>';

}
add_filter( 'excerpt_more', 'new_excerpt_more' );


//Font Size Of Tag
function lifestyle_widget_tag_cloud_args( $args ) {
    $args['largest'] = 14;
    $args['smallest'] = 14;
    $args['unit'] = 'px';
    return $args;
}

add_filter( 'widget_tag_cloud_args', 'lifestyle_widget_tag_cloud_args' );


//View COUNT
require get_template_directory() . "/inc/post-view-count.php";


//Favourite Post
require get_template_directory() . "/template-parts/favourite-post.php";

////Slider
//require get_template_directory() . "/template-parts/post-slider.php";



//Slider Widget

require get_template_directory() . "/inc/widget/slider-widget.php";


//Recent Post Widget

require get_template_directory() . "/inc/widget/latest-post-widget.php";


//Newsletter
require get_template_directory() . "/inc/widget/newsletter-widget.php";


//Popular Post Widget

require get_template_directory() . "/inc/widget/popular-post-widget.php";

//Address Widget

require get_template_directory() . "/inc/widget/address-widget.php";


//social Navigation
require get_template_directory() . "/template-parts/social-navigation.php";


require get_template_directory() . "/inc/template-tags.php";

if ( ! function_exists( 'lifestyle_post_navigation' ) ) :

    function lifestyle_post_navigation() {
        get_template_part( 'template-parts/post', 'navigation' );
    }
endif;


if ( ! function_exists( 'lifestyle_related_post' ) ) :

    function lifestyle_related_post() {
        get_template_part( 'template-parts/related-post' );
    }
endif;


function time_ago_date(  $the_date) {

    return human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' .__( 'ago' );
 }
add_filter( 'get_the_date', 'time_ago_date', 10, 1 );
?>




