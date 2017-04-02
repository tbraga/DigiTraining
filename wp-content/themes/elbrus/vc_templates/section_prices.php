<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Prices
 */

$css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$section_cont = explode( '[/section_price]', $content );
array_pop($section_cont);
if( is_array( $section_cont ) && !empty( $section_cont ) ){
	$out_cont = '';
	foreach( $section_cont as $option ){
		$out_cont .= do_shortcode($option.'[/section_price]');
	}
}

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$out .= '

		<div class="price-section '.esc_attr($css_animation_class).'">
			<div class="row no-gutter plans-list text-center">
				'.$out_cont.'
			</div>
		</div>

	';

echo $out;