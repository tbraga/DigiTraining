<?php

function elbrus_customize_shop_tab($wp_customize, $theme_name) {

	$wp_customize->add_section( 'elbrus_shop_settings' , array(
		'title'      => esc_html__( 'Shop', 'elbrus' ),
		'priority'   => 15,
	) );


	$wp_customize->add_setting( 'elbrus_shop_settings_global_product' , array(
		'default'     => 'on',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_onoff'
	) );

	$wp_customize->add_control(
		'elbrus_shop_settings_global_product',
		array(
			'label'    => esc_html__( 'Global sidebar settings for Product pages', 'elbrus' ),
			'section'  => 'elbrus_shop_settings',
			'settings' => 'elbrus_shop_settings_global_product',
			'description' => esc_html__( 'Global sidebar settings for all Product pages.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'on'  => esc_html__( 'On', 'elbrus' ),
				'off'  => esc_html__( 'Off', 'elbrus' ),
			),
			'priority'   => 3
		)
	);

	$wp_customize->add_setting( 'elbrus_shop_settings_sidebar_type' , array(
		'default'     => '2',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_sidebar_blog_type'
	) );

	$wp_customize->add_control(
		'elbrus_shop_settings_sidebar_type',
		array(
			'label'    => esc_html__( 'Product sidebar type', 'elbrus' ),
			'section'  => 'elbrus_shop_settings',
			'settings' => 'elbrus_shop_settings_sidebar_type',
			'description' => esc_html__( 'Select sidebar type for Product pages.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'1' => esc_html__( 'Full width', 'elbrus' ),
				'2' => esc_html__( 'Right Sidebar', 'elbrus' ),
				'3' => esc_html__( 'Left Sidebar', 'elbrus' ),
			),
			'priority' => 5
		)
	);

	$wp_customize->add_setting( 'elbrus_shop_settings_sidebar_content' , array(
		'default'     => 'product-sidebar-1',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_sidebar_blog_content'
	) );

	$wp_customize->add_control(
		'elbrus_shop_settings_sidebar_content',
		array(
			'label'    => esc_html__( 'Product sidebar content', 'elbrus' ),
			'section'  => 'elbrus_shop_settings',
			'settings' => 'elbrus_shop_settings_sidebar_content',
			'description' => esc_html__( 'Select sidebar content for product pages', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'sidebar-1' => esc_html__( 'WP Default Sidebar', 'elbrus' ),
				'global-sidebar-1' => esc_html__( 'Blog Sidebar', 'elbrus' ),
				'portfolio-sidebar-1' => esc_html__( 'Portfolio Sidebar', 'elbrus' ),
				'shop-sidebar-1' => esc_html__( 'Shop Sidebar', 'elbrus' ),
				'product-sidebar-1' => esc_html__( 'Product Sidebar', 'elbrus' ),
				'custom-area-1' => esc_html__( 'Custom Area', 'elbrus' ),
			),
			'priority' => 10
		)
	);

}