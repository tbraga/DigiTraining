<?php
	/**  Core_Global  **/

	require_once( get_template_directory() . '/library/core/global/options.php');
	require_once( get_template_directory() . '/library/core/global/functions.php');
	require_once( get_template_directory() . '/library/core/global/sidebars.php');
	require_once( get_template_directory() . '/library/core/global/widgets.php');


	if (file_exists(get_template_directory() .'/one-click-demo-install/init.php')) {
		require get_template_directory() .'/one-click-demo-install/init.php';
	}

