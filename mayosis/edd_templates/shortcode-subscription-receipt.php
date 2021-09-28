<?php
/**
 *  EDD Template File for the Subscriptions section of [edd_receipt]
 *
 * @description: Place this template file within your theme directory under /my-theme/edd_templates/
 *
 * @copyright  : http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      : 2.4
 */

global $edd_receipt_args;

$payment       = get_post( $edd_receipt_args['id'] );
$db            = new EDD_Subscriptions_DB;
$args          = array(
	'parent_payment_id' => $payment->ID,
	'order'             => 'ASC'
);

$subscriptions = $db->get_subscriptions( $args );

//Sanity check: ensure this is a subscription download
if ( empty( $subscriptions ) ) {
	return;
}
?>
<div class="subscription-details-reciept">
<h3><?php _e( 'Subscription Details', 'mayosis' ); ?></h3>

<?php do_action( 'edd_subscription_receipt_before_table', $payment ); ?>

<table id="edd_subscription_receipt">
	<thead>
	<tr>
		<?php do_action( 'edd_subscription_receipt_header_before' ); ?>
		<th><?php _e( 'Subscription', 'mayosis' ); ?></th>
		<th><?php _e( 'Renewal Date', 'mayosis' ); ?></th>
		<th><?php _e( 'Initial Amount', 'mayosis' ); ?></th>
		<th><?php _e( 'Times Billed', 'mayosis' ); ?></th>
		<th><?php _e( 'Status', 'mayosis' ); ?></th>
		<?php do_action( 'edd_subscription_receipt_header_after' ); ?>
	</tr>
	</thead>
	<tbody>
	<?php foreach ( $subscriptions as $subscription ) :
		//Set vars
		$title        = get_the_title( $subscription->product_id );
		$renewal_date = ! empty( $subscription->expiration ) ? date_i18n( get_option( 'date_format' ), strtotime( $subscription->expiration ) ) : __( 'N/A', 'mayosis' );
		$frequency    = EDD_Recurring()->get_pretty_subscription_frequency( $subscription->period );
		?>
		<tr>
			<td>
				<span class="edd_subscription_name"><?php echo esc_html($title); ?></span><br/>
				<span class="edd_subscription_billing_cycle"><?php echo edd_currency_filter( edd_format_amount( $subscription->recurring_amount ), edd_get_payment_currency_code( $payment->ID ) ) . ' / ' . $frequency; ?></span>
			</td>
			<td>
				<?php if( 'trialling' == $subscription->status ) : ?>
					<?php _e( 'Trialling Until:', 'mayosis' ); ?>
				<?php endif; ?>
				<span class="edd_subscription_renewal_date"><?php echo esc_html($renewal_date); ?></span>
			</td>
			<td>
				<span class="edd_subscription_initial_amount"><?php echo edd_currency_filter( edd_format_amount( $subscription->initial_amount ), edd_get_payment_currency_code( $payment->ID ) ); ?></span>
			</td>
			<td>
				<span class="edd_subscription_times_billed"><?php echo esc_html($subscription->get_times_billed() . ' / ' . ( ( $subscription->bill_times == 0 ) ? __( 'Until cancelled', 'mayosis' ) : $subscription->bill_times )); ?></span>
			</td>
			<td>
				<span class="edd_subscription_status <?php echo esc_html($subscription->get_status_label()); ?>"><?php echo esc_html($subscription->get_status_label()); ?></span>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</div>
<?php
do_action( 'edd_subscription_receipt_after_table', $payment );