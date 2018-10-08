<?php

function thim_child_enqueue_styles() {
	if ( is_multisite() ) {
		wp_enqueue_style( 'thim-child-style', get_stylesheet_uri() );
	} else {
		wp_enqueue_style( 'thim-parent-style', get_template_directory_uri() . '/style.css', array(), THIM_THEME_VERSION );
	}
}

add_action( 'wp_enqueue_scripts', 'thim_child_enqueue_styles', 100 );

/**
 * Display course info
 */
if ( ! function_exists( 'thim_course_info' ) ) {
    function thim_course_info() {
        $course    = LP()->global['course'];
        $course_id = get_the_ID();

        $course_skill_level = get_post_meta( $course_id, 'thim_course_skill_level', true );
        $course_language    = get_post_meta( $course_id, 'thim_course_language', true );

        ?>
        <div class="thim-course-info">
            <h3 class="title"><?php esc_html_e( 'Project Features', 'eduma' ); ?></h3>
            <ul>
                <li class="skill-feature">
                    <i class="fa fa-level-up"></i>
                    <span class="label"><?php esc_html_e( 'Skill level', 'eduma' ); ?></span>
                    <span class="value"><?php echo esc_html( $course_skill_level ); ?></span>
                </li>
                <li class="students-feature">
                    <i class="fa fa-users"></i>
                    <span class="label"><?php esc_html_e( 'Students', 'eduma' ); ?></span>
                    <span class="value" style="text-align: right;"><?php echo esc_html( get_post_meta( $course_id, 'thim_course_duration', true ) ); ?></span>
                </li>
                <li class="language-feature">
                    <i class="fa fa-puzzle-piece"></i>
                    <span class="label"><?php esc_html_e( 'Likely Majors', 'eduma' ); ?></span>

                    <span class="majors" style=" font-weight:bold; text-align:right;display:block;">
                        <?php $categories = get_the_terms( $post, 'course_category');
                        foreach ($categories as $category){
						  if ($category->description != 'NONE'){
						  $resultst[] = $category->description;
						}
					}
					$result = implode(", ", $resultst);
					echo $result;
					?></span>
                </li>
                <!-- <?php thim_course_certificate( $course_id ); ?> -->
                <li class="assessments-feature">
                    <i class="fa fa-check-square-o"></i>
                    <span class="label"><?php esc_html_e( 'Course Substitutions', 'eduma' ); ?></span>
                    <span class="majors" style=" font-weight:bold; text-align:right;display:block;"><?php echo esc_html( get_post_meta( $course_id, 'thim_course_language', true ) ); ?></span>
                </li>
                <li class="files-feature">
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
                <li class="language-feature">
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
						elseif($price == 2){
							echo 'See Complete Description for Details';
						
						}
						else {
							echo 'Summer Funding Application';
						}
					}?></span>
                </li>
            </ul>
            <form>
			<INPUT style="width: 210px; height: 50px; text-align: center; border: 0px; font-weight: bold; background: #ffcb05; color: #00274c; cursor: pointer; font-size: 100%;" Type="BUTTON" Value="APPLY" Onclick="window.location.href='https://umich.qualtrics.com/jfe/form/SV_ctZut0KKKPcoERv'">
			</form>
            <!-- <?php thim_course_wishlist_button(); ?> -->
        </div>
        <?php
    }
}

/**
 * Display related courses
 */
