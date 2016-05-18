<?php
/**
 * @Author: ducnvtt
 * @Date:   2016-02-24 16:08:51
 * @Last Modified by:   ducnvtt
 * @Last Modified time: 2016-03-15 16:40:28
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class TP_Event_Setting_General extends \TP_Event_Setting_Base
{
	/**
	 * setting id
	 * @var string
	 */
	public $_id = 'general';

	/**
	 * _title
	 * @var null
	 */
	public $_title = null;

	/**
	 * $_position
	 * @var integer
	 */
	public $_position = 10;

	public function __construct()
	{
		$this->_title = __( 'General', 'tp-event-auth' );
		parent::__construct();
	}

	// render fields
	public function load_field()
	{
		return array();
	}

}

new TP_Event_Setting_General();
