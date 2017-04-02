<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $icon_pixstrokegap
 * @var $icon_pixflaticon
 * @var $icon_pixfontawesome
 * @var $icon_pixelegant
 * @var $icon_pixicomoon
 * @var $icon_pixsimple
 * @var $icon_fontawesome
 * @var $icon_openiconic
 * @var $icon_typicons
 * @var $icon_entypo
 * @var $icon_linecons
 * @var $title
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Feature
 */
$type = $icon_pixstrokegap = $icon_pixflaticon = $icon_pixfontawesome =
$icon_pixelegant = $icon_pixicomoon = $icon_pixsimple = $icon_fontawesome =
$icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';

$title = $css_animation = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$out = '';
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
$icon = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : '';

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
$fullcontent = ($content == "") ? "" : '<div class="text">'.do_shortcode($content).'</div>';

$out .= '

	<div class="feature-item braga '. esc_attr($css_animation_class) . '">
		<div class="wrap-feature-icon">
			<div class="feature-icon">
				<span class="'.esc_attr($icon).'"></span>
			</div>
		</div>
		<div class="title">'.wp_kses_post($title).'</div>
		'.$fullcontent.'
	</div>
';

echo $out;