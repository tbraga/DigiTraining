<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $id
 * @var $number
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Flickr
 */

$title = $id = $number = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
$flickr_id = $id != '' ? $id : '37304598@N02';
$flickr_limit = $number != '' ? $number : '6';

$out .= '
	<div class="elbrus_flickr '. esc_attr($css_animation_class) . ' clearfix">
';

if 	( $title != '' ) :

$out .= '
		<h5>'.wp_kses_post($title).'</h5>
';

endif;

$out .= '
		<ul class="basicuse flickr-feed" data-limit="'.esc_attr($flickr_limit).'" data-id="'.esc_attr($flickr_id).'">
		</ul>
	</div>
';

echo $out;