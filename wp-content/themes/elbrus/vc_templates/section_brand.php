<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $image
 * @var $link
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Brand
 */

$image = $link = $css_animation = '';
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

$img_id = preg_replace( '/[^\d]/', '', $image );
$img_link = wp_get_attachment_image_src( $img_id, 'large' );
$img_link = $img_link[0];
$image_meta = elbrus_pix_wp_get_attachment($img_id);
$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$out .= '
		<div class="client-item '. esc_attr($css_animation_class) . '">
';
if ( $use_link ) :
$out .= '
			<a ' . $attributes . '><img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'"></a>
';
else :
	$out .= '
			<img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'">
';
endif;
$out .= '
	</div>
';

echo $out;