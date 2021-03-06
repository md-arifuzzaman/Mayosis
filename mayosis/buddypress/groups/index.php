<?php
/**
 * BuddyPress - Groups
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 * @version 3.0.0
 */

/**
 * Fires at the top of the groups directory template file.
 *
 * @since 1.5.0
 */
do_action( 'bp_before_directory_groups_page' ); ?>

<div id="buddypress">
    
     <div id="item-header-wrap" class="d-none d-md-block">
		<div class="item-scroll-header">
	    	<div id="item-header" role="complementary">
                <h4 class="bp-mayosis-title"><?php the_title();?></h4>

			</div><!-- #item-header -->

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul>
						<?php bp_get_displayed_user_nav(); ?>

						<?php

						/**
						 * Fires after the display of member options navigation.
						 *
						 * @since 1.2.4
						 */
						do_action( 'bp_member_options_nav' ); ?>

						<li class="more"><span> </span></li>
					</ul>
				</div>
			</div><!-- #item-nav -->
		</div><!-- .item-scroll-header -->
    </div><!-- #item-header-wrap -->
    <div id="item-body" class="mayosis-bp-group">
        <div class="bp-header-image-box">
	    <div id="header-cover-image"></div>
	    <div class="header-cover-image-overlay"></div>
	    </div>

	<?php

	/**
	 * Fires before the display of the groups.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_groups' ); ?>

	<?php

	/**
	 * Fires before the display of the groups content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_groups_content' ); ?>

	<?php /* Backward compatibility for inline search form. Use template part instead. */ ?>
	<?php if ( has_filter( 'bp_directory_groups_search_form' ) ) : ?>

		<div id="group-dir-search" class="dir-search" role="search">
			<?php bp_directory_groups_search_form(); ?>
		</div><!-- #group-dir-search -->

	<?php else: ?>

		<?php bp_get_template_part( 'common/search/dir-search-form' ); ?>

	<?php endif; ?>

	<form action="" method="post" id="groups-directory-form" class="dir-form">

		<div id="template-notices" role="alert" aria-atomic="true">
			<?php

			/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
			do_action( 'template_notices' ); ?>

		</div>

		<div class="item-list-tabs" aria-label="<?php esc_attr_e( 'Groups directory main navigation', 'mayosis' ); ?>">
			<ul>
				<li class="selected" id="groups-all">
					<a href="<?php bp_groups_directory_permalink(); ?>">
						<?php
						/* translators: %s: all groups count */
						printf( __( 'All Groups %s', 'mayosis' ), '<span>' . bp_get_total_group_count() . '</span>' );
						?>
					</a>
				</li>

				<?php if ( is_user_logged_in() && bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>
					<li id="groups-personal">
						<a href="<?php echo bp_loggedin_user_domain() . bp_get_groups_slug() . '/my-groups/'; ?>">
							<?php
							/* translators: %s: current user groups count */
							printf( __( 'My Groups %s', 'mayosis' ), '<span>' . bp_get_total_group_count_for_user( bp_loggedin_user_id() ) . '</span>' );
							?>
						</a>
					</li>
				<?php endif; ?>

				<?php

				/**
				 * Fires inside the groups directory group filter input.
				 *
				 * @since 1.5.0
				 */
				do_action( 'bp_groups_directory_group_filter' ); ?>

			</ul>
		</div><!-- .item-list-tabs -->

		<div class="item-list-tabs" id="subnav" aria-label="<?php esc_attr_e( 'Groups directory secondary navigation', 'mayosis' ); ?>" role="navigation">
			<ul>
				<?php

				/**
				 * Fires inside the groups directory group types.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_groups_directory_group_types' ); ?>

				<li id="groups-order-select" class="last filter">

					<label for="groups-order-by"><?php _e( 'Order By:', 'mayosis' ); ?></label>

					<select id="groups-order-by">
						<option value="active"><?php _e( 'Last Active', 'mayosis' ); ?></option>
						<option value="popular"><?php _e( 'Most Members', 'mayosis' ); ?></option>
						<option value="newest"><?php _e( 'Newly Created', 'mayosis' ); ?></option>
						<option value="alphabetical"><?php _e( 'Alphabetical', 'mayosis' ); ?></option>

						<?php

						/**
						 * Fires inside the groups directory group order options.
						 *
						 * @since 1.2.0
						 */
						do_action( 'bp_groups_directory_order_options' ); ?>
					</select>
				</li>
			</ul>
		</div>

		<h2 class="bp-screen-reader-text"><?php
			/* translators: accessibility text */
			_e( 'Groups directory', 'mayosis' );
		?></h2>

		<div id="groups-dir-list" class="groups dir-list">
			<?php bp_get_template_part( 'groups/groups-loop' ); ?>
		</div><!-- #groups-dir-list -->

		<?php

		/**
		 * Fires and displays the group content.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_directory_groups_content' ); ?>

		<?php wp_nonce_field( 'directory_groups', '_wpnonce-groups-filter' ); ?>

		<?php

		/**
		 * Fires after the display of the groups content.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_after_directory_groups_content' ); ?>

	</form><!-- #groups-directory-form -->

	<?php

	/**
	 * Fires after the display of the groups.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_groups' ); ?>
	</div>

</div><!-- #buddypress -->

<?php

/**
 * Fires at the bottom of the groups directory template file.
 *
 * @since 1.5.0
 */
do_action( 'bp_after_directory_groups_page' );
