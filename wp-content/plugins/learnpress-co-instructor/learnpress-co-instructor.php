<?php
/*
Plugin Name: LearnPress Co-Instructor
Plugin URI: http://thimpress.com/learnpress
Description: Building courses with other instructors
Author: ThimPress
Version: 1.0
Author URI: http://thimpress.com
Tags: learnpress, lms, add-on, co-instructor
Text Domain: learnpress-co-instructor
Domain Path: /languages/
*/

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !defined( 'LP_ADDON_CO_INSTRUCTOR_PATH' ) ) {
	define( 'LP_ADDON_CO_INSTRUCTOR_FILE', __FILE__ );
	define( 'LP_ADDON_CO_INSTRUCTOR_PATH', dirname( __FILE__ ) );
}

/**
 * Class LP_Addon_Co_Instructor
 */
class LP_Addon_Co_Instructor {
	/**
	 * @var null
	 */
	protected static $_instance = null;

	/**
	 * LP_Addon_Co_Instructor constructor.
	 */
	function __construct() {
		add_action( 'pre_get_posts', array( $this, 'pre_get_co_items' ) );
		add_filter( 'learn_press_course_settings_meta_box_args', array( $this, 'add_co_instructor_meta_box' ) );
		add_action( 'admin_footer-post.php', array( $this, 'admin_footer' ) );
		add_filter( 'learn_press_valid_quizzes', array( $this, 'co_instructor_valid_quizzes' ) );
		add_filter( 'learn_press_valid_lessons', array( $this, 'co_instructor_valid_lessons' ) );
		add_filter( 'learn_press_valid_courses', array( $this, 'get_available_courses' ) );
		add_action( 'init', array( __CLASS__, 'load_text_domain' ) );
	}

	function co_instructor_valid_lessons() {
		$courses = $this->get_available_courses();
		return $this->get_available_lessons( $courses );
	}

	function co_instructor_valid_quizzes() {
		$courses = $this->get_available_courses();
		return $this->get_available_quizzes( $courses );
	}

	/**
	 * @param $courses
	 *
	 * @return array
	 */
	function get_available_lessons( $courses ) {
		global $wpdb;

		$query   = $wpdb->prepare(
			"
			SELECT         ID
				FROM            $wpdb->posts
				WHERE           ( post_type = %s OR post_type = %s )
				AND				post_author = %d
			",
			'lpr_lesson', 'lp_lesson', get_current_user_id()
		);
		$lessons = $wpdb->get_col( $query );

		if ( $courses ) foreach ( $courses as $course ) {
			// $temp    = learn_press_get_lessons( $course );
			$temp    = $this->get_available_lesson_from_course( $course );
			$lessons = array_unique( array_merge( $lessons, $temp ) );
		}

		return $lessons;
	}

	// get all lessons from course
	function get_available_lesson_from_course( $course = null ) {
		$lp_course = new LP_Course( $course );
		$temp      = array();

		if ( $lessons = $lp_course->get_lessons() ) {
			foreach ( $lessons as $quizze ) {
				$temp[] = $quizze->ID;
			}
		}
		return $temp;
	}

	/**
	 * @param $courses
	 *
	 * @return array
	 */
	function get_available_quizzes( $courses ) {
		global $wpdb;
		$query   = $wpdb->prepare(
			"
				SELECT         ID
				FROM            $wpdb->posts
				WHERE           ( post_type = %s OR post_type = %s )
				AND				post_author = %d
			", 'lpr_quiz', 'lp_quiz', get_current_user_id()
		);
		$quizzes = $wpdb->get_col( $query );
		if ( $courses ) foreach ( $courses as $course ) {
			// get quizze of course
			$temp    = $this->get_available_quizzes_from_course( $course );
			$quizzes = array_unique( array_merge( $quizzes, $temp ) );
		}
		return $quizzes;
	}


// get all quizzes from course
	function get_available_quizzes_from_course( $course = null ) {
		$lp_course = new LP_Course( $course );
		$temp      = array();

		if ( $quizzes = $lp_course->get_quizzes() ) {
			foreach ( $quizzes as $quizze ) {
				$temp[] = $quizze->ID;
			}
		}
		return $temp;
	}

