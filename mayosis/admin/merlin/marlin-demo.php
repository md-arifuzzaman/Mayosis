<?php
/**
 * Available filters for extending Merlin WP.
 *
 * @package   Merlin WP
 * @version   @@pkg.version
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */

/**
 * Filter the home page title from your demo content.
 * If your demo's home page title is "Home", you don't need this.
 *
 * @param string $output Home page title.
 */
function mayosis_merlin_content_home_page_title( $output ) {
	return 'Mayosis front page';
}
add_filter( 'merlin_content_home_page_title', 'mayosis_merlin_content_home_page_title' );

/**
 * Filter the blog page title from your demo content.
 * If your demo's blog page title is "Blog", you don't need this.
 *
 * @param string $output Index blogroll page title.
 */
function mayosis_merlin_content_blog_page_title( $output ) {
	return 'Blog';
}
add_filter( 'merlin_content_blog_page_title', 'mayosis_merlin_content_blog_page_title' );

/**
 * Add your widget area to unset the default widgets from.
 * If your theme's first widget area is "sidebar-1", you don't need this.
 *
 * @see https://stackoverflow.com/questions/11757461/how-to-populate-widgets-on-sidebar-on-theme-activation
 *
 * @param  array $widget_areas Arguments for the sidebars_widgets widget areas.
 * @return array of arguments to update the sidebars_widgets option.
 */
function mayosis_merlin_unset_default_widgets_args( $widget_areas ) {

	$widget_areas = array(
		'sidebar-1' => array(),
	);

	return $widget_areas;
}
add_filter( 'merlin_unset_default_widgets_args', 'mayosis_merlin_unset_default_widgets_args' );

/**
 * Custom content for the generated child theme's functions.php file.
 *
 * @param string $output Generated content.
 * @param string $slug Parent theme slug.
 */
function mayosis_generate_child_functions_php( $output, $slug ) {

	$slug_no_hyphens = strtolower( preg_replace( '#[^a-zA-Z]#', '', $slug ) );

	$output = "
		<?php
		/**
		 * Theme functions and definitions.
		 */
		function {$slug_no_hyphens}_child_enqueue_styles() {

		    if ( SCRIPT_DEBUG ) {
		        wp_enqueue_style( '{$slug}-style' , get_template_directory_uri() . '/style.css' );
		    } else {
		        wp_enqueue_style( '{$slug}-minified-style' , get_template_directory_uri() . '/style.min.css' );
		    }

		    wp_enqueue_style( '{$slug}-child-style',
		        get_stylesheet_directory_uri() . '/style.css',
		        array( '{$slug}-style' ),
		        wp_get_theme()->get('Version')
		    );
		}

		add_action(  'wp_enqueue_scripts', '{$slug_no_hyphens}_child_enqueue_styles' );\n
	";

	// Let's remove the tabs so that it displays nicely.
	$output = trim( preg_replace( '/\t+/', '', $output ) );

	// Filterable return.
	return $output;
}
add_filter( 'merlin_generate_child_functions_php', 'mayosis_generate_child_functions_php', 10, 2 );


/**
 * Define the demo import files (local files).
 *
 * You have to use the same filter as in above example,
 * but with a slightly different array keys: local_*.
 * The values have to be absolute paths (not URLs) to your import files.
 * To use local import files, that reside in your theme folder,
 * please use the below code.
 * Note: make sure your import files are readable!
 */
