<?php
/**
 * @Author: ducnvtt
 * @Date:   2016-02-19 09:11:59
 * @Last Modified by:   ducnvtt
 * @Last Modified time: 2016-03-07 15:58:53
 */
use TP_Event_Auth\Books\Book as Book;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="account-event">
	<?php do_action( 'event_auth_messages', $atts ); ?>
</div>

<?php
if ( ! is_user_logged_in() ) {
	printf( __( 'You are not <a href="%s">login</a>', 'eduma' ), event_auth_login_url() );
	return;
}

if ( $atts->have_posts() ) : ?>

	<table class="list-book-event">
		<thead>
			<th><?php esc_html_e( 'ID', 'eduma' ); ?></th>
			<th><?php esc_html_e( 'Events', 'eduma' ); ?></th>
			<th><?php esc_html_e( 'Type', 'eduma' ); ?></th>
			<th><?php esc_html_e( 'Cost', 'eduma' ); ?></th>
			<th><?php esc_html_e( 'Quantity', 'eduma' ); ?></th>
			<th><?php esc_html_e( 'Method', 'eduma' ); ?></th>
			<th><?php esc_html_e( 'Status', 'eduma' ); ?></th>
		</thead>
		<tbody>
			<?php foreach( $atts->posts as $post ): ?>

				<?php $booking = Book::instance( $post->ID ) ?>
				<tr>
					<td><?php printf( '%s', event_auth_format_ID( $post->ID ) ) ?></td>
					<td><?php printf( '<a href="%s">%s</a>', get_the_permalink( $booking->event_id ), get_the_title( $booking->event_id ) ) ?></td>
					<td><?php printf( '%s', floatval( $booking->cost ) == 0 ? __( 'Free', 'eduma' ) : __( 'Cost', 'eduma' ) ) ?></td>
					<td><?php printf( '%s', event_auth_format_price( floatval( $booking->cost ), $booking->currency ) ) ?></td>
					<td><?php printf( '%s', $booking->qty ) ?></td>
					<td><?php printf( '%s', $booking->payment_id ? event_auth_get_payment_title( $booking->payment_id ) : __( 'No payment.', 'eduma' ) ) ?></td>
					<td><?php printf( '%s', event_auth_booking_status( $booking->ID ) ); ?></td>
				</tr>

			<?php endforeach; ?>
		</tbody>
	</table>

<?php endif; ?>
