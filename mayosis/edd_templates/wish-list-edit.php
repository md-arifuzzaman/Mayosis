<?php
/**
 * Edit Wish List template
*/

$list_id   = edd_wl_get_list_id();
$wish_list = get_post( $list_id );
$content   = $wish_list->post_content;
$title     = get_the_title( $list_id );
$privacy   = get_post_status( $list_id );

?>

<h3 class="edd-wl-heading">
	<?php _e( 'Settings', 'mayosis' ); ?>
</h3>

<form action="<?php echo esc_url( add_query_arg( 'updated', true ) ); ?>" class="wish-list-form" method="post">
	<p>
		<label for="list-title"><?php _e( 'Title', 'mayosis' ); ?> <span class="required">*</span></label>
		<input type="text" name="list-title" id="list-title" value="<?php echo esc_attr( $title ); ?>">
	</p>
	<p>
		<label for="list-description"><?php _e( 'Description', 'mayosis' ); ?></label>
		<textarea name="list-description" id="list-description" rows="2" cols="30"><?php echo esc_attr( $content ); ?></textarea>
	</p>
	<p>
		<select name="privacy">
			<option value="private" <?php selected( $privacy, 'private' ); ?>><?php _e( 'Private - only viewable by you', 'mayosis' ); ?></option>
			<option value="publish" <?php selected( $privacy, 'publish' ); ?>><?php _e( 'Public - viewable by anyone', 'mayosis' ); ?></option>
		</select>
	</p>
	<p>
		<input type="submit" value="<?php _e( 'Update', 'mayosis' ); ?>" class="button">
	</p>

	<input type="hidden" name="submitted" id="submitted" value="true">

	<?php wp_nonce_field( 'list_nonce', 'list_nonce_field' ); ?>
</form>

<?php echo edd_wl_delete_list_link(); ?>
