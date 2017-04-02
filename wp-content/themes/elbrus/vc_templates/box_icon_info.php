<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $icon_pixelegant
 * @var $icon_pixstrokegap
 * @var $icon_pixflaticon
 * @var $icon_pixicomoon
 * @var $icon_pixfontawesome
 * @var $icon_pixsimple
 * @var $icon_fontawesome
 * @var $icon_openiconic
 * @var $icon_typicons
 * @var $icon_entypo
 * @var $icon_linecons
 * @var $title
 * @var $info
 * @var $typebox
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Icon_info
 */

$type = $icon_pixstrokegap = $icon_pixflaticon = $icon_pixfontawesome =
$icon_pixelegant = $icon_pixicomoon = $icon_pixsimple = $icon_fontawesome =
$icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';

$title = $info = $typebox = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
$icon = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : '';

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
$fullicon = ( $icon != '' ) ? '<span class="'.esc_attr($icon).'"></span>' : '';
$add_class = ( $typebox == '2' ) ? 'contacts-list' : '';

$out .= '
	<div class="icon-contact-block '.esc_attr($css_animation_class).'">
	    <div class="row '.esc_attr($add_class).'">
	        <div class="col-md-12 clearfix">
	            <div class="type-info pull-left">
	                '.wp_kses_post($fullicon).'
	                '.wp_kses_post($title).'
	            </div>
	            <div class="info pull-right text-right">
	                <p class="no-margin">'.wp_kses_post($info).'</p>
	            </div>
	        </div>
	    </div>
	</div>
';

echo $out;