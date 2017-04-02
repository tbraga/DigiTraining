<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $before_title
 * @var $title
 * @var $after_title
 * @var $titlepos
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Title
 */
$before_title = $title = $after_title = $titlepos = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
$beforetitle = ($before_title == "") ? "" : '<div class="section-abovetitle">'.wp_kses_post($before_title).'</div>';
$maintitle = ( $title == "" ) ? "" : '<div class="section-title">'.wp_kses_post($title).'</div>';
$aftertitle = ($after_title == "") ? "" : '<div class="section-subtitle">'.wp_kses_post($after_title).'</div>';
$fullcontent = ($content == "") ? "" : '<div class="section-content">'.do_shortcode($content).'</div>';


$out .= '
	<div class="section-heading '. esc_attr($css_animation_class) . ' ' . esc_attr($titlepos) . '">
		'.$beforetitle.'
		'.$maintitle.'
		'.$aftertitle.'
		<div class="design-arrow"></div>
		'.$fullcontent.'
	</div>
';

echo $out;