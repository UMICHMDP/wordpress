<?php
/**
 * Template for displaying archive collection course content
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="learn-press-collections" id="learn-press-collection-<?php echo $id; ?>">
	<?php
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) : $query->the_post();
			LP_Addon_Collections::$in_loop = true;
			LP_Addon_Collections::get_template( 'content-collection-course.php' );
		endwhile;
		LP_Addon_Collections::$in_loop = false;
		learn_press_course_paging_nav();
	} else {
		learn_press_display_message( __( 'No course found!', 'learnpress-collections' ) ) . $id;
	}
	?>
</div>