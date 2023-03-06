<?php 
$techup_enable_portfolio_section = get_theme_mod( 'techup_enable_portfolio_section', false );
$techup_portfolio_title = get_theme_mod( 'techup_portfolio_title');
$techup_portfolio_subtitle = get_theme_mod( 'techup_portfolio_subtitle' );

if($techup_enable_portfolio_section==true ) {
  $techup_portfolio_no        = 6;
  $techup_portfolio_page      = array();
  for( $k = 1; $k <= $techup_portfolio_no; $k++ ) {
     $techup_portfolio_page[] = get_theme_mod('techup_portfolio_page'.$k); 

  }
  $techup_portfolio_args  = array(
  'post_type' => 'page',
  'post__in' => array_map( 'absint', $techup_portfolio_page ),
  'posts_per_page' => absint($techup_portfolio_no),
  'orderby' => 'post__in'
  ); 
  $techup_portfolio_query = new WP_Query( $techup_portfolio_args );
?>
-------------------------------------------------------------------
    <section id="portfolio" class="portfolio-5">
      <div class="container">
        <div class="section-title-5">
          <?php if($techup_portfolio_title) : ?>
          <h2><?php echo esc_html($techup_portfolio_title); ?></h2>
          <?php endif; ?>
          <div class="separator">
            <ul>
               <li><i class="fa fa-trophy"></i></li>
            </ul>
          </div>
          <?php if($techup_portfolio_subtitle) : ?>
          <p><?php echo esc_html($techup_portfolio_subtitle); ?></p>
          <?php endif; ?>
        </div>
        <div class="row portfolio-container">
        <?php
          $count = 0;
          while($techup_portfolio_query->have_posts() && $count <= 5 ) :
          $techup_portfolio_query->the_post();
        ?>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="portfolio-box">
              <?php the_post_thumbnail(); ?>
               <div class="portfolio-box-content">
                <ul>
                  <li><a href="#"><i class="fa fa-plus"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
            <?php
        $count = $count + 1;
        endwhile;
        wp_reset_postdata();
      ?>
          </div>
        </div>     
    </section>

    <?php } ?>