<?php
/**
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$justified_gap= get_theme_mod( 'product_justified_gap','5' );
$productmastitle= get_theme_mod( 'product_justified_title_hover','1' );
$titileboxstyle= get_theme_mod( 'product_justified_hover_style','one' );
$author = get_user_by( 'id', get_query_var( 'author' ) );
$author_id=$post->post_author;

?>
       <div class="row">
        <div class="gridzy justified-gallery-main gridzyLightProgressIndicator gridzyAnimated" data-gridzy-spaceBetween="<?php echo esc_html($justified_gap);?>">
                                 <?php
                    $taxquery=array();
                    if(isset($_GET['download_cats']) && $_GET['download_cats'] !== 'all'){
                        $download_category = $_GET['download_cats'];

                        $taxquery =    array(
                            array(
                                'taxonomy' => 'download_category',
                                'field'    => 'slug',
                                'terms'    => $download_category
                                )
                            );
                    }
                    
                    $paged=( get_query_var( 'paged')) ? get_query_var( 'paged') : 1;
                    
                        
                            $argument = array(
                            's'            => get_search_query(),
                            'order'     => 'DESC',
                            'post_type' => 'download',
                            'paged'     => $paged,
                            'tax_query' => $taxquery
                            );
            
                    $wp_query = new WP_Query(); $wp_query->query($argument);
                    
                    if($wp_query->have_posts()){
                        while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
    <div class="justified-items" id="edd_download_<?php the_ID(); ?>">
                                  <div class="product-justify-item ">
                                      <div <?php post_class(); ?>>
                            <div class="product-justify-item-content">
                               <?php if ( has_post_format( 'video' )) { ?>
                                        <div class="item-thumbnail item-video-justify">
                                            <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                                        </div>
                                    <?php } else { ?>
                                    <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                                    <div class="item-thumbnail">
                                    <a href="<?php the_permalink();?>"><img src="<?php echo maybe_unserialize($thumbnail['0']); ?>" alt="product thumbnail"></a>
                                     </div>
                                    <?php } ?>
                                <?php if ($productmastitle==1){?>
                                
                                <?php if ($titileboxstyle== "one"){ ?>
                                <div class="product-justify-description">
                                    
                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                                    </div>
                                    
                                <?php } elseif ($titileboxstyle== "three"){ ?>
                                
                                 <div class="product-justify-description justify-style-three">
                                     <div class="product_hover_details_button">
                                  <a href="<?php the_permalink();?>"  class="button-fill-color"><?php esc_html_e('View Details','mayosis');?></a>
                                </div>
                                    
                                    </div>
                                <?php } else { ?>
                                <div class="product-justify-description justify-style-two">
                                    
                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                                    
                                    <div class="bottom-metaflex">
                                    <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
                        edd_favorites_load_link( $download_id );
                    } ?> <span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">
								     
								     <i class="zil zi-user"></i>
								 </a></span>
								 </div>
                                </div>
                                <?php } ?>
                                
                                <?php } ?>
                            </div>
                            </div>
                        </div>
                        </div>
                      <?php endwhile; ?>
<?php }
                    else { ?>
<h5>
	<?php esc_html_e("No product found","mayosis"); ?>
</h5>
<?php } ?>

<div class="col-md-12">
	<?php mayosis_page_navs(); ?>
</div>

                            </div>
    </div>