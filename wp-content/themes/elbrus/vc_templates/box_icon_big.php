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
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Icon_Big
 */

$type = $icon_pixstrokegap = $icon_pixflaticon = $icon_pixfontawesome =
$icon_pixelegant = $icon_pixicomoon = $icon_pixsimple = $icon_fontawesome =
$icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';

$title = $info = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
$icon = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : '';

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
	$fullicon = ( $icon != '' ) ? '<div class=" vcenter like"><span class="'.esc_attr($icon).'"></span></div>' : '';

$out .= '

	<div class="buy-section '.esc_attr($css_animation_class).'">
		<div class="section-text">
			'.wp_kses_post($fullicon).'
			<div class="buy-text vcenter">
				<div class="top-text">'.wp_kses_post($title).'</div>
				<div class="bottom-text">'.wp_kses_post($info).'</div>
			</div>
		</div>
	</div>

';

echo $out;