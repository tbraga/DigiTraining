<?php
/**
 * The template for registering metabox.
 *
 * @package Elbrus
 * @since 1.0
 */
add_filter( 'rwmb_meta_boxes', 'elbrus_pix_register_meta_boxes' );

function elbrus_pix_register_meta_boxes( $meta_boxes ) {

	$meta_boxes[] = array(

		'id' => 'post_format',
		'title' => esc_html__( 'Post Format Options', 'elbrus' ),
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(

			array(
				'name' => esc_html__('Post Gallery:','elbrus'),
				'id'   => 'post_gallery',
				'type' => 'image_advanced',
				'max_file_uploads' => 25
			),
			array(
				'name'  => esc_html__('Quote Source:', 'elbrus'),
				'id'    => 'post_quote_source',
				'desc'  => '',
				'type'  => 'text',
				'std'   => '',
			),
			array(
				'name'  => esc_html__('Quote Content:', 'elbrus'),
				'id'    => 'post_quote_content',
				'desc'  => '',
				'type'  => 'textarea',
				'std'   => '',
			),
			array(
				'name'  => esc_html__('Video URL', 'elbrus'),
				'id'    => "post_video",
				'type'  => 'oembed',
				'desc' => esc_html__( 'Enter video link eg (https://youtu.be/R8OOWcsFj0U)', 'elbrus' )
			),
			array(
				'name' => esc_html__('Image for background', 'elbrus'),
				'id'   => 'post_link_bg',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),
			array(
				'name'  => esc_html__('Link URL', 'elbrus'),
				'id'    => 'post_link_url',
				'desc'  => '',
				'type'  => 'url',
				'std'   => '',
			),
			array(
				'name'  => esc_html__('Link text', 'elbrus'),
				'id'    => 'post_link_text',
				'desc'  => '',
				'type'  => 'text',
				'std'   => '',
			),
			array(
				'name'  => esc_html__('Audio URL', 'elbrus'),
				'id'    => "post_audio",
				'type'  => 'oembed',
				'desc' => esc_html__( 'Enter audio link eg (https://soundcloud.com/muse/01-new-born)', 'elbrus' )
			),
		)

	);


	$meta_boxes[] = array(

		'id' => 'page_options',
		'title' => esc_html__( 'Page Subtitle', 'elbrus' ),
		'pages' => array( 'portfolio', 'post', 'page'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(

			array(
				'name'    => esc_html__( 'Text', 'elbrus' ),
				'id'      => 'elbrus_page_subtitle',
				'desc'    => '',
				'type'    => 'text',
				'std'     => ''
			)
		)
	);

	$meta_boxes[] = array(
		'id' => 'portfolio_meta',
		'title' => esc_html__( 'Portfolio Meta', 'elbrus' ),
		'pages' => array( 'portfolio' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Created by', 'elbrus' ),
				'id'    => 'portfolio_create',
				'type'  => 'text',
				'desc' => esc_html__( 'Enter author name', 'elbrus' )
			),
			array(
				'name'  => esc_html__( 'Completed on', 'elbrus' ),
				'id'    => 'portfolio_complete',
				'type'  => 'date',
				'js_options' => array('dateFormat' => 'MM d, yy'),
				'desc' => esc_html__( 'Enter date', 'elbrus' )
			),
			array(
				'name'  => esc_html__( 'Skills', 'elbrus' ),
				'id'    => 'portfolio_skills',
				'type'  => 'text',
				'desc' => esc_html__( 'Enter skills', 'elbrus' )
			),
			array(
				'name'  => esc_html__( 'Client', 'elbrus' ),
				'id'    => 'portfolio_client',
				'type'  => 'text',
				'desc' => esc_html__( 'Enter client name', 'elbrus' )
			),
			array(
				'name'  => esc_html__( 'Client link', 'elbrus' ),
				'id'    => 'portfolio_client_link',
				'type'  => 'url',
				'desc' => esc_html__( 'Enter client link eg (http://themeforest.net/)', 'elbrus' )
			),
			array(
				'name'  => esc_html__( 'Project link', 'elbrus' ),
				'id'    => 'portfolio_button_link',
				'type'  => 'url',
				'desc' => esc_html__( 'Enter project link eg (http://themeforest.net/). Leave empty to hide button View project', 'elbrus' )
			),
		)
	);

	$meta_boxes[] = array(
		'id' => 'post_types',
		'title' => esc_html__( 'Portfolio Option', 'elbrus' ),
		'pages' => array( 'portfolio' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'     => esc_html__( 'Post Types', 'elbrus' ),
				'id'       => "post_types_select",
				'type'     => 'select_advanced',
				'desc' => esc_html__( 'Select post types', 'elbrus' ),
				'options'  => array(
					'image' => esc_html__( 'Gallery', 'elbrus' ),
					'video' => esc_html__( 'Video', 'elbrus' )
				)
			),
			array(
				'name' => esc_html__( 'Post Type For Gallery', 'elbrus' ),
				'id'   => 'portfolio_images',
				'type' => 'image_advanced',
				'max_file_uploads' => 25,
				'desc' => esc_html__( 'Upload images for your portfolio post.', 'elbrus' ),
			),
			array(
				'name'  => esc_html__( 'Video', 'elbrus' ),
				'id'    => 'portfolio_video_href',
				'type'  => 'oembed',
				'desc' => esc_html__( 'Enter video link eg (https://youtu.be/R8OOWcsFj0U)', 'elbrus' )
			),
			array(
				'name' => esc_html__( 'Video width', 'elbrus' ),
				'id'   => 'portfolio_video_width',
				'type' => 'slider',
				'desc' => esc_html__('Range video width', 'elbrus'),
				'suffix' => ' ' . esc_html__( 'px', 'elbrus' ),
				'js_options' => array(
					'min'   => 100,
					'max'   => 2000,
					'step'  => 10,
				),
			),
			array(
				'name' => esc_html__( 'Video height', 'elbrus' ),
				'id'   => 'portfolio_video_height',
				'type' => 'slider',
				'desc' => esc_html__('Range video height', 'elbrus'),
				'suffix' => ' ' . esc_html__( 'px', 'elbrus' ),
				'js_options' => array(
					'min'   => 100,
					'max'   => 1000,
					'step'  => 5,
				),
			),
		)
	);


	return $meta_boxes;
}
