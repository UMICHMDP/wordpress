<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of customizer-options
 *
 * @author Tuannv
 */
require_once "generate-less-to-css.php";

class Thim_Customize_Options {

	function __construct() {
		add_action( 'tf_create_options', array( $this, 'create_customizer_options' ) );
		add_action( 'customize_save_after', array( $this, 'generate_to_css' ) );

		/* Unregister Default Customizer Section */
		add_action( 'customize_register', array( $this, 'unregister' ) );

		/**
		 * The code below is for auto restore style for customizer
		 */
//		add_action( 'switch_theme', array( $this, 'remove_theme_version' ), 10, 3 );
//		add_action( 'admin_init', array( $this, 'restore_style_if_needed' ) );
	}

	/**
	 * Check if version of current theme is changed then restore style in last change
	 */
	public function restore_style_if_needed() {
		$theme_slug  = get_option( 'stylesheet' );
		$theme       = wp_get_theme( $theme_slug );
		$old_version = get_option( "theme_{$theme_slug}_version" );
		$new_version = $theme->get( 'Version' );
		if ( version_compare( $old_version, $new_version, '<' ) || !$this->style_exists() ) {
			$this->generate_to_css();
			update_option( "theme_{$theme_slug}_version", $new_version );
		}
	}

	/**
	 * Check if file style is not exists or is empty
	 *
	 * @return bool
	 */
	private function style_exists() {
		if ( is_multisite() ) {
			$stylesheet = THIM_DIR . 'style-' . get_current_blog_id() . '.css';
		} else {
			$stylesheet = THIM_DIR . 'style.css';
		}
		return ( file_exists( $stylesheet ) && filesize( $stylesheet ) );
	}

	/**
	 * Remove theme version after theme is switched to another
	 *
	 * @param $new_name
	 * @param $new_theme
	 * @param $old_theme
	 */
	public function remove_theme_version( $new_name, $new_theme, $old_theme ) {
		$theme_slug = get_option( 'theme_switched' );
		delete_option( "theme_{$theme_slug}_version" );
	}

	function unregister( $wp_customize ) {
		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'nav' );
		$wp_customize->remove_section( 'static_front_page' );
	}

	function create_customizer_options() {
		$titan = TitanFramework::getInstance( 'thim' );
		/* Register Customizer Sections */
		//include heading
		include THIM_DIR . "inc/admin/customizer-sections/logo.php";

		include THIM_DIR . "inc/admin/customizer-sections/header.php";
		include THIM_DIR . "inc/admin/customizer-sections/header-mainmenu.php";
		include THIM_DIR . "inc/admin/customizer-sections/header-mobile.php";;
		include THIM_DIR . "inc/admin/customizer-sections/header-submenu.php";
		include THIM_DIR . "inc/admin/customizer-sections/header-stickymenu.php";
		include THIM_DIR . "inc/admin/customizer-sections/header-toolbar.php";

		//include styling
		include THIM_DIR . "inc/admin/customizer-sections/styling.php";
		include THIM_DIR . "inc/admin/customizer-sections/styling-color.php";
		include THIM_DIR . "inc/admin/customizer-sections/styling-layout.php";
		include THIM_DIR . "inc/admin/customizer-sections/styling-pattern.php";
		include THIM_DIR . "inc/admin/customizer-sections/styling-rtl.php";

		//include display setting
		include THIM_DIR . "inc/admin/customizer-sections/display.php";
		include THIM_DIR . "inc/admin/customizer-sections/display-archive.php";
		include THIM_DIR . "inc/admin/customizer-sections/display-frontpage.php";
		include THIM_DIR . "inc/admin/customizer-sections/display-postpage.php";
		include THIM_DIR . "inc/admin/customizer-sections/display-sharing.php";


		//include typography
		include THIM_DIR . "inc/admin/customizer-sections/typography.php";

		//include footer
		include THIM_DIR . "inc/admin/customizer-sections/footer.php";
		include THIM_DIR . "inc/admin/customizer-sections/footer-copyright.php";
		include THIM_DIR . "inc/admin/customizer-sections/footer-options.php";

		include THIM_DIR . "inc/admin/customizer-sections/page-builder.php";
		include THIM_DIR . "inc/admin/customizer-sections/page-builder-chosen.php";

		//include woocommerce
		if ( class_exists( 'WooCommerce' ) ) {
			include THIM_DIR . "inc/admin/customizer-sections/woocommerce.php";
			include THIM_DIR . "inc/admin/customizer-sections/woocommerce-archive.php";
			include THIM_DIR . "inc/admin/customizer-sections/woocommerce-setting.php";
			include THIM_DIR . "inc/admin/customizer-sections/woocommerce-single.php";
		}
		// include customizer courses
		if ( class_exists( 'LearnPress' ) ) {
			include THIM_DIR . "inc/admin/customizer-sections/learnpress.php";
			include THIM_DIR . "inc/admin/customizer-sections/learnpress-archive.php";
			include THIM_DIR . "inc/admin/customizer-sections/learnpress-single.php";
			include THIM_DIR . "inc/admin/customizer-sections/learnpress-features.php";
		}

		if ( class_exists( 'THIM_Portfolio' ) ) {
			include THIM_DIR . "inc/admin/customizer-sections/portfolio.php";
			include THIM_DIR . "inc/admin/customizer-sections/portfolio-archive.php";
			include THIM_DIR . "inc/admin/customizer-sections/portfolio-single.php";
		}

		if ( class_exists( 'TP_Event' ) ) {
			include THIM_DIR . "inc/admin/customizer-sections/event.php";
			include THIM_DIR . "inc/admin/customizer-sections/event-archive.php";
			include THIM_DIR . "inc/admin/customizer-sections/event-single.php";
		}

		// include Support
		include THIM_DIR . "inc/admin/customizer-sections/utilities.php";

		//include Custom Css
		include THIM_DIR . "inc/admin/customizer-sections/custom-css.php";
		//include Custom JS
		include THIM_DIR . "inc/admin/customizer-sections/custom-js.php";
		//include Import/Export
		include THIM_DIR . "inc/admin/customizer-sections/import-export.php";
		//include Share this in post
		include THIM_DIR . "inc/admin/metabox-sections/share-this.php";
		include THIM_DIR . "inc/admin/metabox-sections/portfolio-background.php";
	}

	function generate_to_css() {
		$options = get_theme_mods();
		thim_options_variation( $options );
		thim_generate( THIM_DIR . 'style', '.css', $options );
	}
}

new Thim_Customize_Options();