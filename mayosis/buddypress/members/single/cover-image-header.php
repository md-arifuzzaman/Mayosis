<?php

/**
 * BuddyPress - Users Cover Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */


/* TODO Remove when Buddypress fixes it */
$sq_bp_template_override = false;
if(isset( $GLOBALS['members_template'] )) {
	$sq_bp_template_override = true;
	$old_members_template        = $GLOBALS['members_template'];
	$GLOBALS['members_template'] = null;
}

?>



<?php

/**
 * Fires before the display of a member's header.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_before_member_header' ); ?>

<div id="item-header-avatar">
	<a href="<?php bp_displayed_user_link(); ?>">

		<?php bp_displayed_user_avatar( 'type=full' ); ?>

	</a>
	<?php do_action('bp_member_online_status', bp_displayed_user_id()); ?>
</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
		<h2 class="user-nicename">@<?php bp_displayed_user_mentionname(); ?></h2>
	<?php endif; ?>

	<span class="activity"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>

	<?php

	/**
	 * Fires before the display of the member's header meta.
	 *
	 * @since BuddyPress (1.2.0)
	 */
	do_action( 'bp_before_member_header_meta' ); ?>

	<div id="item-meta">

		<?php if ( bp_is_active( 'activity' ) ) : ?>

			<div id="latest-update">

				<?php bp_activity_latest_update( bp_displayed_user_id() ); ?>

			</div>

		<?php endif; ?>

		<div id="item-buttons">

			<?php

			/**
			 * Fires in the member header actions section.
			 *
			 * @since BuddyPress (1.2.6)
			 */
			do_action( 'bp_member_header_actions' ); ?>

		</div><!-- #item-buttons -->

		<?php

		 /**
		  * Fires after the group header actions section.
		  *
		  * If you'd like to show specific profile fields here use:
		  * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
		  *
		  * @since BuddyPress (1.2.0)
		  */
		 do_action( 'bp_profile_header_meta' );

		 ?>

	</div><!-- #item-meta -->

</div><!-- #item-header-content -->

<?php

/**
 * Fires after the display of a member's header.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_after_member_header' ); ?>

<?php
/* TODO Remove when Buddypress fixes it */
if ($sq_bp_template_override) {
	$GLOBALS['members_template'] = $old_members_template;
}
?>

<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
do_action( 'template_notices' ); ?>


<script>
	(function($) {
		$(document).ready(function () {
			$(document).ajaxComplete(function (event, xhr, settings) {
				if(settings.data){
					if(settings.data.indexOf("action=bp_cover_image_delete") != -1){
						$('body').removeClass('is-user-profile');
					}
				}
			});
			if(typeof(bp) !== 'undefined' && typeof(bp.Uploader) !== 'undefined' && typeof(bp.Uploader.filesQueue) !== 'undefined'){
				bp.Uploader.filesQueue.on( 'add', function(){
					$('body').addClass('is-user-profile');
				});
			}
		});
	})(jQuery);
</script>

