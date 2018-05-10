<header>

    <div class=" navbar-default text-center">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <?php wp_nav_menu(apply_filters('lifestyle_wp_nav_menu_header_default', array(
                        'theme_location' => 'primary',
                        'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav ">%3$s</ul>',

                    ))
                );
                ?>
        </div>

    </div>
    </div>
    <div class="header-title text-center text-uppercase">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    </div>


</header>







