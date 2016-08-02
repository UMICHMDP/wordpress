<?php

$number_posts = $instance['number_posts'] ? $instance['number_posts'] : 10;
$link         = get_post_type_archive_link( 'tp_event' );
$query_args   = array(
	'post_type'           => 'tp_event',
	'posts_per_page'      => $number_posts,
	'post_status'         => array( 'tp-event-happenning', 'tp-event-upcoming' ),
	'ignore_sticky_posts' => true
);

$events  = new WP_Query( $query_args );
$html    = array();
$sorting = array();

if ( $events->have_posts() ) {
	if ( $instance['title'] ) {
		echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
	}
	echo '<div class="thim-list-event">';
	if ( $instance['text_link'] <> '' ) {
		echo '<a class="view-all" href="' . esc_url( $link ) . '">' . $instance['text_link'] . '</a>';
	}

	//var_dump($events->posts);
	while ( $events->have_posts() ) {

		$events->the_post();
		$class = 'item-event';

		$time_from = tp_event_start( 'g:i A' );
		$time_end  = tp_event_end( 'g:i A' );

		$location   = tp_event_location();
		$date_show  = tp_event_get_time( 'd' );
		$month_show = tp_event_get_time( 'F' );

		$sorting[ strtotime( tp_event_get_time() ) ] = get_the_ID();
		ob_start();
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
			echo thim_get_feature_image( get_post_thumbnail_id(), 'full', apply_filters( 'thim_event_thumbnail_width', 450 ), apply_filters( 'thim_event_thumbnail_height', 233 ) );
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
		<?php

		$html[ get_the_ID() ] = ob_get_contents();
		ob_end_clean();
	}

	ksort( $sorting );

	if ( ! empty( $sorting ) ) {
		foreach ( $sorting as $value ) {
			if ( $html[ $value ] ) {
				echo ent2ncr( $html[ $value ] );
			}
		}
	}

	echo '</div>';
}

wp_reset_postdata();

?>
