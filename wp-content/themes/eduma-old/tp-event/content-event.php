<?php

$class     = 'item-event';
$time_from = tp_event_start( 'g:i A' );
$time_end  = tp_event_end( 'g:i A' );

$location   = tp_event_location();
$date_show  = tp_event_get_time( 'd' );
$month_show = tp_event_get_time( 'F' );

?>
<div <?php post_class( $class ); ?>>
	<div class="time-from">
		<div class="date">
			<?php echo esc_html( $date_show ); ?>
		</div>
		<div class="month">
			<?php echo esc_html( $month_show ); ?>
		</div>
	</div>
	<?php
	echo '<div class="image">';
	echo thim_get_feature_image( get_post_thumbnail_id(), 'full', 450, 233 );
	echo '</div>';
	?>
	<div class="event-wrapper">
		<h5 class="title">
			<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"> <?php echo get_the_title(); ?></a>
		</h5>

		<div class="meta">
			<div class="time">
				<i class="fa fa-clock-o"></i>
				<?php echo esc_html( $time_from ) . ' - ' . esc_html( $time_end ); ?>
			</div>
			<div class="location">
				<i class="fa fa-map-marker"></i>
				<?php echo ent2ncr( $location ); ?>
			</div>
		</div>
		<div class="description">
			<?php echo thim_excerpt( 25 ); ?>
		</div>
	</div>

</div>