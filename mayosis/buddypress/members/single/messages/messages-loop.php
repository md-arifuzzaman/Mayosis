<?php

/**
 * Fires before the members messages loop.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_before_member_messages_loop' ); ?>

<?php if ( bp_has_message_threads( bp_ajax_querystring( 'messages' ) ) ) : ?>

	<div class="pagination no-ajax" id="user-pag">

		<div class="pag-count" id="messages-dir-count">
			<?php bp_messages_pagination_count(); ?>
		</div>

		<div class="pagination-links" id="messages-dir-pag">
			<?php bp_messages_pagination(); ?>
		</div>

	</div><!-- .pagination -->

	<?php

	/**
	 * Fires after the members messages pagination display.
	 *
	 * @since BuddyPress (1.2.0)
	 */
	do_action( 'bp_after_member_messages_pagination' ); ?>

	<?php

	/**
	 * Fires before the members messages threads.
	 *
	 * @since BuddyPress (1.2.0)
	 */
	do_action( 'bp_before_member_messages_threads' ); ?>

	<form action="<?php echo bp_loggedin_user_domain() . bp_get_messages_slug() . '/' . bp_current_action() ?>/bulk-manage/" method="post" id="messages-bulk-management">

		<table id="message-threads" class="messages-notices">

			<thead>
				<tr>
					<th scope="col" class="thread-checkbox bulk-select-all fancy-checkbox">
						<!--<label class="bp-screen-reader-text" for="select-all-messages">--><?php //esc_html_e( 'Select all', 'mayosis' ); ?><!--</label>-->
						<input id="select-all-messages" type="checkbox">
						<label></label>
					</th>
					<th scope="col" class="thread-from"><?php _e( 'From', 'mayosis' ); ?></th>
					<th scope="col" class="thread-info"><?php _e( 'Subject', 'mayosis' ); ?></th>

					<?php

					/**
					 * Fires inside the messages box table header to add a new column.
					 *
					 * This is to primarily add a <th> cell to the messages box table header. Use
					 * the related 'bp_messages_inbox_list_item' hook to add a <td> cell.
					 *
					 * @since BuddyPress (2.3.0)
					 */
					do_action( 'bp_messages_inbox_list_header' ); ?>

					<?php if ( bp_is_active( 'messages', 'star' ) ) : ?>
						<th scope="col" class="thread-star"><span class="message-action-star"><span class="icon"></span> <span class="screen-reader-text"><?php _e( 'Star', 'mayosis' ); ?></span></span></th>
					<?php endif; ?>

					<th scope="col" class="thread-options"><?php _e( 'Actions', 'mayosis' ); ?></th>
				</tr>
			</thead>

			<tbody>

				<?php while ( bp_message_threads() ) : bp_message_thread(); ?>

					<tr id="m-<?php bp_message_thread_id(); ?>" class="<?php bp_message_css_class(); ?><?php if ( bp_message_thread_has_unread() ) : ?> unread<?php else: ?> read<?php endif; ?>">
						<td class="bulk-select-check fancy-checkbox">
							<input type="checkbox" name="message_ids[]" class="message-check" value="<?php bp_message_thread_id(); ?>" />
							<label></label>
						</td>

						<?php if ( 'sentbox' != bp_current_action() ) : ?>
							<td class="thread-from">
								<?php bp_message_thread_avatar( array( 'width' => 30, 'height' => 30 ) ); ?>
								<span class="from"><?php _e( 'From:', 'mayosis' ); ?></span> <?php bp_message_thread_from(); ?>
								<?php bp_message_thread_total_and_unread_count(); ?>
								<span class="activity"><?php bp_message_thread_last_post_date(); ?></span>
							</td>
						<?php else: ?>
							<td class="thread-from">
								<?php bp_message_thread_avatar( array( 'width' => 30, 'height' => 30 ) ); ?>
								<span class="to"><?php _e( 'To:', 'mayosis' ); ?></span> <?php bp_message_thread_to(); ?>
								<?php bp_message_thread_total_and_unread_count(); ?>
								<span class="activity"><?php bp_message_thread_last_post_date(); ?></span>
							</td>
						<?php endif; ?>

						<td class="thread-info">
							<p><a href="<?php bp_message_thread_view_link(); ?>" title="<?php esc_attr_e( "View Message", "mayosis" ); ?>"><?php bp_message_thread_subject(); ?></a></p>
							<p class="thread-excerpt"><?php bp_message_thread_excerpt(); ?></p>
						</td>

						<?php

						/**
						 * Fires inside the messages box table row to add a new column.
						 *
						 * This is to primarily add a <td> cell to the message box table. Use the
						 * related 'bp_messages_inbox_list_header' hook to add a <th> header cell.
						 *
						 * @since BuddyPress (1.1.0)
						 */
						do_action( 'bp_messages_inbox_list_item' ); ?>

						<?php if ( bp_is_active( 'messages', 'star' ) ) : ?>
							<td class="thread-star">
								<?php bp_the_message_star_action_link( array( 'thread_id' => bp_get_message_thread_id() ) ); ?>
							</td>
						<?php endif; ?>

						<td class="thread-options">
							<?php if ( bp_message_thread_has_unread() ) : ?>
								<a class="read" href="<?php bp_the_message_thread_mark_read_url();?>"><?php _e( 'Read', 'mayosis' ); ?></a>
							<?php else : ?>
								<a class="unread" href="<?php bp_the_message_thread_mark_unread_url();?>"><?php _e( 'Unread', 'mayosis' ); ?></a>
							<?php endif; ?>
							 |
							<a class="delete" href="<?php bp_message_thread_delete_link(); ?>"><?php _e( 'Delete', 'mayosis' ); ?></a>
						</td>
					</tr>

				<?php endwhile; ?>

			</tbody>

		</table><!-- #message-threads -->

		<div class="messages-options-nav">
			<?php bp_messages_bulk_management_dropdown(); ?>
		</div><!-- .messages-options-nav -->

		<?php wp_nonce_field( 'messages_bulk_nonce', 'messages_bulk_nonce' ); ?>
	</form>

	<?php

	/**
	 * Fires after the members messages threads.
	 *
	 * @since BuddyPress (1.2.0)
	 */
	do_action( 'bp_after_member_messages_threads' ); ?>

	<?php

	/**
	 * Fires and displays member messages options.
	 *
	 * @since BuddyPress (1.2.0)
	 */
	do_action( 'bp_after_member_messages_options' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'Sorry, no messages were found.', 'mayosis' ); ?></p>
	</div>

<?php endif;?>

<?php

/**
 * Fires after the members messages loop.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_after_member_messages_loop' ); ?>
