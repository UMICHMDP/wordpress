<?php
/*
	Plugin name: Gallery Portfolio 
	Plugin URI: http://total-soft.pe.hu/gallery-portfolio
	Description: Portfolio plugin created for persons who like to show their photos in high quality with the best gallery design. Gallery & Portfolio plugin will help you more easily create image gallery, photo album, portfolio, grid image and slider portfolio.
	Version: 1.2.6
	Author: Total-Soft
	Author URI: http://total-soft.pe.hu/
	License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/
	require_once(dirname(__FILE__) . '/Includes/Total-Soft-Portfolio-Widget.php');
	require_once(dirname(__FILE__) . '/Includes/Total-Soft-Portfolio-Ajax.php');
	add_action('wp_enqueue_scripts', 'TotalSoft_PG_Widget_Style');
	function TotalSoft_PG_Widget_Style()
	{
		wp_register_style('Total_Soft_Portfolio', plugins_url('/CSS/Total-Soft-Portfolio-Widget.css',__FILE__ ));
		wp_register_style('Total_Soft_Portfolio2', plugins_url('/CSS/Filt_popup.min.css',__FILE__ ));
		wp_enqueue_style('Total_Soft_Portfolio');
		wp_enqueue_style('Total_Soft_Portfolio2');
		wp_register_script('Total_Soft_Portfolio',plugins_url('/JS/Total-Soft-Portfolio-Widget.js',__FILE__),array('jquery','jquery-ui-core'));
		wp_localize_script('Total_Soft_Portfolio', 'object', array('ajaxurl' => admin_url('admin-ajax.php')));
		wp_enqueue_script('Total_Soft_Portfolio');
		wp_enqueue_script("jquery");

		wp_register_style('fontawesome-css', plugins_url('/CSS/totalsoft.css', __FILE__));
		wp_enqueue_style('fontawesome-css');
	}
	add_action('widgets_init', 'TotalSoft_PG_Widget_Reg');
	function TotalSoft_PG_Widget_Reg() 
	{
		register_widget('Total_Soft_Portfolio');
	}
	add_action("admin_menu", 'TotalSoft_PG_Admin_Menu');
	function TotalSoft_PG_Admin_Menu()
	{
		$complete_url = wp_nonce_url( '', 'edit-menu_', 'TS_Portfolio_Nonce' );
		add_menu_page('Admin Menu','Portfolio', 'manage_options','Total_Soft_Portfolio' . $complete_url, 'Add_New_Portfolio',plugins_url('/Images/admin.png',__FILE__));
		add_submenu_page('Total_Soft_Portfolio' . $complete_url, 'Admin Menu', 'Portfolio Manager', 'manage_options', 'Total_Soft_Portfolio' . $complete_url, 'Add_New_Portfolio');
		add_submenu_page('Total_Soft_Portfolio' . $complete_url, 'Admin Menu', 'General Options', 'manage_options', 'Total_Soft_Portfolio_General' . $complete_url, 'Portfolio_Options');
		add_submenu_page('Total_Soft_Portfolio' . $complete_url, 'Admin Menu', '<span id="TS_Port_Sup">Support Forum</span>', 'manage_options', 'Total_Soft_Portfolio_Support', 'TS_Portfolio_Support');
		add_submenu_page('Total_Soft_Portfolio' . $complete_url, 'Admin Menu', 'Total Products', 'manage_options', 'Total_Soft_Products' . $complete_url, 'Total_Soft_Product_Portfolio');
	}
	add_action('admin_init',  'TotalSoft_PG_Admin_Style');
	function TotalSoft_PG_Admin_Style()
	{
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');

		wp_register_style('Total_Soft_Portfolio', plugins_url('/CSS/Total-Soft-Portfolio-Admin.css',__FILE__));
		wp_enqueue_style('Total_Soft_Portfolio' );
		wp_register_script('Total_Soft_Portfolio', plugins_url('/JS/Total-Soft-Portfolio-Admin.js',__FILE__),array('jquery','jquery-ui-core'));
		wp_localize_script('Total_Soft_Portfolio','object', array('ajaxurl'=>admin_url('admin-ajax.php')));
		wp_enqueue_script('Total_Soft_Portfolio');

		wp_register_style('fontawesome-css', plugins_url('/CSS/totalsoft.css', __FILE__));
		wp_enqueue_style('fontawesome-css');
	}

	add_action ('wp_loaded', 'TS_Port_Support');

	function TS_Port_Support()
	{
		if( $_GET['page'] != 'Total_Soft_Portfolio_Support' ){
			return;
		}
		$url = 'https://wordpress.org/support/plugin/gallery-portfolio';
		wp_redirect($url);
		exit;
	}

	add_action( 'admin_footer', 'TS_Portfolio_Support_Blank' );
	function TS_Portfolio_Support_Blank()
	{
		?>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#TS_Port_Sup').parent().attr('target','_blank');
			});
		</script>
		<?php
	}

	function Add_New_Portfolio()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Portfolio-New.php');
	}
	function Portfolio_Options()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Portfolio-Settings.php');
	}
	function TS_Portfolio_Support() {}
	function Total_Soft_Product_Portfolio()
	{
 		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Products.php');
	}
	function TotalSoftPortfolioInstall()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Portfolio-Install.php');
	}
	register_activation_hook(__FILE__,'TotalSoftPortfolioInstall');

	function Total_SoftPortfolio_Short_ID($atts, $content = null)
	{
		$atts=shortcode_atts(
			array(
				"id"=>"1"
			),$atts
		);
		return Total_Soft_Draw_Portfolio($atts['id']);
	}
	add_shortcode('Total_Soft_Portfolio', 'Total_SoftPortfolio_Short_ID');
	function Total_Soft_Draw_Portfolio($Portfolio)
	{
		ob_start();
			$args = shortcode_atts(array('name' => 'Widget Area','id'=>'','description'=>'','class'=>'','before_widget'=>'','after_widget'=>'','before_title'=>'','AFTER_TITLE'=>'','widget_id'=>'','widget_name'=>'Total Soft Portfolio'), $atts, 'Total_Soft_Portfolio' );
			$Total_Soft_Portfolio = new Total_Soft_Portfolio;

			$instance = array('Total_Soft_Portfolio'=>$Portfolio, 'TS_Portfolio_Theme_Name' => '');
			$Total_Soft_Portfolio->widget($args,$instance);
			$cont[] = ob_get_contents();
		ob_end_clean();
		return $cont[0];
	}
	function TotalSoft_Port_Color()
	{
		wp_enqueue_script(
			'alpha-color-picker',
			plugins_url('/JS/alpha-color-picker.js', __FILE__),
			array( 'jquery', 'wp-color-picker' ), // You must include these here.
			null,
			true
		);
		wp_enqueue_style(
			'alpha-color-picker',
			plugins_url('/CSS/alpha-color-picker.css', __FILE__),
			array( 'wp-color-picker' ) // You must include these here.
		);
	}
	add_action( 'admin_enqueue_scripts', 'TotalSoft_Port_Color' );

	function Total_Soft_Portfolio_settings_link($links)
	{
		$forum_link   = '<a target="_blank" href="https://wordpress.org/support/plugin/gallery-portfolio"> Support </a>';
		$premium_link = '<a target="_blank" href="http://total-soft.pe.hu/gallery-portfolio/"> Pro Version </a>';
		array_push($links, $forum_link);
		array_push($links, $premium_link);
		return $links; 
	}

	$plugin = plugin_basename(__FILE__);
	add_filter("plugin_action_links_$plugin", 'Total_Soft_Portfolio_settings_link' );

	function TS_Port_Media_Button() {

		$img = plugins_url('/Images/admin.png',__FILE__);
		$container_id = 'TSPortfolio';
		$title = 'Select Total Soft Portfolio to insert into post';
		$button_text = 'TS Portfolio';
		$context .= '<a class="button thickbox" title="' . $title . '"	href="#TB_inline&inlineId=' . $container_id . '&width=400&height=240">
		<span class="wp-media-buttons-icon" style="background: url(' . $img . '); background-repeat: no-repeat; background-position: left bottom;background-size: 18px 18px;"></span>' . $button_text . '</a>';

		echo $context;
	}
	add_action( 'media_buttons', 'TS_Port_Media_Button');
	add_action( 'admin_footer', 'TS_Port_Media_Button_Content');

	function TS_Port_Media_Button_Content()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Portfolio-Media.php');
	}

	if( isset($_GET['ts_portfolio_preview']) )
	{
		add_filter('the_content', 'TS_Port_theContenta');
		add_filter('template_include', 'TS_Port_templateIncludea');

		function TS_Port_theContenta()
		{
			if (!is_user_logged_in()) return 'Log In first in order to preview the Portfolio.';

			ob_start();
				$args = shortcode_atts(array('name' => 'Widget Area','id'=>'','description'=>'','class'=>'','before_widget'=>'','after_widget'=>'','before_title'=>'','AFTER_TITLE'=>'','widget_id'=>'','widget_name'=>'Total Soft Portfolio'), $_GET['ts_portfolio_preview'], 'Total_Soft_Portfolio' );
				$Total_Soft_Portfolio = new Total_Soft_Portfolio;

				$instance = array('Total_Soft_Portfolio'=>$_GET['ts_portfolio_preview'], 'TS_Portfolio_Theme_Name' => '');
				$Total_Soft_Portfolio->widget($args,$instance);
				$cont[] = ob_get_contents();
			ob_end_clean();
			return $cont[0];
		}
		function TS_Port_templateIncludea()
		{
			return locate_template(array('page.php', 'single.php', 'index.php'));
		}
	}
	if( isset($_GET['ts_portfolio_preview_theme']) )
	{
		add_filter('the_content', 'TS_Port_theContent');
		add_filter('template_include', 'TS_Port_templateInclude');

		function TS_Port_theContent()
		{
			global $wpdb;
			$table_name2 = $wpdb->prefix . "totalsoft_portfolio_dbt";
			$table_name4 = $wpdb->prefix . "totalsoft_portfolio_manager";

			$TotalSoftGalleryP = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id>%d", 0));
			if(count($TotalSoftGalleryP) != 0){ $GalleryPortfolio = $TotalSoftGalleryP[0]->id; }else{ $GalleryPortfolio = ''; }

			if($_GET['ts_portfolio_preview_theme'] == 'true')
			{
				$GalleryPortfolioTheme = 'true';
			}
			else
			{
				$TotalSoftGalleryPOptions = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE id = %d", $_GET['ts_portfolio_preview_theme']));
				$GalleryPortfolioTheme = $TotalSoftGalleryPOptions[0]->TotalSoftPortfolio_SetName;
			}

			if (!is_user_logged_in()) return 'Log In first in order to preview the Portfolio.';

			ob_start();
				$args = shortcode_atts(array('name' => 'Widget Area','id'=>'','description'=>'','class'=>'','before_widget'=>'','after_widget'=>'','before_title'=>'','AFTER_TITLE'=>'','widget_id'=>'','widget_name'=>'Total Soft Portfolio'), $_GET['ts_portfolio_preview'], 'Total_Soft_Portfolio' );
				$Total_Soft_Portfolio = new Total_Soft_Portfolio;

				$instance = array('Total_Soft_Portfolio'=>$GalleryPortfolio, 'TS_Portfolio_Theme_Name' => $GalleryPortfolioTheme);
				$Total_Soft_Portfolio->widget($args,$instance);
				$cont[] = ob_get_contents();
			ob_end_clean();
			return $cont[0];
		}
		function TS_Port_templateInclude()
		{
			return locate_template(array('page.php', 'single.php', 'index.php'));
		}
	}
?>