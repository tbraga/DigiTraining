<?php


function elbrus_init_sidebars() {
	if ( function_exists( 'register_sidebar' ) ) {

		$elbrus_sidebar_css_animation = ( elbrus_get_option('css_animation_settings_sidebar', '') != '' ) ? $elbrus_sidebar_css_animation = ' wow '.elbrus_get_option('css_animation_settings_sidebar') : '';

		register_sidebar( array(
			'name' => esc_html__( 'WP Default Sidebar', 'elbrus' ),
			'id'	=> 'sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget sidebar-item %2$s ' . esc_attr($elbrus_sidebar_css_animation) . '">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		));

		register_sidebar( array(
			'name' => esc_html__( 'Blog Sidebar', 'elbrus' ),
			'id' => 'global-sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget sidebar-item %2$s ' . esc_attr($elbrus_sidebar_css_animation) . '">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		));

		register_sidebar( array(
			'name' => esc_html__( 'Portfolio sidebar', 'elbrus' ),
			'id'	=> 'portfolio-sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget sidebar-item %2$s ' . esc_attr($elbrus_sidebar_css_animation) . '">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		));

		register_sidebar(array(
			'name' => esc_html__('Shop sidebar', 'elbrus' ),
			'id'	=> 'shop-sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget sidebar-item %2$s ' . esc_attr($elbrus_sidebar_css_animation) . '">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="widget-title"><span>',
			'after_title' => '</span></h5>',
		));

		register_sidebar(array(
			'name' => esc_html__('Product sidebar', 'elbrus' ),
			'id'	=> 'product-sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget sidebar-item %2$s ' . esc_attr($elbrus_sidebar_css_animation) . '">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="widget-title"><span>',
			'after_title' => '</span></h5>',
		));

		register_sidebar( array(
			'name' => esc_html__( 'Custom Area', 'elbrus' ),
			'id'	=> 'custom-area-1',
			'before_widget' => '<div id="%1$s" class="widget sidebar-item %2$s ' . esc_attr($elbrus_sidebar_css_animation) . '">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		));

	}
}


add_action( 'widgets_init', 'elbrus_init_sidebars' );