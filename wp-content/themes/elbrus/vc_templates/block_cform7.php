<?php
global $post;
/**
 * Shortcode attributes
 * @var $atts
 * @var $form_id
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Block_Cform7
 */
$form_id = $css_animation = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
$out = '';

$out = '<div class="elbrus-wpcf7 '. esc_attr($css_animation_class) . '">';
$out .= do_shortcode('[contact-form-7 id="'.esc_attr($form_id).'"]');
$out .= '</div>';

echo $out;