<?php
global $post;
/**
 * Shortcode attributes
 * @var $atts
 * @var $form_id
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Block_Mailchimp
 */
$form_id = $css_animation = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
$out = '';

$out = '<div class="'. esc_attr($css_animation_class) . '">';
$out .= do_shortcode('[mc4wp_form id="'.esc_attr($form_id).'"]');
$out .= '</div>';

echo $out;