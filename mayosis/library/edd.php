<?php
/**
 * Custom edd
 *
 * Learn more: http://docs.easydigitaldownloads.com/
 *
 */
$productgridsystem= get_theme_mod( 'product_grid_system','one' );

#-----------------------------------------------------------------#
# Mayosis Product Builder
#-----------------------------------------------------------------#/

if (!function_exists('mayosis_product_builder') ) {
function mayosis_product_builder() {
    $custom_options = get_field('select_custom_template');
        if ($custom_options){
        $product = $custom_options; 
        if ( function_exists('icl_object_id') ) {
        $product =  icl_object_id($product, 'product_template', false,ICL_LANGUAGE_CODE); 
        }
        } else {
        $product = get_theme_mod( 'select_product_blocks','');  
        if ( function_exists('icl_object_id') ) {
        $product =  icl_object_id($product, 'product_template', false,ICL_LANGUAGE_CODE); 
        }
        }
       
         if (!empty($product)) {
             echo  '<div  class="mayosis-product-builder w-full"><div class="product-content-holder">'. \Elementor\Plugin::$instance->frontend->get_builder_content( intval($product) ). '</div></div>';
         }
	

}

}

add_action( 'wp_enqueue_scripts','mayosis_ele_product_css_loader', 500 );
 function mayosis_ele_product_css_loader() {
	if ( ! class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
		return;
	}
     $page_meta = get_post_meta( get_the_ID(), 'pivoo_page_options', true );
    $custom_options =  get_field('select_custom_template');
        if ($custom_options == 'enabled'){
        $product = $custom_options;  
        if ( function_exists('icl_object_id') ) {
        $product =  icl_object_id($product, 'product_template', false,ICL_LANGUAGE_CODE); 
        }
        } else {
        $product = get_theme_mod( 'select_product_blocks',''); 
        if ( function_exists('icl_object_id') ) {
        $product =  icl_object_id($product, 'product_template', false,ICL_LANGUAGE_CODE); 
        }
        }
	$template_id = $product;

	$css_file = new \Elementor\Core\Files\CSS\Post( $template_id );
	$css_file->enqueue();
}
#-----------------------------------------------------------------#
# Mayosis Archive Builder
#-----------------------------------------------------------------#/

if (!function_exists('mayosis_eddarchive_builder') ) {
function mayosis_eddarchive_builder() {
    $term = get_queried_object();
    $custom_options = get_field('edd_category_template', $term);
        if ($custom_options){
        $product = $custom_options;  
        if ( function_exists('icl_object_id') ) {
        $product =  icl_object_id($product, 'product_template', false,ICL_LANGUAGE_CODE); 
        }
        } else {
        $product = get_theme_mod( 'select_product_archive_blocks','');  
        if ( function_exists('icl_object_id') ) {
        $product =  icl_object_id($product, 'product_template', false,ICL_LANGUAGE_CODE); 
        }
        }
       
         if (!empty($product)) {
             echo  '<div  class="mayosis-product-builder w-full"><div class="product-content-holder">'. \Elementor\Plugin::$instance->frontend->get_builder_content( intval($product) ). '</div></div>';
         }
	

}

}

add_action( 'wp_enqueue_scripts','mayosis_ele_archive_css_loader', 500 );
 function mayosis_ele_archive_css_loader() {
	if ( ! class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
		return;
	}
     $term = get_queried_object();
    $custom_options = get_field('edd_category_template', $term);
        if ($custom_options == 'enabled'){
        $product = $custom_options;  
        if ( function_exists('icl_object_id') ) {
        $product =  icl_object_id($product, 'product_template', false,ICL_LANGUAGE_CODE); 
        }
        } else {
        $product = get_theme_mod( 'select_product_archive_blocks',''); 
        if ( function_exists('icl_object_id') ) {
        $product =  icl_object_id($product, 'product_template', false,ICL_LANGUAGE_CODE); 
        }
        }
	$template_id = $product;

	$css_file = new \Elementor\Core\Files\CSS\Post( $template_id );
	$css_file->enqueue();
}




