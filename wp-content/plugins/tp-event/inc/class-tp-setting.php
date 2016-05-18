<?php

class TP_Event_Settings
{

	/**
	 * $_options
	 * @var null
	 */
	public $_options = null;

	/**
	 * prefix option name
	 * @var string
	 */
	public $_prefix = 'thimpress_events';

	/**
	 * _instance
	 * @var null
	 */
	static $_instance = null;

	function __construct( $prefix = null )
	{
		if( $prefix )
			$this->_prefix = $prefix;

		// load options
		if( ! $this->_options )
			$this->_options = $this->options();

		// save, update setting
		add_filter( 'event_admnin_menus', array( $this, 'setting_page' ), 10, 1 );
		add_action( 'admin_init', array( $this, 'register_setting' ) );
	}

	function __get( $id = null )
	{
		$settings = apply_filters( 'tp_event_settings_field', array() );

		if( isset( $settings[$id] ) )
		{
			return $settings[ $id ];
		}

	}

	/**
	 * generate setting page
	 * @param  $menus array
	 * @return array $menus
	 */
	public function setting_page( $menus )
	{
		$settings = apply_filters( 'event_admin_settings', array() );
		if ( count( $settings ) > 0 ) {
			$menus[] = array( 'tp-event', __( 'TP Events Settings', 'tp-event' ), __( 'Settings', 'tp-event' ), 'manage_options', 'tp-event-setting', array( $this, 'register_options_page' ) );
		}
		return $menus;
	}

	/**
	 * register option page
	 * @return
	 */
	function register_options_page()
	{
		tp_event()->_include( 'inc/admin/views/settings.php' );
	}

	function register_setting()
	{
		register_setting( $this->_prefix, $this->_prefix );
	}

	/**
	 * options load options
	 * @return array || null
	 */
	protected function options()
	{
		return get_option( $this->_prefix, null );
	}

	/**
	 * get_name_field
	 * @param  $name of field option
	 * @return string name field
	 */
	public function get_field_name( $name = null )
	{
		if( ! $this->_prefix || ! $name )
			return;

		return $this->_prefix . '[' . $name . ']' ;

	}

	/**
	 * get_name_field
	 * @param  $name of field option
	 * @return string name field
	 */
	public function get_field_id( $name = null, $default = null )
	{
		if( ! $this->_prefix || ! $name )
			return;

		return $this->_prefix . '_' . $name;

	}

	/**
	 * get option value
	 * @param  $name
	 * @return option value. array, string, boolean
	 */
	public function get( $name = null, $default = null )
	{
		if( ! $this->_options )
			$this->_options = $this->options();

		if( $name && isset( $this->_options[ $name ] ) )
			return $this->_options[ $name ];

		return $default;

	}

	/**
	 * get option value
	 * @param  $name
	 * @return option value. array, string, boolean
	 */
	public function set( $name = null, $default = null )
	{
		if( ! $this->_options )
			$this->_options = $this->options();

		if( $name && isset( $this->_options[ $name ] ) )
			return $this->_options[ $name ];

		return $default;

	}

	/**
	 * instance
	 * @param  $prefix
	 * @return object class
	 */
	static function instance( $prefix = null )
	{

		if( ! empty( self::$_instance[ $prefix ] ) ) {

			return $GLOBALS[ 'event_auth_settings' ] = self::$_instance[ $prefix ];
		}

		return $GLOBALS[ 'event_auth_settings' ] = self::$_instance[ $prefix ] = new self( $prefix );

	}

}
