<a href="#" class="topbutton" ><i class="fa fa-chevron-up fa-2x" aria-hidden="true"></i></a>

<footer>
    <div class="container">
           <div class="foot-widget">

               <div class="row">
                   <div class="col-md-3">
                       <?php
                       dynamic_sidebar('lifestyle-footer-widget-1');
                       ?>
                   </div>
                   <div class="col-md-3">
                       <?php
                       dynamic_sidebar('lifestyle-footer-widget-2');
                       ?>
                   </div>
                   <div class="col-md-3">
                       <?php
                       dynamic_sidebar('lifestyle-footer-widget-3');
                       ?>
                   </div>
                   <div class="col-md-3">
                       <?php
                       dynamic_sidebar('lifestyle-footer-widget-4');
                       ?>
                   </div>
               </div>


           </div>

         <hr>

            <p class="copy text-center">&copy;<?php echo date('Y'); ?>  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> .All Right reserved. </p>
            <p>
                <?php my_social_icons_output() ?>
            </p>

    </div>

</footer>

</body>
</html>