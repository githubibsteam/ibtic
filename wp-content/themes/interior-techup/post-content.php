<?php
/**
 * Template part for displaying posts
 *
 *
 * @subpackage techup
 * @since 1.0 
 */
?>
<div id="mt-0 post-<?php the_ID(); ?>" <?php post_class(); ?>>
<article class="mt-0">
	<div>
	  <?php
        if( is_singular() ){
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'techup' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
        }else{
            the_excerpt();
        }
		
	//arguments for query
	$query_args = array(
		'nopaging' => true,
		'post_type' => 'post',
		'post_status' => 'publish',
		'order' => 'ASC',
		'orderby' => 'title',
		'hide_empty' => 1
	);

// The Query
$the_query = new WP_Query( $query_args );

//get title from post
$main_title = get_the_title();
$postID = get_the_ID();
//echo "ID:" . $postID . "<br/>";
		
// The Loop
if ( $the_query->have_posts()) {
		
	// this is a header of posts seznam
	echo '<div class="container">
		<div class="row">
		<div class="col-lg-12">
			<div class="blog-detail">				 	
			<div class="is-layout-flow wp-block-query">
			<ul class="is-layout-flow is-flex-container columns-3 my-2 wp-block-post-template">';
	
	//while for every post which exist

	while ( $the_query->have_posts() ) { 
		
		$the_query->the_post(); //dont move with that please, you break it
		
		$categories = get_the_category(); //get array of every category
		
		foreach($categories as $category)
		{
			$category_name = $category->name; 

			// check for a Featured Image and compare post_title with category_name OR category_description with postID
			if (has_post_thumbnail() && 
				(strtolower($category_name) == strtolower($main_title) || intval($category->description) == intval($postID))
				) {

			//body of every post_button	?>
			<li class="wp-block-post post-197 post type-post status-publish format-standard has-post-thumbnail hentry category-breakdowns"> 
				<a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
					<figure class="rounded mx-5 my-3  wp-block-post-featured-image">
						<?php the_post_thumbnail(); ?>
					</figure>
					<h2 class="has-text-align-center wp-block-post-title has-large-font-size">
						<?php echo get_the_title(); ?>
					</h2>
				</a>
			</li>
		
<?php
        
		}
	}		
}
	//footer of list of post_buttons
	echo "</ul>
		</div>
		</div>
		</div>
		</div>
		</div>";
	
	/* Restore original Post Data */
	wp_reset_postdata();
	
} 
else {
	echo "No post found";
	// no posts found
}
		
		?>
		
		
	</div>
</article>
</div>