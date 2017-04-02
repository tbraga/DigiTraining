<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Title2
 */

$title = $css_animation = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$fullcontent = ($content == "") ? "" : '<div class="focontent">'.do_shortcode($content).'</div>';
$fulltitle = ($title == "") ? "" : '<h5 class="fobox-title">'.wp_kses_post($title).'</h5>';
$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$out = '';
$out .= '
		<div class="fobox '. esc_attr($css_animation_class) . '">
			'.$fulltitle.$fullcontent.'
		</div>
		';
echo $out;