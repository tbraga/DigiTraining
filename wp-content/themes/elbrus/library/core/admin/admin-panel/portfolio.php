<?php

function elbrus_customize_portfolio_tab($wp_customize, $theme_name) {

	$wp_customize->add_panel('elbrus_portfolio_settings',
	array(
		'title' => esc_html__( 'Portfolio', 'elbrus' ),
		'priority' => 14,
		)
	);

	// portfolio general settings
	$wp_customize->add_section( 'elbrus_portfolio_general_settings' , array(
		'title'      => __( 'Portfolio General', 'elbrus' ),
		'priority'   => 10,
		'panel' => 'elbrus_portfolio_settings'
	) );

	$wp_customize->add_setting( 'elbrus_portfolio_settings_trumb_width' , array(
		'default'     => '555',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_absinteger'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_trumb_width',
		array(
			'label'    => esc_html__( 'Portfolio Tumbnails Width (px)', 'elbrus' ),
			'section'  => 'elbrus_portfolio_general_settings',
			'settings' => 'elbrus_portfolio_settings_trumb_width',
			'type'     => 'textfield',
			'description' => esc_html__( 'Default: 555px', 'elbrus' ),
			'priority' => 10
		)
	);

	$wp_customize->add_setting( 'elbrus_portfolio_settings_trumb_height' , array(
		'default'     => '555',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_absinteger'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_trumb_height',
		array(
			'label'    => esc_html__( 'Portfolio Tumbnails Height (px)', 'elbrus' ),
			'section'  => 'elbrus_portfolio_general_settings',
			'settings' => 'elbrus_portfolio_settings_trumb_height',
			'type'     => 'textfield',
			'description' => esc_html__( 'Default: 555px', 'elbrus' ),
			'priority' => 20
		)
	);


	// portfolio categories page settings
	$wp_customize->add_section( 'elbrus_portfolio_categories_settings' , array(
		'title'      => esc_html__( 'Portfolio Category and Archive Pages', 'elbrus' ),
		'priority'   => 20,
		'panel' => 'elbrus_portfolio_settings'
	) );

	$wp_customize->add_setting( 'elbrus_portfolio_settings_type' , array(
		'default'     => 'type_without_icons',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_portfolio_type'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_type',
		array(
			'label'    => esc_html__( 'Item type', 'elbrus' ),
			'section'  => 'elbrus_portfolio_categories_settings',
			'settings' => 'elbrus_portfolio_settings_type',
			'description' => esc_html__( 'Portfolio items per row for portfolio category and archive pages.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'type_without_icons' => esc_html__( 'Without over icons', 'elbrus' ),
				'type_with_icons' => esc_html__( 'With over icons', 'elbrus' ),
			),
			'priority' => 10
		)
	);

	$wp_customize->add_setting( 'elbrus_portfolio_settings_perrow' , array(
		'default'     => '2',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_portfolio_perrow'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_perrow',
		array(
			'label'    => esc_html__( 'Portfolio Column Number', 'elbrus' ),
			'section'  => 'elbrus_portfolio_categories_settings',
			'settings' => 'elbrus_portfolio_settings_perrow',
			'description' => esc_html__( 'Portfolio items per row for portfolio category and archive pages.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'2' => esc_html__( '2 columns', 'elbrus' ),
				'3' => esc_html__( '3 columns', 'elbrus' ),
				'4' => esc_html__( '4 columns', 'elbrus' ),
			),
			'priority' => 20
		)
	);

	$wp_customize->add_setting( 'elbrus_portfolio_settings_perpage' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_per_page'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_perpage',
		array(
			'label'    => esc_html__( 'Portfolio Item per page', 'elbrus' ),
			'section'  => 'elbrus_portfolio_categories_settings',
			'settings' => 'elbrus_portfolio_settings_perpage',
			'description' => esc_html__( 'Portfolio items per page for portfolio category and archive pages. Leave empty to show all items.', 'elbrus' ),
			'type'     => 'textfield',
			'priority' => 30
		)
	);

	$wp_customize->add_setting( 'elbrus_portfolio_settings_sidebar_type' , array(
		'default'     => '2',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_sidebar_portfolio_type'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_sidebar_type',
		array(
			'label'    => esc_html__( 'Portfolio sidebar type', 'elbrus' ),
			'section'  => 'elbrus_portfolio_categories_settings',
			'settings' => 'elbrus_portfolio_settings_sidebar_type',
			'description' => esc_html__( 'Select sidebar type for portfolio category and archive pages.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'1' => esc_html__( 'Full width', 'elbrus' ),
				'2' => esc_html__( 'Right Sidebar', 'elbrus' ),
				'3' => esc_html__( 'Left Sidebar', 'elbrus' ),
			),
			'priority' => 40
		)
	);

	$wp_customize->add_setting( 'elbrus_portfolio_settings_sidebar_content' , array(
		'default'     => 'sidebar-1',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_sidebar_portfolio_content'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_sidebar_content',
		array(
			'label'    => esc_html__( 'Portfolio sidebar content', 'elbrus' ),
			'section'  => 'elbrus_portfolio_categories_settings',
			'settings' => 'elbrus_portfolio_settings_sidebar_content',
			'description' => esc_html__( 'Select sidebar content for portfolio category and archive pages.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'sidebar-1' => esc_html__( 'WP Default Sidebar', 'elbrus' ),
				'global-sidebar-1' => esc_html__( 'Blog Sidebar', 'elbrus' ),
				'portfolio-sidebar-1' => esc_html__( 'Portfolio Sidebar', 'elbrus' ),
				'custom-area-1' => esc_html__( 'Custom Area', 'elbrus' ),
			),
			'priority' => 50
		)
	);

	$wp_customize->add_setting( 'elbrus_portfolio_settings_loadmore' , array(
		'default'     => esc_html__('Load more', 'elbrus' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_text'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_loadmore',
		array(
			'label'    => esc_html__( 'Load More button text', 'elbrus' ),
			'section'  => 'elbrus_portfolio_categories_settings',
			'settings' => 'elbrus_portfolio_settings_loadmore',
			'type'     => 'textfield',
			'priority' => 60
		)
	);


	// portfolio single page settings
	$wp_customize->add_section( 'elbrus_portfolio_single_settings' , array(
		'title'      => esc_html__( 'Portfolio Single Page', 'elbrus' ),
		'priority'   => 30,
		'panel' => 'elbrus_portfolio_settings'
	) );

	$wp_customize->add_setting( 'elbrus_portfolio_settings_related_show' , array(
		'default'     => 'on',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_onoff'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_related_show',
		array(
			'label'    => esc_html__( 'Show block Related projects', 'elbrus' ),
			'section'  => 'elbrus_portfolio_single_settings',
			'settings' => 'elbrus_portfolio_settings_related_show',
			'description' => esc_html__( 'Select on/off Related projects for portfolio single pages.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'on' => esc_html__( 'On', 'elbrus' ),
				'off' => esc_html__( 'Off', 'elbrus' ),
			),
			'priority' => 10
		)
	);

	$wp_customize->add_setting( 'elbrus_portfolio_settings_related_title' , array(
		'default'     => esc_html__('Related projects', 'elbrus' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_text'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_related_title',
		array(
			'label'    => esc_html__( 'Title block Related Projects', 'elbrus' ),
			'section'  => 'elbrus_portfolio_single_settings',
			'settings' => 'elbrus_portfolio_settings_related_title',
			'type'     => 'textfield',
			'priority' => 20
		)
	);

	$wp_customize->add_setting( 'elbrus_portfolio_settings_related_desc' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_text'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_related_desc',
		array(
			'label'    => esc_html__( 'Description block Related Projects', 'elbrus' ),
			'section'  => 'elbrus_portfolio_single_settings',
			'settings' => 'elbrus_portfolio_settings_related_desc',
			'type'     => 'textarea',
			'priority' => 30
		)
	);

	$wp_customize->add_setting( 'elbrus_portfolio_settings_share' , array(
		'default'     => 'on',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_onoff'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_share',
		array(
			'label'    => esc_html__( 'Show share', 'elbrus' ),
			'section'  => 'elbrus_portfolio_single_settings',
			'settings' => 'elbrus_portfolio_settings_share',
			'description' => esc_html__( 'Select on/off share for portfolio single pages.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'on' => esc_html__( 'On', 'elbrus' ),
				'off' => esc_html__( 'Off', 'elbrus' ),
			),
			'priority' => 40
		)
	);

	$wp_customize->add_setting( 'elbrus_portfolio_settings_link_to_all' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_control(
		'elbrus_portfolio_settings_link_to_all',
		array(
			'label'    => esc_html__( 'Link to portfolio all works Page', 'elbrus' ),
			'section'  => 'elbrus_portfolio_single_settings',
			'settings' => 'elbrus_portfolio_settings_link_to_all',
			'type'     => 'textfield',
			'description' => esc_html__( 'Leave empty to show portfolio default archive page.', 'elbrus' ),
			'priority' => 50
		)
	);


}