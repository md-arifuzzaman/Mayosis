<?php
defined('ABSPATH') or die();
/**
 * The Sidemenu Header
 *
 * @package mayosis
 * @since mayosis 1.0
 */
$mainlogo= get_theme_mod( 'main_logo' );
$mainlogoicon= get_theme_mod( 'sidebar_logo_icon' );
$defaultsidecollaspe= get_theme_mod( 'default_side_menu' ,'expanded');
$searchshowhide= get_theme_mod( 'search_cartmenu','off' );
$collapsebutton= get_theme_mod( 'collapse_button','off' );
$iconinexpand= get_theme_mod( 'icon_in_expanded','off' );
$textincollapse= get_theme_mod( 'text_in_collapsed','on' );
$secondaryheader= get_theme_mod( 'secondary_header','on' );
$showbottomsocialpart= get_theme_mod( 'bottom_social_part_sideheader','off' );
$shadow_on_sidebar = get_theme_mod('shadow_on_sidebar');

global $mayosis_options
?>
<!-- mayosis-sidebar Holder -->
 <?php if($defaultsidecollaspe == 'collapse') :?>
            <aside id="mayosis-sidebar" class="active d-none d-lg-block hide-sidebar-mob <?php echo esc_html($shadow_on_sidebar);?>">
                <?php else: ?>
                <aside id="mayosis-sidebar" class="d-none d-lg-block  hide-sidebar-mob">
                <?php endif; ?>
                <div class="sidebar-fixed">
                  
                <div class="mayosis-sidebar-header">
                    <?php if($collapsebutton=="on"){?>
                      <div class="mayosis-collapsible-box">
                            <button type="button" id="mayosis-sidebarCollapse" class="mayosis-collapse-btn burger">
                             <span></span>
                               
                            </button>
                       </div>
                       <?php } ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="sidebar-main-logo"><img src="<?php echo esc_url($mainlogo);  ?>" class="img-responsive main-logo" alt="<?php esc_html__( 'Logo', 'mayosis' ); ?>"/></a>
                  
                </div>
                <?php if($searchshowhide == 'on') :?>
                <div class="sidebar-option-menu">
	            <ul id="cart-menu" class="mayosis-option-menu">
					<?php get_template_part( 'includes/sidemenu-cart-search' ); ?>
    			</ul>
    			</div>
    			<?php endif; ?>
    			<div class="clearfix"></div>
    			<?php if($iconinexpand == 'on') :?>
    			<div class="show-expand-icon">
    			 <?php else: ?>
    			 <div class="hide-expand-icon">
    			 <?php endif;?>
    			 <?php if($textincollapse == 'on') :?>
    			 <div class="collapse-text-show">
    			     <?php else: ?>
    			     <div class="collapse-text-hide">
    			     <?php endif; ?>
               <?php get_template_part( 'includes/main-navigation' ); ?>
               
                   
               </div>
               </div>
              
               <div class="social-icon-sidebar-header">
                   <?php if($mainlogoicon){?>
                    <div class="mayosis-sidebar-s-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($mainlogoicon);  ?>" class="center-block" alt="<?php esc_html__( 'Icon', 'mayosis' ); ?>"/></a></div>
                    <?php } ?>
                    
                     <?php if ($showbottomsocialpart=="on"){?>
                      <?php get_template_part( 'includes/social-icons' ); ?>
                       <?php } ?>
                   </div>
                  
               </div>
              
            </aside>
              <!-- Page Content Holder -->
              <div id="mayosis-sidebarnav-content" class="container-fluid">
                  <div class="sidebar-header-mobile-nav d-block d-lg-none">
                  <div class="to-flex-row th-flex-flex-middle ">
                  	 <div class="to-flex-col th-col-left ">
                    
                      <?php mayosis_header_elements('header_mobile_elements_left','mobile'); ?>
                  
        </div>
                  
                  <div class="to-flex-col th-col-center ">
                    
                      <?php mayosis_header_elements('header_mobile_elements_center','mobile'); ?>
                  
                  </div>
    
    
          <div class="to-flex-col th-col-right ">
            
              <?php mayosis_header_elements('header_mobile_elements_right','mobile'); ?>
           
          </div>
          </div>
          
          </div>
              	<?php if($secondaryheader == 'on') :?>
             <?php get_template_part( 'includes/sidebar-second-header' ); ?>
             <?php endif; ?>
