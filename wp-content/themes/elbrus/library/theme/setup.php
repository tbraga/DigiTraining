<?php

if ( ! function_exists( 'elbrus_setup' ) ) :

function elbrus_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( 'css/editor-style.css' );

	// removes detailed login error information for security
	add_filter( 'login_errors', create_function('$a', "return null;") );

	//Loading theme textdomain
	load_theme_textdomain( 'elbrus', get_template_directory() . '/languages' );

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );

		// Define various thumbnail sizes
		$width = ( ( elbrus_get_option( 'portfolio_settings_trumb_width', '555' ) ) &&
					 is_numeric( elbrus_get_option( 'portfolio_settings_trumb_width', '555' ) ) &&
					 elbrus_get_option( 'portfolio_settings_trumb_width', '555' ) > 0
				 ) ? elbrus_get_option( 'portfolio_settings_trumb_width', '555' ) : 555;
		$height = ( ( elbrus_get_option( 'portfolio_settings_trumb_height', '555' ) ) &&
					 is_numeric( elbrus_get_option( 'portfolio_settings_trumb_height', '555' ) ) &&
					 elbrus_get_option( 'portfolio_settings_trumb_height', '555' ) > 0
				 ) ? elbrus_get_option( 'portfolio_settings_trumb_height', '555' ) : 555;
		add_image_size('elbrus-portfolio-thumb', $width, $height, true);
		add_image_size('elbrus-post-thumb-large', 1170, 560, true); // for blog full widht
		add_image_size('elbrus-post-thumb-middle', 770, 370, true); // for blog with sidebar
		add_image_size('elbrus-post-thumb-home', 555, 400, true); // for blog block on home page
		add_image_size('elbrus-post-thumb-small', 250, 155, true); // for blog widget
		add_image_size('elbrus-preview-thumb', 100, 100, true); // for share
		add_image_size('elbrus-review-thumb', 300, 300, true); //for home testimonials img

		update_option( 'elbrus_default_main_color', '#288cf0' );
		update_option( 'elbrus_default_additional_color', '#288cf0' );
	}

	// support title-tag for Wordpress 4.1+
	add_theme_support( 'title-tag' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// custom menu support
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus( array ('primary_menu' => esc_html__( 'Primary Menu', 'elbrus' ) ) );
	}

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'gallery', 'quote', 'video', 'link', 'audio' ) );

	if ( ! isset( $content_width ) ) {
		$content_width = 1200;
	}

	// ADD SUPPORT FOR WORDPRESS MENU ************/
	add_theme_support('menus');

	$args = array(
		'flex-width' => true,
		'width' => 350,
		'flex-height' => true,
		'height' => 'auto',
		'default-image' => get_template_directory_uri() . '/images/logo.jpg'
	);

	add_theme_support('custom-header', $args);


	$args = array(
		'default-color' => 'FFFFFF'
	);

	add_theme_support('custom-background', $args);

	// WooCommerce support
	add_theme_support( 'woocommerce' );

}
endif;// elbrus_setup
add_action( 'after_setup_theme', 'elbrus_setup' );


add_filter('nav_menu_css_class' , 'elbrus_special_nav_class' , 10 , 2);
function elbrus_special_nav_class($classes, $item){
	 if( in_array( 'current-menu-item', $classes ) ){
			 $classes[] = 'active ';
	 }
	 return $classes;
}

function elbrus_import_files() {
    return array(
		array(
            'import_file_name'           => esc_html__( 'Elbrus', 'elbrus' ),
            'local_import_file'            => esc_url( get_template_directory() . '/library/demo-files/content.xml' ),
            'local_import_widget_file'     => '',
            'local_import_customizer_file' => '',
            'import_preview_image_url'   => '',
            'import_notice'              => '',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'elbrus_import_files' );