function mayosis_merlin_import_file_urls() {
	return array(
	array(
            'import_file_name'             => 'Main Demo(Elementor)',
            'categories'                   => array( 'Elementor' ),
            'import_file_url'            => 'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/main-demo/main-elementor.xml',
            'import_widget_file_url'     => 'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/main-demo/widget.wie',
            'import_customizer_file_url' => 'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/main-demo/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2018/07/01mayo2.jpg',
            'preview_url'                  => 'https://teconce.com/mayosis-maindemo/',
            'import_notice'              => __
            ( 'Before Setup Demo Please Install All Plugin Requireds.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues.', 'mayosis' ),
        ),
        
        array(
            'import_file_name'             => 'Main Demo(WP Bakery)',
            'categories'                   => array( 'WPBakery' ),
            'import_file_url'            => 'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/main-demo/main.xml',
            'import_widget_file_url'     => 'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/main-demo/widget.wie',
            'import_customizer_file_url' => 'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/main-demo/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2018/07/01mayo2.jpg',
            'preview_url'                  => 'https://teconce.com/mayosis-maindemo/',
            'import_notice'              => __
            ( 'Before Setup Demo Please Install All Plugin Requireds.Intall WPBakery as Page Builder.For Import You Need to wait 3-5 Mintues.', 'mayosis' ),
        ),


        array(
            'import_file_name'             => 'Mayo Photos Demo(Elementor)',
            'categories'                   => array( 'Elementor' ),
            'import_file_url'            => 'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayophoto/main-elementor.xml',
            'import_widget_file_url'     =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayophoto/widget.wie',
            'import_customizer_file_url' =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayophoto/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2018/07/01mayo-2.jpg',
            'preview_url'                  => 'https://teconce.com/mayosis-mayophoto/',
            'import_notice'              => __
            ( 'Before Setup Demo Please Install All Plugin Requireds.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues.', 'mayosis' ),
        ),
        
        
        
         array(
            'import_file_name'             => 'Mayo Photos Demo(WP Bakery)',
            'categories'                   => array( 'WPBakery' ),
            'import_file_url'            =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayophoto/main-vc.xml',
            'import_widget_file_url'     =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayophoto/widget.wie',
            'import_customizer_file_url' =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayophoto/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2018/07/01mayo-2.jpg',
            'preview_url'                  => 'https://teconce.com/mayosis-mayophoto/',
            'import_notice'              => __
            ( 'Before Setup Demo Please Install All Plugin Requireds.Intall WPbakery as Page Builder.For Import You Need to wait 3-5 Mintues.', 'mayosis' ),
        ),
        
        array(
            'import_file_name'             => 'Graphic Market Multivendor Demo(Elementor)',
            'categories'                   => array( 'Elementor' ),
            'import_file_url'            =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/graphicmarket/elementor.xml',
            'import_widget_file_url'     =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/graphicmarket/widget.wie',
            'import_customizer_file_url' =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/graphicmarket/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2019/01/graphic-design-multivendor-home.jpg',
            'preview_url'                  => 'https://teconce.com/mayosis-graphicmarket/',
            'import_notice'              => __
            ( 'You Should Install Frontend Submission before use this demo.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues.', 'mayosis' ),
        ),
        
        array(
            'import_file_name'             => 'Graphic Market Multivendor Demo(WP Bakery)',
            'categories'                   => array( 'WPBakery' ),
            'import_file_url'            =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/graphicmarket/vc.xml',
            'import_widget_file_url'     =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/graphicmarket/widget.wie',
            'import_customizer_file_url' =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/graphicmarket/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2019/01/graphic-design-multivendor-home.jpg',
            'preview_url'                  => 'https://teconce.com/mayosis-graphicmarket/',
            'import_notice'              => __
            ( 'You Should Install Frontend Submission before use this demo.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues.', 'mayosis' ),
        ),
        
        array(
            'import_file_name'             => 'Videokit (Elementor)',
            'categories'                   => array( 'Elementor' ),
            'import_file_url'            =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/videokit/elementor.xml',
            'import_widget_file_url'     =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/videokit/widget.wie',
            'import_customizer_file_url' =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/videokit/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2019/07/videokit.jpg',
            'preview_url'                  => 'https://teconce.com/videokit/',
            'import_notice'              => __
            ( 'If you want to make this site subscription base you should install All Access before use this demo.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues. After import please make all product format video from each download!', 'mayosis' ),
        ),
        
        
         array(
            'import_file_name'             => 'Stockpik (Elementor)',
            'categories'                   => array( 'Elementor' ),
            'import_file_url'            =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/stockpik/elementor.xml',
            'import_widget_file_url'     =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/stockpik/widget.wie',
            'import_customizer_file_url' =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/stockpik/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2019/10/stockpik.jpg',
            'preview_url'                  => 'https://teconce.com/stockpik/',
            'import_notice'              => __
            ( 'If you want to make this site subscription base you should install All Access before use this demo.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues. After import please make all product format video from each download!', 'mayosis' ),
        ),
        
        
         array(
            'import_file_name'             => 'Musicum (Elementor)',
            'categories'                   => array( 'Elementor' ),
            'import_file_url'            =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/musicum/elementor.xml',
            'import_widget_file_url'     =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/musicum/widget.wie',
            'import_customizer_file_url' =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/musicum/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2019/10/stockpik.jpg',
            'preview_url'                  => 'https://teconce.com/musicum/',
            'import_notice'              => __
            ( 'If you want to make this site subscription base you should install All Access before use this demo.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues. After import please make all product format video from each download!', 'mayosis' ),
        ),
        
        array(
            'import_file_name'             => 'Mayofont (Elementor)',
            'categories'                   => array( 'Elementor' ),
            'import_file_url'            =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayofont/elementor.xml',
            'import_widget_file_url'     =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayofont/widget.wie',
            'import_customizer_file_url' =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayofont/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2019/10/stockpik.jpg',
            'preview_url'                  => 'https://teconce.com/mayofont/',
            'import_notice'              => __
            ( 'If you want to make this site subscription base you should install All Access before use this demo.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues. After import please make all product format video from each download!', 'mayosis' ),
        ),
        
          array(
            'import_file_name'             => 'Mayocraft (Elementor)',
            'categories'                   => array( 'Elementor' ),
            'import_file_url'            =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayocraft/content.xml',
            'import_widget_file_url'     =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayocraft/widgets.wie',
            'import_customizer_file_url' =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayocraft/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2021/01/mayocraft-1.jpg',
            'preview_url'                  => 'https://mayo.teconcetheme.com/mayocraft',
            'import_notice'              => __
            ( 'If you want to make this site subscription base you should install All Access before use this demo.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues. After import please make all product format video from each download!', 'mayosis' ),
        ),
        
        array(
            'import_file_name'             => 'Mayoarty (Elementor)',
            'categories'                   => array( 'Elementor' ),
            'import_file_url'            =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayoarty/content.xml',
            'import_widget_file_url'     =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayoarty/widgets.wie',
            'import_customizer_file_url' =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayoarty/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2021/01/mayoarty-1.jpg',
            'preview_url'                  => 'https://mayo.teconcetheme.com/mayoarty',
            'import_notice'              => __
            ( 'If you want to make this site subscription base you should install All Access before use this demo.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues. After import please make all product format video from each download!', 'mayosis' ),
        ),
        
        array(
            'import_file_name'             => 'RTL Demo(Elementor)',
            'categories'                   => array( 'Elementor' ),
            'import_file_url'            =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayortl/rtl.xml',
            'import_widget_file_url'     =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayortl/widget.wie',
            'import_customizer_file_url' =>  'https://demo-data.nyc3.digitaloceanspaces.com/Mayosis/mayortl/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2019/01/mayortl.png',
            'preview_url'                  => 'https://teconce.com/mayosisrtl/',
            'import_notice'              => __
            ( 'You Should Change Language to a RTL Language before use this demo.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues.', 'mayosis' ),
        ),

    );
}
add_filter( 'merlin_import_files', 'mayosis_merlin_import_file_urls' );

/**
 * Execute custom code after the whole import has finished.
 */
function mayosis_merlin_after_import_setup() {
	// Assign menus to their locations.
	 $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $top_menu = get_term_by( 'name', 'Top Left Side Menu', 'nav_menu' );


	set_theme_mod( 'nav_menu_locations', array(
            'main-menu' => $main_menu->term_id,
            'top-menu' => $top_menu->term_id,
        )
    );

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'merlin_after_all_import', 'mayosis_merlin_after_import_setup' );
