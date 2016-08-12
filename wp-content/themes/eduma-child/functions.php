<?php

function thim_child_enqueue_styles() {
	if ( is_multisite() ) {
		wp_enqueue_style( 'thim-child-style', get_stylesheet_uri() );
	} else {
		wp_enqueue_style( 'thim-parent-style', get_template_directory_uri() . '/style.css' );
	}
}

add_action( 'wp_enqueue_scripts', 'thim_child_enqueue_styles', 100 );

/**
 * Display course info
 */
if ( ! function_exists( 'thim_course_info' ) ) {
	function thim_course_info() {
		global $course;
		$course_id = get_the_ID();
		$categories = get_the_terms( $post, 'course_category' );
		?>
		<div class="thim-course-info" >
			<h3 class="title"><?php esc_html_e( 'Project Features', 'eduma' ); ?></h3>
			<ul>
	
				<li>
					<i class="fa fa-level-up"></i>
					<span class="label"><?php esc_html_e( 'Skill level', 'eduma' ); ?></span>
					<span class="value" style="text-align: right;"><?php echo esc_html( get_post_meta( $course_id, 'thim_course_skill_level', true ) ); ?></span>
				</li>
				<li>
					<i class="fa fa-users"></i>
					<span class="label"><?php esc_html_e( 'Students', 'eduma' ); ?></span>
					<span class="value" style="text-align: right;"><?php echo esc_html( get_post_meta( $course_id, 'thim_course_duration', true ) ); ?></span>
				</li>
				<?php //thim_course_certificate( $course_id ); ?>
				
				<li>
					<i class="fa fa-puzzle-piece"></i>
					<span class="label" ><?php esc_html_e( 'Likely Majors', 'eduma' ); ?></span>
					<span class="majors" style=" font-weight:bold; text-align:right;display:block;"><?php foreach ($categories as $category){
						if ($category->description != 'NONE'){
						$resultst[] = $category->description;
						}
					}
					$result = implode(", ", $resultst);
					echo $result;
					
					
					 ?></span>
				</li>
				<li>
					<i class="fa fa-check-square-o"></i>
					<span class="label"><?php esc_html_e( 'Course Substitutions', 'eduma' ); ?></span>
					<span class="majors" style=" font-weight:bold; text-align:right;display:block;"><?php echo esc_html( get_post_meta( $course_id, 'thim_course_language', true ) ); ?></span>
				</li>
				<li>
					<i class="fa fa-files-o"></i>
					<span class="label"><?php esc_html_e( 'IP & NDA Required?', 'eduma' ); ?></span>
					<?php $user_count = $course->count_users_enrolled( 'append' ) ? $course->count_users_enrolled( 'append' ) : 0; ?>
					<span class="value" style="text-align: right;"><?php 
					  if ($user_count == 1){
						echo 'Yes';
						}
					else {
						echo 'No';
					}
					 ?></span>
				</li>
				<li>
					<i class="fa fa-language"></i>
					<span class="label"><?php esc_html_e( 'Summer Opportunity', 'eduma' ); ?></span>
					<span class="majors" style=" font-weight:bold; text-align:right;display:block;"><?php 
					if ($course->is_free()){
						echo 'Internship Guaranteed';
					} 
					else {
						$price = $course->get_price();
						if ($price == 1){
							echo 'Interview Guaranteed';
						}
						else {
							echo 'Summer Funding Application';
						}
					}?></span>
				</li>
			</ul>
			<form>
			<INPUT style="width: 210px; height: 50px; text-align: center; border: 0px; font-weight: bold; background: #ffcb05; color: #00274c; cursor: pointer; font-size: 100%;" Type="BUTTON" Value="APPLY" Onclick="window.location.href='https://umich.qualtrics.com/SE/?SID=SV_2ft3dA8XuKeslbT'">
			</form>
			
			
		</div>
		<?php
	}

}

/**
 * Display related courses
 */
