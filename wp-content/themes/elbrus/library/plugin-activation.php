<?php
/******* TGM Plugin ********/
function elbrus_pix_theme_register_required_plugins(){
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name' => esc_html__( 'Contact Form 7', 'elbrus' ), // The plugin name
			'slug' => 'contact-form-7', // The plugin slug (typically the folder name)
			'required' => true, // If false, the plugin is only 'recommended' instead of required

		) ,
		array(
			'name' => esc_html__( 'Mailchimp', 'elbrus' ), // The plugin name
			'slug' => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
			'required' => true, // If false, the plugin is only 'recommended' instead of required
		) ,
		array(
			'name' => esc_html__( 'Revolution Slider', 'elbrus' ), // The plugin name
			'slug' => 'revslider', // The plugin slug (typically the folder name)
			'source' => 'http://envato.templines.com/plugins/revslider.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''// If set, overrides default API URL and points to an external URL
		) ,
		array(
			'name' => esc_html__( 'WPBakery Visual Composer', 'elbrus' ), // The plugin name
			'slug' => 'js_composer', // The plugin slug (typically the folder name)
			'source' => 'http://envato.templines.com/plugins/js_composer.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''// If set, overrides default API URL and points to an external URL
		) ,
		array(
			'name' => esc_html__( 'Regenerate Thumbnails', 'elbrus' ), // The plugin name
			'slug' => 'regenerate-thumbnails', // The plugin slug (typically the folder name)
			'required' => true, // If false, the plugin is only 'recommended' instead of required
		) ,
		array(
			'name' => esc_html__( 'PixthemeCustom', 'elbrus' ), // The plugin name
			'slug' => 'pixtheme-custom', // The plugin slug (typically the folder name)
			'source' => esc_url('http://envato.templines.com/plugins/pixtheme-custom/elbrus/pixtheme-custom.zip'), // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''// If set, overrides default API URL and points to an external URL
		) ,
		array(
			'name' => esc_html__( 'Font Icons Loader', 'elbrus' ), // The plugin name
			'slug' => 'font-icons-loader', // The plugin slug (typically the folder name)
			'source' => esc_url('http://envato.templines.com/plugins/tempmonst/font-icons-loader.zip'), // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => '' // If set, overrides default API URL and points to an external URL
		) ,
		array(
			'name' => esc_html__( 'Meta Box', 'elbrus' ), // The plugin name
			'slug' => 'meta-box', // The plugin slug (typically the folder name)
			'required' => true, // If false, the plugin is only 'recommended' instead of required
		) ,

		array(
			'name' => esc_html__( 'One Click Demo Import', 'elbrus' ), // The plugin name
			'slug' => 'one-click-demo-import', // The plugin slug (typically the folder name)
			'required' => true, // If false, the plugin is only 'recommended' instead of required
		) ,

	);
	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id' => 'elbrus', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '', // Default absolute path to pre-packaged plugins.
		'menu' => 'tgmpa-install-plugins', // Menu slug.
		'has_notices' => true, // Show admin notices or not.
		'dismissable' => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false, // Automatically activate plugins after installation or not.
		'message' => '', // Message to output right before the plugins table.
		'strings' => array(
			'page_title' => esc_html__('Install Required Plugins', 'elbrus') ,
			'menu_title' => esc_html__('Install Plugins', 'elbrus') ,
			'installing' => esc_html__('Installing Plugin: %s', 'elbrus') , // %s = plugin name.
			'oops' => esc_html__('Something went wrong with the plugin API.', 'elbrus') ,
			'notice_can_install_required' => wp_kses_post( _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'elbrus') ) , // %1$s = plugin name(s).
			'notice_can_install_recommended' => wp_kses_post( _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'elbrus') ) , // %1$s = plugin name(s).
			'notice_cannot_install' => wp_kses_post( _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'elbrus') ) , // %1$s = plugin name(s).
			'notice_can_activate_required' => wp_kses_post( _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'elbrus') ) , // %1$s = plugin name(s).
			'notice_can_activate_recommended' => wp_kses_post( _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'elbrus') ) , // %1$s = plugin name(s).
			'notice_cannot_activate' => wp_kses_post( _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'elbrus') ) , // %1$s = plugin name(s).
			'notice_ask_to_update' => wp_kses_post( _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'elbrus') ) , // %1$s = plugin name(s).
			'notice_cannot_update' => wp_kses_post( _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'elbrus') ) , // %1$s = plugin name(s).
			'install_link' => wp_kses_post( _n_noop('Begin installing plugin', 'Begin installing plugins', 'elbrus') ) ,
			'activate_link' => wp_kses_post( _n_noop('Begin activating plugin', 'Begin activating plugins', 'elbrus') ) ,
			'return' => esc_html__('Return to Required Plugins Installer', 'elbrus') ,
			'plugin_activated' => esc_html__('Plugin activated successfully.', 'elbrus') ,
			'complete' => esc_html__('All plugins installed and activated successfully. %s', 'elbrus') , // %s = dashboard link.
			'nag_type' => 'updated'

			// Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.

		)
	);
	tgmpa($plugins, $config);
}

add_action('tgmpa_register', 'elbrus_pix_theme_register_required_plugins');


function elbrus_pix_vcSetAsTheme(){
	vc_set_as_theme();
	require_once (get_template_directory() . '/library/theme/vc_templates.php');
}

add_action('vc_before_init', 'elbrus_pix_vcSetAsTheme');

if ( function_exists( 'set_revslider_as_theme' ) ) {
	add_action( 'init', 'elbrus_pix_revsliderSetAsTheme' );
	function elbrus_pix_revsliderSetAsTheme() {
	 set_revslider_as_theme();
	}
}

?>