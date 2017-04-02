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
 * @var $amount
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Amount
 */
$type = $icon_pixstrokegap = $icon_pixflaticon = $icon_pixfontawesome =
$icon_pixelegant = $icon_pixicomoon = $icon_pixsimple = $icon_fontawesome =
$icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';

$title = $amount = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
$icon = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : '';

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$out .= '

	<article>
		<div class="achieve-item chart '. esc_attr($css_animation_class) . '" data-percent="'.esc_attr($amount).'">
			<div class="achieve-icon">
				<span class="'.esc_attr($icon).'"></span>
			</div>
			<div class="count percent">'.wp_kses_post($amount).'</div>
			<div class="name">'.wp_kses_post($title).'</div>
		</div>
	</article>

';

echo $out;