<?php
/**
 * Template for displaying the curriculum of a course
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $course;

$section_index = 1;

?>

<div class="curriculum-sections course-curriculum">

	<?php do_action( 'learn_press_before_single_course_curriculum' ); ?>

	<?php if ( $curriculum = $course->get_curriculum() ): ?>


		<ul class="curriculum-sections">
	<?php echo '<span style="color:#0d57aa; font-style: italic; font-size: 80%; line-height: 20%;"> MDP Sponsored Projects are both a professional and academic learning experience for students. By participating in this program, students are actively preparing for graduate school and a professional career. As part of the experience, MDP expects professional behavior. To best prepare you for future professional opportunities, your experiences on this MDP team will be very broad. In addition to key technical skills that you will bring to the team, you will engage deeply in the self-directed learning of new and important concepts, demonstrate flexibility, collaboration, and cooperation, and develop strong professional communication skills. This also means that you will need to be able to work outside of your traditional area of study in the true multidisciplinary nature of our projects. You won’t always be able to anticipate how your skills and expertise will be used, so the MDP Sponsored Project will challenge you to grow and develop as a professional.</span>'?>

			<?php foreach ( $curriculum as $section ) : ?>

				<?php

				$section->section_index = $section_index;
				learn_press_get_template(
					'single-course/loop-section.php',
					array(
						'section'       => $section,
					)
				);?>
 
				<?php $section_index ++; ?>
			<?php endforeach; ?>

		</ul>

	<?php else: ?>
		<?php echo apply_filters( 'learn_press_course_curriculum_empty', __( 'No Student Roles', 'eduma' ) ); ?>
	<?php endif; ?>

	<?php do_action( 'learn_press_after_single_course_curriculum' ); ?>

</div>