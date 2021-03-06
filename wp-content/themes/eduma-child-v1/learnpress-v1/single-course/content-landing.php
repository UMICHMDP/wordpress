<?php
/**
 * Template for displaying content of landing course
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$review_is_enable = thim_plugin_active( 'learnpress-course-review/learnpress-course-review.php' );

?>

<?php do_action( 'learn_press_before_content_landing' ); ?>

<div id="course-landing">

	<div class="course-content popup-content">
		<?php do_action( 'learn_press_content_landing_summary' ); ?>
	</div>

	<div class="course-tabs">

		<ul class="nav nav-tabs">
			<li class="active" role="presentation">
				<a href="#tab-course-description" data-toggle="tab">
					<i class="fa fa-bookmark"></i>
					<span><?php esc_html_e( 'Description', 'eduma' ); ?></span>
				</a>
			</li>
			<li >
				<a href="#tab-course-curriculum" data-toggle="tab">
					<i class="fa fa-cube"></i>
					<span><?php esc_html_e( 'Project Areas', 'eduma' ); ?></span>
				</a>
			</li>
			<li role="presentation">
				<a href="#tab-course-instructor" data-toggle="tab">
					<i class="fa fa-user"></i>
					<span><?php esc_html_e( 'Faculty & Sponsor', 'eduma' ); ?></span>
				</a>
			</li>
			<?php?>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="tab-course-description">
				<?php do_action( 'learn_press_begin_course_content_course_description' ); ?>
				<div class="thim-course-content">
					<?php the_content();?>
					<a href="http://mdp.engin.umich.edu/2017-application-checklist-to-get-started/">How to Apply</a>
				</div>
				<?php thim_course_info(); ?>
				<?php do_action( 'learn_press_end_course_content_course_description' ); ?>
				<?php do_action( 'thim_social_share' ); ?>
			</div>
			<div class="tab-pane" id="tab-course-curriculum">
				<?php learn_press_course_curriculum(); ?>
			</div>
			<div class="tab-pane" id="tab-course-instructor">
				<?php the_excerpt(); ?>
			</div>
			<?php ?>
		</div>

	</div>

	<div class="thim-course-menu-landing">
		<div class="container">
			<ul class="thim-course-landing-tab">
				<li>
					<a href="#tab-course-description"><?php esc_html_e( 'Description', 'eduma' ); ?></a>
				</li>
				<li>
					<a href="#tab-course-curriculum"><?php esc_html_e( 'Project Areas', 'eduma' ); ?></a>
				</li>
				<li>
					<a href="#tab-course-instructor"><?php esc_html_e( 'Faculty & Sponsor', 'eduma' ); ?></a>
				</li>
				<?php /*if ( $review_is_enable ) : ?>
					<li>
						<a href="#tab-course-review"><?php esc_html_e( 'Reviews', 'eduma' ); ?></a>
					</li>
				<?php endif; */?>

			</ul>
			<div class="thim-course-landing-button">
				<?php
				//learn_press_course_price();
				//learn_press_course_enroll_button();
				?>
			</div>
		</div>
	</div>

</div>

<?php do_action( 'learn_press_after_content_landing' ); ?>
