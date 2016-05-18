<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php _e( 'View Certificate', 'learnpress-certificates' ); ?></title>

	<link rel="stylesheet" id="open-sans-css" href="https://fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&amp;subset=latin%2Clatin-ext&amp;" type="text/css" media="all">
	<?php do_action( 'wp_enqueue_scripts' ); ?>
	<?php wp_print_styles( 'learn-press-frontend-cert' ); ?>
	<?php wp_print_scripts( 'learn-press-frontend-cert' ); ?>

</head>
<?php
global $wp_query, $wp;
$cert_name = $_REQUEST['view'];
$cert = learn_press_get_certificate_by_name( $_REQUEST['view'] );
$cert_data = LP_Addon_Certificates::instance()->get_json( $cert->ID, learn_press_get_profile_user() );
?>
<body class="learn-press-cert-preview">
<div id="learn-press-cert-wrap">
	<div id="cert-design-viewport">
		<img class="cert-template" src="<?php echo $cert_data['template'];?>">
		<canvas></canvas>
	</div>
	<div class="cert-design-actions">
		<?php _e( 'Download as:', 'learnpress-certificates' );?>
		<a href="" class="download" data-type="png" data-name="<?php echo $cert_name;?>"><?php _e( 'PNG', 'learnpress-certificates' );?></a>
		|
		<a href="" class="download" data-type="jpg" data-name="<?php echo $cert_name;?>"><?php _e( 'JPG', 'learnpress-certificates' );?></a>
	</div>
	<form id="learn-press-form-download-cert" method="post">
		<input type="hidden" name="download_cert[name]" value="<?php echo $cert_name;?>" />
	</form>
</div>
<script type="text/javascript">
	var cert_data = <?php echo json_encode( $cert_data );?>;
</script>
</body>
</html>
