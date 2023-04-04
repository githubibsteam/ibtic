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
<!-- button to go back -->
<div class="text-left" >
	<a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a>
</div>
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
		
	//get permalink with path
	$url = get_permalink();
	
	//disembl the url to names of categories
	$catUrl = explode("/", $url, -2);
	$lengthUrl = count($catUrl);
	

	// write categories to variables
	$explode_items = (ENVIRONMENT=='local' ? 4 : 3);
	for($i = $explode_items; $i < $lengthUrl ; $i++)
	{
		$term = get_term_by('slug', $catUrl[$i], 'category');

		$id = $term->term_id;
		
		if($i == $explode_items)
		{
			$fId = $id;
		}
		else if($i > $explode_items){
			$fId = $fId."_".$id;
		}
	}
		?>
		
		<!--button to form with parametrs saved in url-->
		<div style="padding: 20px; text-align: center">
			<a href="coordtic/form?id=<?php echo $fId;?>&idpost=<?=get_the_ID();?>" class="btn-2 mt-3">Formulari de contacte</a>
		</div>
	</div>
</article>
</div>