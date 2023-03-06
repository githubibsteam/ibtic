<?php
/*
 * Template Name: Form
 * Template Post Type: page
 */
   
 get_header();  ?>
<div class="bg-w">
	<div class="container my-4">
		<div class="row">
			<?php if( is_active_sidebar( 'blog-sidebar' ) ){ ?>
				<div class="col-lg-8">
			<?php }else{ ?>
				<div class="col-lg-12">
			<?php } ?>
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						get_template_part( 'form-content', 'single' );
					endwhile;?>
					
					  <?php
				else :
				get_template_part( 'form-content', 'none' );
     			endif;
				if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; ?>
		</div>
		<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php
get_footer();
?>

