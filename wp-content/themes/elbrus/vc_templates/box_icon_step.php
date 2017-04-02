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
 * @var $step
 * @var $color
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Amount
 */

$type = $icon_pixstrokegap = $icon_pixflaticon = $icon_pixfontawesome =
$icon_pixelegant = $icon_pixicomoon = $icon_pixsimple = $icon_fontawesome =
$icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';

$title = $step = $color = $css_animation = '';
$out = $arrow = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
$icon = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : '';
$step_number = ( is_numeric($step) && $step > 0 ) ? $step : '1';
$wowdelay = ($step_number - 1)*0.3;

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$out .= '

		<div class="step-item '.esc_attr($color).' '.esc_attr($css_animation_class).'" data-wow-delay="'.esc_attr($wowdelay).'s">
			<div class="item-icon" data-count="' . esc_attr($step_number) . '">
				<span class="' . esc_attr($icon) . '"></span>
			</div>
			<div class="item-text">
				<h5>' . wp_kses_post($title) . '</h5>
			</div>
		</div>

	';

echo $out;