if ( class_exists( 'Easy_Digital_Downloads' ) && class_exists( 'mayosis_core' )) :
        /**
         * Email Template
         */
        
        function mayosis_edd_register_email_template( $templates ) {
            $templates['mayosis-simple'] = 'Mayosis Simple';
            return $templates;
        }
        add_filter( 'edd_email_templates', 'mayosis_edd_register_email_template' );


    function mayosis_email_custom_fields( $settings ) {
        global $edd_options;
   
     
            $mayosis_extra_settings = array(
                array(
                    'id'         => 'mayosis_simple_mailing_address',
                    'name'       => __( 'Add Mailing Address', 'mayosis' ),
                    'desc'       => __( 'add a mailing address for footer', 'mayosis' ),
                    'type'       => 'text',

                ),

                array(
                    'id'         => 'mayosis_product_cover',
                    'name'       => __( 'Add product Cover Image', 'mayosis' ),
                    'desc'       => __( 'upload product cover image', 'mayosis' ),
                    'type'       => 'upload',

                ),

            );
        

        return array_merge( $settings, $mayosis_extra_settings );
    }
    add_filter( 'edd_settings_emails', 'mayosis_email_custom_fields' );



///////////////////////////////////////////////////////////////////////////////////////////
//////////////////////   EDD Sale Count /////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

    if( ! function_exists( 'dm_get_edd_sale_count' ) ){
        function mayosis_get_edd_sale_count($postID){
            return get_post_meta( $postID, '_edd_download_sales', true );
        }
    }


    function edd_count_total_file_downloads() {
        global $edd_logs;
        return $edd_logs->get_log_count( null, 'file_download' );
    }


endif;

/**
 * Show the list of products when the cart is empty
 *
 * @since 1.0
 */
