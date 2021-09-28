<?php
defined('ABSPATH') or die();
 $headersearchstyle= get_theme_mod( 'search_form_style','standard');
 $headerplaceholdertext= get_theme_mod( 'search_form_placeholder_cs','e.g. mockup');
 $searchhome= get_theme_mod( 'hide_searchbar_home','both');
  $categorydrop= get_theme_mod( 'header_search_category',true);

?>
 <?php if ($headersearchstyle == "ghost"): ?>
  <div class="header-ghost-form header-search-form <?php if (is_front_page() && $searchhome=="sticky") { ?>search-hide-normal-state<?php }?>">
      
      <?php elseif ($headersearchstyle == "minimal"): ?>
       <div class="header-minimal-form header-search-form <?php if (is_front_page() && $searchhome=="sticky") { ?>search-hide-normal-state<?php }?>">
      <?php else : ?>
      
      <div class="product-search-form header-search-form <?php if (is_front_page() && $searchhome=="sticky") { ?>search-hide-normal-state<?php }?>">
      <?php endif; ?>
		<form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
		    
		    <?php if ($categorydrop== true){?>
	        <?php 
				$taxonomies = array('download_category');
				$args = array('orderby'=>'count','hide_empty'=>true,'parent'   => 0,);
				echo mayosis_vendor_cat_dropdown($taxonomies, $args);
			 ?>
			 
			 <?php } ?>
		
			
			 
			<div class="search-fields">
				<input name="s" value="<?php echo (isset($_GET['s']))?$_GET['s']: null; ?>" type="text" placeholder="<?php echo esc_html($headerplaceholdertext); ?>">
				<input type="hidden" name="post_type" value="download">
			<span class="search-btn"><input value="" type="submit"></span>
			</div>
		</form>
	</div>