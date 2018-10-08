<?php
/**
 * Thankyou page
 *
 * @author 		ThimPress
 * @package 	LearnPress/Templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( $order ){
?>
<p><?php echo apply_filters( 'learn_press_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'eduma' ), $order ); ?></p>

<table class="order_details">
	<tr class="order">
		<th><?php _e( 'Order Number', 'eduma' ); ?></th>
		<td>
			<?php echo $order->get_order_number(); ?>
		</td>
	</tr>
	<tr class="date">
		<th><?php _e( 'Date', 'eduma' ); ?></th>
		<td>
			<?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?>
		</td>
	</tr>
	<tr class="total">
		<th><?php _e( 'Total', 'eduma' ); ?></th>
		<td>
			<?php echo $order->get_formatted_order_total(); ?>
		</td>
	</tr>
	<?php if ( $method_title = $order->get_payment_method_title() ) : ?>
		<tr class="method">
			<th><?php _e( 'Payment Method', 'eduma' ); ?></th>
			<td>
				<?php echo $method_title; ?>
			</td>
		</tr>
	<?php endif; ?>
</table>

	<?php do_action( 'learn_press_order_received_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'learn_press_order_received', $order->id ); ?>

<?php } else{ ?>

	<p><?php echo apply_filters( 'learn_press_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'eduma' ), null ); ?></p>

<?php } ?>