<?php

function elbrus_customize_header_tab($wp_customize, $theme_name) {

	$wp_customize->add_section( 'elbrus_header_settings' , array(
		'title'      => esc_html__( 'Header', 'elbrus' ),
		'priority'   => 5,
	) );

	/*
	$wp_customize->add_setting( 'elbrus_header_settings_type' , array(
		'default'     => '1',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_header_type'
	) );

	$wp_customize->add_control(
		'elbrus_header_settings_type',
		array(
			'label'    => esc_html__( 'Header Type', 'elbrus' ),
			'section'  => 'elbrus_header_settings',
			'settings' => 'elbrus_header_settings_type',
			'type'     => 'select',
			'choices'  => array(
				'1' => esc_html__( 'Transparent menu', 'elbrus' ),
				'2' => esc_html__( 'White background menu', 'elbrus' ),
			),
			'priority'   => 5
		)
	);
	*/

	$wp_customize->add_setting( 'elbrus_header_settings_headerimage' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback'=>'esc_url_raw'
	) );

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'elbrus_header_settings_headerimage',
			array(
				'label'      => esc_html__( 'Header Image', 'elbrus' ),
				'section'    => 'elbrus_header_settings',
				'context'    => 'elbrus_header_settings_headerimage',
				'settings'   => 'elbrus_header_settings_headerimage',
				'priority'   => 10
			)
		)
	);

	$wp_customize->add_setting( 'elbrus_header_settings_headerimage_overlay' , array(
		'default'     => 'on',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_onoff'
	) );

	$wp_customize->add_control(
		'elbrus_header_settings_headerimage_overlay',
		array(
			'label'    => esc_html__( 'On/off header image overlay', 'elbrus' ),
			'section'  => 'elbrus_header_settings',
			'settings' => 'elbrus_header_settings_headerimage_overlay',
			'type'     => 'select',
			'choices'  => array(
				'on' => esc_html__( 'On', 'elbrus' ),
				'off' => esc_html__( 'Off', 'elbrus' ),
			),
			'priority'   => 20
		)
	);

	$wp_customize->add_setting( 'elbrus_header_settings_headerimage_opacity' , array(
		'default'     => '0.1',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_overlay_opacity'
	) );

	$wp_customize->add_control(
		'elbrus_header_settings_headerimage_opacity',
		array(
			'label'    => esc_html__( 'Select header image overlay opacity', 'elbrus' ),
			'section'  => 'elbrus_header_settings',
			'settings' => 'elbrus_header_settings_headerimage_opacity',
			'type'     => 'select',
			'choices'  => array(
				'0.1' => '0.1',
				'0.2' => '0.2',
				'0.3' => '0.3',
				'0.4' => '0.4',
				'0.5' => '0.5',
				'0.6' => '0.6',
				'0.7' => '0.7',
				'0.8' => '0.8',
				'0.9' => '0.9',
			),
			'priority'   => 30
		)
	);

	$wp_customize->add_setting( 'elbrus_header_settings_subtitle' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_text'
	) );

	$wp_customize->add_control(
		'elbrus_header_settings_subtitle',
		array(
			'label'    => esc_html__( 'Page Subtitle', 'elbrus' ),
			'section'  => 'elbrus_header_settings',
			'settings' => 'elbrus_header_settings_subtitle',
			'type'     => 'text',
			'priority'   => 40
		)
	);

	$wp_customize->add_setting( 'elbrus_header_settings_title_single_post' , array(
		'default'     => esc_html__('Blog details', 'elbrus' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_text'
	) );

	$wp_customize->add_control(
		'elbrus_header_settings_title_single_post',
		array(
			'label'    => esc_html__( 'Title Single Post Page', 'elbrus' ),
			'section'  => 'elbrus_header_settings',
			'settings' => 'elbrus_header_settings_title_single_post',
			'type'     => 'text',
			'priority'   => 50
		)
	);

	$wp_customize->add_setting( 'elbrus_header_settings_title_all_posts' , array(
		'default'     => esc_html__('All posts', 'elbrus' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_text'
	) );

	$wp_customize->add_control(
		'elbrus_header_settings_title_all_posts',
		array(
			'label'    => esc_html__( 'Title All Posts Page', 'elbrus' ),
			'section'  => 'elbrus_header_settings',
			'settings' => 'elbrus_header_settings_title_all_posts',
			'type'     => 'text',
			'priority'   => 60
		)
	);

	$wp_customize->add_setting( 'elbrus_header_settings_title_single_portfolio' , array(
		'default'     => esc_html__('Single work', 'elbrus' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_text'
	) );

	$wp_customize->add_control(
		'elbrus_header_settings_title_single_portfolio',
		array(
			'label'    => esc_html__( 'Title Single Portfolio Page', 'elbrus' ),
			'section'  => 'elbrus_header_settings',
			'settings' => 'elbrus_header_settings_title_single_portfolio',
			'type'     => 'text',
			'priority'   => 70
		)
	);

	$wp_customize->add_setting( 'elbrus_header_settings_title_search_results' , array(
		'default'     => esc_html__('Search results', 'elbrus' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_text'
	) );

	$wp_customize->add_control(
		'elbrus_header_settings_title_search_results',
		array(
			'label'    => esc_html__( 'Title Search Results Page', 'elbrus' ),
			'section'  => 'elbrus_header_settings',
			'settings' => 'elbrus_header_settings_title_search_results',
			'type'     => 'text',
			'priority'   => 80
		)
	);

}