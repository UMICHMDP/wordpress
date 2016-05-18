<?php
/*
Plugin Name: LearnPress Collections
Plugin URI: http://thimpress.com/learnpress
Description: Collecting related courses into one collection by administrator
Author: ThimPress
Version: 1.0
Author URI: http://thimpress.com
Tags: learnpress
Text Domain: learnpress-collections
Domain Path: /languages/
*/

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
 *  Define constants
 */
define( 'LP_COLLECTIONS_PATH', dirname( __FILE__ ) );

/**
 * Class LP_Addon_Collections
 */
class LP_Addon_Collections {
	/**
	 * @var null
	 */
	protected static $_instance = null;

	/**
	 * @var null
	 */
	public static $query = null;

	public static $in_loop = false;

	/**
	 * LP_Addon_Collections constructor.
	 */
	function __construct() {
		add_action( 'init', array( $this, 'register_collections' ) );
		add_filter( 'learn_press_admin_tabs_info', array( $this, 'admin_tabs_info' ) );
		add_filter( 'learn_press_admin_tabs_on_pages', array( $this, 'admin_tabs_on_pages' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'collection_settings_metabox' ), 20 );
		add_filter( 'rwmb_meta_boxes', array( $this, 'course_collection' ), 20 );
		add_filter( 'the_content', array( $this, 'collections' ), 10000 );
		add_filter( 'post_class', array( $this, 'collection_class' ) );
		add_filter( 'is_learnpress', array( $this, 'is_learnpress' ) );
		add_action( 'save_post_lp_collection', array( $this, 'update_course_collections' ), 10 );
		add_action( 'save_post_lp_course', array( $this, 'update_collection_courses' ), 10 );
		add_action( 'template_include', array( $this, 'template_controller' ), 10 );

		add_shortcode( 'learn_press_collection', array( $this, 'shortcode' ) );

		add_action( 'widgets_init', array( $this, 'register_widget' ) );
		//
		if ( function_exists( 'learn_press_load_plugin_text_domain' ) ) {
			learn_press_load_plugin_text_domain( LP_COLLECTIONS_PATH );
		}

		require_once LP_COLLECTIONS_PATH . '/inc/functions.php';
	}

	function template_controller( $template ) {
		$file = '';
		if ( is_singular( array( 'lp_collection' ) ) ) {
			$file   = 'single-collection.php';
			$find[] = learn_press_template_path() . "/addons/collections/{$file}";
		} elseif ( is_post_type_archive( 'lp_collection' ) ) {
			$file   = 'archive-collection.php';
			$find[] = learn_press_template_path() . "/addons/collections/{$file}";
		}
		if ( $file ) {
			$template = locate_template( array_unique( $find ) );
			if ( !$template ) {
				$template = LP_COLLECTIONS_PATH . '/templates/' . $file;
			}
		}
		return $template;
	}

	function register_widget() {
		include_once LP_COLLECTIONS_PATH . '/inc/widget.php';

		register_widget( 'LP_Collections_Widget' );
	}

	function is_learnpress( $is ) {
		return $is || is_post_type_archive( 'lp_collection' ) || is_singular( array( 'lp_collection' ) );
	}

	function collection_class( $classes ) {
		if ( is_singular( array( 'lp_collection' ) ) ) {
			$classes = (array) $classes;
			if ( false !== ( $key = array_search( 'hentry', $classes ) ) ) {
				unset( $classes[$key] );
			}
		}
		return $classes;
	}

	function shortcode( $atts ) {
		$atts = shortcode_atts(
			array( 'id' => 0 ),
			$atts
		);
		ob_start();
		$id      = $atts['id'];
		$content = '';
		if ( $id ) {
			$courses = get_post_meta( $id, '_lp_collection_courses' );
			if ( !$courses ) {
				$courses = array( 0 );
			}
			$args     = array(
				'post_type'           => 'lp_course',
				'post_status'         => 'publish',
				'post__in'            => $courses,
				'ignore_sticky_posts' => 1
			);
			$query    = new WP_Query( $args );
			$template = learn_press_collections_locate_template( 'archive-collection-course.php' );
			include $template;
			wp_reset_query();
			$content = ob_get_clean();
		}
		return $content;
	}

