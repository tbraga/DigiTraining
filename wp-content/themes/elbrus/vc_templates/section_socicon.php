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
 * @var $link
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Socicon
 */

$type = $icon_pixstrokegap = $icon_pixflaticon = $icon_pixfontawesome =
$icon_pixelegant = $icon_pixicomoon = $icon_pixsimple = $icon_fontawesome =
$icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';

$link = $css_animation = '';
$attributes = array();
$a_href = $a_title = $a_target = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
$icon = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : '';

$href = vc_build_link( $link );
$use_link = false;
if ( strlen( $href['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $href['url'];
	$a_title = $href['title'];
	$a_target = strlen( $href['target'] ) > 0 ? $href['target'] : '_self';
}

if ( $use_link ) {
	$attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
	$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
	$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
}
$attributes = implode( ' ', $attributes );

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

if ( $use_link ) :
	$out .= '

		<li class="'. esc_attr($css_animation_class) . '"><a ' . $attributes . '><i class="'.esc_attr($icon).'"></i></a></li>

	';
endif;

echo $out;