	function pre_get_co_items( $query ) {
		$current_user = wp_get_current_user();
		global $pagenow;

		if ( is_admin() && ( in_array( 'lpr_teacher', $current_user->roles ) || in_array( 'lp_teacher', $current_user->roles ) ) && $pagenow == 'edit.php' ) {
			$post_type = isset( $_REQUEST['post_type'] ) ? sanitize_text_field( $_REQUEST['post_type'] ) : '';
			if ( in_array( $post_type, array( 'lpr_course', 'lp_course', 'lpr_lesson', 'lp_lesson', 'lpr_quiz', 'lp_quiz' ) ) ) {
				$courses         = $this->get_available_courses();
				$empty_post_type = 'lpr_empty';
				if ( in_array( $post_type, array( 'lpr_course', 'lp_course' ) ) ) {
					if ( count( $courses ) == 0 ) {
						if ( $post_type === 'lp_course' ) {
							$empty_post_type = 'lp_empty';
						}
						$query->set( 'post_type', $empty_post_type );
					} else {
						$query->set( 'post_type', $post_type );
						$query->set( 'post__in', $courses );
					}
					add_filter( 'views_edit-lpr_course', array( $this, 'restrict_co_items' ), 20 );
					add_filter( 'views_edit-lp_course', 'learn_press_restrict_co_items', 20 );
					return;
				}
				if ( in_array( $post_type, array( 'lpr_lesson', 'lp_lesson' ) ) ) {
					$lessons = learn_press_get_available_lessons( $courses );
					if ( count( $lessons ) == 0 ) {
						if ( $post_type === 'lp_lesson' ) {
							$empty_post_type = 'lp_empty';
						}
						$query->set( 'post_type', $empty_post_type );
					} else {
						$query->set( 'post_type', $post_type );
						$query->set( 'post__in', $lessons );
					}
					add_filter( 'views_edit-lpr_lesson', array( $this, 'restrict_co_items' ), 20 );
					add_filter( 'views_edit-lp_lesson', array( $this, 'restrict_co_items' ), 20 );
					return;
				}
				if ( in_array( $post_type, array( 'lpr_quiz', 'lp_quiz' ) ) ) {
					$quizzes = learn_press_get_available_quizzes( $courses );
					if ( count( $quizzes ) == 0 ) {
						if ( $post_type === 'lp_quiz' ) {
							$empty_post_type = 'lp_empty';
						}
						$query->set( 'post_type', $empty_post_type );
					} else {
						$query->set( 'post_type', $post_type );
						$query->set( 'post__in', $quizzes );
					}
					add_filter( 'views_edit-lpr_quiz', array( $this, 'restrict_co_items' ), 20 );
					add_filter( 'views_edit-lp_quiz', array( $this, 'restrict_co_items' ), 20 );
					return;
				}
			}
		}
	}

	/**
	 * @param $views
	 *
	 * @return mixed
	 */
	function restrict_co_items( $views ) {

		$post_type = get_query_var( 'post_type' );
		$author    = get_current_user_id();

		$new_views = array(
			'all'        => __( 'All', 'learnpress-co-instructor' ),
			'mine'       => __( 'Mine', 'learnpress-co-instructor' ),
			'publish'    => __( 'Published', 'learnpress-co-instructor' ),
			'private'    => __( 'Private', 'learnpress-co-instructor' ),
			'pending'    => __( 'Pending Review', 'learnpress-co-instructor' ),
			'future'     => __( 'Scheduled', 'learnpress-co-instructor' ),
			'draft'      => __( 'Draft', 'learnpress-co-instructor' ),
			'trash'      => __( 'Trash', 'learnpress-co-instructor' ),
			'co_teacher' => __( 'Co-instructor', 'learnpress-co-instructor' )
		);

		$url = 'edit.php';

		foreach ( $new_views as $view => $name ) {

			$query = array(
				'post_type' => $post_type
			);

			if ( $view == 'all' ) {
				$query['all_posts'] = 1;
				$class              = ( get_query_var( 'all_posts' ) == 1 || ( get_query_var( 'post_status' ) == '' && get_query_var( 'author' ) == '' ) ) ? ' class="current"' : '';

			} elseif ( $view == 'mine' ) {
				$query['author'] = $author;
				$class           = ( get_query_var( 'author' ) == $author ) ? ' class="current"' : '';
			} elseif ( $view == 'co_teacher' ) {
				$query['author'] = - $author;
				$class           = ( get_query_var( 'author' ) == - $author ) ? ' class="current"' : '';

			} else {
				$query['post_status'] = $view;
				$class                = ( get_query_var( 'post_status' ) == $view ) ? ' class="current"' : '';
			}

			$result = new WP_Query( $query );

			if ( $result->found_posts > 0 ) {

				$views[$view] = sprintf(
					'<a href="%s"' . $class . '>' . __( $name, 'learnpress-co-instructor' ) . ' <span class="count">(%d)</span></a>',
					esc_url( add_query_arg( $query, $url ) ),
					$result->found_posts
				);

			} else {

				unset( $views[$view] );

			}

		}

		return $views;
	}


	/**
	 * @return array
	 */
	function get_available_courses() {
		$return = false;
		if ( !current_user_can( 'lpr_teacher' ) ) {
			$return = true;
		}

		if ( !current_user_can( 'lp_teacher' ) ) {
			$return = true;
		}
		if ( $return === false ) {
			return array();
		}
		global $wpdb;

		$query = $wpdb->prepare(
			"
				SELECT DISTINCT p.ID
					FROM				$wpdb->posts AS p
					INNER JOIN 			$wpdb->postmeta AS pm ON p.ID = pm.post_id
					WHERE  				( p.post_author = %d AND ( p.post_type = %s OR p.post_type = %s ) )
					OR 					( ( pm.meta_key = %s OR pm.meta_key = %s ) AND pm.meta_value= %d AND ( p.post_type = %s OR p.post_type = %s ) )
			",
			get_current_user_id(), 'lpr_course', 'lp_course', '_lpr_co_teacher', '_lp_co_teacher', get_current_user_id(), 'lpr_course', 'lp_course'
		);
		return $wpdb->get_col( $query );
	}

