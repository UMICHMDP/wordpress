<?php
/**
 * @Author: ducnvtt
 * @Date:   2016-02-24 16:33:45
 * @Last Modified by:     ducnvtt
 * @Last Modified time: 2 2016-03-01 09:18:59
 */

$event_setting = apply_filters( 'event_admin_settings', array() );
?>

<?php if( $event_setting ): ?>

	<?php $current_tab = isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] ? $_GET[ 'tab' ] : current( array_keys( $event_setting ) ) ?>

	<form method="POST" name="tp_event_options" action="options.php">
		<?php settings_fields( $this->options->_prefix ); ?>
		<div class="wrap tp_event_setting_wrapper">

			<!--	Tabs	-->
			<h2 class="nav-tab-wrapper">
				<?php foreach( $event_setting as $key => $title ): ?>

					<a href="<?php echo esc_url( admin_url( 'admin.php?page=tp-event-setting&tab=' . $key ) ); ?>" class="nav-tab<?php echo $current_tab === $key ? ' nav-tab-active' : '' ?>" data-tab="<?php echo esc_attr( $key ) ?>">
						<?php printf( '%s', $title ) ?>
					</a>

				<?php endforeach; ?>
			</h2>

			<!--	Content 	-->
			<div class="tp_event_wrapper_content">

				<?php foreach( $event_setting as $key => $title ): ?>

					<div id="<?php echo esc_attr( $key ) ?>">
						<?php echo do_action( 'event_admin_setting_' . $key . '_content' ); ?>
					</div>

				<?php endforeach; ?>

			</div>

		</div>

		<?php submit_button(); ?>

	</form>

<?php endif; ?>
