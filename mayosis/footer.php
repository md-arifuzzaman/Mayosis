<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 *  @package mayosis
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$footerbacktotop = get_theme_mod( 'footer_back_to_top_hide','on');
$enable_footer_builder = get_theme_mod( 'enable_footer_builder','hide');

?>
	<div class="clearfix"></div>
	
	<?php if($enable_footer_builder== 'on'){?>
	         <?php get_template_part( 'templates/footer-builder'); ?>
	<?php  } else { ?>
	
	  <?php get_template_part( 'templates/footer-normal'); ?>
	<?php } ?>
	



</div>
</div>
	<?php if($footerbacktotop== 'on'){ ?>
	<a id="back-to-top" href="#" class="back-to-top" role="button"><i class="zil zi-chevron-up"></i></a>
	<?php } ?>
<?php wp_footer(); ?>
</body>
<!-- End Main Layout --> 

</html>