<?php

global $post;

$limit           = $instance['limit'];
$columns         = $instance['grid-options']['columns'];
$view_all_course = ( $instance['view_all_courses'] && '' != $instance['view_all_courses'] ) ? $instance['view_all_courses'] : false;
$sort            = $instance['order'];

$condition = array(
	'post_type'           => 'lp_course',
	'posts_per_page'      => $limit,
	'ignore_sticky_posts' => true,
);

if ( $sort == 'category' && $instance['cat_id'] && $instance['cat_id'] != 'all' ) {
	if ( get_term( $instance['cat_id'], 'course_category' ) ) {
		$condition['tax_query'] = array(
			array(
				'taxonomy' => 'course_category',
				'field'    => 'term_id',
				'terms'    => $instance['cat_id']
			),
		);
	}
}

if ( $sort == 'popular' ) {
	global $wpdb;
	$the_query = $wpdb->get_col( $wpdb->prepare(
		"
		SELECT pm.post_id, pm.meta_value + COUNT(pm.post_id) - IF (uc.course_id, 0, 1) as students 
		FROM `$wpdb->postmeta` AS pm
		LEFT JOIN `$wpdb->learnpress_user_courses` AS uc ON pm.post_id = uc.course_id
		WHERE pm.meta_key = %s
		GROUP BY pm.post_id
		ORDER BY students DESC",
		'_lp_students'
	) );

	$condition['post__in'] = $the_query;
	$condition['orderby']  = 'post__in';
}


$the_query = new WP_Query( $condition );

if ( $the_query->have_posts() ) :
	if ( $instance['title'] ) {
		echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
	}
	?>
	<div class="thim-course-megamenu">
		<?php
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$course = LP_Course::get_course( $post->ID );
			$is_required = $course->is_required_enroll();
			?>
			<div class="lpr_course <?php echo 'course-grid-' . $columns; ?>">
				<div class="course-item">
					<?php
					echo '<div class="course-thumbnail">';
					echo '<a href="' . esc_url( get_the_permalink() ) . '" >';
					echo thim_get_feature_image( get_post_thumbnail_id( $post->ID ), 'full', apply_filters( 'thim_course_thumbnail_width', 450 ), apply_filters('thim_course_thumbnail_height', 450), get_the_title() );
					echo '</a>';
					echo '</div>';
					?>
					<div class="thim-course-content">
						<h2 class="course-title">
							<a href="<?php echo esc_url( get_the_permalink() ); ?>"> <?php echo get_the_title(); ?></a>
						</h2>
						<?php/*
						<div class="course-meta">
							<div class="course-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
								<?php if ( $course->is_free() || !$is_required ) : ?>
									<div class="value free-course" itemprop="price" content="<?php esc_attr_e( 'Free', 'eduma' ); ?>">
										<?php esc_html_e( 'Free', 'eduma' ); ?>
									</div>
								<?php else: $price = learn_press_format_price( $course->get_price(), true ); ?>
									<div class="value " itemprop="price" content="<?php echo esc_attr( $price ); ?>">
										<?php echo esc_html( $price ); ?>
									</div>
								<?php endif; ?>
								<meta itemprop="priceCurrency" content="<?php echo learn_press_get_currency_symbol(); ?>" />

							</div>
						</div>
						*/?>
						<?php
						echo '<a class="course-readmore" href="' . esc_url( get_the_permalink() ) . '">' . esc_html__( 'Read More', 'eduma' ) . '</a>';
						?>
					</div>
				</div>
			</div>
			<?php
		endwhile;
		?>
	</div>
	<?php

endif;

wp_reset_postdata();
