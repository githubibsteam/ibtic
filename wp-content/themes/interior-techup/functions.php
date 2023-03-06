<?php
/**
 * Child Theme functions and definitions.
 * This theme is a child theme for Techup.
 *
 * @subpackage interior Techup
 * @author  wptexture https://testerwp.com/
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 */

/**
 * Theme functions and definitions.
  
*/

function publish_category( $post)
{
	
		//edit taxonomy and add parent
		
		//$catTermId = get_term_by('name', $title, 'category');
}



function automatic_category( $new_status, $old_status, $post) {
	
	//compare status if it is publish or updated
	if ( 'publish' === $new_status && 'publish' !== $old_status) //published
	{
		//include administrative functions
		require_once( ABSPATH . '/wp-admin/includes/taxonomy.php');	
		
		//get title from post
		$title = $post->post_title;

		//if it doesnt contains contr then it creates category
		//if (!str_contains($title, 'contr')) { 
	
		//cat args
		$category = array('cat_name'=> $title,
						  'category_description'=> $post->ID); //save id of post to desc because
													//category update is connected by post id
		
		//insert new category
		wp_insert_category($category);	
		
		//}
		
		
	}
	else if('publish' === $new_status && 'publish' === $old_status)//updated
	{
		//get title from post
		$title = $post->post_title;
		
		//include administrative functions
		require_once( ABSPATH . '/wp-admin/includes/taxonomy.php');
		
		//get every category that exist
		$categories = get_categories( array(
		'orderby' => 'name',
		'order'   => 'ASC',
		'hide_empty' => 0
		) );
		
		$post_categories = wp_get_post_categories( $post->ID ); //get every category conected with the post
			
					foreach ( $post_categories as $c ) {
							$cat = get_category( $c );
						  $category_termId = $cat->term_id ; //get term id
					}
		

			foreach($categories as $category){
				//compare category desc with postID because if you change the title it doesnt now 	
				//which category is connect with post
				if(intval($category->description) == intval($post->ID)){
				
					//args for updated category, there must be cat_ID for update category else it
					//creates newone
					$args = array('cat_ID'=> $category->term_id,
							   	  'cat_name'=> $title,
								  'category_description'=> $post->ID,
								  'category_parent' => $category_termId);
			//update category
			wp_insert_category($args);
			}
		}
	}
}
add_action( 'transition_post_status', 'automatic_category', 999, 3); //if transition post status
										//change it calls this function, important 999 is priority


add_action( 'template_redirect', 'wpsites_attachment_redirect');
function wpsites_attachment_redirect(){
global $post;
if ( is_attachment() && isset($post->post_parent) && is_numeric($post->post_parent) && ($post->post_parent != 0) ) :
    wp_redirect( get_permalink( $post->post_parent ), 301 );
    exit();
    wp_reset_postdata();
    endif;
}

 
add_action( 'wp_enqueue_scripts', 'interior_techup_child_css',25);
function interior_techup_child_css() {
	wp_enqueue_style( 'interior-techup-parent-theme-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'interior-techup-child-style',get_stylesheet_directory_uri() . '/child-css/child.css');
    wp_enqueue_style( 'interior-techup-child-color-style',get_stylesheet_directory_uri() . '/child-css/color.css');
	wp_enqueue_style( 'interior-techup-child-form-style',get_stylesheet_directory_uri() . '/child-css/form.css');
	wp_enqueue_script( 'interior-techup-custom-script', get_stylesheet_directory_uri() . '/child-js/custom-script.js', array(), false, true);
	wp_enqueue_style( 'interior-techup-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap' ); 
}


function interior_techup_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'techup_custom_header_args', array(
		'default-image'          => get_stylesheet_directory_uri() . '/img/header.jpg',
		'default-text-color'     => 'fff',
		'width'                  => 1920,
		'height'                 => 850,
		'flex-height'            => true,
		'wp-head-callback'       => 'mini_techup_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'interior_techup_custom_header_setup' );

if ( ! function_exists( 'mini_techup_header_style' ) ) :

	function mini_techup_header_style() {
		$header_text_color = get_header_textcolor();

		?>
		<style type="text/css">
			<?php
				if ( get_header_image() ) :
			?>
			.page-banner
			  {
				background-image:url('<?php header_image(); ?>');
			  }
		
			.site-title,.site-description
			 {
			color: #<?php echo esc_attr($header_text_color); ?>;
			
			  }

			<?php endif; ?>	
		</style>
<!--	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
		<?php
	}
endif;