if ( ! function_exists( 'thim_related_courses' ) ) {
	function thim_related_courses() {
		$related_courses = thim_get_related_courses( null, array( 'posts_per_page' => 3 ) );
		if ( $related_courses ) {
			?>
			<div class="thim-ralated-course">
				<h3 class="related-title"><?php esc_html_e( 'You May Like', 'eduma' ); ?></h3>

				<div class="thim-course-grid">
					<?php foreach ( $related_courses as $course_item ) : ?>
						<?php
						$course      = LP_Course::get_course( $course_item->ID );
						$is_required = $course->is_required_enroll();
						?>
						<article class="course-grid-3 lpr_course">
							<div class="course-item">
								<div class="course-thumbnail">
									<a href="<?php echo get_the_permalink( $course_item->ID ); ?>">
										<?php
										echo thim_get_feature_image( get_post_thumbnail_id( $course_item->ID ), 'full', 450, 450, $course->post_title );
										?>
									</a>
									<?php //thim_course_wishlist_button( $course_item->ID ); ?>
									<?php echo '<a class="course-readmore" href="' . esc_url( get_the_permalink( $course_item->ID ) ) . '">' . esc_html__( 'Read More', 'eduma' ) . '</a>'; ?>
								</div>
								<div class="thim-course-content">
									<div class="course-author">
										<?php //echo get_avatar( $course_item->post_author, 40 ); ?>
									</div>
									<h2 class="course-title">
										<a rel="bookmark" href="<?php echo get_the_permalink( $course_item->ID ); ?>"><?php echo esc_html( $course_item->post_title ); ?></a>
									</h2> <!-- .entry-header -->
									<div class="course-meta">
										<?php
										$count_student = $course->count_users_enrolled( 'append' ) ? $course->count_users_enrolled( 'append' ) : 0;
										?>
										<?php //thim_course_ratings_count( $course_item->ID ); ?>
										
									</div>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
			<?php
		}
	}
}
if (!function_exists('thim_excerpt')){
function thim_excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_content(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	} else {
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

	return '<p>' . $excerpt . '</p>';
}
}
if (!function_exists('thim_learnpress_breadcrumb')){
function thim_learnpress_breadcrumb() {

		// Do not display on the homepage
		if ( is_front_page() || is_404() ) {
			return;
		}

		// Get the query & post information
		global $post;

		// Build the breadcrums
		echo '<ul itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs" class="breadcrumbs">';

		// Home page
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_html( get_home_url() ) . '" title="' . esc_attr__( 'Home', 'eduma' ) . '"><span itemprop="name">' . esc_html__( 'Home', 'eduma' ) . '</span></a></li>';

		if ( is_single() ) {

			$categories = get_the_terms( $post, 'course_category' );

			if ( get_post_type() == 'lp_course' ) {
				// All courses
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'lp_course' ) ) . '" title="' . esc_attr__( 'All projects', 'eduma' ) . '"><span itemprop="name">' . esc_html__( 'All projects', 'eduma' ) . '</span></a></li>';
			} else {
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( get_post_meta( $post->ID, '_lp_course', true ) ) ) . '" title="' . esc_attr( get_the_title( get_post_meta( $post->ID, '_lp_course', true ) ) ) . '"><span itemprop="name">' . esc_html( get_the_title( get_post_meta( $post->ID, '_lp_course', true ) ) ) . '</span></a></li>';
			}

			// Single post (Only display the first category)
			if ( isset( $categories[0] ) ) {
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_term_link( $categories[0] ) ) . '" title="' . esc_attr( $categories[0]->name ) . '"><span itemprop="name">' . esc_html( $categories[0]->name ) . '</span></a></li>';
			}
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';

		} else if ( is_tax( 'course_category' ) || is_tax( 'course_tag' ) ) {
			// All courses
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'lp_course' ) ) . '" title="' . esc_attr__( 'All projects', 'eduma' ) . '"><span itemprop="name">' . esc_html__( 'All projects', 'eduma' ) . '</span></a></li>';

			// Category page
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( single_term_title( '', false ) ) . '">' . esc_html( single_term_title( '', false ) ) . '</span></li>';
		} else if ( ! empty( $_REQUEST['s'] ) && ! empty( $_REQUEST['ref'] ) && ( $_REQUEST['ref'] == 'course' ) ) {
			// All courses
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'lp_course' ) ) . '" title="' . esc_attr__( 'All projects', 'eduma' ) . '"><span itemprop="name">' . esc_html__( 'All projects', 'eduma' ) . '</span></a></li>';

			// Search result
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( 'Search results for:', 'eduma' ) . ' ' . esc_attr( get_search_query() ) . '">' . esc_html__( 'Search results for:', 'eduma' ) . ' ' . esc_html( get_search_query() ) . '</span></li>';
		} else {
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( 'All projects', 'eduma' ) . '">' . esc_html__( 'All projects', 'eduma' ) . '</span></li>';
		}

		echo '</ul>';
	}
}
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_events_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts

function create_events_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Events', 'taxonomy general name' ),
    'singular_name' => _x( 'Event', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Events' ),
    'all_items' => __( 'All Events' ),
    'parent_item' => __( 'Parent Event' ),
    'parent_item_colon' => __( 'Parent Event:' ),
    'edit_item' => __( 'Edit Event' ), 
    'update_item' => __( 'Update Event' ),
    'add_new_item' => __( 'Add New Event' ),
    'new_item_name' => __( 'New Event Name' ),
    'menu_name' => __( 'Events' ),
  ); 	

// Now register the taxonomy

  register_taxonomy('events',array('tp_event'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'event' ),
  ));

}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_csubstitutions_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts

function create_csubstitutions_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Course Substitutions', 'taxonomy general name' ),
    'singular_name' => _x( 'Course Substitution', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Course Substitutions' ),
    'all_items' => __( 'All Course Substitutions' ),
    'parent_item' => __( 'Parent Course Substitution' ),
    'parent_item_colon' => __( 'Parent Course Substitution:' ),
    'edit_item' => __( 'Edit Course Substitution' ), 
    'update_item' => __( 'Update Course Substitution' ),
    'add_new_item' => __( 'Add New Course Substitution' ),
    'new_item_name' => __( 'New Course Substitution Name' ),
    'menu_name' => __( 'Course Substitutions' ),
  ); 	

// Now register the taxonomy

  register_taxonomy('csubstitutions',array('lp_course'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'course-substitution' ),
  ));

}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_ptypes_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts

function create_ptypes_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Project Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Project Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Project Types' ),
    'all_items' => __( 'All Project Types' ),
    'parent_item' => __( 'Parent Project Type' ),
    'parent_item_colon' => __( 'Parent Project Type:' ),
    'edit_item' => __( 'Edit Project Type' ), 
    'update_item' => __( 'Update Project Type' ),
    'add_new_item' => __( 'Add New Project Type' ),
    'new_item_name' => __( 'New Project Type Name' ),
    'menu_name' => __( 'Project Types' ),
  ); 	

// Now register the taxonomy

  register_taxonomy('ptypes',array('lp_course'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'project-type' ),
  ));

}