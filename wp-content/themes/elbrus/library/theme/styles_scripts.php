<?php

add_filter('woocommerce_enqueue_styles', 'elbrus_load_woo_styles');
function elbrus_load_woo_styles($styles){
	if (isset($styles['woocommerce-general']) && isset($styles['woocommerce-general']['src'])){
		$styles['woocommerce-general']['src'] = get_template_directory_uri() . '/assets/woocommerce/css/woocommerce.css';
	}
	return $styles;
}

add_action('wp_enqueue_scripts', 'elbrus_load_styles_scripts');
function elbrus_load_styles_scripts(){

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_style('elbrus-fonts', elbrus_fonts_url(), array(), NULL, 'screen, all');
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.4.0', 'screen, all');
	wp_enqueue_style('stroke-gap-icons', get_template_directory_uri() . '/fonts/Stroke-Gap-Icons-Webfont/style.css', array(), NULL, 'screen, all');
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.5', 'screen, all');
	wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/owl-carousel/owl.carousel.css', array(), '1.3.3', 'screen, all');
	wp_enqueue_style('slick-carousel', get_template_directory_uri() . '/assets/slick-carousel/slick.css', array(), '1.5.8', 'screen, all');
	wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.min.css', array(), '3.5.0', 'screen, all');
	wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/assets/prettyphoto/css/prettyPhoto.css', array(), NULL, 'screen, all' );
	wp_enqueue_style('elbrus-main', get_template_directory_uri() . '/css/main.css', array(), NULL, 'screen, all');
	wp_enqueue_style('elbrus-debugging', get_template_directory_uri() . '/debugging.css');
	wp_enqueue_style('elbrus-dynamic-styles', admin_url('admin-ajax.php').'?action=dynamic_styles');


	wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery') , '1.11.4', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') , '3.3.5', true );
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array('jquery') , '4.0.0', true );
	wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.min.js', array('jquery') , '1.1.2', true );
	//wp_enqueue_script( 'smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll.min.js', array('jquery') , '1.0.1', true );
	wp_enqueue_script( 'easypiechart', get_template_directory_uri() . '/js/jquery.easypiechart.min.js', array('jquery') , '2.1.7', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery') , '2.8.3', true );
	wp_enqueue_script( 'jflickrfeed', get_template_directory_uri() . '/js/jflickrfeed.min.js', array('jquery') , NULL, true );
	wp_enqueue_script( 'onscreen', get_template_directory_uri() . '/js/onscreen.min.js', array('jquery') , NULL, true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery') , '2.2.2', true );
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js', array('jquery') , '4.1.0', true );
	wp_enqueue_script( 'DoubleTapToGo', get_template_directory_uri() . '/js/DoubleTapToGo.js', array('jquery') , NULL, true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/owl-carousel/owl.carousel.min.js', array('jquery') , '1.3.3', true );
	wp_enqueue_script( 'slick-carousel', get_template_directory_uri() . '/assets/slick-carousel/slick.min.js', array('jquery') , '1.5.8', true );
	wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/assets/prettyphoto/js/jquery.prettyPhoto.js', array('jquery') , '3.1.6', true );
	wp_enqueue_script( 'elbrus-custom', get_template_directory_uri() . '/js/custom.js', array('jquery') , NULL, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }

}

function elbrus_dynamic_styles() {
	include( get_template_directory().'/css/dynamic-styles.php' );
	exit;
}
add_action('wp_ajax_dynamic_styles', 'elbrus_dynamic_styles');
add_action('wp_ajax_nopriv_dynamic_styles', 'elbrus_dynamic_styles');

//Load Custom Admin Scripts
function elbrus_custom_admin_enqueue_scripts() {

	wp_enqueue_style('elbrus-admin', get_template_directory_uri() . '/css/admin.css', array(), NULL, 'screen, all');

	wp_register_script('elbrus_custom_admin_script', get_template_directory_uri() . '/js/custom-admin.js', false, '1.0.0');
	wp_enqueue_script('elbrus_custom_admin_script');
}
add_action('admin_enqueue_scripts', 'elbrus_custom_admin_enqueue_scripts');

add_filter('body_class','elbrus_browser_body_class');
function elbrus_browser_body_class($classes = '') {
	$classes[] = 'animated-css';
	$classes[] = 'layout-switch';

	if (elbrus_get_option('header_settings_type')){
		$headerType = elbrus_get_option('header_settings_type');
		$classes[] =  'home-construction-v' . $headerType;

	}

	return $classes;
}