function checkout_empty_cart_template() {
$empty_cart_title = get_theme_mod('empty_cart_title','Your Cart is Empty');
$empty_cart_subtitle = get_theme_mod('empty_cart_subtitle','No Problem, Lets Start Browse');
    echo ( '<section id="Section_empty_cart">
            <div class="container">
			    <div class="row">
                        
                      <div class="col-md-12 empty_cart_icon">
                      <i class="fa fa-shopping-cart"></i>
                      <h1>'.$empty_cart_title.'</h1>
                      <h2>'.$empty_cart_subtitle.'</h2>
						</div>

                    </div>
                
            </div>
        </section>' );
    get_template_part( 'content/content', 'product-footer' );
}
add_filter( 'edd_cart_empty', 'checkout_empty_cart_template' );

/**
 * Add wrapper class to EDD [download] shortcode
 *
 * @since mayosis 1.0
 */
  if ($productgridsystem=='three') {
function mayosis_edd_download_wrap( $class, $atts ) {
    
         return 'justified-edd-shortcode container gridzy justified-gallery-main gridzyLightProgressIndicator gridzyAnimated ' . $class;
   
    
   
}
add_filter( 'edd_downloads_list_wrapper_class', 'mayosis_edd_download_wrap', 10, 2 );

 } elseif ($productgridsystem=='two') {
     
     function mayosis_edd_download_wrap( $class, $atts ) {
    
         return 'product-masonry product-masonry-gutter product-masonry-style-2 product-masonry-masonry product-masonry-full product-masonry-3-column ' . $class;
   
    
   
}
add_filter( 'edd_downloads_list_wrapper_class', 'mayosis_edd_download_wrap', 10, 2 );

 } else {
     
     function mayosis_edd_download_wrap( $class, $atts ) {
    
        $productarchivecolgrid= get_theme_mod( 'product_archive_column_grid','two' );
        
        if ($productarchivecolgrid=='one') {
       $newclass= 'mayosis_edd_download_columns_2';
        }  elseif ($productarchivecolgrid=='three') {
            $newclass= 'mayosis_edd_download_columns_4';
            
        } elseif ($productarchivecolgrid=='four') {
            $newclass= 'mayosis_edd_download_columns_6';
        } else {
             $newclass= 'edd_download_columns_3';
        }
         return 'dm-default-wrapper download-wrapper ' . $newclass;
    
   
}
add_filter( 'edd_downloads_list_wrapper_class', 'mayosis_edd_download_wrap', 10, 2 );
     
 }
/**
 * Change checkout page image size
 *
 * @since mayosis 1.0
 */
function mayosis_filter_edd_checkout_image_size( $array ) {
    return array( 120, 80 );
}
add_filter( 'edd_checkout_image_size', 'mayosis_filter_edd_checkout_image_size', 10, 1 );

if ( class_exists( 'EDD_Wish_Lists' ) ) {

    function mayosis_remove_favorites() {
        // remove from default location
        remove_action( 'edd_purchase_link_end', 'edd_favorites_load_link' );

        remove_action( 'edd_purchase_link_top', 'edd_favorites_load_link' );

    }
    add_action( 'template_redirect', 'mayosis_remove_favorites' );



    /**
     * Remove standard favorite links
     * @return [type] [description]
     */
    function mayosis_wisthlist_load() {
        // remove standard add to wish list link
        remove_action( 'edd_purchase_link_top', 'edd_favorites_load_link' );

        // add our new link
        add_action( 'edd_purchase_link_top', 'edd_wl_load_wish_list_link' );
    }
    add_action( 'template_redirect', 'mayosis_wisthlist_load' );
}



function mayosis_edd_email_tags() {

    $mayosis_email_tags = array(
        array(
            'tag'         => 'mayosis_download_list',
            'description' => __( 'A list of download links for each download purchased', 'mayosis' ),
            'function'    => 'mayosis_get_edd_email_tags'
        ),
    );
    // Apply edd_email_tags filter
    $mayosis_email_tags = apply_filters( 'edd_email_tags', $mayosis_email_tags );

    // Add email tags
    foreach ( $mayosis_email_tags as $email_tag ) {
        edd_add_email_tag( $email_tag['tag'], $email_tag['description'], $email_tag['function'] );
    }

}
add_action( 'edd_add_email_tags', 'mayosis_edd_email_tags' );


/**
 * Email template tag: download_list
 * A list of download links for each download purchased
 *
 * @param int $payment_id
 *
 * @return string download_list
 */
function mayosis_get_edd_email_tags( $payment_id ) {
    $payment = new EDD_Payment( $payment_id );

    $payment_data  = $payment->get_meta();
    $mayosis_download_list = '<div class="mayo-simple-ui">';
    $cart_items    = $payment->cart_details;
    $email         = $payment->email;

    if ( $cart_items ) {
        $show_names = apply_filters( 'edd_email_show_names', true );
        $show_links = apply_filters( 'edd_email_show_links', true );

        foreach ( $cart_items as $item ) {

            if ( edd_use_skus() ) {
                $sku = edd_get_download_sku( $item['id'] );
            }

            if ( edd_item_quantities_enabled() ) {
                $quantity = $item['quantity'];
            }

            $price_id = edd_get_cart_item_price_id( $item );
            if ( $show_names ) {
                $mayosis_download_list .= '<div class="every-product-term-thg"><div class="email-first-pd-tf">';
                $title = '<p class="m-i-title">' . get_the_title( $item['id'] ) . '';
                if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $item['id'] ) ) {
                    $mayosis_download_list .= get_the_post_thumbnail( $item['id'], apply_filters( 'mayosis-email-thumbnail', array( 75,50 ) ) );
                }
                if ( ! empty( $quantity ) && $quantity > 1 ) {
                    $title .= "&nbsp;&ndash;" . __( 'x', 'mayosis' ) . '' . $quantity;
                }

                if ( ! empty( $sku ) ) {
                    $title .= "&nbsp;&ndash;&nbsp;" . __( 'SKU', 'mayosis' ) . ': ' . $sku;
                }

                if( ! empty( $price_id ) && 0 !== $price_id ){
                    $title .= "&nbsp;&ndash;&nbsp;" . edd_get_price_option_name( $item['id'], $price_id, $payment_id );
                }

                $mayosis_download_list .= ' '. apply_filters( 'edd_email_receipt_download_title', $title, $item, $price_id, $payment_id ) . '</p></div><div class="extra-information-email-df">';
            }
            $mayosis_download_list .= edd_cart_item_price( $item['id'], $item['options']);
            $files = edd_get_download_files( $item['id'], $price_id );

            if ( ! empty( $files ) ) {

                foreach ( $files as $filekey => $file ) {

                    if ( $show_links ) {
                        $mayosis_download_list .= '<div class="mayosis-email-p-td">';
                        $file_url = edd_get_download_file_url( $payment_data['key'], $email, $filekey, $item['id'], $price_id );
                        $mayosis_download_list .= '<a href="' . esc_url_raw( $file_url ) . '">' . Download . '</a>';
                        $mayosis_download_list .= '</div></div>';
                    } else {
                        $mayosis_download_list .= '<div>';
                        $mayosis_download_list .= edd_get_file_name( $file );
                        $mayosis_download_list .= '</div></div>';
                    }

                }

            } elseif ( edd_is_bundled_product( $item['id'] ) ) {

                $bundled_products = apply_filters( 'edd_email_tag_bundled_products', edd_get_bundled_products( $item['id'], $price_id ), $item, $payment_id, 'download_list' );

                foreach ( $bundled_products as $bundle_item ) {

                    $mayosis_download_list .= '<div class="edd_bundled_product"><p class="m-i-title">' . get_the_title( $bundle_item ) . '</p></div>';

                    $download_files = edd_get_download_files( edd_get_bundle_item_id( $bundle_item ), edd_get_bundle_item_price_id( $bundle_item ) );

                    foreach ( $download_files as $filekey => $file ) {
                        if ( $show_links ) {
                            $mayosis_download_list .= '<div>';
                            $file_url = edd_get_download_file_url( $payment_data['key'], $email, $filekey, $bundle_item, $price_id );
                            $mayosis_download_list .= '<a href="' . esc_url( $file_url ) . '">' . Download . '</a>';
                            $mayosis_download_list .= '</div>';
                        } else {
                            $mayosis_download_list .= '<div>';
                            $mayosis_download_list .= edd_get_file_name( $file );
                            $mayosis_download_list .= '</div>';
                        }
                    }
                }

            } else {

                $no_downloads_message = apply_filters( 'edd_receipt_no_files_found_text', __( 'No files.', 'mayosis' ), $item['id'] );
                $no_downloads_message = apply_filters( 'edd_email_receipt_no_downloads_message', $no_downloads_message, $item['id'], $price_id, $payment_id );

                if ( ! empty( $no_downloads_message ) ){
                    $mayosis_download_list .= '<div>';
                    $mayosis_download_list .= $no_downloads_message;
                    $mayosis_download_list .= '</div>';
                }
            }


            if ( '' != edd_get_product_notes( $item['id'] ) ) {
                $mayosis_download_list .= ' &mdash; <small>' . edd_get_product_notes( $item['id'] ) . '</small>';
            }


            if ( $show_names ) {
                $mayosis_download_list .= '</div>';
            }
        }
    }
    $mayosis_download_list .= '</div>';
    $payment  = new EDD_Payment( $payment_id );
    $subtotal = edd_currency_filter( edd_format_amount( $payment->subtotal ), $payment->currency );
    $tax     = edd_currency_filter( edd_format_amount( $payment->tax ), $payment->currency );
    $price   = edd_currency_filter( edd_format_amount( $payment->total ), $payment->currency );
    $mayosis_download_list .= '<div style="overflow:hidden;padding-bottom:15px;">';
    $mayosis_download_list .= '<div class="bottom-payment-gateway-email">';
    $mayosis_download_list .= '<span>Purchased via '. edd_get_gateway_checkout_label( $payment->gateway ). '</span>';
    $mayosis_download_list .= '<span>at '. date_i18n( get_option( 'date_format' ), strtotime( $payment->date ) ). '</span>';
    $mayosis_download_list .= '</div>';
    $mayosis_download_list .= '<ul class="bottom-tag-detailsout">';

    $mayosis_download_list .= '<li><span>Sub Total:</span> ' . html_entity_decode( $subtotal, ENT_COMPAT, 'UTF-8' ).'</li>';
    $mayosis_download_list .= '<li><span>Tax: </span>' . html_entity_decode(  $tax, ENT_COMPAT, 'UTF-8' ).'</li>';
    $mayosis_download_list .= '<li><strong class="strong-caps-left">Total Payment: </strong><strong>' . html_entity_decode(  $price, ENT_COMPAT, 'UTF-8' ).'</strong></li>';


    $mayosis_download_list .= '</ul>';
    $mayosis_download_list .= '</div>';
    return $mayosis_download_list;
}