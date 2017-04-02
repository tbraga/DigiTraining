<?php

function elbrus_customize_css_animation_tab($wp_customize, $theme_name) {

	$wp_customize->add_section( 'elbrus_css_animation_settings' , array(
		'title'      => esc_html__( 'Css Animation', 'elbrus' ),
		'priority'   => 16,
	) );

	$elbrus_customize_css_animation =  array(
		'' => esc_html__( 'No', 'elbrus' ),
		'bounce' => esc_html__( 'bounce', 'elbrus' ),
		'flash' => esc_html__( 'flash', 'elbrus' ),
		'pulse' => esc_html__( 'pulse', 'elbrus' ),
		'rubberBand' => esc_html__( 'rubberBand', 'elbrus' ),
		'shake' => esc_html__( 'shake', 'elbrus' ),
		'swing' => esc_html__( 'swing', 'elbrus' ),
		'tada' => esc_html__( 'tada', 'elbrus' ),
		'wobble' => esc_html__( 'wobble', 'elbrus' ),
		'jello' => esc_html__( 'jello', 'elbrus' ),

		'bounceIn' => esc_html__( 'bounceIn', 'elbrus' ),
		'bounceInDown' => esc_html__( 'bounceInDown', 'elbrus' ),
		'bounceInLeft' => esc_html__( 'bounceInLeft', 'elbrus' ),
		'bounceInRight' => esc_html__( 'bounceInRight', 'elbrus' ),
		'bounceInUp' => esc_html__( 'bounceInUp', 'elbrus' ),
		'bounceOut' => esc_html__( 'bounceOut', 'elbrus' ),
		'bounceOutDown' => esc_html__( 'bounceOutDown', 'elbrus' ),
		'bounceOutLeft' => esc_html__( 'bounceOutLeft', 'elbrus' ),
		'bounceOutRight' => esc_html__( 'bounceOutRight', 'elbrus' ),
		'bounceOutUp' => esc_html__( 'bounceOutUp', 'elbrus' ),

		'fadeIn' => esc_html__( 'fadeIn', 'elbrus' ),
		'fadeInDown' => esc_html__( 'fadeInDown', 'elbrus' ),
		'fadeInDownBig' => esc_html__( 'fadeInDownBig', 'elbrus' ),
		'fadeInLeft' => esc_html__( 'fadeInLeft', 'elbrus' ),
		'fadeInLeftBig' => esc_html__( 'fadeInLeftBig', 'elbrus' ),
		'fadeInRight' => esc_html__( 'fadeInRight', 'elbrus' ),
		'fadeInRightBig' => esc_html__( 'fadeInRightBig', 'elbrus' ),
		'fadeInUp' => esc_html__( 'fadeInUp', 'elbrus' ),
		'fadeInUpBig' => esc_html__( 'fadeInUpBig', 'elbrus' ),
		'fadeOut' => esc_html__( 'fadeOut', 'elbrus' ),
		'fadeOutDown' => esc_html__( 'fadeOutDown', 'elbrus' ),
		'fadeOutDownBig' => esc_html__( 'fadeOutDownBig', 'elbrus' ),
		'fadeOutLeft' => esc_html__( 'fadeOutLeft', 'elbrus' ),
		'fadeOutLeftBig' => esc_html__( 'fadeOutLeftBig', 'elbrus' ),
		'fadeOutRight' => esc_html__( 'fadeOutRight', 'elbrus' ),
		'fadeOutRightBig' => esc_html__( 'fadeOutRightBig', 'elbrus' ),
		'fadeOutUp' => esc_html__( 'fadeOutUp', 'elbrus' ),
		'fadeOutUpBig' => esc_html__( 'fadeOutUpBig', 'elbrus' ),

		'flip' => esc_html__( 'flip', 'elbrus' ),
		'flipInX' => esc_html__( 'flipInX', 'elbrus' ),
		'flipInY' => esc_html__( 'flipInY', 'elbrus' ),
		'flipOutX' => esc_html__( 'flipOutX', 'elbrus' ),
		'flipOutY' => esc_html__( 'flipOutY', 'elbrus' ),

		'lightSpeedIn' => esc_html__( 'lightSpeedIn', 'elbrus' ),
		'lightSpeedOut' => esc_html__( 'lightSpeedOut', 'elbrus' ),

		'rotateIn' => esc_html__( 'rotateIn', 'elbrus' ),
		'rotateInDownLeft' => esc_html__( 'rotateInDownLeft', 'elbrus' ),
		'rotateInDownRight'=> esc_html__( 'rotateInDownRight', 'elbrus' ),
		'rotateInUpLeft' => esc_html__( 'rotateInUpLeft', 'elbrus' ),
		'rotateInUpRight'=> esc_html__( 'rotateInUpRight', 'elbrus' ),
		'rotateOut' => esc_html__( 'rotateOut', 'elbrus' ),
		'rotateOutDownLeft' => esc_html__( 'rotateOutDownLeft', 'elbrus' ),
		'rotateOutDownRight' => esc_html__( 'rotateOutDownRight', 'elbrus' ),
		'rotateOutUpLeft' => esc_html__( 'rotateOutUpLeft', 'elbrus' ),
		'rotateOutUpRight' => esc_html__( 'rotateOutUpRight', 'elbrus' ),

		'slideInUp' => esc_html__( 'slideInUp', 'elbrus' ),
		'slideInDown' => esc_html__( 'slideInDown', 'elbrus' ),
		'slideInLeft' => esc_html__( 'slideInLeft', 'elbrus' ),
		'slideInRight' => esc_html__( 'slideInRight', 'elbrus' ),
		'slideOutUp' => esc_html__( 'slideOutUp', 'elbrus' ),
		'slideOutDown' => esc_html__( 'slideOutDown', 'elbrus' ),
		'slideOutLeft' => esc_html__( 'slideOutLeft', 'elbrus' ),
		'slideOutRight' => esc_html__( 'slideOutRight', 'elbrus' ),

		'zoomIn' => esc_html__( 'zoomIn', 'elbrus' ),
		'zoomInDown' => esc_html__( 'zoomInDown', 'elbrus' ),
		'zoomInLeft' => esc_html__( 'zoomInLeft', 'elbrus' ),
		'zoomInRight' => esc_html__( 'zoomInRight', 'elbrus' ),
		'zoomInUp' => esc_html__( 'zoomInUp', 'elbrus' ),
		'zoomOut' => esc_html__( 'zoomOut', 'elbrus' ),
		'zoomOutDown' => esc_html__( 'zoomOutDown', 'elbrus' ),
		'zoomOutLeft' => esc_html__( 'zoomOutLeft', 'elbrus' ),
		'zoomOutRight' => esc_html__( 'zoomOutRight', 'elbrus' ),
		'zoomOutUp' => esc_html__( 'zoomOutUp', 'elbrus' ),

		'hinge' => esc_html__( 'hinge', 'elbrus' ),
		'rollIn' => esc_html__( 'rollIn', 'elbrus' ),
		'rollOut' => esc_html__( 'rollOut', 'elbrus' ),
	);

	$wp_customize->add_setting( 'elbrus_css_animation_settings_header_title' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_animation'
	) );

	$wp_customize->add_control(
		'elbrus_css_animation_settings_header_title',
		array(
			'label'    => esc_html__( 'Header Title Animation', 'elbrus' ),
			'section'  => 'elbrus_css_animation_settings',
			'settings' => 'elbrus_css_animation_settings_header_title',
			'description' => esc_html__( 'Select css animation for Header Title Block.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => $elbrus_customize_css_animation,
			'priority' => 10
		)
	);

	$wp_customize->add_setting( 'elbrus_css_animation_settings_blog' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_animation'
	) );

	$wp_customize->add_control(
		'elbrus_css_animation_settings_blog',
		array(
			'label'    => esc_html__( 'Blog Animation', 'elbrus' ),
			'section'  => 'elbrus_css_animation_settings',
			'settings' => 'elbrus_css_animation_settings_blog',
			'description' => esc_html__( 'Select css animation for blog pages.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => $elbrus_customize_css_animation,
			'priority' => 20
		)
	);

	$wp_customize->add_setting( 'elbrus_css_animation_settings_sidebar' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_animation'
	) );

	$wp_customize->add_control(
		'elbrus_css_animation_settings_sidebar',
		array(
			'label'    => esc_html__( 'Sidebar Animation', 'elbrus' ),
			'section'  => 'elbrus_css_animation_settings',
			'settings' => 'elbrus_css_animation_settings_sidebar',
			'description' => esc_html__( 'Select css animation for Sidebar.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => $elbrus_customize_css_animation,
			'priority' => 30
		)
	);

	$wp_customize->add_setting( 'elbrus_css_animation_settings_portfolio' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'elbrus_sanitize_animation'
	) );

	$wp_customize->add_control(
		'elbrus_css_animation_settings_portfolio',
		array(
			'label'    => esc_html__( 'Portfolio Category Page Animation', 'elbrus' ),
			'section'  => 'elbrus_css_animation_settings',
			'settings' => 'elbrus_css_animation_settings_portfolio',
			'description' => esc_html__( 'Select css animation for portfolio category pages.', 'elbrus' ),
			'type'     => 'select',
			'choices'  => $elbrus_customize_css_animation,
			'priority' => 70
		)
	);

}