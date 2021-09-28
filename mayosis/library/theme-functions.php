<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function mayosis_preview_fix ($query) {
    if ( !is_page() ) {
        if( $query->is_main_query() && array_key_exists('preview_id', $_GET) ) {
            $post_types = array( 'download','post' );
            $query->set( 'post_type', $post_types );
        }
    }
}
add_filter( 'pre_get_posts', 'mayosis_preview_fix' );


// Menu Fallback
function mayosis_default_menu()
{
    get_template_part('includes/fallback-menu.php');
}


#-----------------------------------------------------------------#
# Ajax URL
#-----------------------------------------------------------------#
if( ! function_exists( 'mayosis_ajax' ) ){
    function mayosis_ajax() {
        ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
        <?php
    }
}
add_action('wp_head','mayosis_ajax');


#-----------------------------------------------------------------#
# ACF Dependency
#-----------------------------------------------------------------#/
function mayosis_disable_acf_on_frontend($plugins)
{
    if (is_admin())
        return $plugins;
    foreach ($plugins as $i => $plugin)
        if ('advanced-custom-fields-pro/acf.php' == $plugin)
            unset($plugins[$i]);
    return $plugins;
}
add_filter('option_active_plugins', 'mayosis_disable_acf_on_frontend');


#-----------------------------------------------------------------#
# Comment on EDD Download
#-----------------------------------------------------------------#/
function mayosis_edd_add_comments_support($supports)
{
    $supports[] = 'comments';
    return $supports;
}
add_filter('edd_download_supports', 'mayosis_edd_add_comments_support');

#-----------------------------------------------------------------#
# Mayosis Paginantion
#-----------------------------------------------------------------#/
if (!function_exists('mayosis_page_navs')): /**
 * Displays post pagination links
 *
 * @since mayosis 1.0
 */
    function mayosis_page_navs($query = false)
    {
        global $wp_query;
        if ($query) {
            $temp_query = $wp_query;
            $wp_query   = $query;
        }
        // Return early if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        ?>
        <div class="common-paginav text-center">
            <div class="pagination">
                <?php
                $big = 999999999; // need an unlikely integer
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages,
                    'prev_text' => 'Previous',
                    'next_text' => 'Next'
                ));
                ?>
            </div>
        </div>
        <?php
        if (isset($temp_query)) {
            $wp_query = $temp_query;
        }
    }
endif;



#-----------------------------------------------------------------#
# Download Dropdown Category
#-----------------------------------------------------------------#/
function mayosis_get_terms_dropdown($taxonomies, $args)
{
    $myterms = get_terms($taxonomies, $args);
    $output  = "<div class='download_cat_filter '><select name='download_cats'>";
    $output .= "<option value='all'>" . esc_html__("All", "mayosis") . "</option>";
    foreach ($myterms as $term) {
        $term_name = $term->name;
        $slug      = $term->slug;
        $output .= "<option value='" . $slug . "'>" . $term_name . "</option>";
    }
    $output .= "</select></div>";
    return $output;
}


function mayosis_vendor_cat_dropdown($taxonomies, $args)
{
    $myterms = get_terms($taxonomies, $args);
    $output  = "<div class='mayosis_vendor_cat'><select name='download_cats'>";
    $output .= "<option value='all'>" . esc_html__("All", "mayosis") . "</option>";
    foreach ($myterms as $term) {
        $term_name = $term->name;
        $slug      = $term->slug;
        $output .= "<option value='" . $slug . "'>" . $term_name . "</option>";
    }
    $output .= "</select></div>";
    return $output;
}



add_filter('edd_has_variable_price', 'special_nav_class', 10, 2);
function mayosis_excerpt($limit)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
    return $excerpt;
}
function mayosis_content($limit)
{
    $content = explode(' ', get_the_content(), $limit);
    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(" ", $content) . '...';
    } else {
        $content = implode(" ", $content);
    }
    $content = preg_replace('/[.+]/', '', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
function mayosis_description($limit)
{
    $description = explode(' ', the_author_meta('description'), $limit);
    if (count($description) >= $limit) {
        array_pop($description);
        $description = implode(" ", $description) . '...';
    } else {
        $description = implode(" ", $description);
    }
    $description = preg_replace('`[[^]]*]`', '', $description);
    return $description;
}
#-----------------------------------------------------------------#
# Title Clipping
#-----------------------------------------------------------------#/
function mayosis_short_title($after = '', $length)
{
    $mytitle = explode(' ', get_the_title(), $length);
    if (count($mytitle) >= $length) {
        array_pop($mytitle);
        $mytitle = implode(" ", $mytitle) . $after;
    } else {
        $mytitle = implode(" ", $mytitle);
    }
    return $mytitle;
}



#-----------------------------------------------------------------#
# HEX to RGB Converter
#-----------------------------------------------------------------#/

function mayosis_hexto_rgb($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}


#-----------------------------------------------------------------#
# Easy social share
#-----------------------------------------------------------------#/

add_filter('essb_is_theme_integrated', 'mayosis_essb_is_in_theme');
function mayosis_essb_is_in_theme() {
    return true;
}

#-----------------------------------------------------------------#
# Mayosis Elementor CPT Support
#-----------------------------------------------------------------#/
function mayosis_ele_cpt_support() {

    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );

    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'product_template','footer_builder','edd_archive_builder']; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }

    //if it DOES exist, but product_template is NOT defined
    else if( ! in_array( 'product_template', $cpt_support ) ) {
        $cpt_support[] = 'product_template'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }

    //if it DOES exist, but product_template is NOT defined
    else if( ! in_array( 'footer_builder', $cpt_support ) ) {
        $cpt_support[] = 'footer_builder'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }

    else if( ! in_array( 'edd_archive_builder', $cpt_support ) ) {
        $cpt_support[] = 'edd_archive_builder'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }

    //otherwise do nothing, product_template already exists in elementor_cpt_support option
}
add_action( 'after_switch_theme', 'mayosis_ele_cpt_support' );