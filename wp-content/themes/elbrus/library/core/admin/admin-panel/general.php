<?php

function elbrus_customize_general_tab($wp_customize, $theme_name) {

	$wp_customize->add_section( 'elbrus_general_settings' , array(
		'title'      => esc_html__( 'General Settings', 'elbrus' ),
		'priority'   => 0,
	) );

	/* logo image */
	$wp_customize->add_setting( 'elbrus_general_settings_logo' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback'=>'esc_url_raw'
	) );

	$wp_customize->add_control(
	   new WP_Customize_Image_Control(
		   $wp_customize,
		   'elbrus_general_settings_logo',
			   array(
				   'label'      => esc_html__( 'Logo image', 'elbrus' ),
				   'section'    => 'elbrus_general_settings',
				   'context'    => 'elbrus_general_settings_logo',
				   'settings'   => 'elbrus_general_settings_logo',
				   'priority'   => 50,
				   'description' => esc_html__( 'Recommended size: 130x34', 'elbrus')
			   )
	   )
   );

	$wp_customize->add_setting( 'elbrus_general_settings_logo_inverse' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback'=>'esc_url_raw'
	) );

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'elbrus_general_settings_logo_inverse',
			array(
				'label'      => esc_html__( 'Logo inverse image', 'elbrus' ),
				'section'    => 'elbrus_general_settings',
				'context'    => 'elbrus_general_settings_logo_inverse',
				'settings'   => 'elbrus_general_settings_logo_inverse',
				'priority'   => 50,
				'description' => esc_html__( 'Recommended size: 130x34', 'elbrus')
			)
		)
	);

	$wp_customize->add_setting( 'elbrus_general_settings_logo_mobile' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback'=>'esc_url_raw'
	) );

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'elbrus_general_settings_logo_mobile',
			array(
				'label'      => esc_html__( 'Logo mobile image', 'elbrus' ),
				'section'    => 'elbrus_general_settings',
				'context'    => 'elbrus_general_settings_logo_mobile',
				'settings'   => 'elbrus_general_settings_logo_mobile',
				'priority'   => 50,
				'description' => esc_html__( 'Recommended size: 34x34', 'elbrus')
			)
		)
	);

	$wp_customize->add_setting( 'elbrus_general_settings_loader' , array(
		'default'     => 'off',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_loader'
	) );

   $wp_customize->add_control(
		'elbrus_general_settings_loader',
		array(
			'label'    => esc_html__( 'Loader', 'elbrus' ),
			'section'  => 'elbrus_general_settings',
			'settings' => 'elbrus_general_settings_loader',
			'type'     => 'select',
			'choices'  => array(
				'off'  => esc_html__( 'Off', 'elbrus' ),
				'usemain' => esc_html__( 'Use on main', 'elbrus' ),
				'useall' => esc_html__( 'Use on all pages', 'elbrus' )
			),
			'priority'   => 110
		)
	);

   $wp_customize->add_setting( 'elbrus_general_settings_css_live_editor' , array(
		'default'     => 'off',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_onoff'
	) );

   $wp_customize->add_control(
		'elbrus_general_settings_css_live_editor',
		array(
			'label'    => esc_html__( 'On/off Front Editor', 'elbrus' ),
			'section'  => 'elbrus_general_settings',
			'settings' => 'elbrus_general_settings_css_live_editor',
			'type'     => 'select',
			'choices'  => array(
				'off'  => esc_html__( 'Off', 'elbrus' ),
				'on' => esc_html__( 'On', 'elbrus' )
			),
			'priority'   => 120
		)
	);

}