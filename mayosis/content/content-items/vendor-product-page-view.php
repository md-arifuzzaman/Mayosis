 <?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $post;
$productgridsystem= get_theme_mod( 'product_grid_system','one' );
if ( is_singular( 'download' ) ) {
			$author = new WP_User( $post->post_author );
		} else {
			$author = fes_get_vendor();
		}

		if ( ! $author ) {
			$author = get_current_user_id();
}
$disablehit= get_theme_mod( 'disable_hit_count','show' );

?>

<?php if ($disablehit == 'show'){ ?>
  <div class="single--metabox--info col">
                            <h4>

                                <?php
                                global $wp_query;

                                $author_id = get_the_author_meta( 'ID',$author->ID );
                                
                                $author_posts = get_posts( array('post_type'=>'download' ,'author' => $author_id,'numberposts' => -1) );
                                
                                $counter = 0; // needed to collect the total sum of views
                                
                                foreach ( $author_posts as $post ) {
                                
                                    $views =  get_post_meta( $post->ID, 'hits', true);
                                
                                    $counter += ((int)$views);
                                }
                                echo esc_html($counter);
                                

                                ?>
                            </h4>
                            <p><?php esc_html_e('Page Views','mayosis')?></p>
                        </div>
                        <?php } ?>