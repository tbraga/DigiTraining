<?php
	/**  _ Core_Admin _   **/

	/*  Show custom admin logo  */

	function elbrus_login_logo()
	{
		echo '
	   <style type="text/css">
			#login h1 a { background: url(' . esc_url(get_template_directory_uri()) . '/images/logo.png) no-repeat center 0 !important;
			height: 47px;
			width: 310px;
			text-align: center;
		}
		</style>';
	}

	/*  Redirect To Theme Options Page on Activation  */
	if (is_admin() && isset($_GET['activated'])) {
		wp_redirect(admin_url('themes.php'));
	}

	/*  Load custom admin scripts & styles  */
	function elbrus_load_custom_wp_admin_style()
	{
		if (function_exists('WC') && WC()){
			$suffix       = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_register_script( 'wc-enhanced-select', WC()->plugin_url() . '/assets/js/admin/wc-enhanced-select' . $suffix . '.js', array( 'jquery', 'select2' ), WC_VERSION );
			wp_localize_script( 'wc-enhanced-select', 'wc_enhanced_select_params', array(
				'i18n_matches_1'            => esc_html_x( 'One result is available, press enter to select it.', 'enhanced select', 'elbrus' ),
				'i18n_matches_n'            => esc_html_x( '%qty% results are available, use up and down arrow keys to navigate.', 'enhanced select', 'elbrus' ),
				'i18n_no_matches'           => esc_html_x( 'No matches found', 'enhanced select', 'elbrus' ),
				'i18n_ajax_error'           => esc_html_x( 'Loading failed', 'enhanced select', 'elbrus' ),
				'i18n_input_too_short_1'    => esc_html_x( 'Please enter 1 or more characters', 'enhanced select', 'elbrus' ),
				'i18n_input_too_short_n'    => esc_html_x( 'Please enter %qty% or more characters', 'enhanced select', 'elbrus' ),
				'i18n_input_too_long_1'     => esc_html_x( 'Please delete 1 character', 'enhanced select', 'elbrus' ),
				'i18n_input_too_long_n'     => esc_html_x( 'Please delete %qty% characters', 'enhanced select', 'elbrus' ),
				'i18n_selection_too_long_1' => esc_html_x( 'You can only select 1 item', 'enhanced select', 'elbrus' ),
				'i18n_selection_too_long_n' => esc_html_x( 'You can only select %qty% items', 'enhanced select', 'elbrus' ),
				'i18n_load_more'            => esc_html_x( 'Loading more results&hellip;', 'enhanced select', 'elbrus' ),
				'i18n_searching'            => esc_html_x( 'Searching&hellip;', 'enhanced select', 'elbrus' ),
				'ajax_url'                  => admin_url( 'admin-ajax.php' ),
				'search_products_nonce'     => wp_create_nonce( 'search-products' ),
				'search_customers_nonce'    => wp_create_nonce( 'search-customers' )
			) );

			wp_enqueue_script( 'wc-enhanced-select' );
		}

	}

	add_action('login_head', 'elbrus_login_logo');
	add_filter('login_headerurl', create_function('', 'return get_home_url();'));
	add_filter('login_headertitle', create_function('', 'return false;'));
	add_action('admin_enqueue_scripts', 'elbrus_load_custom_wp_admin_style');


	/* Admin Panel */
	require_once( get_template_directory() . '/library/core/admin/admin-panel.php' );

	require_once( get_template_directory() . '/library/core/admin/class-tgm-plugin-activation.php' );

	require_once( get_template_directory() . '/library/core/admin/post-fields.php' );

	require_once( get_template_directory() . '/library/core/admin/functions.php' );