if ( ! function_exists( 'thim_related_courses' ) ) {
    function thim_related_courses() {
        $related_courses = thim_get_related_courses( 5 );
        $theme_options_data = get_theme_mods();
        $style_content = isset($theme_options_data['thim_layout_content_page']) ? $theme_options_data['thim_layout_content_page'] : 'normal';

        if ( $related_courses ) {
            $layout_grid = get_theme_mod('thim_learnpress_cate_layout_grid', '');
            $cls_layout = ($layout_grid!='' && $layout_grid!='layout_courses_1') ? ' cls_courses_2' : ' ';
            ?>
            <div class="thim-ralated-course <?php echo $cls_layout;?>">

                <?php if( $style_content == 'new-1' ) {?>
                    <div class="sc_heading clone_title  text-left">
                        <h2 class="title"><?php esc_html_e( 'You May Like', 'eduma' ); ?></h2>
                        <div class="clone"><?php esc_html_e( 'You May Like', 'eduma' ); ?></div>
                    </div>
                <?php } else {?>
                    <h3 class="related-title">
                        <?php esc_html_e( 'You May Like', 'eduma' ); ?>
                    </h3>
                <?php }?>

                <div class="thim-course-grid">
                    <div class="thim-carousel-wrapper" data-visible="3" data-itemtablet="2" data-itemmobile="1" data-pagination="1">
                        <?php foreach ( $related_courses as $course_item ) : ?>
                            <?php
                            $course = learn_press_get_course( $course_item->ID );
                            $is_required = $course->is_required_enroll();
                            ?>
                            <article class="lpr_course">
                                <div class="course-item">
                                    <div class="course-thumbnail">
                                        <a class="thumb" href="<?php echo get_the_permalink( $course_item->ID ); ?>">
                                            <?php
                                            if ( $layout_grid!='' && $layout_grid!='layout_courses_1' ) {
                                                echo thim_get_feature_image( get_post_thumbnail_id( $course_item->ID ), 'full', 320, 220, get_the_title( $course_item->ID ) );
                                            } else {
                                                echo thim_get_feature_image( get_post_thumbnail_id( $course_item->ID ), 'full', 450, 450, get_the_title( $course_item->ID ) );
                                            }
                                            ?>
                                        </a>
                                        <!-- <?php thim_course_wishlist_button( $course_item->ID ); ?> -->
                                        <?php echo '<a class="course-readmore" href="' . esc_url( get_the_permalink( $course_item->ID ) ) . '">' . esc_html__( 'Read More', 'eduma' ) . '</a>'; ?>
                                    </div>
                                    <div class="thim-course-content">
                                        <!-- <div class="course-author">
                                            <?php echo get_avatar( $course_item->post_author, 40 ); ?>
                                            <div class="author-contain">
                                                <div class="value">
                                                    <a href="<?php echo esc_url( learn_press_user_profile_link( $course_item->post_author ) ); ?>">
                                                        <?php echo get_the_author_meta( 'display_name', $course_item->post_author ); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div> -->
                                        <h2 class="course-title">
                                            <a rel="bookmark"
                                               href="<?php echo get_the_permalink( $course_item->ID ); ?>"><?php echo esc_html( $course_item->post_title ); ?></a>
                                        </h2> <!-- .entry-header -->
                                        <div class="course-meta">
                                            <!-- <?php
                                            $count_student = $course->get_users_enrolled() ? $course->get_users_enrolled() : 0;
                                            ?>
                                            <div class="course-students">
                                                <label><?php esc_html_e( 'Students', 'eduma' ); ?></label>
                                                <?php do_action( 'learn_press_begin_course_students' ); ?>

                                                <div class="value"><i class="fa fa-group"></i>
                                                    <?php echo esc_html( $count_student ); ?>
                                                </div>
                                                <?php do_action( 'learn_press_end_course_students' ); ?>

                                            </div> -->
                                            <!-- <?php thim_course_ratings_count( $course_item->ID ); ?> -->
                                            <!-- <?php if ( $price = $course->get_price_html() ) {

                                                $origin_price = $course->get_origin_price_html();
                                                $sale_price   = $course->get_sale_price();
                                                $sale_price   = isset( $sale_price ) ? $sale_price : '';
                                                $class        = '';
                                                if ( $course->is_free() || ! $is_required ) {
                                                    $class .= ' free-course';
                                                    $price = esc_html__( 'Free', 'eduma' );
                                                }

                                                ?>

                                                <div class="course-price" itemprop="offers" itemscope
                                                     itemtype="http://schema.org/Offer">
                                                    <div class="value<?php echo $class; ?>" itemprop="price">
                                                        <?php
                                                        if ( $sale_price !== '' ) {
                                                            echo '<span class="course-origin-price">' . $origin_price . '</span>';
                                                        }
                                                        ?>
                                                        <?php echo $price; ?>
                                                    </div>
                                                    <meta itemprop="priceCurrency"
                                                          content="<?php echo learn_press_get_currency_symbol(); ?>"/>
                                                </div>
                                                <?php
                                            }
                                            ?> -->
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}


/**
 * Breadcrumb for LearnPress
 */
if ( ! function_exists( 'thim_learnpress_breadcrumb' ) ) {
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
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'lp_course' ) ) . '" title="' . esc_attr__( 'All Projects', 'eduma' ) . '"><span itemprop="name">' . esc_html__( 'All Projects', 'eduma' ) . '</span></a></li>';
            } else {
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( get_post_meta( $post->ID, '_lp_course', true ) ) ) . '" title="' . esc_attr( get_the_title( get_post_meta( $post->ID, '_lp_course', true ) ) ) . '"><span itemprop="name">' . esc_html( get_the_title( get_post_meta( $post->ID, '_lp_course', true ) ) ) . '</span></a></li>';
            }

            // Single post (Only display the first category)
            if ( isset( $categories[0] ) ) {
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_term_link( $categories[0] ) ) . '" title="' . esc_attr( $categories[0]->name ) . '"><span itemprop="name">' . esc_html( $categories[0]->name ) . '</span></a></li>';
            }
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';

        } else if ( learn_press_is_course_taxonomy() || learn_press_is_course_tag() ) {
            // All courses
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'lp_course' ) ) . '" title="' . esc_attr__( 'All Projects', 'eduma' ) . '"><span itemprop="name">' . esc_html__( 'All Projects', 'eduma' ) . '</span></a></li>';

            // Category page
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( learn_press_single_term_title( '', false ) ) . '">' . esc_html( learn_press_single_term_title( '', false ) ) . '</span></li>';
        } else if ( ! empty( $_REQUEST['s'] ) && ! empty( $_REQUEST['ref'] ) && ( $_REQUEST['ref'] == 'course' ) ) {
            // All courses
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'lp_course' ) ) . '" title="' . esc_attr__( 'All Projects', 'eduma' ) . '"><span itemprop="name">' . esc_html__( 'All Projects', 'eduma' ) . '</span></a></li>';

            // Search result
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( 'Search results for:', 'eduma' ) . ' ' . esc_attr( get_search_query() ) . '">' . esc_html__( 'Search results for:', 'eduma' ) . ' ' . esc_html( get_search_query() ) . '</span></li>';
        } else {
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( 'All Projects', 'eduma' ) . '">' . esc_html__( 'All Projects', 'eduma' ) . '</span></li>';
        }

        echo '</ul>';
    }
}