	function collections( $content ) {
		if ( is_singular( array( 'lp_collection' ) ) ) {
			if ( !preg_match( '/\[learn_press_collection\s?(.*)\]/', $content ) ) {
				$content = $content . do_shortcode( '[learn_press_collection id="' . get_the_ID() . '"]' );
			}
			remove_filter( 'the_content', array( $this, 'collections' ) );
		}
		return $content;
	}

	static function locate_template( $name ) {
		return learn_press_collections_locate_template( $name );
	}

	static function get_template( $name, $args = null ) {
		return learn_press_collections_get_template( $name, $args );
	}

	function register_collections() {
		$labels = array(
			'name'               => _x( 'Collections', 'Post Type General Name', 'learnpress-collections' ),
			'singular_name'      => _x( 'Collection', 'Post Type Singular Name', 'learnpress-collections' ),
			'menu_name'          => __( 'Collections', 'learnpress-collections' ),
			'parent_item_colon'  => __( 'Parent Item:', 'learnpress-collections' ),
			'all_items'          => __( 'Collections', 'learnpress-collections' ),
			'view_item'          => __( 'View Collection', 'learnpress-collections' ),
			'add_new_item'       => __( 'Add New Collection', 'learnpress-collections' ),
			'add_new'            => __( 'Add New', 'learnpress-collections' ),
			'edit_item'          => __( 'Edit Collection', 'learnpress-collections' ),
			'update_item'        => __( 'Update Collection', 'learnpress-collections' ),
			'search_items'       => __( 'Search Collection', 'learnpress-collections' ),
			'not_found'          => __( 'No collection found', 'learnpress-collections' ),
			'not_found_in_trash' => __( 'No collection found in Trash', 'learnpress-collections' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'has_archive'        => true,
			'capability_type'    => 'lp_order',
			'map_meta_cap'       => true,
			'show_in_menu'       => 'learn_press',
			'show_in_admin_bar'  => true,
			'show_in_nav_menus'  => true,
			'taxonomies'         => array(),
			'supports'           => array( 'title', 'editor', 'thumbnail', 'revisions', 'comments', 'excerpt' ),
			'hierarchical'       => true,
			'rewrite'            => array( 'slug' => 'collections', 'hierarchical' => true, 'with_front' => false )
		);

		register_post_type( 'lp_collection', $args );
	}

	/*
	* Add tab Collection into collection admin tabs
	*/
	function admin_tabs_info( $arr ) {
		$arr[11] = array(
			"link" => "edit.php?post_type=lp_collection",
			"name" => __( "Collections", "learnpress-collections" ),
			"id"   => "edit-lp_collection",
		);
		return $arr;
	}

	/*
	* Add admin tabs into page 'edit-lp_collection' and 'lp_collection'
	*/
	function admin_tabs_on_pages( $arr ) {
		array_push( $arr, 'edit-lp_collection' );
		array_push( $arr, 'lp_collection' );
		return $arr;
	}

	/**
	 * @param $meta_boxes
	 *
	 * @return mixed
	 */
	function collection_settings_metabox( $meta_boxes ) {
		$prefix       = '_lp_';
		$meta_boxes[] = array(
			'id'       => 'collection_settings',
			'title'    => 'Collection Settings',
			'context'  => 'side',
			'priority' => 'low',
			'pages'    => array( 'lp_collection' ),
			'fields'   => array(
				array(
					'name'        => __( 'Get courses', 'learnpress-collections' ),
					'id'          => "{$prefix}collection_courses",
					'type'        => 'post',
					'post_type'   => 'lp_course',
					'field_type'  => 'select_advanced',
					'multiple'    => true,
					'desc'        => 'Collecting related courses into one collection',
					'placeholder' => __( 'Select courses', 'learnpress-collections' ),
					'query_args'  => array(
						'author' => ''
					)
				),
			)
		);
		return apply_filters( 'learn_press_collection_settings_metabox', $meta_boxes );
	}

	/**
	 * @param $meta_boxes
	 *
	 * @return mixed
	 */
	function course_collection( $meta_boxes ) {
		$prefix       = '_lp_';
		$meta_boxes[] = array(
			'id'       => 'course_collection',
			'title'    => 'Collection Settings',
			'context'  => 'side',
			'priority' => 'low',
			'pages'    => array( 'lp_course' ),
			'fields'   => array(
				array(
					'name'        => __( 'Get collections', 'learnpress_collections' ),
					'id'          => "{$prefix}course_collections",
					'type'        => 'post',
					'post_type'   => 'lp_collection',
					'field_type'  => 'select_advanced',
					'multiple'    => true,
					'desc'        => 'Select collections',
					'placeholder' => __( 'Select collections', 'learnpress_collections' ),
					'query_args'  => array(
						'author' => ''
					)
				),
			)
		);
		return apply_filters( 'learn_press_course_collection_metabox', $meta_boxes );
	}

	/**
	 * Update course collections
	 *
	 * @param $collection_id
	 */
	function update_course_collections( $collection_id ) {
		$new_courses = isset( $_POST['_lp_collection_courses'] ) ? $_POST['_lp_collection_courses'] : array();
		$old_courses = get_post_meta( $collection_id, '_lpr_collection_courses' ) ? get_post_meta( $collection_id, '_lp_collection_courses' ) : array();
		$added       = array_diff( $new_courses, $old_courses );
		$removed     = array_diff( $old_courses, $new_courses );
		if ( $added ) {
			foreach ( $added as $course ) {
				$collections = get_post_meta( $course, '_lp_course_collections' );
				if ( !in_array( $collection_id, $collections ) ) {
					add_post_meta( $course, '_lp_course_collections', $collection_id );
				}
			}
		}
		if ( $removed ) {
			foreach ( $removed as $course ) {
				$collections = get_post_meta( $course, '_lp_course_collections' );
				if ( in_array( $collection_id, $collections ) ) {
					delete_post_meta( $course, '_lp_course_collections', $collection_id );
				}
			}
		}
	}

	/**
	 * Update collection courses
	 *
	 * @param $course_id
	 */
	function update_collection_courses( $course_id ) {
		$new_collections = isset ( $_POST['_lp_course_collections'] ) ? $_POST['_lp_course_collections'] : array();
		$old_collections = get_post_meta( $course_id, '_lp_course_collections' ) ? get_post_meta( $course_id, '_lp_course_collections' ) : array();
		$added           = array_diff( $new_collections, $old_collections );
		$removed         = array_diff( $old_collections, $new_collections );

		if ( $added ) {
			foreach ( $added as $collection ) {
				$courses = get_post_meta( $collection, '_lp_collection_courses' );
				if ( !in_array( $course_id, $courses ) ) {
					add_post_meta( $collection, '_lp_collection_courses', $course_id );
				}
			}
		}
		if ( $removed ) {
			foreach ( $removed as $collection ) {
				$courses = get_post_meta( $collection, '_lp_collection_courses' );
				if ( in_array( $course_id, $courses ) ) {
					delete_post_meta( $collection, '_lp_collection_courses', $course_id );
				}
			}
		}
	}

	/**
	 * @return LP_Addon_Collections|null
	 */
	static function instance() {
		if ( !self::$_instance ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

add_action( 'learn_press_ready', array( 'LP_Addon_Collections', 'instance' ) );

/**
 * Register collections course addon
 */
function learn_press_register_collections() {
	define( 'COLLECTIONS_TMPL', LPR_COLLECTIONS_PATH . '/template/' );
	define( 'COLLECTIONS_THEME_TMPL', learn_press_template_path() . '/addons/course-collections/' );
	require_once( LPR_COLLECTIONS_PATH . '/inc/collections.php' );
	require_once( LPR_COLLECTIONS_PATH . '/inc/widget.php' );
}

add_action( 'learn_press_register_add_ons', 'learn_press_register_collections' );

function learnpress_collections_translations() {
	$textdomain    = 'learnpress_collections';
	$locale        = apply_filters( "plugin_locale", get_locale(), $textdomain );
	$lang_dir      = dirname( __FILE__ ) . '/lang/';
	$mofile        = sprintf( '%s.mo', $locale );
	$mofile_local  = $lang_dir . $mofile;
	$mofile_global = WP_LANG_DIR . '/plugins/' . $mofile;
	if ( file_exists( $mofile_global ) ) {
		load_textdomain( $textdomain, $mofile_global );
	} else {
		load_textdomain( $textdomain, $mofile_local );
	}
}
