<?php

/**
 * BuddyPress - Users Groups
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
	<ul>
		<?php if ( bp_is_my_profile() ) bp_get_options_nav(); ?>

		<?php if ( !bp_is_current_action( 'invites' ) ) : ?>

			<li id="groups-order-select" class="last filter">

				<label for="groups-order-by"><?php _e( 'Order By:', 'mayosis' ); ?></label>
				<select id="groups-order-by">
					<option value="active"><?php _e( 'Last Active', 'mayosis' ); ?></option>
					<option value="popular"><?php _e( 'Most Members', 'mayosis' ); ?></option>
					<option value="newest"><?php _e( 'Newly Created', 'mayosis' ); ?></option>
					<option value="alphabetical"><?php _e( 'Alphabetical', 'mayosis' ); ?></option>

					<?php

					/**
					 * Fires inside the members group order options select input.
					 *
					 * @since BuddyPress (1.2.0)
					 */
					do_action( 'bp_member_group_order_options' ); ?>

				</select>
			</li>

		<?php endif; ?>

	</ul>
</div><!-- .item-list-tabs -->

<?php

switch ( bp_current_action() ) :

	// Home/My Groups
	case 'my-groups' :

		/**
		 * Fires before the display of member groups content.
		 *
		 * @since BuddyPress (1.2.0)
		 */
		do_action( 'bp_before_member_groups_content' ); ?>

		<div class="groups mygroups">

			<?php bp_get_template_part( 'groups/groups-loop' ); ?>

		</div>

		<?php

		/**
		 * Fires after the display of member groups content.
		 *
		 * @since BuddyPress (1.2.0)
		 */
		do_action( 'bp_after_member_groups_content' );
		break;

	// Group Invitations
	case 'invites' :
		bp_get_template_part( 'members/single/groups/invites' );
		break;

	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;
