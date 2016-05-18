<?php
/**
 * @Author: ducnvtt
 * @Date:   2016-02-24 16:21:27
 * @Last Modified by:   ducnvtt
 * @Last Modified time: 2016-03-16 14:31:28
 */

class TP_Event_Admin_Menu
{
	/**
	 * menus
	 * @var array
	 */
	public $_menus = array();

	/**
	 * instead new class
	 * @var null
	 */
	static $_instance = null;

	public function __construct()
	{
		// admin menu
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_filter( 'tp_event_register_event_post_type_args', array( $this, 'menu' ) );
	}

	// add admin menu callback
	function admin_menu()
	{
		$event_menu = apply_filters( 'event_menu_title', __( 'TP Events', 'tp-event' ) );
		/**
		 * menus
		 * @var
		 */
		$menus = apply_filters( 'event_admnin_menus', $this->_menus );
		if ( $menus ) {
			add_menu_page( $event_menu, $event_menu, 'manage_options', 'tp-event', null, 'dashicons-calendar', 9 );
			foreach( $menus as $menu )
			{
				call_user_func_array( 'add_submenu_page', $menu);
			}
		}
	}

	/**
	 * add menu item
	 * @param $params
	 */
	function add_menu( $params )
	{
		$this->_menus[] = $params;
	}

	function menu( $args ) {
		$menus = apply_filters( 'event_admnin_menus', $this->_menus );
		if ( ! empty( $menus ) ) {
			$args['show_in_menu'] = 'tp-event';
		}
		return $args;
	}

	/**
	 * instance
	 * @return object class
	 */
	static function instance()
	{
		if( self::$_instance )
			return self::$_instance;

		return new self();
	}


}

TP_Event_Admin_Menu::instance();