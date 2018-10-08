<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
	global $wpdb;

	$table_name4 = $wpdb->prefix . "totalsoft_portfolio_manager";
	$TotalSoftPortfolio = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id>%d order by id", 0));
?>
<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery('#TS_Port_Media_Insert').on('click', function () {
			var id = jQuery('#TS_Port_Media_Select option:selected').val();
			window.send_to_editor('[Total_Soft_Portfolio id="' + id + '"]');
			tb_remove();
			return false;
		});
	});
</script>
<form method="POST">
	<div id="TSPortfolio" style="display: none;">
		<?php
			$new_port_link = admin_url('admin.php?page=Total_Soft_Portfolio');
			$new_port_link_n = wp_nonce_url( '', 'edit-menu_', 'TS_Portfolio_Nonce' );

			if ($TotalSoftPortfolio && !empty($TotalSoftPortfolio)) { ?>
				<h3>Select The Portfolio</h3>
				<select id="TS_Port_Media_Select">
					<?php
						foreach ($TotalSoftPortfolio as $TotalSoftPortfolio1)
						{
							?> <option value="<?php echo $TotalSoftPortfolio1->id; ?>"> <?php echo $TotalSoftPortfolio1->TotalSoftPortfolio_Title; ?> </option> <?php
						}
					?>
				</select>
				<button class='button primary' id='TS_Port_Media_Insert'>Insert Portfolio</button>
			<?php } else {
				printf('<p>%s<a class="button" href="%s">%s</a></p>', 'You have not created any portfolios yet' . '<br>', $new_port_link . $new_port_link_n, 'Create New Portfolio');
			}
		?>
	</div>
</form>