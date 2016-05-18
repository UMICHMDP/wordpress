<?php
/*
Plugin Name: LearnPress Certificates
Plugin URI: http://thimpress.com/learnpress
Description: An addon for LearnPress plugin to create certificate for a course
Author: ThimPress
Author URI: http://thimpress.com
Tags: learnpress
Version: 1.0
Text Domain: learnpress-certificates
Domain Path: /languages/
*/
/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

define( 'LP_ADDON_CERTIFICATES_FILE', __FILE__ );
define( 'LP_ADDON_CERTIFICATES_PATH', dirname( __FILE__ ) );

/**
 * Class LP_Addon_Certificates
 */
class LP_Addon_Certificates {
	/**
	 * @var null
	 */
	protected static $_instance = null;

	function __construct() {

		$this->includes();
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_menu', array( $this, 'remove_meta_boxes' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_assets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue_assets' ) );
		add_action( 'save_post', array( $this, 'update_cert' ) );
		add_action( 'wp_ajax_learn-press-cert-load-field', array( $this, 'load_field' ) );
		add_filter( 'learn_press_certificate_field_options', array( $this, 'field_options' ), 10, 2 );
		add_filter( 'manage_edit-lp_course_columns', array( $this, 'columns_head' ) );
		add_action( 'manage_lp_course_posts_custom_column', array( $this, 'columns_content' ), 10, 2 );
		add_filter( 'manage_edit-lp_cert_columns', array( $this, 'columns_head' ) );
		add_action( 'manage_lp_cert_posts_custom_column', array( $this, 'columns_content' ), 10, 2 );
		add_filter( 'learn_press_user_profile_tabs', array( $this, 'certificates_tab' ), 105, 2 );
		add_filter( 'learn_press_profile_tab_endpoints', array( $this, 'profile_tab_endpoints' ) );
		add_action( 'template_include', array( $this, 'cert_preview' ), 9999999 );
		add_action( 'learn_press_user_finish_course', array( $this, 'on_finish_course' ), 100, 3 );
		add_action( 'learn_press_content_learning_summary', array( $this, 'popup_cert' ), 70 );


		add_action( 'init', array( $this, 'download' ) );

		if ( function_exists( 'learn_press_load_plugin_text_domain' ) ) {
			learn_press_load_plugin_text_domain( LP_ADDON_CERTIFICATES_PATH, true );
		}
	}

	function popup_cert() {
		$cert_data = learn_press_get_user_certificates( get_current_user_id(), get_the_ID() );
		if ( !$cert_data ) {
			return;
		}
		$user_id   = get_current_user_id();
		$cert_data = (array) $cert_data;
		if ( get_transient( '_user_cert_' . $user_id ) ) {
			delete_transient( '_user_cert_' . $user_id );
			$cert_data['popup'] = true;
		}
		learn_press_certificates_template( 'popup-cert.php', $cert_data );
	}

	function on_finish_course( $course_id, $user_id, $result ) {
		$user = learn_press_get_user( $user_id );
		if ( !( $user && $user->has_passed_course( $course_id ) ) ) {
			return;
		}

		if ( !( $cert_id = learn_press_course_has_cert( $course_id ) ) ) {
			return;
		}

		set_transient(
			'_user_cert_' . $user_id,
			array(
				'cert_id'   => $cert_id,
				'course_id' => $course_id,
				'user_id'   => $user_id
			),
			HOUR_IN_SECONDS
		);
	}

	function cert_preview( $template ) {
		if ( learn_press_is_profile() && !empty( $_REQUEST['view'] ) ) {
			$template = learn_press_certificates_locate_template( '/templates/cert-preview.php' );
		}
		return $template;
	}

	function get_tab_slug() {
		return learn_press_get_certificate_tab_slug();
	}

	function certificates_tab( $tabs, $user ) {
		$tabs[$this->get_tab_slug()] = array(
			'title'    => __( 'Certificates', 'learnpress-certificates' ),
			'callback' => array( $this, 'certificates_tab_content' )
		);
		return $tabs;
	}

	function certificates_tab_content( $tab, $tabs, $user ) {
		learn_press_certificates_template(
			'course-certificates.php',
			array(
				'certificates' => learn_press_get_user_certificates( get_current_user_id() )
			)
		);
	}

	function field_options( $options, $type ) {
		switch ( $type ) {
			case 'student-name':
				$options   = array_reverse( $options );
				$options[] = array(
					'name'    => 'display',
					'type'    => 'select',
					'title'   => __( 'Display', 'learnpress-certificates' ),
					'std'     => '',
					'options' => array(
						'{login_name}'   => __( 'Login name' ),
						'{display_name}' => __( 'Display name' ),
					)
				);
				$options   = array_reverse( $options );
				break;
			case 'custom':
				$options   = array_reverse( $options );
				$options[] = array(
					'name'  => 'text',
					'type'  => 'text',
					'title' => __( 'Text', 'learnpress-certificates' ),
					'std'   => ''
				);
				$options   = array_reverse( $options );
				break;
			case 'course-start-date':
			case 'course-end-date':
			case 'current-date':
			case 'current-time':
				$options   = array_reverse( $options );
				$options[] = array(
					'name'  => 'format',
					'type'  => 'text',
					'title' => __( 'Format', 'learnpress-certificates' ),
					'std'   => preg_match( '/date$/', $type ) ? get_option( 'date_format' ) : get_option( 'time_format' )
				);
				$options   = array_reverse( $options );
		}
		return $options;
	}

	function load_field() {
		$field_options = learn_press_get_request( 'field' );
		if ( !$field_options ) {
			throw new Exception( __( 'Error!', 'learnpress-certificates' ) );
		}
		if ( empty( $field_options['fieldType'] ) ) {
			throw new Exception( __( 'Invalid field type!', 'learnpress-certificates' ) );
		}

		require_once LP_ADDON_CERTIFICATES_PATH . '/incs/html/field-options.php';

		die();
	}

	/**
	 * Include common files
	 */
	function includes() {
		require_once LP_ADDON_CERTIFICATES_PATH . '/incs/class-lp-certificate-field.php';
		require_once LP_ADDON_CERTIFICATES_PATH . '/incs/lp-certificate-functions.php';

		return;
		require_once( LP_ADDON_CERTIFICATES_PATH . '/incs/class-lpr-certificate-helper.php' );
		require_once( LP_ADDON_CERTIFICATES_PATH . '/incs/class-lpr-certificate-field.php' );
	}

	/**
	 * Register Certificate post type
	 */
	function register_post_type() {
		define( 'LP_ADDON_CERTIFICATES_THEME_PATH', learn_press_template_path() . '/addons/certificates/' );

		register_post_type( 'lp_cert',
			array(
				'labels'             => array(
					'name'          => __( 'Certificate', 'learnpress-certificates' ),
					'menu_name'     => __( 'Certificates', 'learnpress-certificates' ),
					'singular_name' => __( 'Certificate', 'learnpress-certificates' ),
					'add_new_item'  => __( 'Add New Certificate', 'learnpress-certificates' ),
					'edit_item'     => __( 'Edit Certificate', 'learnpress-certificates' ),
					'all_items'     => __( 'Certificates', 'learnpress-certificates' ),
				),
				'public'             => false,
				'publicly_queryable' => false,
				'show_ui'            => true,
				'has_archive'        => false,
				'capability_type'    => 'lp_course',
				'map_meta_cap'       => true,
				'show_in_menu'       => 'learn_press',
				'show_in_admin_bar'  => true,
				'show_in_nav_menus'  => true,
				'supports'           => array(
					'title',
					'author'
				),
				'rewrite'            => array( 'slug' => 'certificate' ),
				'map_meta_cap'       => true,
			)
		);
		$this->init();
	}

	function remove_meta_boxes() {
		remove_meta_box( 'authordiv', 'lp_cert', 'normal' );
	}

	function update_cert( $post_id ) {
		if ( get_post_type( $post_id ) == 'lp_course' ) {
			$cert = learn_press_get_request( 'learn-press-cert' );
			update_post_meta( $post_id, "_lp_cert", $cert );
			return;
		}
		if ( get_post_type( $post_id ) != 'lp_cert' ) {
			return;
		}
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}
		$cert = learn_press_get_request( 'learn-press-cert' );
		if ( !$cert ) {
			return;
		}
		foreach ( $cert as $k => $v ) {
			if ( is_string( $v ) ) {
				$v = stripcslashes( $v );
				$v = ( $j = json_decode( $v ) ) ? $j : $v;
			}
			if ( $k == 'preview' ) {
				$url = $this->output_preview( $post_id, $v );
				update_post_meta( $post_id, "_lp_cert_{$k}", $url );
				continue;
			}
			update_post_meta( $post_id, "_lp_cert_{$k}", $v );
		}
	}

	function output_preview( $cert, $data ) {
		if ( preg_match_all( '!data:image\/(.*?);base64,!', $data, $matches ) ) {
			$data       = substr( $data, strlen( $matches[0][0] ) );
			$upload_dir = learn_press_certificate_upload_dir( '' );

			$cert_name = get_post_field( 'post_name', $cert ) . '-preview.' . $this->get_file_ext( $matches[1][0] );
			file_put_contents( $upload_dir['path'] . '/' . $cert_name, base64_decode( $data ) );
			return $upload_dir['url'] . '/' . $cert_name;
		}
	}

	function get_file_ext( $type ) {
		$return = '';
		switch ( $type ) {
			case 'png':
				$return = 'png';
				break;
			case 'jpeg':
				$return = 'jpg';
				break;
		}
		return $return;
	}

	/**
	 * Add meta box to certificate screen
	 */
	function add_meta_boxes() {
		add_meta_box(
			'learn-press-cert-meta-box',
			__( 'Certificate Design', 'learnpress-certificates' ),
			array( $this, 'cert_form' ),
			'lp_cert',
			'normal',
			'high'
		);

		add_meta_box(
			'learn-press-certs-meta-box',
			__( 'Certificate', 'learnpress-certificates' ),
			array( $this, 'course_certs' ),
			'lp_course',
			'normal',
			'low'
		);
	}

	/**
	 * Meta box design form
	 */
	function cert_form( $post ) {
		$has_template = get_post_meta( $post->ID, '_lp_cert_template', true );
		require_once LP_ADDON_CERTIFICATES_PATH . '/incs/html/cert-design.php';
	}

	/**
	 * Meta box design form
	 *
	 * @var int
	 */
	function course_certs( $post ) {
		require_once LP_ADDON_CERTIFICATES_PATH . '/incs/html/course-certs.php';
	}

	function admin_enqueue_assets() {
		if ( !in_array( get_post_type(), array( 'lp_course', 'lp_cert' ) ) ) {
			return;
		}

		wp_enqueue_script( 'fabric', plugins_url( '/assets/js/fabric.js', LP_ADDON_CERTIFICATES_FILE ), array( 'jquery', 'backbone', 'underscore', 'jquery-ui-slider', 'wp-color-picker' ) );
		wp_enqueue_script( 'learn-press-admin-cert', plugins_url( '/assets/js/admin.js', LP_ADDON_CERTIFICATES_FILE ), array( 'fabric' ) );

		wp_enqueue_style( 'learn-press-admin-cert', plugins_url( '/assets/css/admin.css', LP_ADDON_CERTIFICATES_FILE ), array( 'wp-color-picker' ) );
		//wp_enqueue_script( 'learn-press-admin-cert', '', array( 'jquery', 'backbone', 'underscore' ) );
	}

	function frontend_enqueue_assets() {
		if ( !apply_filters( 'learn_press_certificates_frontend_enqueue_assets', !( !learn_press_is_profile() && !learn_press_is_course() ) ) ) {
			return;
		}
		wp_enqueue_script( 'fabric', plugins_url( '/assets/js/fabric.js', LP_ADDON_CERTIFICATES_FILE ), array( 'jquery', 'backbone', 'underscore' ) );
		wp_enqueue_script( 'learn-press-frontend-cert', plugins_url( '/assets/js/certificates.js', LP_ADDON_CERTIFICATES_FILE ), array( 'fabric' ) );
		wp_enqueue_style( 'learn-press-frontend-cert', plugins_url( '/assets/css/certificates.css', LP_ADDON_CERTIFICATES_FILE ) );
	}

	function get_json( $post_id, $user_id = 0 ) {
		$layers = ( $layers = get_post_meta( $post_id, '_lp_cert_layers', true ) ) && is_array( $layers ) ? array_filter( $layers ) : null;
		if ( $user_id && $course = learn_press_get_certificate_course( $post_id ) ) {
			$layers = $this->apply_content_fields( $user_id, $course->ID, $layers );
		}
		return array(
			'template' => ( $template = get_post_meta( $post_id, '_lp_cert_template', true ) ) ? $template : null,
			'layers'   => $layers
		);
	}

	function get_variables( $user_id, $course_id ) {
		global $wpdb;
		$variables = array(
			'{login_name}'        => 'user_login_name',
			'{display_name}'      => 'user_display_name',
			'{course_name}'       => 'course_name',
			'{course_start_date}' => 'course_start_date',
			'{course_end_date}'   => 'course_end_date',
			'{current_date}'      => 'current_date',
			'{current_time}'      => 'current_time',
			'{course_percent}'    => 'course_percent'
		);
		$user      = learn_press_get_user( $user_id );
		$loaded    = array();
		foreach ( $variables as $var => $name ) {
			if ( array_key_exists( $name, $loaded ) ) {
				$variables[$var] = $loaded[$name];
				continue;
			}
			switch ( $name ) {
				case 'user_login_name':
					$value = $user->user_login;
					break;
				case 'user_display_name':
					$value = $user->display_name;
					break;
				case 'course_name':
					$value = get_the_title( $course_id );
					break;
				case 'course_start_date':
				case 'course_end_date':
					$query = $wpdb->prepare( "
						SELECT uc.start_time, uc.end_time
						FROM {$wpdb->prefix}learnpress_user_courses uc
						WHERE uc.user_id = %d
							AND uc.course_id = %d
					", $user_id, $course_id );
					if ( $result = $wpdb->get_row( $query ) ) {
						$value = ( $name == 'course_start_date' ) ? strtotime( $result->start_time ) : strtotime( $result->end_time );
					}
					break;
				case 'current_date':
				case 'current_time':
					$value = current_time( 'mysql' );
					break;
				case 'course_percent':
					$value = LP_Course::get_course( $course_id )->evaluate_course_results( $user_id );
			}
			$loaded[$name]   = $value;
			$variables[$var] = $value;
		}
		return apply_filters( 'learn_press_certificate_field_variables', $variables );
	}

	function apply_content_fields( $user, $course_id, $layers ) {
		if ( is_string( $user ) || is_numeric( $user ) ) {
			$user = learn_press_get_user( $user );
		}
		if ( $layers && $user ) {

			$variables = $this->get_variables( $user->ID, $course_id );
			//$searches  = array_keys( $variables );
			//$replaces  = array_values( $variables );
			$apply = $variables;

			foreach ( $layers as $i => $layer ) {
				$text = $layer->text;
				switch ( $layer->fieldType ) {
					case 'student-name':
						if ( empty( $layer->display ) ) {
							$text = '{login_name}';
						} else {
							$text = $layer->display;
						}
						break;
					case 'course-name':
						$text = '{course_name}';
						break;
					case 'course-start-date':
						$text         = '{course_start_date}';
						$format       = !empty( $layer->format ) ? $layer->format : get_option( 'date_format' );
						$apply[$text] = date( $format, @strtotime( $variables[$text] ) );
						break;
					case 'course-end-date':
						$text         = '{course_end_date}';
						$format       = !empty( $layer->format ) ? $layer->format : get_option( 'date_format' );
						$apply[$text] = date( $format, @strtotime( $variables[$text] ) );
						break;
					case 'current-date':
						$text         = '{current_date}';
						$format       = !empty( $layer->format ) ? $layer->format : get_option( 'time_format' );
						$apply[$text] = date( $format, @strtotime( $variables[$text] ) );
						break;
					case 'current-time':
						$text         = '{current_time}';
						$format       = !empty( $layer->format ) ? $layer->format : get_option( 'time_format' );
						$apply[$text] = date( $format, @strtotime( $variables[$text] ) );
						break;
					case 'custom':
						$text = $layer->text;
						if ( preg_match_all( '!\{(.+?)(:(.+?))?\}!', $text, $matches ) ) {
							foreach ( $matches[1] as $k => $var_name ) {
								if ( $var_name == 'course_start_date' || $var_name == 'course_end_date' || $var_name == 'current_date' ) {
									$format = !empty( $matches[3][$k] ) ? $matches[3][$k] : get_option( 'date_format' );
									$reg    = '/' . str_replace( array( '{', '}' ), array( '\{', '\}' ), $matches[0][$k] ) . '/';
									$text   = preg_replace( $reg, date( $format, $variables['{' . $var_name . '}'] ), $text );
								} elseif ( $var_name == 'current_time' ) {
									$format = !empty( $matches[3][$k] ) ? $matches[3][$k] : get_option( 'time_format' );
									$reg    = '/' . str_replace( array( '{', '}' ), array( '\{', '\}' ), $matches[0][$k] ) . '/';
									$text   = preg_replace( $reg, date( $format, $variables['{' . $var_name . '}'] ), $text );
								} elseif ( $var_name == 'course_percent' ) {
									$reg   = '/' . str_replace( array( '{', '}' ), array( '\{', '\}' ), $matches[0][$k] ) . '/';
									$point = 0;
									switch ( $matches[3][0] ) {
										case 'point_10':
											$point = $variables['{course_percent}'] * 10;
											$point = round( $point, 1 );
											break;
										case 'point_100':
										default:
											$point = $variables['{course_percent}'] * 100;
											$point = round( $point, 2 );
									}

									$text = preg_replace( $reg, $point, $text );
								}
							}
						}
						break;
				}
				foreach ( $apply as $search => $replace ) {
					$text = str_replace( $search, $replace, $text );
				}
				$layers[$i]->text = $text;
			}
		}
		return $layers;
	}

	function columns_head( $columns ) {
		$columns['certificate'] = __( 'Certificate', 'learnpress-certificates' );
		return $columns;
	}

	function columns_content( $column, $post_id ) {
		switch ( $column ) {
			case 'certificate':
				if ( get_post_type( $post_id ) == 'lp_cert' ) {
					$course_cert = $post_id;
				} else {
					$course_cert = get_post_meta( $post_id, '_lp_cert', true );
				}
				if ( $course_cert ) {
					$preview = get_post_meta( $course_cert, '_lp_cert_preview', true );
					echo '<div class="course-cert-preview">';
					echo sprintf( '<a href="%s"><img src="%s" alt="%s" /></a>', get_edit_post_link( $course_cert ), $preview, get_post_field( 'post_name', $course_cert ) );
					echo '</div>';
				} else {
					_e( '-', 'learnpress-certificates' );
				}
		}
	}

	function init() {
		$endpoint                   = preg_replace( '!_!', '-', $this->get_tab_slug() );
		LP()->query_vars[$endpoint] = $endpoint;
		add_rewrite_endpoint( $endpoint, EP_ROOT | EP_PAGES );
	}

	function profile_tab_endpoints( $endpoints ) {
		$endpoints[] = $this->get_tab_slug();
		return $endpoints;
	}

	function download() {
		if ( !empty( $_POST['download_cert'] ) ) {
			$data = $_POST['download_cert']['data'];
			$name = $_POST['download_cert']['name'];
			if ( preg_match_all( '!data:(image\/(.*?));base64,!', $data, $matches ) ) {

				$data       = substr( $data, strlen( $matches[0][0] ) );
				$upload_dir = learn_press_certificate_upload_dir();

				$cert_name = $name . '.' . $this->get_file_ext( $matches[2][0] );
				file_put_contents( $upload_dir['userpath'] . '/' . $cert_name, base64_decode( $data ) );
				header( 'Content-Type: ' . $matches[1][0] );
				header( 'Content-Disposition: attachment; filename="' . $cert_name . '"' );
				readfile( $upload_dir['userpath'] . '/' . $cert_name );
				exit();
			}
		}
	}

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

add_action( 'plugins_loaded', array( 'LP_Addon_Certificates', 'instance' ) );

//print_r(unserialize('a:3:{s:2:"id";s:3:"368";s:6:"layers";a:1:{i:0;O:8:"stdClass":38:{s:4:"type";s:4:"text";s:7:"originX";s:4:"left";s:7:"originY";s:3:"top";s:4:"left";d:1293.555219364599224718404002487659454345703125;s:3:"top";d:472.496217851739856996573507785797119140625;s:5:"width";d:144.06999999999999317878973670303821563720703125;s:6:"height";i:24;s:4:"fill";s:7:"#000000";s:6:"stroke";N;s:11:"strokeWidth";i:1;s:15:"strokeDashArray";N;s:13:"strokeLineCap";s:4:"butt";s:14:"strokeLineJoin";s:5:"miter";s:16:"strokeMiterLimit";i:10;s:6:"scaleX";i:1;s:6:"scaleY";i:1;s:5:"angle";i:0;s:5:"flipX";b:0;s:5:"flipY";b:0;s:7:"opacity";i:1;s:6:"shadow";N;s:7:"visible";b:1;s:6:"clipTo";N;s:15:"backgroundColor";s:0:"";s:8:"fillRule";s:7:"nonzero";s:24:"globalCompositeOperation";s:11:"source-over";s:4:"text";s:11:"Course name";s:8:"fontSize";d:92.9500756429652170709232450462877750396728515625;s:10:"fontWeight";s:6:"normal";s:10:"fontFamily";s:9:"Helvetica";s:9:"fontStyle";s:0:"";s:10:"lineHeight";i:1;s:14:"textDecoration";s:0:"";s:9:"textAlign";s:4:"left";s:4:"path";N;s:19:"textBackgroundColor";s:0:"";s:9:"useNative";b:1;s:5:"field";s:11:"course_name";}}s:7:"preview";s:28:"_certificate_preview_368.png";}'));