<?php

	require_once( get_template_directory() . '/library/core/admin/admin-panel/general.php' );
	require_once( get_template_directory() . '/library/core/admin/admin-panel/style.php' );
	require_once( get_template_directory() . '/library/core/admin/admin-panel/header.php' );
	require_once( get_template_directory() . '/library/core/admin/admin-panel/footer.php' );
	require_once( get_template_directory() . '/library/core/admin/admin-panel/portfolio.php' );
	require_once( get_template_directory() . '/library/core/admin/admin-panel/blog.php' );
	require_once( get_template_directory() . '/library/core/admin/admin-panel/css_animation.php' );
	require_once( get_template_directory() . '/library/core/admin/admin-panel/shop.php' );
	require_once( get_template_directory() . '/library/core/admin/admin-panel/sanitizer.php' );


	function elbrus_customize_register( $wp_customize ) {


		/** GENERAL SETTINGS **/
		elbrus_customize_general_tab($wp_customize, 'elbrus');


		/** STYLE SECTION **/

		elbrus_customize_style_tab($wp_customize, 'elbrus');


		/** HEADER SECTION **/

		elbrus_customize_header_tab($wp_customize, 'elbrus');


		/** FOOTER SECTION **/

		elbrus_customize_footer_tab($wp_customize, 'elbrus');


		/** PORTFOLIO PANEL AND SECTIONS **/

		elbrus_customize_portfolio_tab($wp_customize, 'elbrus');


		/** BLOG SECTION **/

		elbrus_customize_blog_tab($wp_customize, 'elbrus');


		/** CSS ANIMATION SECTION **/

		elbrus_customize_css_animation_tab($wp_customize, 'elbrus');


		/** SHOP SECTION **/

		elbrus_customize_shop_tab($wp_customize, 'elbrus');


		/** Remove unused sections */

		$removedSections = apply_filters('elbrus_admin_customize_removed_sections', array('header_image','background_image'));
		foreach ($removedSections as $_sectionName){
			$wp_customize->remove_section($_sectionName);
		}

	}

	add_action( 'customize_register', 'elbrus_customize_register' );