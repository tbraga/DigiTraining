<?php
	/**  Theme_index  **/

	require_once( get_template_directory() . '/library/theme/styles_scripts.php');
	require_once( get_template_directory() . '/library/theme/functions.php');
	require_once( get_template_directory() . '/library/theme/meta-boxes.php');
	require_once( get_template_directory() . '/library/theme/setup.php');
	require_once( get_template_directory() . '/library/theme/vc_templates.php');
	require_once( get_template_directory() . '/library/theme/customizer.php');
	require_once( get_template_directory() . '/library/theme/woocommerce.php');


	// Plugin Yellow Pencil: Visual CSS Style Editor
	add_site_option( 'YP_PART_OF_THEME', 'true' );
	if ( elbrus_get_option( 'general_settings_css_live_editor', 'off' ) == 'on' ) {
		define( 'WT_DEMO_MODE', 'true' );
	}
