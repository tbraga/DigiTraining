<?php
add_action( 'init', 'elbrus_integrateWithVC', 200 );

function elbrus_integrateWithVC() {

	if (!function_exists('vc_map'))
		return FALSE;

	$args = array( 'taxonomy' => 'category', 'hide_empty' => '0');
	$categories_blog = get_categories($args);
	$cats_post = array();
	$i = 0;

	foreach($categories_blog as $category){
		if ($category && is_object($category)){
			if($i==0){
				$default = $category->slug;
				$i++;
			}
			$cats_post[$category->name] = $category->term_id;
		}

	}

	$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0');
	$categories_port = get_categories($args);
	$cats_port = array();
	$i = 0;

	foreach($categories_port as $category){
		if ($category && is_object($category)){
			if($i==0){
				$default = $category->slug;
				$i++;
			}
			$cats_port[$category->name] = $category->term_id;
		}

	}

	$args = array( 'post_type' => 'wpcf7_contact_form');
	$forms = get_posts($args);
	$cform7 = array();
	if ( empty( $forms['errors'] ) ) {
		foreach ( $forms as $form ) {
			$cform7[$form->post_title] = $form->ID;
		}
	}

	$args = array( 'post_type' => 'mc4wp-form');
	$newsletter_forms = get_posts($args);
	$mc4wp = array();
	if ( empty( $newsletter_forms['errors'] ) ) {
		foreach ( $newsletter_forms as $form ) {
			$mc4wp[$form->post_title] = $form->ID;
		}
	}

	/** Fonts Icon Loader */

	$vc_icons_data = elbrus_init_vc_icons();

	$add_css_animation = array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'CSS Animation', 'elbrus' ),
		'param_name' => 'css_animation',
		'admin_label' => true,
		'value' => array(
			esc_html__( 'No', 'elbrus' ) => '',
			esc_html__( 'bounce', 'elbrus' ) => 'bounce',
			esc_html__( 'flash', 'elbrus' ) => 'flash',
			esc_html__( 'pulse', 'elbrus' ) => 'pulse',
			esc_html__( 'rubberBand', 'elbrus' ) => 'rubberBand',
			esc_html__( 'shake', 'elbrus' ) => 'shake',
			esc_html__( 'swing', 'elbrus' ) => 'swing',
			esc_html__( 'tada', 'elbrus' ) => 'tada',
			esc_html__( 'wobble', 'elbrus' ) => 'wobble',
			esc_html__( 'jello', 'elbrus' ) => 'jello',

			esc_html__( 'bounceIn', 'elbrus' ) => 'bounceIn',
			esc_html__( 'bounceInDown', 'elbrus' ) => 'bounceInDown',
			esc_html__( 'bounceInLeft', 'elbrus' ) => 'bounceInLeft',
			esc_html__( 'bounceInRight', 'elbrus' ) => 'bounceInRight',
			esc_html__( 'bounceInUp', 'elbrus' ) => 'bounceInUp',
			esc_html__( 'bounceOut', 'elbrus' ) => 'bounceOut',
			esc_html__( 'bounceOutDown', 'elbrus' ) => 'bounceOutDown',
			esc_html__( 'bounceOutLeft', 'elbrus' ) => 'bounceOutLeft',
			esc_html__( 'bounceOutRight', 'elbrus' ) => 'bounceOutRight',
			esc_html__( 'bounceOutUp', 'elbrus' ) => 'bounceOutUp',

			esc_html__( 'fadeIn', 'elbrus' ) => 'fadeIn',
			esc_html__( 'fadeInDown', 'elbrus' ) => 'fadeInDown',
			esc_html__( 'fadeInDownBig', 'elbrus' ) => 'fadeInDownBig',
			esc_html__( 'fadeInLeft', 'elbrus' ) => 'fadeInLeft',
			esc_html__( 'fadeInLeftBig', 'elbrus' ) => 'fadeInLeftBig',
			esc_html__( 'fadeInRight', 'elbrus' ) => 'fadeInRight',
			esc_html__( 'fadeInRightBig', 'elbrus' ) => 'fadeInRightBig',
			esc_html__( 'fadeInUp', 'elbrus' ) => 'fadeInUp',
			esc_html__( 'fadeInUpBig', 'elbrus' ) => 'fadeInUpBig',
			esc_html__( 'fadeOut', 'elbrus' ) => 'fadeOut',
			esc_html__( 'fadeOutDown', 'elbrus' ) => 'fadeOutDown',
			esc_html__( 'fadeOutDownBig', 'elbrus' ) => 'fadeOutDownBig',
			esc_html__( 'fadeOutLeft', 'elbrus' ) => 'fadeOutLeft',
			esc_html__( 'fadeOutLeftBig', 'elbrus' ) => 'fadeOutLeftBig',
			esc_html__( 'fadeOutRight', 'elbrus' ) => 'fadeOutRight',
			esc_html__( 'fadeOutRightBig', 'elbrus' ) => 'fadeOutRightBig',
			esc_html__( 'fadeOutUp', 'elbrus' ) => 'fadeOutUp',
			esc_html__( 'fadeOutUpBig', 'elbrus' ) => 'fadeOutUpBig',

			esc_html__( 'flip', 'elbrus' ) => 'flip',
			esc_html__( 'flipInX', 'elbrus' ) => 'flipInX',
			esc_html__( 'flipInY', 'elbrus' ) => 'flipInY',
			esc_html__( 'flipOutX', 'elbrus' ) => 'flipOutX',
			esc_html__( 'flipOutY', 'elbrus' ) => 'flipOutY',

			esc_html__( 'lightSpeedIn', 'elbrus' ) => 'lightSpeedIn',
			esc_html__( 'lightSpeedOut', 'elbrus' ) => 'lightSpeedOut',

			esc_html__( 'rotateIn', 'elbrus' ) => 'rotateIn',
			esc_html__( 'rotateInDownLeft', 'elbrus' ) => 'rotateInDownLeft',
			esc_html__( 'rotateInDownRight', 'elbrus' ) => 'rotateInDownRight',
			esc_html__( 'rotateInUpLeft', 'elbrus' ) => 'rotateInUpLeft',
			esc_html__( 'rotateInUpRight', 'elbrus' ) => 'rotateInUpRight',
			esc_html__( 'rotateOut', 'elbrus' ) => 'rotateOut',
			esc_html__( 'rotateOutDownLeft', 'elbrus' ) => 'rotateOutDownLeft',
			esc_html__( 'rotateOutDownRight', 'elbrus' ) => 'rotateOutDownRight',
			esc_html__( 'rotateOutUpLeft', 'elbrus' ) => 'rotateOutUpLeft',
			esc_html__( 'rotateOutUpRight', 'elbrus' ) => 'rotateOutUpRight',

			esc_html__( 'slideInUp', 'elbrus' ) => 'slideInUp',
			esc_html__( 'slideInDown', 'elbrus' ) => 'slideInDown',
			esc_html__( 'slideInLeft', 'elbrus' ) => 'slideInLeft',
			esc_html__( 'slideInRight', 'elbrus' ) => 'slideInRight',
			esc_html__( 'slideOutUp', 'elbrus' ) => 'slideOutUp',
			esc_html__( 'slideOutDown', 'elbrus' ) => 'slideOutDown',
			esc_html__( 'slideOutLeft', 'elbrus' ) => 'slideOutLeft',
			esc_html__( 'slideOutRight', 'elbrus' ) => 'slideOutRight',

			esc_html__( 'zoomIn', 'elbrus' ) => 'zoomIn',
			esc_html__( 'zoomInDown', 'elbrus' ) => 'zoomInDown',
			esc_html__( 'zoomInLeft', 'elbrus' ) => 'zoomInLeft',
			esc_html__( 'zoomInRight', 'elbrus' ) => 'zoomInRight',
			esc_html__( 'zoomInUp', 'elbrus' ) => 'zoomInUp',
			esc_html__( 'zoomOut', 'elbrus' ) => 'zoomOut',
			esc_html__( 'zoomOutDown', 'elbrus' ) => 'zoomOutDown',
			esc_html__( 'zoomOutLeft', 'elbrus' ) => 'zoomOutLeft',
			esc_html__( 'zoomOutRight', 'elbrus' ) => 'zoomOutRight',
			esc_html__( 'zoomOutUp', 'elbrus' ) => 'zoomOutUp',

			esc_html__( 'hinge', 'elbrus' ) => 'hinge',
			esc_html__( 'rollIn', 'elbrus' ) => 'rollIn',
			esc_html__( 'rollOut', 'elbrus' ) => 'rollOut',

		),
		'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'elbrus' )
	);


	/** Additional Row Settings */

	$attributes1 = array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Use Section Anchor', 'elbrus' ),
			'param_name' => 'panchor',
			'value' => array(
					esc_html__( 'Use Simple Anchor', 'elbrus' ) => 'anchor-simple',
					esc_html__( 'Use Anchor with background', 'elbrus' ) => 'anchor-effect',
					esc_html__( 'Do not use', 'elbrus' ) => 'anchor-disabled',
			),
			'description' => esc_html__( 'Need Row ID. ', 'elbrus' )
		),
	);

	$attributes2 = array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Padding', 'elbrus' ),
			'param_name' => 'ppadding',
			'value' => array(
				esc_html__( "Default", "elbrus" ) => 'vc_pixrow-no-padding',
				esc_html__( "Both", "elbrus" ) => 'vc_pixrow-padding-both',
				esc_html__( "Top", "elbrus" ) => 'vc_pixrow-padding-top',
				esc_html__( "Bottom", "elbrus" ) => 'vc_pixrow-padding-bottom',
			),
			'description' => esc_html__( 'Top, bottom, both', 'elbrus' ),
			'group' => esc_html__( 'Row Options', 'elbrus' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Overlay', 'elbrus' ),
			'param_name' => 'pixoverlay',
			'value' => array(
				esc_html__( esc_html__( "No", "elbrus" ), "elbrus" ) => '',
				esc_html__( esc_html__( "Yes", "elbrus" ), "elbrus" ) => 'vc_row-overlay dark',

			),
			'description' => esc_html__( 'Yes / No', 'elbrus' ),
			'group' => esc_html__( 'Row Options', 'elbrus' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Overlay Opacity', 'elbrus' ),
			'param_name' => 'pixoverlayopacity',
			'value' => "0.1",
			'description' => esc_html__( 'Values 0.1 - 0.9', 'elbrus' ),
			'group' => esc_html__( 'Row Options', 'elbrus' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Bottom effect', 'elbrus' ),
			'param_name' => 'pix_bottom_effect',
			'value' => array(
				esc_html__( 'Without bottom effect', 'elbrus' ) => '',
				esc_html__( 'With bottom effect', 'elbrus' ) => 'with-bottom-effect',
				esc_html__( 'With transparent bottom effect', 'elbrus' ) => 'with-bottom-effect transparent-effect',
			),
			'group' => esc_html__( 'Row Options', 'elbrus' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Text Color', 'elbrus' ),
			'param_name' => 'ptextcolor',
			'value' => array(
				esc_html__( 'Default', 'elbrus' ) => 'text-default',
				esc_html__( 'White', 'elbrus' ) => 'text-white',
				esc_html__( 'Black', 'elbrus' ) => 'text-black',
			),
			'description' => esc_html__( "Text Color", 'elbrus' ),
			'group' => esc_html__( 'Row Options', 'elbrus' ),
		),
	);
	if ( ! function_exists('fil_init') ) {
		$attributes = array_merge($attributes1, $attributes2);
	} else {
		$attributes = array_merge($attributes1, elbrus_get_vc_icons($vc_icons_data), $attributes2);
	}

	vc_add_params( 'vc_row', $attributes );


	vc_map(
		array(
			'name' => esc_html__( 'Title Box with decor', 'elbrus' ),
			'base' => 'box_title',
			'class' => 'pix-theme-icon2',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Before Title', 'elbrus' ),
					'param_name' => 'before_title',
					'description' => esc_html__( 'Before Title text.', 'elbrus' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title', 'elbrus' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Title param.', 'elbrus' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'After Title', 'elbrus' ),
					'param_name' => 'after_title',
					'description' => esc_html__( 'After Title text.', 'elbrus' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Box Title Position', 'elbrus' ),
					'param_name' => 'titlepos',
					'value' => array(
						esc_html__( 'Center', 'elbrus' ) => 'text-center',
						esc_html__( 'Left', 'elbrus' ) => 'text-left',
						esc_html__( 'Right', 'elbrus' ) => 'text-right',
					),
					'description' => esc_html__( 'Center, left or right', 'elbrus' ),
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Content', 'elbrus' ),
					'param_name' => 'content',
					'description' => esc_html__( 'Enter your content.', 'elbrus' )
				),
				$add_css_animation
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Title extends WPBakeryShortCode {

		}
	}

	vc_map(
		array(
			'name' => esc_html__( 'Title Box underline', 'elbrus' ),
			'base' => 'box_title2',
			'class' => 'pix-theme-icon2',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title', 'elbrus' ),
					'param_name' => 'title',
					'value' => esc_html__( 'I am Title', 'elbrus' ),
					'description' => esc_html__( 'Title param.', 'elbrus' )
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Content', 'elbrus' ),
					'param_name' => 'content',
					'value' => '',
					'description' => esc_html__( 'Enter your content.', 'elbrus' )
				),
				$add_css_animation,
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Title2 extends WPBakeryShortCode {

		}
	}


	elbrus_vc_map(
		array(
			'name' => esc_html__( 'Feature Box (top icon)', 'elbrus' ),
			'base' => 'box_feature',
			'class' => 'pix-theme-icon3',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title', 'elbrus' ),
					'param_name' => 'title',
					'value' => esc_html__( 'I am Title', 'elbrus' ),
					'description' => esc_html__( 'Title param.', 'elbrus' )
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Content', 'elbrus' ),
					'param_name' => 'content',
					'value' => wp_kses_post( __( '<p>I am test text block. Click edit button to change this text.</p>', 'elbrus' ) ),
					'description' => esc_html__( 'Enter your content.', 'elbrus' )
				)
			)
		),
		$add_css_animation,
		elbrus_get_vc_icons($vc_icons_data)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Feature extends WPBakeryShortCode {

		}
	}


	elbrus_vc_map(
		array(
			'name' => esc_html__( 'Feature Box (left icon)', 'elbrus' ),
			'base' => 'box_feature_left_icon',
			'class' => 'pix-theme-icon3',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'elbrus' ),
					'param_name' => 'title',
					'value' => esc_html__( 'I am Title', 'elbrus' ),
					'description' => esc_html__( 'Title param.', 'elbrus' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Under Title', 'elbrus' ),
					'param_name' => 'under_title',
					'description' => esc_html__( 'Under Title text', 'elbrus' )
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Content', 'elbrus' ),
					'param_name' => 'content',
					'value' => wp_kses_post( __( '<p>I am test text block. Click edit button to change this text.</p>', 'elbrus' ) ),
					'description' => esc_html__( 'Enter your content.', 'elbrus' )
				)
			)
		),
		$add_css_animation,
		elbrus_get_vc_icons($vc_icons_data)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Feature_Left_Icon extends WPBakeryShortCode {

		}
	}

	elbrus_vc_map(
		array(
			'name' => esc_html__( 'Amount Box', 'elbrus' ),
			'base' => 'box_amount',
			'class' => 'pix-theme-icon',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title', 'elbrus' ),
					'param_name' => 'title',
					'value' => esc_html__( 'Project', 'elbrus' ),
					'description' => esc_html__( 'Title.', 'elbrus' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Amount', 'elbrus' ),
					'param_name' => 'amount',
					'value' => '999',
					'description' => esc_html__( 'Amount.', 'elbrus' )
				),
			)
		),
		$add_css_animation,
		elbrus_get_vc_icons($vc_icons_data)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Amount extends WPBakeryShortCode {

		}
	}


	//////// Carousel Reviews ////////

	vc_map( array(
		'name' => esc_html__( 'Reviews', 'elbrus' ),
		'base' => 'section_reviews',
		'class' => 'pix-theme-icon5',
		'as_parent' => array('only' => 'section_review'),
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Templines', 'elbrus' ),

		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Reviews per page', 'elbrus' ),
				'param_name' => 'reviews_per_page',
				'value' => array(
					"2" => 2,
					"1" => 1,
				),
				'description' => esc_html__( 'Select number of columns.', 'elbrus' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Carousel', 'elbrus' ),
				'param_name' => 'disable_carousel',
				'value' => array(
					esc_html__('Enable', 'elbrus') => 1,
					esc_html__('Disable', 'elbrus') => 0,
				),
				'description' => esc_html__( 'On/off carousel', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Auto Play', 'elbrus' ),
				'param_name' => 'autoplay',
				'value' => '4000',
				'description' => esc_html__( 'Enter autoplay speed in milliseconds. 0 is turn off autoplay.', 'elbrus' ),
			),
			$add_css_animation,
		),


		'js_view' => 'VcColumnView',

	) );


	vc_map( array(
		'name' => esc_html__( 'Review', 'elbrus' ),
		'base' => 'section_review',
		'class' => 'pix-theme-icon5',
		'as_child' => array('only' => 'section_reviews'),
		'content_element' => true,
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'elbrus' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Name', 'elbrus' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Person name.', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Position', 'elbrus' ),
				'param_name' => 'position',
				'description' => esc_html__( 'Text under the name.', 'elbrus' )
			),
			$add_css_animation,
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Review Text', 'elbrus' ),
				"param_name" => "content",
				"value" => wp_kses_post( __( '<p>I am test text block. Click edit button to change this text.</p>', 'elbrus' ) ),
				"description" => esc_html__( 'Enter text.', 'elbrus' )
			),
		)
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Reviews extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Review extends WPBakeryShortCode {
		}
	}

	/////////////////////////////////

	//////// Our Team ////////

	vc_map( array(
		'name' => esc_html__( 'Slider Team Members', 'elbrus' ),
		'base' => 'section_team',
		'class' => 'pix-theme-icon5',
		'as_parent' => array('only' => 'section_team_member'),
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Templines', 'elbrus' ),
		'params' => array(
			$add_css_animation,
		),
		'js_view' => 'VcColumnView',

	) );


	vc_map( array(
		'name' => esc_html__( 'Team Member', 'elbrus' ),
		'base' => 'section_team_member',
		'class' => 'pix-theme-icon',
		'as_child' => array('only' => 'section_team'),
		'content_element' => true,
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'elbrus' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Name', 'elbrus' ),
				'param_name' => 'name',
				'description' => esc_html__( 'Team member name.', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Position', 'elbrus' ),
				'param_name' => 'position',
				'description' => esc_html__( 'Member position.', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 1', 'elbrus' ),
				'param_name' => 'scn1',
				'description' => esc_html__( 'https://twitter.com/', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 1', 'elbrus' ),
				'param_name' => 'scn_icon1',
				'description' => wp_kses_post( __( 'Add icon fa-twitter <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'elbrus' ) )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 2', 'elbrus' ),
				'param_name' => 'scn2',
				'description' => esc_html__( 'https://www.facebook.com/', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 2', 'elbrus' ),
				'param_name' => 'scn_icon2',
				'description' => wp_kses_post( __( 'Add icon fa-facebook <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'elbrus' ) )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 3', 'elbrus' ),
				'param_name' => 'scn3',
				'description' => esc_html__( 'https://www.linkedin.com/', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 3', 'elbrus' ),
				'param_name' => 'scn_icon3',
				'description' => wp_kses_post( __( 'Add icon fa-linkedin <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'elbrus' ) )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 4', 'elbrus' ),
				'param_name' => 'scn4',
				'description' => esc_html__( 'https://www.googleplus.com/', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 4', 'elbrus' ),
				'param_name' => 'scn_icon4',
				'description' => wp_kses_post( __( 'Add icon fa-google-plus <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'elbrus' ) )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'E-mail', 'elbrus' ),
				'param_name' => 'scn5',
				'description' => esc_html__( 'Example: youremail@example.com (Leave empty to hide e-mail)', 'elbrus' )
			),
			$add_css_animation,
		)
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Team extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Team_Member extends WPBakeryShortCode {
		}
	}

	////////////////////////

	// block one teem member

	vc_map( array(
		'name' => esc_html__( 'Team Member box', 'elbrus' ),
		'base' => 'box_team_member',
		'class' => 'pix-theme-icon',
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'elbrus' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Name', 'elbrus' ),
				'param_name' => 'name',
				'description' => esc_html__( 'Team member name.', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Position', 'elbrus' ),
				'param_name' => 'position',
				'description' => esc_html__( 'Member position.', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 1', 'elbrus' ),
				'param_name' => 'scn1',
				'description' => esc_html__( 'https://twitter.com/', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 1', 'elbrus' ),
				'param_name' => 'scn_icon1',
				'description' => wp_kses_post( __( 'Add icon fa-twitter <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'elbrus' ) )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 2', 'elbrus' ),
				'param_name' => 'scn2',
				'description' => esc_html__( 'https://www.facebook.com/', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 2', 'elbrus' ),
				'param_name' => 'scn_icon2',
				'description' => wp_kses_post( __( 'Add icon fa-facebook <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'elbrus' ) )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 3', 'elbrus' ),
				'param_name' => 'scn3',
				'description' => esc_html__( 'https://www.linkedin.com/', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 3', 'elbrus' ),
				'param_name' => 'scn_icon3',
				'description' => wp_kses_post( __( 'Add icon fa-linkedin <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'elbrus' ) )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 4', 'elbrus' ),
				'param_name' => 'scn4',
				'description' => esc_html__( 'https://www.googleplus.com/', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 4', 'elbrus' ),
				'param_name' => 'scn_icon4',
				'description' => wp_kses_post( __( 'Add icon fa-google-plus <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'elbrus' ) )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'E-mail', 'elbrus' ),
				'param_name' => 'scn5',
				'description' => esc_html__( 'Example: youremail@example.com (Leave empty to hide e-mail)', 'elbrus' )
			),
			$add_css_animation,
		)
	) );

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Team_Member extends WPBakeryShortCode {
		}
	}


	vc_map(
		array(
			"name" => esc_html__( 'Posts Block', 'elbrus' ),
			"base" => 'block_posts',
			"class" => 'pix-theme-icon4',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			"params" => array(
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Category', 'elbrus' ),
					'param_name' => 'cat_post',
					'value' => $cats_post,
					'description' => esc_html__( 'Select category to show their post.', 'elbrus' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Columns Number', 'elbrus' ),
					'param_name' => 'columns_number',
					'value' => array(
						esc_html__('Columns 3', 'elbrus') => '3',
						esc_html__('Columns 2', 'elbrus') => '2',
					)
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Posts Count', 'elbrus' ),
					'param_name' => 'posts_count',
					'value' => '3',
					'description' => esc_html__( 'If empty, display all posts.', 'elbrus' ),
				),
				$add_css_animation,
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Block_Posts extends WPBakeryShortCode {

		}
	}

	// block About

	vc_map( array(
		'name' => esc_html__( 'About box', 'elbrus' ),
		'base' => 'box_about',
		'class' => 'pix-theme-icon',
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'elbrus' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Title block.', 'elbrus' )
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'elbrus' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'elbrus' )
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Link', 'elbrus' ),
				'param_name' => 'link',
				'description' => esc_html__( 'Select url.', 'elbrus' )
			),
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Content', 'elbrus' ),
				'param_name' => 'content',
				'value' => wp_kses_post( __( '<p>I am test text block. Click edit button to change this text.</p>', 'elbrus' ) ),
				'description' => esc_html__( 'Enter text.', 'elbrus' )
			),
			$add_css_animation,
		)
	) );

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_About extends WPBakeryShortCode {
		}
	}


	/// twitter

	vc_map(
		array(
			"name" => esc_html__( 'Twitter Box', 'elbrus' ),
			"base" => 'box_twitter',
			 "class" => 'pix-theme-icon6',
			"category" => esc_html__( 'Templines', 'elbrus'),
			'show_settings_on_create' => true,
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'elbrus' ),
					'param_name' => 'title',
					'value' => esc_html__( 'Latest from twitter', 'elbrus' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Username', 'elbrus' ),
					'param_name' => 'username',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Consumer Key', 'elbrus' ),
					'param_name' => 'consumer_key',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Consumer Secret', 'elbrus' ),
					'param_name' => 'consumer_secret',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Access Token', 'elbrus' ),
					'param_name' => 'access_token',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Access Token Secret', 'elbrus' ),
					'param_name' => 'access_token_secret',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Tweets to show', 'elbrus' ),
					'param_name' => 'num_of_tweets',
					'value' => '5',
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel', 'elbrus' ),
					'param_name' => 'disable_carousel',
					'value' => array(
						esc_html__('Enable', 'elbrus') => 1,
						esc_html__('Disable', 'elbrus') => 0,
					),
					'description' => __( 'On/off carousel', 'elbrus' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Auto Play', 'elbrus' ),
					'param_name' => 'autoplay',
					'value' => '4000',
					'description' => esc_html__( 'Enter autoplay speed in milliseconds. 0 is turn off autoplay.', 'elbrus' ),
				),
				$add_css_animation,
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Twitter extends WPBakeryShortCode {
			public function hyperlinks($text) {
				$text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a target=\"_blank\" href=\"$1\" class=\"twitter-link\">$1</a>", $text);
				$text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a target=\"_blank\" href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
				// match name@address
				$text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a target=\"_blank\" href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
					//mach #trendingtopics. Props to Michael Voigt
				$text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a target=\"_blank\" href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
				return $text;
			}
			/**
			 * Find twitter usernames and link to them
			 */
			public function twitter_users($text) {
				   $text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
				   return $text;
			}
		}
	}

	//////////////////////////////////////////////////////////////////////

	//////// Timeline ////////

	vc_map( array(
		'name' => esc_html__( 'Timeline', 'elbrus' ),
		'base' => 'section_timeline',
		'class' => 'pix-theme-icon5',
		'as_parent' => array('only' => 'section_timeline_option'),
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Templines', 'elbrus' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Timeline block per page', 'elbrus' ),
				'param_name' => 'count',
				'value' => '3',
				'description' => esc_html__( 'If empty, display all blocks', 'elbrus' ),
			),
			$add_css_animation,
		),


		'js_view' => 'VcColumnView',

	) );


	vc_map( array(
		'name' => esc_html__( 'Timeline option', 'elbrus' ),
		'base' => 'section_timeline_option',
		'class' => 'pix-theme-icon',
		'as_child' => array('only' => 'section_timeline'),
		'content_element' => true,
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Position On Timeline', 'elbrus' ),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Left', 'elbrus') => 'left',
					esc_html__('Right', 'elbrus') => 'right',
				),
				'description' => esc_html__( 'Left/right position on timeline', 'elbrus' )
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'elbrus' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Date', 'elbrus' ),
				'param_name' => 'date',
				'description' => esc_html__( 'Option date', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'elbrus' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Option title', 'elbrus' )
			),
			$add_css_animation,
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Content', 'elbrus' ),
				"param_name" => "content",
				"value" => wp_kses_post( __( '<p>I am test text block. Click edit button to change this text.</p>', 'elbrus' ) ),
				"description" => esc_html__( 'Enter text.', 'elbrus' )
			),
		)
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Timeline extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Timeline_Option extends WPBakeryShortCode {
		}
	}

	/////////////////////////////////


	/// section_analytics
	vc_map( array(
		'name' => esc_html__( 'Detailed Analytics', 'elbrus' ),
		'base' => 'section_analytics',
		'class' => 'pix-theme-icon5',
		'as_parent' => array('only' => 'section_analytics_option'),
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Templines', 'elbrus'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'elbrus' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'elbrus' )
			),
			$add_css_animation,
		),
		'js_view' => 'VcColumnView',

	) );
	vc_map( array(
		'name' => esc_html__( 'Analytic Option', 'elbrus' ),
		'base' => 'section_analytics_option',
		'class' => 'pix-theme-icon',
		'as_child' => array('only' => 'section_analytics'),
		'content_element' => true,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'elbrus' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Title.', 'elbrus' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Under Title', 'elbrus' ),
				'param_name' => 'under_title',
				'description' => esc_html__( 'Under Title.', 'elbrus' )
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Horizontal Item Position", "elbrus" ),
				"param_name" => "itempos",
				"value" => array(
					esc_html__( "Left", "elbrus" ) => 'left',
					esc_html__( "Right", "elbrus" ) => 'right',
				),
				"description" => esc_html__( "Left or right", "elbrus" ),
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Vertical Item Position", "elbrus" ),
				"param_name" => "itempos_vert",
				"value" => array(
					esc_html__( "Top", "elbrus" ) => 'top',
					esc_html__( "Middle", "elbrus" ) => 'middle',
					esc_html__( "Bottom", "elbrus" ) => 'bottom',
				),
				"description" => esc_html__( "Top, middle or bottom", "elbrus" ),
			),
			$add_css_animation,
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Info", "elbrus" ),
				"param_name" => "content",
				"description" => esc_html__( "Enter information.", "elbrus" )
			),
		)
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Analytics extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Analytics_Option extends WPBakeryShortCode {
		}
	}
	////////////////////////

	elbrus_vc_map(
		array(
			"name" => esc_html__( "Icon Step", "elbrus" ),
			"base" => "box_icon_step",
			"class" => "pix-theme-icon3",
			"category" => esc_html__( "Templines", "elbrus"),
			'params' => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", "elbrus" ),
					"param_name" => "title",
					"value" => esc_html__( "I am title", "elbrus" ),
					"description" => esc_html__( "Add Title ", "elbrus" )
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Step", "elbrus" ),
					"param_name" => "step",
					"value" => '1',
					"description" => esc_html__( "Use step number.", "elbrus" )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Type', 'elbrus' ),
					'param_name' => 'color',
					'value' => array(
						esc_html__( "Black", "elbrus" ) => '',
						esc_html__( "Color", "elbrus" ) => 'invert',
					),
					'description' => '',
				),
			)
		),
		$add_css_animation,
		elbrus_get_vc_icons($vc_icons_data)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Icon_Step extends WPBakeryShortCode {

		}
	}

	///Price
	vc_map( array(
		'name' => esc_html__( 'Price', 'elbrus' ),
		'base' => 'section_prices',
		'class' => 'pix-theme-icon',
		'as_parent' => array('only' => 'section_price'),
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Templines', 'elbrus'),
		'params' => array(
			$add_css_animation,
		),
		'js_view' => 'VcColumnView',

	) );

	vc_map(
		array(
			"name" => esc_html__( 'Price Table', 'elbrus' ),
			"base" => 'section_price',
			"class" => 'pix-theme-icon',
			'as_child' => array('only' => 'section_prices'),
			'content_element' => true,
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Type Price', 'elbrus' ),
					'param_name' => 'type',
					'value' => array(
						esc_html__( 'Simple', 'elbrus' ) => '',
						esc_html__( 'Popular', 'elbrus' ) => 'active',
					),
					'description' => esc_html__( 'Simple or popular', 'elbrus' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Width Table Price', 'elbrus' ),
					'param_name' => 'width_type',
					'value' => array(
						esc_html__( '1/3', 'elbrus' ) => '3',
						esc_html__( '1/4', 'elbrus' ) => '4',
					),
					'description' => esc_html__( '1/3 or 1/4', 'elbrus' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Price Title', 'elbrus' ),
					'param_name' => 'price_title',
					'description' => esc_html__( 'Price title.', 'elbrus' ),
					'value' => esc_html__( 'Basic', 'elbrus' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Amount', 'elbrus' ),
					'param_name' => 'price_amount',
					'value' => esc_html__( '$150', 'elbrus' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Date', 'elbrus' ),
					'param_name' => 'price_date',
					'value' => esc_html__( 'per month', 'elbrus' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Text', 'elbrus' ),
					'param_name' => 'btntext',
					'description' => esc_html__( 'Button text.', 'elbrus' ),
					'value' => esc_html__( 'Sign up now', 'elbrus' ),
				),
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'Link', 'elbrus' ),
					'param_name' => 'btnlink',
					'description' => esc_html__( 'Button link.', 'elbrus' ),
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => esc_html__( 'Content', 'elbrus' ),
					'param_name' => 'content',
					'value' => wp_kses_post( __( '<ul><li>1</li><li>2</li><li class="inactive">3</li></ul>', 'elbrus' ) ),
				),
				$add_css_animation,
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Prices extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Price extends WPBakeryShortCode {
		}
	}


	//////// Social Buttons ////////


	vc_map( array(
		'name' => esc_html__( 'Social Buttons', 'elbrus' ),
		'base' => 'section_socialbuts',
		'class' => 'pix-theme-icon3',
		'as_parent' => array('only' => 'section_socialbut'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Templines', 'elbrus' ),
		'params' => array(
			$add_css_animation,
		),
		'js_view' => 'VcColumnView',

	) );

	vc_map(
		array(
			'name' => esc_html__( 'Color Social Button', 'elbrus' ),
			'base' => 'section_socialbut',
			'class' => 'pix-theme-icon',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			'as_child' => array('only' => 'section_socialbuts'),
			'content_element' => true,
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'elbrus' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Social title.', 'elbrus' )
				),
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'Link', 'elbrus' ),
					'param_name' => 'link',
					'description' => esc_html__( 'Social link.', 'elbrus' )
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_html__( "Background Color", 'elbrus' ),
					"param_name" => "bg_color",
					"value" => "#ff6400",
					"description" => esc_html__( "Select bg color.", 'elbrus' )
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_html__( "Color", 'elbrus' ),
					"param_name" => "color",
					"value" => "#fff",
					"description" => esc_html__( "Select text color.", 'elbrus' )
				),
				$add_css_animation,
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Socialbuts extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Socialbut extends WPBakeryShortCode {

		}
	}


	////////////////////////

	vc_map( array(
		'name' => esc_html__( 'Social Icons', 'elbrus' ),
		'base' => 'section_socicons',
		'class' => 'pix-theme-icon',
		'as_parent' => array('only' => 'section_socicon'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Templines', 'elbrus' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'elbrus' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Social title.', 'elbrus' ),
				'value' => esc_html__( 'We are social 24/7 - Get in touch', 'elbrus' ),
			),
			$add_css_animation,
		),
		'js_view' => 'VcColumnView',

	) );


	elbrus_vc_map(
		array(
			'name' => esc_html__( 'Social Button', 'elbrus' ),
			'base' => 'section_socicon',
			'class' => 'pix-theme-icon',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			'as_child' => array('only' => 'section_socicons'),
			'content_element' => true,
			'params' => array(
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'Link', 'elbrus' ),
					'param_name' => 'link',
					'description' => esc_html__( 'Social link.', 'elbrus' )
				),
			)
		),
		$add_css_animation,
		elbrus_get_vc_icons($vc_icons_data)
	);

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Socicons extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Socicon extends WPBakeryShortCode {

		}
	}


	////////////////////////

	/////////// brands

	vc_map( array(
		'name' => esc_html__( 'Brands', 'elbrus' ),
		'base' => 'section_brands',
		'class' => 'pix-theme-icon',
		'as_parent' => array('only' => 'section_brand'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Templines', 'elbrus' ),
		'params' => array(
			$add_css_animation,
		),
		'js_view' => 'VcColumnView',

	) );

	vc_map(
		array(
			'name' => esc_html__( 'Brand', 'elbrus' ),
			'base' => 'section_brand',
			'class' => 'pix-theme-icon',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			'as_child' => array('only' => 'section_brands'),
			'content_element' => true,
			'params' => array(
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image', 'elbrus' ),
					'param_name' => 'image',
					'description' => esc_html__( 'Select image from media library.', 'elbrus' )
				),
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'Link', 'elbrus' ),
					'param_name' => 'link',
					'value' => esc_html__( 'https://wordpress.com', 'elbrus' ),
					'description' => esc_html__( 'Brand link.', 'elbrus' )
				),
				$add_css_animation,
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Brands extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Brand extends WPBakeryShortCode {

		}
	}

	//////////////////


	vc_map(
		array(
			"name" => esc_html__( "Portfolio", 'elbrus' ),
			"base" => "section_portfolio",
			"class" => "pix-theme-icon",
			'category' => esc_html__( 'Templines', 'elbrus' ),
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Show filter', 'elbrus' ),
					'param_name' => 'template',
					'value' => array(
						esc_html__( "Yes", 'elbrus' ) => 'isotop',
						esc_html__( "No", 'elbrus' ) => 'landing',
					),
					'description' => '',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Categories', 'elbrus' ),
					'param_name' => 'cat_port',
					'value' => $cats_port,
					'description' => esc_html__( 'Select categories to show their portfolio.', 'elbrus' ),
					'dependency' => array(
						'element' => 'template',
						'value' => array('isotop', 'landing'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Columns Number', 'elbrus' ),
					'param_name' => 'perrow',
					'value' => array(
						esc_html__( '2 Columns', 'elbrus' ) => '2',
						esc_html__( '3 Columns', 'elbrus' ) => '3',
						esc_html__( '4 Columns', 'elbrus' ) => '4',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Items Count', 'elbrus' ),
					'param_name' => 'count',
					'description' => esc_html__( 'Select number portfolio works to show per page. Leave empty to show all warks.', 'elbrus' ),
					'dependency' => array(
						'element' => 'template',
						'value' => array('isotop', 'landing'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Item type', 'elbrus' ),
					'param_name' => 'type',
					'value' => array(
						esc_html__( 'Without over icons', 'elbrus' ) => 'type_without_icons',
						esc_html__( 'With over icons', 'elbrus' ) => 'type_with_icons',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Show Load more button', 'elbrus' ),
					'param_name' => 'btnshow',
					'value' => array(
						esc_html__( 'No', 'elbrus' ) => 'no',
						esc_html__( 'Yes', 'elbrus' ) => 'yes',
					),
					'dependency' => array(
						'element' => 'template',
						'value' => array('isotop', 'landing'),
					),
					'description' => esc_html__( 'Show or not button Load more', 'elbrus' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button text', 'elbrus' ),
					'param_name' => 'btntext',
					'value' => esc_html__( 'Load more', 'elbrus' ),
					'dependency' => array(
						'element' => 'btnshow',
						'value' => array('yes'),
					),
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => esc_html__( 'Description', 'elbrus' ),
					'param_name' => 'content',
					'value' => '',
				),
				$add_css_animation,
				array(
					'type' => 'tab_id',
					'heading' => esc_html__( 'ID', 'elbrus' ),
					'param_name' => "tab_id",
				),
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Portfolio extends WPBakeryShortCode {

		}
	}

	vc_map(
		array(
			"name" => esc_html__( "Portfolio Latest Works", 'elbrus' ),
			"base" => "section_portfolio_latest_works",
			"class" => "pix-theme-icon",
			'category' => esc_html__( 'Templines', 'elbrus' ),
			"params" => array(
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Categories', 'elbrus' ),
					'param_name' => 'cat_port',
					'value' => $cats_port,
					'description' => esc_html__( 'Select categories to show their portfolio.', 'elbrus' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Items Count', 'elbrus' ),
					'param_name' => 'count',
					'description' => esc_html__( 'Select number portfolio works to show. Leave empty to show all warks.', 'elbrus' ),
				),
				$add_css_animation,
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Portfolio_Latest_Works extends WPBakeryShortCode {

		}
	}

	vc_map(
		array(
			"name" => esc_html__( 'Contact Form 7', 'elbrus' ),
			"base" => "block_cform7",
			"class" => "pix-theme-icon6",
			'category' => esc_html__( 'Templines', 'elbrus' ),
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Contact Form', 'elbrus' ),
					'param_name' => 'form_id',
					'value' => $cform7,
					'description' => esc_html__( 'Select contact form to show', 'elbrus' )
				),
				$add_css_animation,
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Block_Cform7 extends WPBakeryShortCode {

		}
	}

	////////////////////////

	vc_map(
		array(
			"name" => esc_html__( 'Mailchimp Block', 'elbrus' ),
			"base" => "block_mailchimp",
			"class" => "pix-theme-icon6",
			'category' => esc_html__( 'Templines', 'elbrus' ),
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Mailchimp Form', 'elbrus' ),
					'param_name' => 'form_id',
					'value' => $mc4wp,
					'description' => esc_html__( 'Select Mailchimp Form to show', 'elbrus' )
				),
				$add_css_animation,
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Block_Mailchimp extends WPBakeryShortCode {

		}
	}

	vc_map(
		array(
			"name" => esc_html__( 'Flickr', 'elbrus' ),
			"base" => "flickr",
			"class" => "pix-theme-icon6",
			'category' => esc_html__( 'Templines', 'elbrus' ),
			"params" => array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => esc_html__( "Title", 'elbrus' ),
					"param_name" => "title",
					"value" => esc_html__( 'Latest From Flickr', 'elbrus' ),
					"description" => ''
				),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => esc_html__( "Flickr ID", 'elbrus' ),
					"param_name" => "id",
					"value" => '37304598@N02',
					"description" => esc_html__( "Get your flickr ID from: //idgettr.com/", 'elbrus' )
				 ),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => esc_html__( "Number of photos", 'elbrus' ),
					"param_name" => "number",
					"value" => '6',
					"description" => esc_html__( "Default 6.", 'elbrus' )
				 ),
				 $add_css_animation,
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Flickr extends WPBakeryShortCode {

		}
	}

	/// section_tabs
	vc_map( array(
		'name' => esc_html__( 'Tabs', 'elbrus' ),
		'base' => 'section_tabs',
		'class' => 'pix-theme-icon',
		'as_parent' => array('only' => 'section_tab'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element' => true,
		'category' => esc_html__( 'Templines', 'elbrus'),
		'params' => array(
			$add_css_animation,
		),
		'js_view' => 'VcColumnView', // must be added for all Containers ( or should be extended in js ). VC Dev team
	) );

	elbrus_vc_map(
		array(
			'name' => esc_html__( 'Tab', 'elbrus' ),
			'base' => 'section_tab',
			'class' => 'pix-theme-icon',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			'as_child' => array('only' => 'section_tabs'),
			'content_element' => true,
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'elbrus' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Tab title.', 'elbrus' )
				),
				array(
					'type' => 'tab_id',
					'heading' => esc_html__( 'Tab ID', 'elbrus' ),
					'param_name' => "tab_id",
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Content Image', 'elbrus' ),
					'param_name' => 'image',
					'description' => esc_html__( 'Select image.', 'elbrus' )
				),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => esc_html__( "Content", 'elbrus' ),
					"param_name" => "content",
					"value" => wp_kses_post( __( "<p>I am test text block. Click edit button to change this text.</p>", 'elbrus' ) ),
					"description" => esc_html__( "Enter your content.", 'elbrus' )
				),
			),
			'js_view' => 'VcTabView',
		),
		$add_css_animation,
		elbrus_get_vc_icons($vc_icons_data)
	);

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Tabs extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Tab extends WPBakeryShortCode {
		}
	}
	//////////////////////////////////

	////icon box info

	elbrus_vc_map(
		array(
			"name" => esc_html__( "Info Icon Box", "elbrus" ),
			"base" => "box_icon_info",
			"class" => "pix-theme-icon3",
			"category" => esc_html__( "Templines", "elbrus"),
			'params' => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", "elbrus" ),
					"param_name" => "title",
					"value" => esc_html__( "I am title", "elbrus" ),
					"description" => esc_html__( "Add Title ", "elbrus" )
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Info", "elbrus" ),
					"param_name" => "info",
					"description" => esc_html__( "Add Info", "elbrus" )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Type', 'elbrus' ),
					'param_name' => 'typebox',
					'value' => array(
						esc_html__( 'Simple', 'elbrus' ) => '1',
						esc_html__( 'Underline', 'elbrus' ) => '2',
					),
					'description' => esc_html__( 'Select type icon box', 'elbrus' ),
				),
			)
		),
		$add_css_animation,
		elbrus_get_vc_icons($vc_icons_data)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Icon_Info extends WPBakeryShortCode {

		}
	}


	//// icon big

	elbrus_vc_map(
		array(
			"name" => esc_html__( "Big Icon Box", "elbrus" ),
			"base" => "box_icon_big",
			"class" => "pix-theme-icon3",
			"category" => esc_html__( "Templines", "elbrus"),
			'params' => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", "elbrus" ),
					"param_name" => "title",
					"value" => esc_html__( "I am title", "elbrus" ),
					"description" => esc_html__( "Add Title ", "elbrus" )
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Info", "elbrus" ),
					"param_name" => "info",
					"description" => esc_html__( "Add Info", "elbrus" )
				),
			)
		),
		$add_css_animation,
		elbrus_get_vc_icons($vc_icons_data)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Icon_Big extends WPBakeryShortCode {

		}
	}

	//// buttons

	vc_map(
		array(
			'name' => esc_html__( 'Button', 'elbrus' ),
			'base' => 'box_button',
			'class' => 'pix-theme-icon',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Button text', 'elbrus' ),
					'param_name' => 'btntext',
					'description' => esc_html__( 'Enter Button text', 'elbrus' )
				),
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'Link', 'elbrus' ),
					'param_name' => 'btnlink',
					'description' => esc_html__( 'Button link.', 'elbrus' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Type', 'elbrus' ),
					'param_name' => 'btntype',
					'value' => array(
						esc_html__( 'Default (bg white)', 'elbrus' ) => 'btn-default',
						esc_html__( 'Info (bg transparent)', 'elbrus' ) => 'btn-info',
						esc_html__( 'Primary (bg main color)', 'elbrus' ) => 'btn-primary',
						esc_html__( 'Warning (bg white color - hover main color)', 'elbrus' ) => 'btn-primary-warning',
					),
					'description' => esc_html__( 'Select button type', 'elbrus' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Type', 'elbrus' ),
					'param_name' => 'btnstyle',
					'value' => array(
						esc_html__( 'Inline', 'elbrus' ) => 'inline',
						esc_html__( 'Center', 'elbrus' ) => 'text-center',
						esc_html__( 'Left', 'elbrus' ) => 'text-left',
						esc_html__( 'Right', 'elbrus' ) => 'text-right',
					),
					'description' => esc_html__( 'Select button type', 'elbrus' ),
				),
				$add_css_animation
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Button extends WPBakeryShortCode {

		}
	}


	///// video

	vc_map(
		array(
			'name' => esc_html__( 'Video', 'elbrus' ),
			'base' => 'box_video',
			'class' => 'pix-theme-icon',
			'category' => esc_html__( 'Templines', 'elbrus' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'elbrus' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Title.', 'elbrus' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Under Title', 'elbrus' ),
					'param_name' => 'undertitle',
					'description' => esc_html__( 'Under Title.', 'elbrus' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'YouTube link', 'elbrus' ),
					'param_name' => 'url',
					'value' => 'https://youtu.be/R8OOWcsFj0U',
					'description' => esc_html__( 'Use YouTube link.', 'elbrus' )
				),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => esc_html__( "Content", "elbrus" ),
					"param_name" => "content",
				),
				$add_css_animation,
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Box_Video extends WPBakeryShortCode {

		}
	}


	vc_map(
		array(
			"name" => esc_html__( "Google Map", 'elbrus' ),
			"base" => "section_map",
			"class" => "pix-theme-icon6",
			"category" => esc_html__( 'Templines', 'elbrus'),
			"params" => array(
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Marker Image', 'elbrus' ),
					'param_name' => 'image',
					'value' => '',
					'description' => esc_html__( 'Select image from media library.', 'elbrus' )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"heading" => esc_html__( "Address", 'elbrus' ),
					"param_name" => "address",
					"value" => '',
					"description" => esc_html__( "Example: San Diego, CA", 'elbrus' )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"heading" => esc_html__( "Map Width", 'elbrus' ),
					"param_name" => "width",
					"value" => '',
					"description" => esc_html__( "Default 100%", 'elbrus' )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"heading" => esc_html__( "Map Height", 'elbrus' ),
					"param_name" => "height",
					"value" => '',
					"description" => esc_html__( "Default 300px", 'elbrus' )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"heading" => esc_html__( "Zoom", 'elbrus' ),
					"param_name" => "zoom",
					"value" => '',
					"description" => esc_html__( "Zoom 0-20. Default 12.", 'elbrus' )
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Scroll Wheel", 'elbrus' ),
					"param_name" => "scrollwheel",
					'value' => array(
						esc_html__( "Off", 'elbrus' ) => 'false',
						esc_html__( "On", 'elbrus' ) => 'true',
					),
					"description" => esc_html__( "Zoom map with scroll", 'elbrus' )
				),
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Map extends WPBakeryShortCode {
		}
	}



}