	// hidden all button section within co-instructor
	function admin_footer() {
		global $post_type;
		global $post;
		if ( !in_array( $post_type, array( 'lp_course', 'lpr_course' ) ) ) {
			return;
		}


		$instructors  = learn_press_course_get_instructors( $post->ID );
		$current_user = wp_get_current_user();
		if ( array_key_exists( $current_user->ID, $instructors ) ) : var_dump( 1 ); ?>

			<style type="text/css">
				.lp-section-actions .dashicons-trash,
				.curriculum-sections .section-item-actions .lp-remove,
				.curriculum-sections .item-bulk-actions .lp-check-items,
				.section-item-actions .item-checkbox {
					display: none !important;
				}
			</style>

		<?php endif;
	}

	// ADD METABOX CO-INSTRUCTOR IN COURSES
	function add_co_instructor_meta_box( $meta_box ) {
		$class       = '';
		$post_author = '';
		if ( isset( $_GET['post'] ) && isset( get_post( $_GET['post'] )->post_author ) ) {
			$post_author = get_post( $_GET['post'] )->post_author;
			if ( $post_author != get_current_user_id() && !current_user_can( 'manage_options' ) ) {
				$class = 'hidden';
			}
		}
		$include       = array();
		$users_by_role = get_users( array( 'role' => 'administrator' ) );
		if ( $users_by_role ) {
			foreach ( $users_by_role as $user ) {
				if ( $user->ID != $post_author ) {
					$include[$user->ID] = $user->user_login;
				}
			}
		}
		$users_by_role = get_users( array( 'role' => 'lp_teacher' ) );
		if ( $users_by_role ) {
			foreach ( $users_by_role as $user ) {
				if ( $user->ID != $post_author ) {
					$include[$user->ID] = $user->user_login;
				}
			}
		}
		$users_by_role = get_users( array( 'role' => 'lpr_teacher' ) );
		if ( $users_by_role ) {
			foreach ( $users_by_role as $user ) {
				if ( $user->ID != $post_author ) {
					$include[$user->ID] = $user->user_login;
				}
			}
		}

		$meta_box['fields'][] = array(
			'name'        => __( 'Co-Instructors', 'learnpress-co-instructor' ),
			'id'          => "_lp_co_teacher",
			'desc'        => __( 'Colleagues\'ll work with you', 'learnpress-co-instructor' ),
			'class'       => $class,
			'type'        => 'teacher',
			'multiple'    => true,
			'type'        => 'select_advanced',
			'placeholder' => __( 'Instructor username', 'learnpress-co-instructor' ),
			'options'     => $include
		);
		return $meta_box;
	}

	static function install() {
		$teacher = get_role( 'lp_teacher' );
		if ( $teacher ) {
			$teacher->add_cap( 'edit_others_lp_lessons' );
			$teacher->add_cap( 'edit_others_lp_courses' );
		}
	}

	static function uninstall() {
		$teacher = get_role( 'lp_teacher' );
		if ( $teacher ) {
			$teacher->remove_cap( 'edit_others_lp_lessons' );
			$teacher->remove_cap( 'edit_others_lp_courses' );
		}
	}

	/**
	 * Load text domain
	 */
	static function load_text_domain() {
		if( function_exists('learn_press_load_plugin_text_domain')){ learn_press_load_plugin_text_domain(LP_ADDON_CO_INSTRUCTOR_PATH, true ); }
	}

	/**
	 * @return LP_Addon_Co_Instructor|null
	 */
	static function instance() {
		if ( !defined( 'LEARNPRESS_VERSION' ) || ( version_compare( LEARNPRESS_VERSION, '1.0', '<' ) ) ) {
			return false;
		}
		if ( !self::$_instance ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

add_action( 'plugins_loaded', array( 'LP_Addon_Co_Instructor', 'instance' ) );
register_activation_hook( __FILE__, array( 'LP_Addon_Co_Instructor', 'install' ) );
register_deactivation_hook( __FILE__, array( 'LP_Addon_Co_Instructor', 'uninstall' ) );

function learn_press_course_get_instructors( $course_id = null ) {
	if ( !$course_id ) {
		$course_id = get_the_ID();
	}
	// if not isset course id return empty array
	if ( !$course_id ) {
		return array();
	}

	$co_teacher = array();
	// get list teachers by post meta _lp_co_teacher
	$teachers = get_post_meta( $course_id, '_lp_co_teacher' );
	if ( !$teachers ) {
		$teachers = get_post_meta( $course_id, '_lpr_co_teacher' );
	}

	foreach ( $teachers as $key => $teacher ) {
		$co_teacher[$teacher] = new WP_User( $teacher );
	}

	// return teachers
	return $co_teacher;
}