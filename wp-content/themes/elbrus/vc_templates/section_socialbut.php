<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $link
 * @var $bg_color
 * @var $color
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Socialbut
 */
$title = $link = $bg_color = $color = $css_animation = '';
$attributes = array();
$a_href = $a_title = $a_target = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

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

$text_color = ( $color != '' ) ? $color  : '#fff';

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

if ( $use_link ) :
	$out .= '

			<div class="col-md-2 col-sm-4 '. esc_attr($css_animation_class) . '">
				<a ' . $attributes . ' class="social-item" style="background-color: '.esc_attr($bg_color).'; color: '.esc_attr($text_color).';">'. wp_kses_post($title) .'</a>
			</div>

	';
endif;

echo $out;