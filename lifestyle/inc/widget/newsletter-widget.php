<?php
add_action( 'init', 'kv_register_shortcode_for_newsletter');

function kv_register_shortcode_for_newsletter(){

    add_shortcode('kv_email_subscriptions', 'kv_email_subscription_fn' );
}



class Kv_Subscription_widget extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'kv_email_subscription',
            'description' => 'A Simple Email Subscription Widget to get subscribers info',
        );
        parent::__construct( 'my_widget', 'Newsletter', $widget_ops );
    }

    public function widget( $args, $instance ) {


        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Newsletter ' );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
         echo $args['before_widget'];
             if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        echo $args['after_widget'];
        do_action('kv_email_subscription');

    }
}

add_action( 'widgets_init', function(){
    register_widget( 'Kv_Subscription_widget' );
});


if(!function_exists('kv_email_subscription_fn')) {
    add_action('kv_email_subscription' , 'kv_email_subscription_fn' );

    function kv_email_subscription_fn() {


        if('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['kv_submit_subscription'])) {

//            if ( $title ) {
//                echo $args['before_title'] . $title . $args['after_title'];
//            }

            if( filter_var($_POST['subscriber_email'], FILTER_VALIDATE_EMAIL) ){

                $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

                $subject = sprintf(__('New Subscription on %s','kvc'), $blogname);

                $to = get_option('admin_email');

                $headers = 'From: '. sprintf(__('%s Admin', 'kvc'), $blogname) .' <No-repy@'.$_SERVER['SERVER_NAME'] .'>' . PHP_EOL;

                $message  = sprintf(__('Hi ,', 'kvc')) . PHP_EOL . PHP_EOL;
                $message .= sprintf(__('You have a new subscription on your %s website.', 'kvc'), $blogname) . PHP_EOL . PHP_EOL;
                $message .= __('Email Details', 'kvc') . PHP_EOL;
                $message .= __('-----------------') . PHP_EOL;
                $message .= __('User E-mail: ', 'kvc') . stripslashes($_POST['subscriber_email']) . PHP_EOL;
                $message .= __('Regards,', 'kvc') . PHP_EOL . PHP_EOL;
                $message .= sprintf(__('Your %s Team', 'kvc'), $blogname) . PHP_EOL;
                $message .= trailingslashit(get_option('home')) . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;

                if (wp_mail($to, $subject, $message, $headers)){

                    echo 'Your e-mail (' . $_POST['subscriber_email'] . ') has been added to our mailing list!';
                }	else	{
                    echo 'There was a problem with your e-mail (' . $_POST['subscriber_email'] . ')';
                }
            }else{
                echo 'There was a problem with your e-mail (' . $_POST['subscriber_email'] . ')';
            }
        }?>



            <form id="newsletter-footer" action="" method="POST">

                <p class="subscribe-label">Subscribe now to our Newsletter</p>
                <div class="newsletter-form">
                        <input type="email" class="form-control" name="subscriber_email" placeholder="Enter your Email">
                        <input type="hidden" name="kv_submit_subscription" value="Submit">
<!--                        <input type="submit" name="submit_form" value="Submit">-->
                        <button class="search-submit" type="submit">Subscribe</i></button>

                </div>
            </form>

    <?php }

} ?>