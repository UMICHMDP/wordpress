<?php
/**
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $course;
$viewable = learn_press_user_can_view_lesson( $item->ID, $course->id );
$class    = $viewable ? 'viewable' : '';
$tag      = $viewable ? 'a' : 'span';
$target   = apply_filters( 'learn_press_section_item_link_target', '_blank', $item );

$is_enrolled = LP()->user->has( 'enrolled-course', $course->id );
$is_required = get_post_meta( $course->id, '_lp_required_enroll', true );

?>

<li <?php learn_press_course_lesson_class( $item->ID, $class ); ?> data-type="<?php echo $item->post_type; ?>">

	
	
	

	<?php echo apply_filters( 'learn_press_section_item_title', get_the_title( $item->ID ), $item ); ?>

</<?php echo $tag; ?>>




<?php do_action( 'learn_press_after_section_item_title', $item, $section, $course ); ?>

</li>
