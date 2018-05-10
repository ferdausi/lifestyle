<?php
get_header();
?>




<div class="container">
	<div class="row">
		<div id="primary" class="content-area col-md-8">
			<main id="main" class="site-main" role="main">
				<!--        <div class="container">-->
				<?php
				if (have_posts() ) :

					while ( have_posts() ) : the_post();?>

						<?php
						get_template_part( 'post-content/content', get_post_format() );


					endwhile;

				else : ?>
				   <h3><?php echo "Nothing Found";?></h3>

					<?php
				endif;
				lifestyle_posts_pagination();

				?>

			</main><!-- .site-main -->

		</div><!-- .content-area -->

		<div class="col-md-4">

			<?php get_sidebar()?>

		</div>
	</div>
</div>

<?php get_footer();?>
