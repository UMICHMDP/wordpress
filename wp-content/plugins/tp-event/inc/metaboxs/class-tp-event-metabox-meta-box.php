<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class TP_Event_Meta_Box_Event extends TP_Event_Meta_Box
{
	/**
	 * id of the meta box
	 * @var null
	 */
	public $_id = null;

	/**
	 * title of meta box
	 * @var null
	 */
	public $_title = null;

	/**
	 * array meta key
	 * @var array
	 */
	public $_name = array();

	public function __construct()
	{
		$this->_id = 'tp_event_setting_section';
		$this->_title = __( 'Event Settings', 'tp-event' );
		$this->_layout = TP_EVENT_INC . '/metaboxs/views/event-countdown.php';
		add_action( 'tp_event_schedule_status', array( $this, 'schedule_status' ), 10, 2 );

		add_action( 'event_metabox_setting_section', array( $this, 'metabox' ) );
		parent::__construct();
	}

	public function update( $post_id, $post, $update )
	{
		if( ! isset( $_POST ) || empty( $_POST ) )
			return;

		if( $post->post_type !== 'tp_event' )
			return;

		remove_action( 'save_post', array( $this, 'update' ), 10, 3 );
		parent::update( $post_id, $post, $update );

		$post = tp_event_add_property_countdown( $post );

		$event_start = strtotime( $post->event_start );
		$event_end = strtotime( $post->event_end );

		$time = current_time( 'timestamp' );

		$status = 'draft';
		if( $event_start && $event_end ) {
			if( $event_start > $time ) {
				$status = 'tp-event-upcoming';
			} else if( $event_start <= $time && $time < $event_end ) {
				$status = 'tp-event-happenning';
			} else if( $time >= $event_end ) {
				$status = 'tp-event-expired';
			}
			// wp_schedule_single_event( $time, 'tp_event_schedule_status', array( $post_id, 'tp-event-upcoming' ) );
			wp_schedule_single_event( $event_start, 'tp_event_schedule_status', array( $post_id, 'tp-event-happenning' ) );
			wp_schedule_single_event( $event_end, 'tp_event_schedule_status', array( $post_id, 'tp-event-expired' ) );
		}

		if ( ! in_array( get_post_status( $post_id ), array( 'tp-event-upcoming', 'tp-event-happenning', 'tp-event-expired' ) ) ) {
			wp_update_post( array( 'ID' => $post_id, 'post_status' => $status ) );
		}

		add_action( 'save_post', array( $this, 'update' ), 10, 3 );
	}

	public function schedule_status( $post_id, $status )
	{
		wp_clear_scheduled_hook( 'tp_event_schedule_status', array( $post_id, $status ) );
		$old_status = get_post_status( $post_id );

		if ( $old_status !== $status && in_array( $status, array( 'tp-event-upcoming', 'tp-event-happenning', 'tp-event-expired' ) ) ) {
			$post = tp_event_add_property_countdown( get_post( $post_id ) );

			$current_time = current_time( 'timestamp' );
			$event_start = strtotime( $post->event_start );
			$event_end = strtotime( $post->event_end );
			if ( $status === 'tp-event-expired' && $current_time < $event_end ) {
				return;
			}

			if ( $status === 'tp-event-happenning' && $current_time < $event_start ) {
				return;
			}

			wp_update_post( array( 'ID' => $post_id, 'post_status' => $status ) );
		}
	}

	public function metabox( $tab_id ) {
		if ( $tab_id === 'general' ) {
			require_once $this->_layout;
		}
	}

	public function load_field(){
		return array(
				'general' => array(
					'title'	=> __( 'General', 'tp-event' )
				)
			);
	}

}

new TP_Event_Meta_Box_Event();
