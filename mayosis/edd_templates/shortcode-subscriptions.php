<?php
/**
 *  EDD Template File for [edd_subscriptions] shortcode
 *
 * @description: Place this template file within your theme directory under /my-theme/edd_templates/
 *
 * @copyright  : http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      : 2.4
 */

//For logged in users only
if ( is_user_logged_in() ):

	if ( ! empty( $_GET['updated'] ) && '1' === $_GET['updated'] ) :

		?>
			<div class="edd-alert edd-alert-success">
				<?php _e( '<strong>Success:</strong> Subscription payment method updated', 'mayosis' ); ?>
			</div>
		<?php

	endif;

	//Get subscription
	$subscriber    = new EDD_Recurring_Subscriber( get_current_user_id(), true );
	$subscriptions = $subscriber->get_subscriptions( 0, array( 'active', 'expired', 'cancelled', 'failing', 'trialling' ) );

	if ( $subscriptions ) :
		do_action( 'edd_before_purchase_history' ); ?>

		<table id="edd_user_history">
			<thead>
			<tr class="edd_purchase_row">
				<?php do_action( 'edd_recurring_history_header_before' ); ?>
				<th><?php _e( 'Subscription', 'mayosis' ); ?></th>
				<th><?php _e( 'Status', 'mayosis' ); ?></th>
				<th><?php _e( 'Renewal Date', 'mayosis' ); ?></th>
				<th><?php _e( 'Initial Amount', 'mayosis' ); ?></th>
				<th><?php _e( 'Times Billed', 'mayosis' ); ?></th>
				<th><?php _e( 'Actions', 'mayosis' ); ?></th>
				<?php do_action( 'edd_recurring_history_header_after' ); ?>
			</tr>
			</thead>
			<?php foreach ( $subscriptions as $subscription ) :
				$frequency    = EDD_Recurring()->get_pretty_subscription_frequency( $subscription->period );
				$renewal_date = ! empty( $subscription->expiration ) ? date_i18n( get_option( 'date_format' ), strtotime( $subscription->expiration ) ) : __( 'N/A', 'mayosis' );
				?>
				<tr>
					<?php do_action( 'edd_recurring_history_row_start', $subscription ); ?>
					<td>
						<span class="edd_subscription_name"><?php echo get_the_title( $subscription->product_id ); ?></span><br/>
						<span class="edd_subscription_billing_cycle"><?php echo edd_currency_filter( edd_format_amount( $subscription->recurring_amount ), edd_get_payment_currency_code( $subscription->parent_payment_id ) ) . ' / ' . $frequency; ?></span>
					</td>
					<td>
						<span class="edd_subscription_status <?php echo esc_html($subscription->get_status_label()); ?>"><?php echo esc_html($subscription->get_status_label()); ?></span>
					</td>
					<td>
						<?php if( 'trialling' == $subscription->status ) : ?>
							<?php _e( 'Trialling Until:', 'mayosis' ); ?>
						<?php endif; ?>
						<span class="edd_subscription_renewal_date"><?php echo esc_html($renewal_date); ?></span>
					</td>
					<td>
						<span class="edd_subscription_initial_amount"><?php echo edd_currency_filter( edd_format_amount( $subscription->initial_amount ), edd_get_payment_currency_code( $subscription->parent_payment_id ) ); ?></span>
					</td>
					<td>
						<span class="edd_subscriptiontimes_billed"><?php echo esc_html($subscription->get_times_billed() . ' / ' . ( ( $subscription->bill_times == 0 ) ? __( 'Until cancelled', 'mayosis' ) : $subscription->bill_times )); ?></span>
					</td>
					<td>
						<a href="<?php echo esc_url( add_query_arg( 'payment_key', edd_get_payment_key( $subscription->parent_payment_id ), edd_get_success_page_uri() ) ); ?>" class="edd_subscription_invoice"><?php _e( 'View Invoice', 'mayosis' ); ?></a>
						<?php if( $subscription->can_update() ) : ?>
							&nbsp;|&nbsp;
							<a href="<?php echo esc_url( $subscription->get_update_url() ); ?>"><?php _e( 'Update Payment Method', 'mayosis' ); ?></a>
						<?php endif; ?>
						<?php if( $subscription->can_renew() ) : ?>
							&nbsp;|&nbsp;
							<a href="<?php echo esc_url( $subscription->get_renew_url() ); ?>" class="edd_subscription_renew"><?php _e( 'Renew', 'mayosis' ); ?></a>
						<?php endif; ?>
						<?php if( $subscription->can_cancel() ) : ?>
							&nbsp;|&nbsp;
							<a href="<?php echo esc_url( $subscription->get_cancel_url() ); ?>" class="edd_subscription_cancel"><?php _e( 'Cancel', 'mayosis' ); ?></a>
						<?php endif; ?>
						<?php if( $subscription->can_reactivate() ) : ?>
							&nbsp;|&nbsp;
							<a href="<?php echo esc_url( $subscription->get_reactivation_url() ); ?>" class="edd-subscription-reactivate"><?php _e( 'Reactivate', 'mayosis' ); ?></a>
						<?php endif; ?>
					</td>
					<?php do_action( 'edd_recurring_history_row_end', $subscription ); ?>

				</tr>
			<?php endforeach; ?>
		</table>

		<?php do_action( 'edd_after_recurring_history' ); ?>

	<?php else : ?>

		<p class="edd-no-purchases"><?php _e( 'You have not made any subscription purchases.', 'mayosis' ); ?></p>

	<?php endif; //end if subscription ?>

<?php endif; //end is_user_logged_in() ?>
