<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if( !class_exists('mayosis_theme_script') ) {

    class mayosis_theme_script {

    
    public function __construct() {

    
            add_action('wp_enqueue_scripts',array( $this, 'mayosis_scripts' ));
            
             add_action('admin_enqueue_scripts',array( $this, 'mayosis_register_admin_styles' ));
            
         

        }

#-----------------------------------------------------------------#
# Enqueue Styles & scripts
#-----------------------------------------------------------------#/

public function mayosis_scripts()
{

    // Theme stylesheet.
    wp_enqueue_style('mayosis-style', get_stylesheet_uri());
    wp_enqueue_style('mayosis-bootstrap',MAYOSIS_THEMEPATH . '/css/bootstrap.min.css');
    wp_enqueue_style('mayosis-essential',MAYOSIS_THEMEPATH . '/css/essential.css');
    wp_enqueue_style( 'mayosis-plyr-style',MAYOSIS_THEMEPATH . '/css/plyr.css' );
    wp_enqueue_style( 'mayosis-main-style',MAYOSIS_THEMEPATH . '/css/main.min.css' );
    wp_style_add_data( 'mayosis-main-style', 'rtl', 'replace' );

    // Zero Icon.
    wp_enqueue_style('zeroicon-line',MAYOSIS_THEMEPATH . '/css/zero-icon-line.css');

    $fontawesomeenabled = get_theme_mod( 'disable_font_awesome','hide');
    $enablebar = get_theme_mod( 'enable_notification_bar','hide');
    if ($fontawesomeenabled == 'show'){
        wp_enqueue_style('fontawesome',MAYOSIS_THEMEPATH . '/css/all.min.css');
    }

    if ($enablebar == 'show'){
        wp_enqueue_script('mayosis-notification',MAYOSIS_THEMEPATH . '/js/jquery.notification.min.js', array('jquery'), '1.0', true);
    }

    if (class_exists('WPBakeryShortCode')):
        // Page Builder Font Icon.
        wp_enqueue_style('font-awesome');
    endif;

    wp_enqueue_script('smoothscroll',MAYOSIS_THEMEPATH . '/js/smoothscroll.min.js', array(), '1.1', true);

    wp_enqueue_script( 'html5', get_theme_file_uri( '/js/html5.js' ), array(), '3.7.3' );
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );


    wp_enqueue_script('mayosis-bootstarap',MAYOSIS_THEMEPATH . '/js/bootstrap.min.js', array(), '5.0', true);
    
    
    //Enqueue hoverIntent
    wp_enqueue_script( 'hoverIntent' );

    wp_enqueue_script('mayosis-yoututbe',MAYOSIS_THEMEPATH . '/js/youtube.js', array(), '1.0', true);
    // Theme Jquery.
    wp_enqueue_script('mayosis-theme',MAYOSIS_THEMEPATH . '/js/theme.min.js', array('jquery'), '1.0', true);

    // Common Plugin Jquery.
    wp_enqueue_script('mayosis-common',MAYOSIS_THEMEPATH . '/js/jquery.common.min.js', array(), '1.5.6', true);

    wp_enqueue_script('mayosis-smart-sticky',MAYOSIS_THEMEPATH . '/js/sticky.js', array(), '1.0', true);

    wp_enqueue_script('mayosis-sticky-social',MAYOSIS_THEMEPATH . '/js/sticky-sidebar-min.js', array(), '1.0', true);

    wp_enqueue_script('mayosis-load-more',MAYOSIS_THEMEPATH . '/js/mayosisloadmore.js', array('jquery'), '1.0', true);


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('mayosis-video-plyr',MAYOSIS_THEMEPATH . '/js/plyr.min.js', array('jquery'), '3.6.8', true);


    $mayosis_player_type = get_theme_mod( 'product_wave_audio','hide');

    $mayosis_player_style = get_theme_mod( 'product_wave_style','standard');

    if ($mayosis_player_type == 'show'){
        if ( has_post_format( 'audio' ) && is_singular( 'download' )) {

            if ($mayosis_player_style=="fixed"){
                wp_enqueue_style('mayosis-awp_fixed_bar',MAYOSIS_THEMEPATH . '/css/awp_fixed_bar.css');

            }else {

                wp_enqueue_style('mayosis-awp_standard_bar',MAYOSIS_THEMEPATH . '/css/awp_standard_bar.css');
            }

            wp_enqueue_style('mayosis-m-customscrollbar',MAYOSIS_THEMEPATH . '/css/jquery.mCustomScrollbar.css');
            wp_enqueue_script('mayosis-audio-wave-surfer',MAYOSIS_THEMEPATH . '/js/wavesurfer.min.js', array('jquery'), '3.3', false);

            wp_enqueue_script('mayosis-m-customscrollbar',MAYOSIS_THEMEPATH . '/js/jquery.mCustomScrollbar.concat.min.js', array('jquery'), '1.0', false);


            wp_enqueue_script('mayosis-new-cb',MAYOSIS_THEMEPATH . '/js/new_cb.js', array('jquery'), '1.0', false);

            wp_enqueue_script('mayosis-new-wave',MAYOSIS_THEMEPATH . '/js/new.js', array('jquery'), '1.0', false);
        }
    }

    // Object parallax
    wp_enqueue_script('mayosis-parallax',MAYOSIS_THEMEPATH . '/js/jquery.parallax-scroll.js', array('jquery'), '1.1', true);
    wp_enqueue_script('mayosis-object',MAYOSIS_THEMEPATH . '/js/parallax.hover.js', array('jquery'), '1.5', true);


    wp_enqueue_script('mayosis-product-gallery',MAYOSIS_THEMEPATH . '/js/gallery.main.js', array(), '0.9.4', true);

    // Before After
    wp_enqueue_script('beerslider',MAYOSIS_THEMEPATH . '/js/jquery.beerslider.js', array('jquery'), '1.1', true);
    wp_enqueue_style('beerslidercss',MAYOSIS_THEMEPATH . '/css/BeerSlider.css');


    /**
     * Enqueue jQuery Cookie
     */

    if (class_exists('Easy_Digital_Downloads') && function_exists('EDD_FES') && is_page(EDD_FES()->helper->get_option('fes-vendor-dashboard-page', false))) {
        if (isset($_GET['task']) && 'products' === $_GET['task']) {
            wp_enqueue_script('mayosis-cookie-js',MAYOSIS_THEMEPATH . '/js/jquery.cookie.js', array('jquery'), '1.4.1', true);
        }
    }

}




#-----------------------------------------------------------------#
# Register/Enqueue JS/CSS In Admin Panel
#-----------------------------------------------------------------#

public function mayosis_register_admin_styles()
{
    wp_enqueue_style('mayosis-admin-css',MAYOSIS_THEMEPATH . '/css/admin.css');

    wp_enqueue_script('mayosis-admin-js',MAYOSIS_THEMEPATH . '/js/admin.js', array('jquery'), '0.9.4', true);

}


}
 new mayosis_theme_script;
}