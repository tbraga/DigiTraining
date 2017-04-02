<?php

function elbrus_customize_footer_tab($wp_customize, $theme_name) {

	$staticBlocks = elbrus_get_staticblock_option_array();

	$wp_customize->add_section( 'elbrus_footer_settings' , array(
		'title'      => esc_html__( 'Footer', 'elbrus' ),
		'priority'   => 6,
	) );

	$wp_customize->add_setting( 'elbrus_footer_block_top' , array(
		'default'     => 'default',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_footer_block'
	) );

	$wp_customize->add_control(
		'elbrus_footer_block_top',
		array(
			'label'    => esc_html__( 'Top Footer Block', 'elbrus' ),
			'section'  => 'elbrus_footer_settings',
			'settings' => 'elbrus_footer_block_top',
			'type'     => 'select',
			'choices'  => $staticBlocks,
			'priority' => 10
		)
	);

	$wp_customize->add_setting( 'elbrus_footer_block' , array(
		'default'     => 'default',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_footer_block'
	) );

	$wp_customize->add_control(
		'elbrus_footer_block',
		array(
			'label'    => esc_html__( 'Bottom Footer Block', 'elbrus' ),
			'section'  => 'elbrus_footer_settings',
			'settings' => 'elbrus_footer_block',
			'type'     => 'select',
			'choices'  => $staticBlocks,
			'priority' => 10
		)
	);

}