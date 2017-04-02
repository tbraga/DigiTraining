<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $btntext
 * @var $btnlink
 * @var $btntype
 * @var btnstyle
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Button
 */
$btntext = $btnlink = $btntype = $btnstyle = $css_animation = '';
$attributes = array();
$a_href = $a_title = $a_target = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$href = vc_build_link( $btnlink );
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

$btn_type = ( $btntype != '' ) ? $btntype : 'btn-default';
$btn_style = ( $btnstyle != '' ) ? $btnstyle : 'inline';

if ( $use_link ) {
	if ( $btn_style != 'inline' ) {
	$out .= '<div class="'.esc_attr($btn_style).'">';
	}
	$out .= '

		<a ' . $attributes . ' class="elbrus-btn btn '.esc_attr($btn_type).' '.esc_attr($css_animation_class).'">'.wp_kses_post($btntext).'</a>

	';
	if ( $btn_style != 'inline' ) {
	$out .= '</div>';
	}
} else {
	if ( $btn_style != 'inline' ) {
	$out .= '<div class="'.esc_attr($btn_style).'">';
	}
	$out .= '

		<button ' . $attributes . ' class="elbrus-btn btn '.esc_attr($btn_type).' '.esc_attr($css_animation_class).'">'.wp_kses_post($btntext).'</button>

	';
	if ( $btn_style != 'inline' ) {
	$out .= '</div>';
	}
}

echo $out;