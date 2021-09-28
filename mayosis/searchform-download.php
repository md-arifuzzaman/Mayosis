<?php
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 $searchbehviour= get_theme_mod( 'search_behaviour','dropdown');
$searchresults = get_search_query();
?>

	<?php

if ($searchbehviour== 'collapse'): ?>
 <li class="search-one">
  <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="maxcollapse">
                <input type="search" placeholder="<?php esc_html_e( 'Type and Hit Enter', 'mayosis' ); ?>" name="s" id="s" class="maxcollapse-input"  value="<?php echo esc_html($searchresults); ?>" onkeyup="buttonUp();" required>
                <input type="submit" class="maxcollapse-submit" value="download">
                <span class="maxcollapse-icon"><i class="zil zi-search"></i></span>
            </form>
						
						</li>
<?php elseif ($searchbehviour == 'dropdown'): ?>
<li class="dropdown search-dropdown-main">
            <a href="#" class="" data-bs-toggle="dropdown"  aria-expanded="false" id="dropdownMenuLink"><i class="zil zi-search" aria-hidden="true"></i></a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li>
                <form role="search" method="get" class="search-form-none search-form-collapsed" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php $searchresults = get_search_query(); ?>
                    <input  value="<?php echo esc_html($searchresults); ?>" placeholder="<?php esc_html_e( 'Type and Hit Enter', 'mayosis' ); ?>" type="search" name="s" id="s" class="dm_search"   >
                        <button type="submit" value="Search">
                            <i class="zil zi-search" aria-hidden="true"></i>
                            <input type="hidden" name="post_type" value="download" />
                        </button>  
                        
                </form>
                </li>
              </ul>
          </li>
<?php else: ?>
<li class="d-none d-md-block"><a href="#searchoverlay" class="searchoverlay-button" data-lity><i class="zil zi-search"></i></li>

<li class="overlay_button_search d-block d-md-none"><a href="#searchoverlay" class="searchoverlay-button" data-lity><i class="zil zi-search"></i></a></li>
 <div id="searchoverlay" class="main_searchoverlay lity-hide" >
    
    <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php $searchresults = get_search_query(); ?>
        <div class="search">
          <i class="zil zi-search"></i>
          <input value="<?php echo esc_html($searchresults); ?>" placeholder="<?php esc_html_e( 'Type and Hit Enter', 'mayosis' ); ?>" type="search" name="s" id="s" class="full-screen-search" />
        
             <input type="hidden" name="post_type" value="download" />
             
        </div>
    </form>
</div>
<?php endif; ?>