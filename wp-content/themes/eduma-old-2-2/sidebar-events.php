<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package thim
 */
if ( !is_active_sidebar( 'sidebar_events' ) ) {
	return;
}
?>

<div id="sidebar" class="widget-area col-sm-3 sidebar-events sticky-sidebar" role="complementary">
	<?php if ( !dynamic_sidebar( 'sidebar_events' ) ) :
		dynamic_sidebar( 'sidebar_events' );
	endif; // end sidebar widget area ?>
</div><!-- #secondary -->
