<?php

function elbrus_get_option($slug,$_default = false) {

	$theme_slug = get_option( 'stylesheet' );

	if ($stgs = elbrus_getCustomizeSettings()){
		$slug_option_name = 'elbrus_'.$slug;

		if (isset($stgs->$slug_option_name))
			return esc_attr($stgs->$slug_option_name);
	}

	$slug = 'elbrus_' . $slug;

	$pix_options = get_option('theme_mods_'.$theme_slug);

	if (isset($pix_options[$slug])){
		return esc_attr($pix_options[$slug],'default');
	}else{
		if ($_default)
			return esc_attr($_default,'default');
		else
			return false;
	}

}

function elbrus_getCustomizeSettings(){
	if (isset($_POST['wp_customize']) && $_POST['wp_customize'] == 'on'){
		$settings = json_decode(stripslashes($_POST['customized']));
		return $settings;
	}else{
		return false;
	}

}

function elbrus_pix_log($data, $name = 'default'){
	global $wp_filesystem;

	if (elbrusDeveloperLog == false)
		return;

	$logDir = get_template_directory() . '/library/core/log/';
	$logFile = $logDir . $name . '.log';
	$_data = time() . ' - ' . $data;

	if( empty( $wp_filesystem ) ) {
		require_once( ABSPATH .'/wp-admin/includes/file.php' );
		WP_Filesystem();
	}

	if( $wp_filesystem ) {
		$wp_filesystem->put_contents(
			$logFile,
			$_data,
			FS_CHMOD_FILE // predefined mode settings for WP files
		);
	}

}