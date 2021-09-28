   <div class="post-promo-box grid_dm search--post-grid">
            <?php
            // display featured image?
            if ( has_post_thumbnail() ) :?>
                <div class="mayosis-blog-flex">
                    <div class="post-thumbnail">
                        <figure class="mayosis-fade-in">
                            <?php
                            the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                            ?>
                            <figcaption>
                                <div class="overlay_content_center">
                                    <a href="<?php
                                    the_permalink(); ?>" class="btn btn-default hover-btn"><?php esc_html_e('View Post','mayosis'); ?></a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            <?php else: ?>
            <?php endif; ?>
            <div class="mayosis-blog-flex  post-details">

                <div class="single-blog-title"><a href="<?php
                    the_permalink(); ?>"><?php
                        the_title(); ?></a></div>
                <div class="single-user-info">
                    <ul>
                        <li><a href="<?php
                            echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><i class="zil zi-user"></i> <?php
                                the_author(); ?></a></li>
                        <li class="mayo-post-cat-pr"><i class="zil zi-archive"></i> <?php mayosis_category_list();?></li>
                        <li class="date"><a href="<?php the_permalink(); ?>"><i class="zil zi-clock"></i> <?php
                                echo esc_html(get_the_date()); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>