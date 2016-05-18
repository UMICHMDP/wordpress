<?php
$cert_data = LP_Addon_Certificates::instance()->get_json( $cert_id, $user_id );
$cert_name = get_post_field( 'post_name', $cert_id );
$close     = '<a href="" class="close">' . __( 'Close', 'learnpress-certificates' ) . '</a>';
?>
<button id="learn-press-popup-certificate"><?php _e( 'View Certificate', 'learnpress-certificates' ); ?></button>
<div id="" class="learn-press-cert-preview popup">
	<div id="learn-press-cert-wrap">

		<?php learn_press_display_message( __( 'Congrats! You have taken a certificate for this course', 'learnpress-certificates' ) . $close ); ?>

		<div id="cert-design-viewport">
			<img class="cert-template" src="<?php echo $cert_data['template']; ?>">
			<canvas></canvas>
		</div>
		<div class="cert-design-actions">
			<?php _e( 'Download as:', 'learnpress-certificates' ); ?>
			<a href="" class="download" data-type="png" data-name="<?php echo $cert_name; ?>"><?php _e( 'PNG', 'learnpress-certificates' ); ?></a>
			|
			<a href="" class="download" data-type="jpg" data-name="<?php echo $cert_name; ?>"><?php _e( 'JPG', 'learnpress-certificates' ); ?></a>
		</div>
	</div>
	<form id="learn-press-form-download-cert" method="post">
		<input type="hidden" name="download_cert[name]" value="<?php echo $cert_name; ?>" />
	</form>
	<script type="text/javascript">
		var cert_data = <?php echo json_encode( $cert_data );?>,
			$button = null;
		jQuery(document).ready(function ($) {

			function showPopup() {
				$('html, body').css('overflow', 'hidden');
				$('.learn-press-cert-preview.popup')
					.appendTo(document.body)
					.fadeIn(function () {
						if (!$(this).data('cert')) {
							LP_Model_Certificates = window.LP_Model_Certificates = new $.LP_Certificates.Model(cert_data);
							LP_View_Certificates = window.LP_View_Certificates = new $.LP_Certificates.View({model: LP_Model_Certificates});
							$(this).data('cert', LP_View_Certificates)
						}
					})
					.on('click', '.close', function (e) {
						e.preventDefault();
						$('.learn-press-cert-preview.popup').fadeOut(function () {
							$('html, body').css('overflow', '');
						});
					});

				if (typeof cert_data == 'undefined') {
					return;
				}
			}

			$button = $('#learn-press-popup-certificate').click(function () {
				showPopup();
			})
			<?php if( !empty( $popup )): ?>
			$button.trigger('click');
			<?php endif;?>
		});
	</script>
</div>