<div class="thim-link-login thim-login-popup">
	<?php if ( is_user_logged_in() ): ?>
		<?php if ( thim_plugin_active( 'learnpress/learnpress.php' ) ) : ?>
			<?php if ( thim_is_new_learnpress() ) : ?>
				<a class="profile" href="<?php echo esc_url( learn_press_user_profile_link() ); ?>"><?php esc_html_e( 'Profile', 'eduma' ); ?></a>
			<?php else: ?>
				<a class="profile" href="<?php echo esc_url( apply_filters( 'learn_press_instructor_profile_link', '#', get_current_user_id(), '' ) ); ?>"><?php esc_html_e( 'Profile', 'eduma' ); ?></a>
			<?php endif; ?>
		<?php endif; ?>

		<a class="logout" href="<?php echo esc_url( wp_logout_url( apply_filters('thim_default_logout_redirect', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) ) ); ?>"><?php echo esc_html( $instance['text_logout'] ); ?></a>
	<?php else : ?>
		<?php
		$registration_enabled = get_option( 'users_can_register' );
		if ( $registration_enabled ) :
			?>
			<a class="register" href="<?php echo esc_url( thim_get_register_url() ); ?>"><?php echo esc_html( $instance['text_register'] ); ?></a>
		<?php endif; ?>
		<a class="login" href="<?php echo esc_url( thim_get_login_page_url() ); ?>"><?php echo esc_html( $instance['text_login'] ); ?></a>
	<?php endif; ?>
</div>

<?php if ( !is_user_logged_in() ): ?>
	<div id="thim-popup-login" class="<?php echo ( ! empty( $instance['shortcode'] ) ) ? 'has-shortcode' : '' ; ?>">
		<div class="thim-login-container">
			<?php
			if ( ! empty( $instance['shortcode'] ) ) {
				echo do_shortcode( $instance['shortcode'] );
			}
			?>
			<div class="thim-login">
				<h2 class="title"><?php esc_html_e( 'Login with your site account', 'eduma' ); ?></h2>
				<?php wp_login_form( array(
						'redirect'       => ! empty( $_REQUEST['redirect_to'] ) ? esc_url( $_REQUEST['redirect_to'] ) : apply_filters( 'thim_default_login_redirect', home_url() ),
						'id_username'    => 'thim_login',
						'id_password'    => 'thim_pass',
						'label_username' => esc_html__( 'Username or email', 'eduma' ),
						'label_password' => esc_html__( 'Password', 'eduma' ),
						'label_remember' => esc_html__( 'Remember me', 'eduma' ),
						'label_log_in'   => esc_html__( 'Login', 'eduma' ),
				) ); ?>
				<?php
				$registration_enabled = get_option( 'users_can_register' );
				if ( $registration_enabled ) :
					?>
					<?php echo '<p class="link-bottom">' . esc_html__( 'Not a member yet? ', 'eduma' ) . '<a href="' . esc_url( thim_get_register_url() ) . '">' . esc_html__( 'Register now', 'eduma' ) . '</a></p>'; ?>
				<?php endif; ?>

			</div>
		</div>
	</div>
<?php endif; ?>