<?php
function ct_tribes_social_array() {

    $social_sites = array(
        'twitter'       => 'tribes_twitter_profile',
        'facebook'      => 'tribes_facebook_profile',
        'google-plus'   => 'tribes_googleplus_profile',
        'pinterest'     => 'tribes_pinterest_profile',
        'linkedin'      => 'tribes_linkedin_profile',
        'youtube'       => 'tribes_youtube_profile',
        'vimeo'         => 'tribes_vimeo_profile',
        'tumblr'        => 'tribes_tumblr_profile',
        'instagram'     => 'tribes_instagram_profile',
        'flickr'        => 'tribes_flickr_profile',
        'dribbble'      => 'tribes_dribbble_profile',
        'rss'           => 'tribes_rss_profile',
        'reddit'        => 'tribes_reddit_profile',
        'soundcloud'    => 'tribes_soundcloud_profile',
        'spotify'       => 'tribes_spotify_profile',
        'vine'          => 'tribes_vine_profile',
        'yahoo'         => 'tribes_yahoo_profile',
        'behance'       => 'tribes_behance_profile',
        'codepen'       => 'tribes_codepen_profile',
        'delicious'     => 'tribes_delicious_profile',
        'stumbleupon'   => 'tribes_stumbleupon_profile',
        'deviantart'    => 'tribes_deviantart_profile',
        'digg'          => 'tribes_digg_profile',
        'github'        => 'tribes_github_profile',
        'hacker-news'   => 'tribes_hacker-news_profile',
        'steam'         => 'tribes_steam_profile',
        'vk'            => 'tribes_vk_profile',
        'weibo'         => 'tribes_weibo_profile',
        'tencent-weibo' => 'tribes_tencent_weibo_profile',
        '500px'         => 'tribes_500px_profile',
        'foursquare'    => 'tribes_foursquare_profile',
        'slack'         => 'tribes_slack_profile',
        'slideshare'    => 'tribes_slideshare_profile',
        'qq'            => 'tribes_qq_profile',
        'whatsapp'      => 'tribes_whatsapp_profile',
        'skype'         => 'tribes_skype_profile',
        'wechat'        => 'tribes_wechat_profile',
        'xing'          => 'tribes_xing_profile',
        'paypal'        => 'tribes_paypal_profile',
        'email-form'    => 'tribes_email_form_profile'
    );

    return apply_filters( 'ct_tribes_social_array_filter', $social_sites );
}


function my_add_customizer_sections( $wp_customize ) {

    $social_sites = ct_tribes_social_array();

    // set a priority used to order the social sites
    $priority = 5;

    // section
    $wp_customize->add_section( 'ct_tribes_social_media_icons', array(
        'title'       => __( 'Social Media Icons', 'tribes' ),
        'priority'    => 25,
        'description' => __( 'Add the URL for each of your social profiles.', 'tribes' )
    ) );

    // create a setting and control for each social site
    foreach ( $social_sites as $social_site => $value ) {

        $label = ucfirst( $social_site );

        if ( $social_site == 'google-plus' ) {
            $label = 'Google Plus';
        } elseif ( $social_site == 'rss' ) {
            $label = 'RSS';
        } elseif ( $social_site == 'soundcloud' ) {
            $label = 'SoundCloud';
        } elseif ( $social_site == 'slideshare' ) {
            $label = 'SlideShare';
        } elseif ( $social_site == 'codepen' ) {
            $label = 'CodePen';
        } elseif ( $social_site == 'stumbleupon' ) {
            $label = 'StumbleUpon';
        } elseif ( $social_site == 'deviantart' ) {
            $label = 'DeviantArt';
        } elseif ( $social_site == 'hacker-news' ) {
            $label = 'Hacker News';
        } elseif ( $social_site == 'whatsapp' ) {
            $label = 'WhatsApp';
        } elseif ( $social_site == 'qq' ) {
            $label = 'QQ';
        } elseif ( $social_site == 'vk' ) {
            $label = 'VK';
        } elseif ( $social_site == 'wechat' ) {
            $label = 'WeChat';
        } elseif ( $social_site == 'tencent-weibo' ) {
            $label = 'Tencent Weibo';
        } elseif ( $social_site == 'paypal' ) {
            $label = 'PayPal';
        } elseif ( $social_site == 'email-form' ) {
            $label = 'Contact Form';
        }
        // setting
        $wp_customize->add_setting( $social_site, array(
            'sanitize_callback' => 'esc_url_raw'
        ) );
        // control
        $wp_customize->add_control( $social_site, array(
            'type'     => 'url',
            'label'    => $label,
            'section'  => 'ct_tribes_social_media_icons',
            'priority' => $priority
        ) );
        // increment the priority for next site
        $priority = $priority + 5;
    }
}
add_action( 'customize_register', 'my_add_customizer_sections' );


function my_social_icons_output() {

    $social_sites = ct_tribes_social_array();

    foreach ( $social_sites as $social_site => $profile ) {

        if ( strlen( get_theme_mod( $social_site ) ) > 0 ) {
            $active_sites[ $social_site ] = $social_site;
        }
    }

    if ( ! empty( $active_sites ) ) {

        echo '<ul class="social-media-icons list-inline text-center">';
        foreach ( $active_sites as $key => $active_site ) {
            $class = 'fa fa-' . $active_site; ?>
            <li ">
                <a class="<?php echo esc_attr( $active_site ); ?>" target="_blank" href="<?php echo esc_url( get_theme_mod( $key ) ); ?>">
                    <i class="<?php echo esc_attr( $class ); ?>" title="<?php echo esc_attr( $active_site ); ?>"></i>
                </a>
            </li>
        <?php }
        echo "</ul>";
    }
}