<?php
$productgridimagesize= get_theme_mod( 'product_grid_image_size','full' );
$productgridimagewidth= get_theme_mod( 'product_grid_image_width','' );
$productgridimageheight= get_theme_mod( 'product_grid_image_height','' );
$ids = get_post_meta($post->ID, 'vdw_gallery_id', true);

?>
<?php if ( has_post_format( 'gallery' )) { ?>

 <ul class="without-thumb">
                   
           
             <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value,$size = 'full'); ?>
             <li data-thumb="<?php echo esc_url($image[0]); ?>"> 

                <img src="<?php echo esc_url($image[0]); ?>" alt="gallery-image" />
            </li>
             <?php endforeach; endif; ?>
        </ul>
        <?php } else {?>
 <?php if ($productgridimagesize=='custom'){ ?>


 <?php
                        // display featured image?
                        if ( has_post_thumbnail() ) :
                            the_post_thumbnail('mayosis-custom-thumb');
                        endif;

                        ?>

<?php } else { ?>

            <?php
                        // display featured image?
                        if ( has_post_thumbnail() ) :
                            the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                        endif;

                        ?>
 <?php } ?>
                        
<?php }?>