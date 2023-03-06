<?php
$techup_enable_banner_section = get_theme_mod( 'techup_enable_banner_section', true );
$techup_banner_image = get_theme_mod( 'techup_banner_image', esc_url(  get_template_directory_uri() . '/assets/images/banner.jpg' ) );
$techup_banner_title = get_theme_mod( 'techup_banner_title','');
$techup_banner_content = get_theme_mod( 'techup_banner_content','');
$techup_banner_button_label1 = get_theme_mod( 'techup_banner_button_label1','');
$techup_banner_button_link1 = get_theme_mod( 'techup_banner_button_link1','');
      
if($techup_enable_banner_section==true ) {
?>  
 	<section class="hero-sec beg-img" style="background-image:url(<?php if($techup_banner_image) { echo esc_url($techup_banner_image); } else { echo esc_url(get_header_image()); } ?>)">
      <div class="container">
        <div class="row">
          <div class="content-sec">
              <h2 class="section-title">
                <?php echo esc_html($techup_banner_title); ?>
              </h2>
              <div class="heading__description">
                <p><?php echo esc_html($techup_banner_content); ?></p>
              </div>
              <?php echo do_shortcode( '[ivory-search id="776" title="Custom Search Form"]' ); ?>
              <?php if($techup_banner_button_label1) :?>
              <div class="btn-wraper">
              <a href="<?php echo esc_url($techup_banner_button_link1); ?>" class="readmore-btn"><?php echo esc_html($techup_banner_button_label1); ?></a>
            </div>
             <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

	<div id="content"></div>

    <!--End Hero-->
 
<?php
}
?>