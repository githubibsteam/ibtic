<?php
$techup_enable_blog_section = get_theme_mod( 'techup_enable_blog_section', true );
$techup_blog_cat 		= get_theme_mod( 'techup_blog_cat', 'uncategorized' );
if($techup_enable_blog_section == true) 
{
	$techup_blog_title 	= get_theme_mod( 'techup_blog_title', esc_html__( 'Our News & Blogs','interior-techup'));
	$techup_blog_subtitle 	= get_theme_mod( 'techup_blog_subtitle', esc_html__( 'Latest News','interior-techup') );
	$techup_rm_button_label 	= get_theme_mod( 'techup_rm_button_label', esc_html__( 'Read More','interior-techup'));
	$techup_blog_count 	 = apply_filters( 'techup_blog_count', 3 );
?> 	
	<!-- blog start-->
    <section class="blog-5">
      <div class="container">
        <div class="section-title-5">
          <?php if($techup_blog_title) : ?>
            <h2><?php echo esc_html( $techup_blog_title ); ?></h2>
            <?php endif; ?>
          <div class="separator">
            <ul>
               <li><i class="fa fa-trophy"></i></li>
            </ul>
          </div>
          <?php if($techup_blog_subtitle) : ?>
            <p><?php echo esc_html( $techup_blog_subtitle ); ?></p>
            <?php endif; ?>
        </div>
            <div class="row">
                            <?php 
        if( !empty( $techup_blog_cat ) ) 
          {
          $blog_args = array(
            'post_type'    => 'post',
            'category_name'  => esc_attr( $techup_blog_cat ),
            'posts_per_page' => absint( $techup_blog_count ),
          );
          
          $blog_query = new WP_Query( $blog_args );
          if( $blog_query->have_posts() ) 
          {
            while( $blog_query->have_posts() ) 
            {
              $blog_query->the_post();
              ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box">
                            <?php the_post_thumbnail(); ?>
                        <div class="box-content">
                            <h3><?php the_title(); ?></h3>
                            <?php if ($techup_rm_button_label !=""){ ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-wraper1"><?php echo esc_html($techup_rm_button_label); ?></a>
                          <?php } ?>
                        </div>
                    </div>
                </div>
                 <?php
            }
          }
          wp_reset_postdata();
        } ?>
            </div>
                
        </div>
    </section>

<?php } ?>