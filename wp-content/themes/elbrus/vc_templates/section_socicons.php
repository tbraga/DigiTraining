<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Socicons
 */

$title = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$out_cont = '';

preg_match_all( '/\[section_socicon([^\]]+)\]/i', $content, $matches, PREG_OFFSET_CAPTURE );
if( isset( $matches[0] ) && !empty( $matches[0] ) ){
	$i=0;
	foreach( $matches[0] as $option ){
		$i++;
		$out_cont .= do_shortcode($option[0]);
	}
}

$out .= '
		<div class="social-section '. esc_attr($css_animation_class) . '">
			<div class="tt">'.wp_kses_post($title).'</div>
			<ul class="list-socials">
				'.$out_cont.'
			</ul>
		</div>
	';

echo $out;