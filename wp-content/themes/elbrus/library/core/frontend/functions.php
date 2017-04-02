<?php

	function elbrus_js_vars(){

		$vars = '';

		$_js = apply_filters('elbrus_js_vars',$vars);

		echo esc_js($_js);

	}


	function elbrus_css_vars(){

		$css = '';
		$header_color  = elbrus_get_option('header_all_color');
		$footer_color  = elbrus_get_option('footer_all_color');
		if ($footer_color){

			$css .= '.footer-top { background-color: '.$header_color.' !important}';
			$css .= '.footer-bottom { background-color: '.$header_color.' !important}';
		}


		if ($header_color)
			$css .= '.header-top { background-color: '.$header_color.' !important}';
		$css .= '';

		echo esc_html($css);
	}


	function elbrus_get_theme_header(){
		$headerType = 1;
		global $wp_query;


		$pix_header_type_page = get_post_meta(get_the_ID(), 'pix_page_header_type', true);
		if ($pix_header_type_page && $pix_header_type_page != 'global'){
			$headerType = (int)$pix_header_type_page;
		}else{
			if (elbrus_get_option('header_settings_type')){
				$headerType = elbrus_get_option('header_settings_type');
			}
		}

		$headerFile = get_template_directory() . '/templates/header/types/header' . $headerType . '.php';
		if (file_exists($headerFile))
			include_once( $headerFile );
	}

	function elbrus_load_block($block_name){

		global $woocommerce,$theme_name;

		$blockData = explode('/',$block_name);
		$blockType = (isset($blockData[0]))?$blockData[0]:'';
		$blockName = (isset($blockData[1]))?$blockData[1]:'';


		if (file_exists(get_template_directory() . '/templates/' . $blockType . '/' . $blockName . '.php')){
			include_once(get_template_directory() . '/templates/' . $blockType . '/' . $blockName . '.php');
		}



	}


	function elbrus_woo_get_page_id(){

		global $post;

		if( is_shop() || is_product_category() || is_product_tag() )
			$id = get_option( 'woocommerce_shop_page_id' );
		elseif( is_product() || !empty($post->ID) )
			$id = $post->ID;
		else
			$id = 0;
		return $id;
	}


	function elbrus_checkAvailableJsToPage($types){
		foreach($types as $type){
			if (function_exists('is_product') && is_product() && $type == 'product'){
				return true;
			}
		}
		return false;
	}

	function elbrus_get_staticblock_content($blockId) {

			if ($blockId == 'default'){
				return '';
			}

			$block = get_post($blockId);
			$shortcodes_custom_css = get_post_meta( $blockId, '_wpb_shortcodes_custom_css', true );
			if ( ! empty( $shortcodes_custom_css ) ) {
				echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
				echo esc_html($shortcodes_custom_css);
				echo '</style>';
			}
			echo apply_filters('the_content', $block->post_content);

	}


	function elbrus_get_staticblock_option_array(){

		$args = array(
			'post_type'        => 'staticblocks',
			'post_status'      => 'publish',
		);
		$staticBlocks = array();
		$staticBlocks['default'] = esc_html__('Select block', 'elbrus');
		$args['posts_per_page'] = -1;
		$staticBlocksData = get_posts( $args );
		foreach($staticBlocksData as $_block){
			$staticBlocks[$_block->ID] = $_block->post_title;
		}
		return $staticBlocks;
	}