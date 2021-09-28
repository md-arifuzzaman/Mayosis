<?php
/**
 *  EDD Template File which overrides the [edd_all_access_passes] shortcode with the details of a single All Access Pass.
 *
 * @description: Place this template file within your theme directory under /my-theme/edd_templates/ - For more information see: https://easydigitaldownloads.com/videos/template-files/
 *
 * @copyright  http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

//For logged in users only
if ( is_user_logged_in() ) {

	$all_access_pass = new EDD_All_Access_Pass( $_GET['payment_id'], $_GET['download_id'], $_GET['price_id'] );

	// Check if this All Access Pass has been upgraded
	if( 'upgraded' == $all_access_pass->status ){
		$upgraded_aa_data = explode( '_', $all_access_pass->is_prior_of );
		$upgraded_payment_id = intval( $upgraded_aa_data[0] );
		$upgraded_download_id = intval( $upgraded_aa_data[1] );
		$upgraded_price_id = intval( $upgraded_aa_data[2] );
		$upgraded_all_access_pass = new EDD_All_Access_Pass( $upgraded_payment_id, $upgraded_download_id, $upgraded_price_id );
	}

	if ( 'invalid' == $all_access_pass->status ) {
		echo __( 'Nothing found for that URL', 'mayosis' );
	} else {
		$download = new EDD_Download( $all_access_pass->download_id );

		?>
		<p class="edd-sl-manage-license-details">
			<span class="edd-sl-manage-license-product"><?php _e( 'Product', 'mayosis' ); ?>: <span><?php echo esc_html($download->get_name()); ?></span></span>
		</p>

		<table id="edd_all_access_pass_details" class="edd_all_access_table">

			<thead>
				<tr class="edd_all_access_pass_details_row">
					<?php do_action( 'edd_all_access_pass_details_header_before' ); ?>
					<th class="edd_all_access_details"><?php _e( 'Details', 'mayosis' ); ?></th>
					<th class="edd_all_access_values"><?php _e( 'Value', 'mayosis' ); ?></th>
					<?php do_action( 'edd_all_access_pass_details_header_after' ); ?>
				</tr>
			</thead>

			<tbody>
				<?php
				// Only show start and expiration dates for specific statuses
				if ( 'active' == $all_access_pass->status || 'expired' == $all_access_pass->status ) { ?>
					<tr class="edd_all_access_pass_details_row">
						<?php do_action( 'edd_all_access_pass_details_row_start', $all_access_pass ); ?>
						<td class="row-label">
							<span class="edd-aa-start-date-label"><?php _e( 'Start Date:', 'mayosis' ); ?></span>
						</td>
						<td class="row-value">
							<span class="edd-aa-start-date-value"><?php echo date( 'M d, Y, g:i a', $all_access_pass->start_time ); ?></span>
						</td>
						<?php do_action( 'edd_all_access_pass_details_row_end', $all_access_pass ); ?>
					</tr>
					<tr class="edd_all_access_pass_details_row">
						<?php do_action( 'edd_all_access_pass_details_row_start', $all_access_pass ); ?>
						<td class="row-label">
							<span class="edd-aa-expiration-date-label"><?php
							if ( 'upgraded' == $all_access_pass->status ){
								_e( 'Upgraded Date:', 'mayosis' );
							}else{
								_e( 'Expiration Date:', 'mayosis' );
							}
							?></span>
						</td>
						<td class="row-value">
							<span class="edd-aa-expiration-date-value"><?php

							// If this all access pass has been upgraded, show the upgrade date instead of the expiration.
							if ( 'upgraded' == $all_access_pass->status ){

								// The "Upgraded Date" is the time the upgrade payment took place.
								echo date( 'M d, Y, g:i a', strtotime( $upgraded_all_access_pass->payment->date ) );

							}else{

								// If we are here, this pass was not upgraded so show the normal Expiration Time.
								echo esc_html($all_access_pass->expiration_time == 'never' ? __( 'Never Expires', 'mayosis' ) : date( 'M d, Y, g:i a', $all_access_pass->expiration_time ));
							}
							?></span>
						</td>
						<?php do_action( 'edd_all_access_pass_details_row_end', $all_access_pass ); ?>
					</tr>
				<?php }

				// If this All Access Pass has renewal payments waiting to take over
				if ( !empty( $all_access_pass->renewal_payment_ids ) && 'active' == $all_access_pass->status ) {
					?>
					<tr class="edd_all_access_pass_details_row">
						<?php do_action( 'edd_all_access_pass_details_row_start', $all_access_pass ); ?>
						<td class="row-label">
							<span class="edd-aa-upcoming-access-label"><?php _e( 'Upcoming Access Periods:', 'mayosis' ); ?></span>
						</td>
						<td class="row-value">
							<?php

								// If this all access pass is set to never expire, renewals won't ever be used. Output a relevant message.
								if( 'never' == $all_access_pass->expiration_time ){
										echo '<span class="edd-aa-upcoming-period">';
										echo sprintf( __( 'You have %i renewal payments but your current pass is set to never expire.', 'mayosis' ), count( $all_access_pass->renewal_payment_ids ) );
										echo '</span>';
								}else{

									// If we got to here, this All Access pass has an actual expiration date - it's not infinite.
									$duration_time = strtotime( $all_access_pass->duration_number . ' ' . $all_access_pass->duration_unit, 0 );

									$loop_num = 1;

									//Loop through each upcoming renewal payment ID
									foreach ( $all_access_pass->renewal_payment_ids as $renewal_payment_id ) {

										echo '<span class="edd-aa-upcoming-period">';
										echo '<span class="edd-aa-upcoming-start-date">';
										echo __( 'Start Date', 'mayosis' ) . ': ' . date( 'M d, Y', $all_access_pass->start_time + ( $duration_time * $loop_num ) );
										echo '</span>';
										echo '<span class="edd-aa-upcoming-expiration-date">';
										echo __( 'Expiration Date', 'mayosis' ) . ': ' . date( 'M d, Y', $all_access_pass->start_time + ( $duration_time * ( $loop_num + 1 ) ) );
										echo '</span>';
										echo '</span>';

										$loop_num = $loop_num + 1;

									}

								}

							?>
						</td>
						<?php do_action( 'edd_all_access_pass_details_row_end', $all_access_pass ); ?>
					</tr>
					<?php
				}
				?>

				<tr class="edd_all_access_pass_details_row">
					<?php do_action( 'edd_all_access_pass_details_row_start', $all_access_pass ); ?>
					<td class="row-label">
						<span class="edd-aa-status-label"><?php _e( 'Status:', 'mayosis' ); ?></span>
					</td>
					<td class="row-value">
						<span class="edd-aa-status-value">
							<?php
								$aa_status       = $all_access_pass->status;
								$aa_status_label = edd_all_access_get_status_label( $aa_status );

								// If this All Access Pass has expired and been renewed by a newer payment than the one attached to this pass.
								if ( 'renewed' == $all_access_pass->status ){

									$customer = new EDD_Customer( get_current_user_id(), true );

									// Get the customer's current All Access Passes from the customer meta
									$customer_all_access_passes = $customer->get_meta( 'all_access_passes' );

									// Get the payent ID attached to the current/latest All Access Pass for this product directly from the customer meta
									$latest_payment_id = $customer_all_access_passes[$all_access_pass->download_id . '_' . $all_access_pass->price_id]['payment_id'];

									// Get the URL of the upgraded All Access Pass
									$view_latest_aa_pass_url = add_query_arg( array(
										'action' => 'view_all_access_pass',
										'payment_id' => $latest_payment_id,
										'download_id' => $all_access_pass->download_id,
										'price_id' => $all_access_pass->price_id,
									) );

									echo '<span class="edd-aa-' . $aa_status . '-status">' . $aa_status_label . ' <a href="' . $view_latest_aa_pass_url . '">' . __( '(View Current)', 'mayosis' ) . '</a></span>';

								}else if ( 'upcoming' == $all_access_pass->status ){

									// If this All Access Pass is a renewal payment waiting for expiration of the current pass, link the customer to the current.

									$customer = new EDD_Customer( get_current_user_id(), true );

									// Get the customer's current All Access Passes from the customer meta
									$customer_all_access_passes = $customer->get_meta( 'all_access_passes' );

									// Get the payent ID attached to the current/latest All Access Pass for this product directly from the customer meta
									$latest_payment_id = $customer_all_access_passes[$all_access_pass->download_id . '_' . $all_access_pass->price_id]['payment_id'];

									// Get the URL of the upgraded All Access Pass
									$view_latest_aa_pass_url = add_query_arg( array(
										'action' => 'view_all_access_pass',
										'payment_id' => $latest_payment_id,
										'download_id' => $all_access_pass->download_id,
										'price_id' => $all_access_pass->price_id,
									) );

									echo '<span class="edd-aa-' . $aa_status . '-status">' . $aa_status_label . ' <a href="' . $view_latest_aa_pass_url . '">' . __( '(View Current)', 'mayosis' ) . '</a></span>';

								}elseif ( 'upgraded' == $all_access_pass->status ){

									// If this All Access Pass has been upgraded to another one - making this one expired before its time, let the customer know.

									// Get the URL of the upgraded All Access Pass
									$view_upgraded_aa_pass_url = add_query_arg( array(
										'action' => 'view_all_access_pass',
										'payment_id' => $upgraded_all_access_pass->payment_id,
										'download_id' => $upgraded_all_access_pass->download_id,
										'price_id' => $upgraded_all_access_pass->price_id,
									) );

									echo '<span class="edd-aa-' . $aa_status . '-status"><a href="' . $view_upgraded_aa_pass_url . '">' . $aa_status_label . '</a></span>';
								}elseif ( 'expired' == $aa_status ) {
									// Output a link so the customer can easily renew.
									$args = array( 'edd_action' => 'add_to_cart', 'download_id' => $all_access_pass->download_id, 'price_id' => $all_access_pass->price_id );

									$renew_url = add_query_arg( $args, edd_get_checkout_uri() );

									echo '<span class="edd-aa-' . $aa_status . '-status">' . $aa_status_label . '</span> | ' . '<a href="' . $renew_url . '">' . __( 'Renew', 'mayosis' ) . '</a>';
								} else {
									echo '<span class="edd-aa-' . $aa_status . '-status">' . $aa_status_label . '</span>';
								}
							?>
						</span>
					</td>
					<?php do_action( 'edd_all_access_pass_details_row_end', $all_access_pass ); ?>
				</tr>
				<?php
				// If this All Access Pass has been upgraded, renewed, or is awaiting activation, the rest of the data is irrelevant so only show if relevant
				if ( 'renewed' != $all_access_pass->status && 'upgraded' != $all_access_pass->status && 'upcoming' != $all_access_pass->status ){
					?><tr class="edd_all_access_pass_details_row">
						<?php do_action( 'edd_all_access_pass_details_row_start', $all_access_pass ); ?>
						<td class="row-label">
							<span class="edd-aa-access-to-label"><?php _e( 'Access To:', 'mayosis' ); ?></span>
						</td>
						<td class="row-value">
							<span class="edd-aa-access-to-value">
								<?php

									$aa_total_categories_count = count( $all_access_pass->included_categories );
									$aa_current_iteration = 0;
									foreach ( $all_access_pass->included_categories as $included_category_id ) {
										if ( 'all' == $included_category_id ) {
											echo __( 'All Products', 'mayosis' );
											break;
										} else {
											$term_data = get_term( $included_category_id, 'download_category' );
											echo esc_html($term_data->name);
										}

										if ($aa_current_iteration < ( $aa_total_categories_count - 1 ) ) {
											echo ', ';
										}

										$aa_current_iteration = $aa_current_iteration + 1;
									}
								?>
							</span>
						</td>
						<?php do_action( 'edd_all_access_pass_details_row_end', $all_access_pass ); ?>
					</tr>
					<tr class="edd_all_access_pass_details_row">
						<td class="row-label">
							<span class="edd-aa-access-duration-label"><?php _e( 'All Access Duration:', 'mayosis' ); ?></span>
						</td>
						<td class="row-value">
							<span class="edd-aa-access-duration-value"><?php echo edd_all_access_duration_string( $all_access_pass ); ?></span>
						</td>
					</tr>
					<tr class="edd_all_access_pass_details_row">
						<td class="row-label">
							<span class="edd-aa-price-variation-label"><?php _e( 'Included Price Variations:', 'mayosis' ); ?></span>
						</td>
						<td class="row-value">
							<span class="edd-aa-price-variation-value">
								<?php
									if ( $all_access_pass->number_of_price_ids == 0 ) {
										echo __( 'All price variations included.', 'mayosis' );
									} else {
										echo '<ul>';
										for ( $included_price_id = 1; $included_price_id <= $all_access_pass->number_of_price_ids; $included_price_id++ ) {

											$variation_string = __( 'th Price Variation from each product', 'mayosis' );
											$variation_string = $included_price_id == 1 ? __( 'st Price Variation from each product', 'mayosis' ) : $variation_string;
											$variation_string = $included_price_id == 2 ? __( 'nd Price Variation from each product', 'mayosis' ) : $variation_string;
											$variation_string = $included_price_id == 3 ? __( 'rd Price Variation from each product', 'mayosis' ) : $variation_string;

											echo '<li class="edd-aa-included-price-id ' . $included_price_id . '"><input type="checkbox" disabled name="edd_all_access_meta[included_price_ids][]" class="edd_all_access_included_price_id" value="' . esc_attr( $included_price_id ) . '" ' . esc_attr( ( in_array( $included_price_id, $all_access_pass->included_price_ids ) ? ' checked ' : '' ) ) . '/>' . $included_price_id . $variation_string . ' &nbsp;</li>';
										}
										echo '</ul>';
									}
								?>
							</span>
						</td>
					</tr>
					<tr class="edd_all_access_pass_details_row">
						<td class="row-label">
							<span class="edd-aa-download-limit-label"><?php _e( 'Download Limit:', 'mayosis' ); ?></span>
						</td>
						<td class="row-value">
							<span class="edd-aa-download-limit-value"><?php echo edd_all_access_download_limit_string( $all_access_pass ); ?></span>
						</td>
					</tr>

					<?php if ( $all_access_pass->download_limit != 0 ) { ?>
						<tr class="edd_all_access_pass_details_row">
							<td class="row-label">
								<span class="edd-aa-downloads-used-label"><?php _e( 'Downloads Used:', 'mayosis' ); ?></span>
							</td>
							<td class="row-value">
								<span class="edd-aa-downloads-used-value"><?php echo esc_html($all_access_pass->downloads_used); ?></span>
							</td>
						</tr>
						<tr class="edd_all_access_pass_details_row">
							<td class="row-label">
								<span class="edd-aa-downloads-left-label"><?php _e( 'Downloads Left:', 'mayosis' ); ?></span>
							</td>
							<td class="row-value">
								<span class="edd-aa-downloads-left-value"><?php echo esc_html($downloads_left = $all_access_pass->download_limit - $all_access_pass->downloads_used); ?></span>
							</td>
						</tr>
						<tr class="edd_all_access_pass_details_row">
							<td class="row-label">
								<span class="edd-aa-current-period-start-label"><?php _e( 'Current Download Period started at:', 'mayosis' ); ?></span>
							</td>
							<td class="row-value">
								<span class="edd-aa-current-period-start-value"><?php echo date( 'M d, Y, g:i a', $all_access_pass->downloads_used_last_reset ); ?></span>
							</td>
						</tr>
						<tr class="edd_all_access_pass_details_row">
							<td class="row-label">
								<span class="edd-aa-next-period-begins-label"><?php _e( 'Next Download Period begins at:', 'mayosis' ); ?></span>
							</td>
							<td class="row-value">
								<span class="edd-aa-next-period-begins-value"><?php echo date( 'M d, Y, g:i a', $all_access_pass->downloads_used_last_reset + strtotime( '1 ' . edd_all_access_download_limit_time_period_to_string( $all_access_pass->download_limit_time_period ), 0 ) ); ?></span>
							</td>
						</tr>
						<tr class="edd_all_access_pass_details_row">
							<td class="row-label">
								<span class="edd-aa-current-time-label"><?php _e( 'Current Time (on server):', 'mayosis' ); ?></span>
							</td>
							<td class="row-value">
								<span class="edd-aa-current-time-value"><?php echo date( 'M d, Y, g:i a', current_time( 'timestamp' ) ); ?></span>
							</td>
						</tr>
					<?php }
				}?>

			</tbody>
		</table>
		<?php
	}
}
