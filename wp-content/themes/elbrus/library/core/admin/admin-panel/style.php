<?php

function elbrus_customize_style_tab($wp_customize, $theme_name) {


	$wp_customize->add_section( 'elbrus_style_settings' , array(
		'title'      => esc_html__( 'Style Settings', 'elbrus' ),
		'priority'   => 4,
	) );

	$wp_customize->add_setting(
		'elbrus_style_settings_main_color',
		array(
			'default' => get_option('elbrus_default_main_color'),
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'elbrus_style_settings_main_color',
			array(
				'label' => esc_html__( 'Main Color', 'elbrus' ),
				'section' => 'elbrus_style_settings',
				'settings' => 'elbrus_style_settings_main_color',
				'priority'   => 10
			)
		)
	);

	$wp_customize->add_setting(
		'elbrus_style_settings_additional_color_darker',
		array(
			'default' => get_option('elbrus_default_additional_color'),
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'elbrus_style_settings_additional_color_darker',
			array(
				'label' => esc_html__( 'Additional Color', 'elbrus' ),
				'section' => 'elbrus_style_settings',
				'settings' => 'elbrus_style_settings_additional_color_darker',
				'priority'   => 20
			)
		)
	);


}