if ( ! function_exists( 'thim_learnpress_page_title' ) ) {
    function thim_learnpress_page_title( $echo = true ) {
        $title = '';
        if ( get_post_type() == 'lp_course' && ! is_404() && ! is_search() || learn_press_is_courses() || learn_press_is_course_taxonomy() ) {
            if ( learn_press_is_course_taxonomy() ) {
                $title = learn_press_single_term_title( '', false );
            } else {
                $title = esc_html__( 'All Projects', 'eduma' );
            }
        }
        // if ( get_post_type() == 'lp_quiz' && ! is_404() && ! is_search() ) {
        //     if ( is_tax() ) {
        //         $title = learn_press_single_term_title( '', false );
        //     } else {
        //         $title = esc_html__( 'Quiz', 'eduma' );
        //     }
        // }
        if ( $echo ) {
            echo $title;
        } else {
            return $title;
        }
    }
}


if ( ! function_exists( 'thim_course_wishlist_button' ) ) {
    function thim_course_wishlist_button( $course_id = null ) {
        // if ( ! thim_plugin_active( 'learnpress-wishlist/learnpress-wishlist.php' ) || 1==1 ) {
        //     return;
        // }
        // LP_Addon_Wishlist::instance()->wishlist_button( $course_id );

    }
}

/**
 * Display price html
 */

if ( ! function_exists( 'thim_course_loop_price_html' ) ) {
    function thim_course_loop_price_html( $course ) {
        $class = ( $course->has_sale_price() ) ? ' has-origin' : '';
        if ( $course->is_free() ) {
            $class .= ' free-course';
        }
        ?>
        <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
            <!-- <?php if ( $price_html = $course->get_price_html() ) { ?>
                <div class="value <?php echo $class; ?>" itemprop="price">
                    <?php if ( $course->get_origin_price() != $course->get_price() ) { ?>
                        <?php $origin_price_html = $course->get_origin_price_html(); ?>
                        <span class="course-origin-price"><?php echo $origin_price_html; ?></span>
                    <?php } ?>
                    <?php echo $price_html; ?>
                </div>
                <meta itemprop="priceCurrency" content="<?php echo learn_press_get_currency_symbol(); ?>" />
            <?php } ?> -->
        </div>
        <?php
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

//image attachment
function myprefix_redirect_attachment_page() {
    if ( is_attachment() ) {
        global $post;
        if ( $post && $post->post_parent ) {
            wp_redirect( esc_url( get_permalink( $post->post_parent ) ), 301 );
            exit;
        } else {
            wp_redirect( esc_url( home_url( '/' ) ), 301 );
            exit;
        }
    }
}
add_action( 'template_redirect', 'myprefix_redirect_attachment_page' );



// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_separate', trailingslashit( get_stylesheet_directory_uri() ) . 'ctc-style.css', array( 'thim-parent-style','thim-style','thim-font-flaticon','thim-style-options' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css' );

// END ENQUEUE PARENT ACTION
