<?php
defined('ABSPATH') or die();
 global $current_user;
wp_get_current_user();
$bgremovelogin= get_theme_mod( 'login_logout_bg_remove' );
$logintext= get_theme_mod( 'login_text','Login' );
$logouttext= get_theme_mod( 'logout_text','Logout' );
$accountmenus = get_theme_mod( 'my_account_repeater',  array() ); 
$loginpp= get_theme_mod( 'login_popup_enable','disable');
$register_url =  get_theme_mod( 'register_url');
if ($loginpp=="enable"){
    $loginpparg="data-lity";
    $loginlink= '#mayosis_vendorlogin';
} else {
    $loginpparg="";
    $loginlink= get_theme_mod( 'login_url' );
}
?>
<ul id="account-button" class="mayosis-option-menu d-none d-lg-block">
   <?php
	if (!is_user_logged_in())
		{ ?> 
<li class="menu-item">
            <?php

            if ($bgremovelogin == 'remove'): ?>
    <a href="<?php
		echo esc_url($loginlink); ?>" <?php echo esc_html($loginpparg);?>><i class="zil zi-user"></i> <?php echo esc_html($logintext); ?></a>
            <?php else : ?>

                <a href="<?php
                echo esc_url($loginlink); ?>" class="login-button" <?php echo esc_html($loginpparg);?>><i class="zil zi-user"></i> <?php echo esc_html($logintext); ?></a>
            <?php endif; ?>
</li>

<?php
		}
	  else
		{ ?>

		<li class="dropdown cart_widget cart-style-one menu-item my-account-menu">
    <a href="#"><i class="zil zi-user"></i> <?php echo esc_html($current_user->display_name ); ?></a>
    
   
    <div class="dropdown-menu my-account-list">
        
         
     <div class="mayosis-account-user-information">
        <span><?php echo get_avatar(get_the_author_meta('email'), '40'); ?></span>
     
       <span class="user-display-name-acc"><?php echo esc_html($current_user->display_name ); ?></span>
</div>
        
     <?php wp_nav_menu( 
	array( 
	'theme_location' => 'account-menu', 
	'menu_class' => '',
	'fallback_cb' => 'mayosis_menu_walker::fallback',
	'walker'  => new mayosis_menu_walker()
	) 
); ?>
    <div class="mayosis-logout-information">
       <a href="<?php echo wp_logout_url(home_url('/'));?> " class="mayosis-logout-link"><i class="zil zi-sign-out"></i> <?php esc_html_e('Logout','mayosis');?></a>
</div>
  </div>
</li>

<?php } ?>
</ul>

<div id="account-mob" class="mayosis-option-menu d-block d-lg-none">
    <?php
	if (!is_user_logged_in())
		{ ?> 
		<div id="mayosis-sidemenu">
		       
		  <ul>
               <li class="menu-item">
                <a href="<?php
            		echo esc_url($loginlink); ?>" <?php echo esc_html($loginpparg);?>><i class="zil zi-user"></i> <?php echo esc_html($logintext); ?></a>
            </li>
        </ul>
</div>
<?php } else { ?>
<div class="inner norm"><div class="popr" data-id="3" data-mode="top"><i class="zil zi-user"></i> <?php echo esc_html($current_user->display_name ); ?> <i class="zil zi-chevron-up right-position-mob"></i></div></div>

<div class="popr-box" data-box-id="3">
<?php wp_nav_menu( 
	array( 
	'theme_location' => 'account-menu', 
	'container_id' => 'mayosis-sidemenu',
	'fallback_cb' => 'mayosis_menu_walker::fallback',
	'walker'  => new mayosis_accordion_navwalker()
	) 
); ?>
 <div class="mayosis-account-information mobile_account_info">
        <span><?php echo get_avatar(get_the_author_meta('email'), '30'); ?></span>
     
       <a href="<?php echo wp_logout_url(home_url('/'));?> " class="mayosis-logout-link"><?php esc_html_e('Logout','mayosis');?></a>
</div>
</div>

<?php } ?>
   
</div>

<div id="mayosis_vendorlogin" class="lity-hide">
              
                  <div class="modal-body">
                       <h4 class="modal-title mb-4"><?php esc_html_e('Login','mayosis');?></h4>
                      <?php echo do_shortcode(' [edd_login]'); ?>
                      <a class="sigining-up text-center" href="<?php echo esc_url($register_url);?>"><?php esc_html_e('New here? Create an account!','mayosis');?></a>
                  </div>
</div>