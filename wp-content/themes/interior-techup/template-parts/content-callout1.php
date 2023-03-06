<?php
$techup_enable_callout_section1 = get_theme_mod( 'techup_enable_callout_section1', false );
$techup_co1_image = get_theme_mod( 'techup_co1_image' );

if($techup_enable_callout_section1 == true ) {
$techup_callout_title1 = get_theme_mod( 'techup_callout_title1');
$techup_callout_content1 = get_theme_mod( 'techup_callout_content1');
if($techup_co1_image=="")
{
	$techup_co1_image = esc_url(  get_template_directory_uri() ); 
}
?>
<section class="cta-7">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h3 class="c-white"><?php echo esc_html($techup_callout_title1); ?></h3>
				<p class="c-white mb-0"><?php echo esc_html($techup_callout_content1); ?></p>
			   <div class="flex-btn">
				  <div class="btn">
					<a href="#"><?php echo esc_html__('Contact Now','interior-techup'); ?></a>
				  </div>
			 </div>
		</div>
	</div>
</div>
</section>

<?php } ?>