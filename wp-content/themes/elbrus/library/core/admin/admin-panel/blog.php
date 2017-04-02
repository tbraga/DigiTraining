<?php

function elbrus_customize_blog_tab($wp_customize, $theme_name) {

	$wp_customize->add_section( 'elbrus_blog_settings' , array(
		'title'      => esc_html__( 'Blog', 'elbrus' ),
		'priority'   => 12,
	) );


	$wp_customize->add_setting( 'elbrus_blog_settings_sidebar_type' , array(
		'default'     => '2',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_sidebar_blog_type'
	) );

	$wp_customize->add_control(
		'elbrus_blog_settings_sidebar_type',
		array(
			'label'    => esc_html__( 'Blog sidebar type', 'elbrus' ),
			'section'  => 'elbrus_blog_settings',
			'settings' => 'elbrus_blog_settings_sidebar_type',
			'description' => esc_html__( 'Select sidebar type for blog pages (not for static page) - all posts, arhive, category, etc.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'1' => esc_html__( 'Full width', 'elbrus' ),
				'2' => esc_html__( 'Right Sidebar', 'elbrus' ),
				'3' => esc_html__( 'Left Sidebar', 'elbrus' ),
			),
			'priority' => 5
		)
	);

	$wp_customize->add_setting( 'elbrus_blog_settings_sidebar_content' , array(
		'default'     => 'sidebar-1',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_sidebar_blog_content'
	) );

	$wp_customize->add_control(
		'elbrus_blog_settings_sidebar_content',
		array(
			'label'    => esc_html__( 'Blog sidebar content', 'elbrus' ),
			'section'  => 'elbrus_blog_settings',
			'settings' => 'elbrus_blog_settings_sidebar_content',
			'description' => esc_html__( 'Select sidebar content for blog pages (not for static page) - all posts, arhive, category, etc.', 'elbrus' ),
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

	$wp_customize->add_setting( 'elbrus_blog_settings_readmore' , array(
		'default'     => esc_html__('Read more', 'elbrus' ),
		'transport'   => 'refresh',
		'sanitize_callback'=>'elbrus_sanitize_text',
	) );

	$wp_customize->add_control(
		'elbrus_blog_settings_readmore',
		array(
			'label'    => esc_html__( 'Read More button text', 'elbrus' ),
			'section'  => 'elbrus_blog_settings',
			'settings' => 'elbrus_blog_settings_readmore',
			'type'     => 'textfield',
			'priority' => 20
		)
	);

	$wp_customize->add_setting( 'elbrus_blog_show_share' , array(
		'default'     => 'on',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_onoff'
	) );

	$wp_customize->add_control(
		'elbrus_blog_show_share',
		array(
			'label'    => esc_html__( 'Show share buttons', 'elbrus' ),
			'section'  => 'elbrus_blog_settings',
			'settings' => 'elbrus_blog_show_share',
			'description' => esc_html__( 'Show share buttons on single post.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'on'  => esc_html__( 'On', 'elbrus' ),
				'off'  => esc_html__( 'Off', 'elbrus' ),
			),
			'priority'   => 30
		)
	);

	$wp_customize->add_setting( 'elbrus_blog_show_date' , array(
		'default'     => 'on',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_onoff'
	) );

	$wp_customize->add_control(
		'elbrus_blog_show_date',
		array(
			'label'    => esc_html__( 'Show date', 'elbrus' ),
			'section'  => 'elbrus_blog_settings',
			'settings' => 'elbrus_blog_show_date',
			'description' => esc_html__( 'Show date posts on/off.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'on'  => esc_html__( 'On', 'elbrus' ),
				'off'  => esc_html__( 'Off', 'elbrus' ),
			),
			'priority'   => 40
		)
	);

	$wp_customize->add_setting( 'elbrus_blog_show_author' , array(
		'default'     => 'on',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_onoff'
	) );

	$wp_customize->add_control(
		'elbrus_blog_show_author',
		array(
			'label'    => esc_html__( 'Show author', 'elbrus' ),
			'section'  => 'elbrus_blog_settings',
			'settings' => 'elbrus_blog_show_author',
			'description' => esc_html__( 'Show author posts on/off.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'on'  => esc_html__( 'On', 'elbrus' ),
				'off'  => esc_html__( 'Off', 'elbrus' ),
			),
			'priority'   => 50
		)
	);

	$wp_customize->add_setting( 'elbrus_blog_show_tags' , array(
		'default'     => 'on',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_onoff'
	) );

	$wp_customize->add_control(
		'elbrus_blog_show_tags',
		array(
			'label'    => esc_html__( 'Show Tags', 'elbrus' ),
			'section'  => 'elbrus_blog_settings',
			'settings' => 'elbrus_blog_show_tags',
			'description' => esc_html__( 'Show Tags list on/off.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => array(
				'on'  => esc_html__( 'On', 'elbrus' ),
				'off'  => esc_html__( 'Off', 'elbrus' ),
			),
			'priority'   => 50
		)
	);

}