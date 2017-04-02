<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $reviews_per_page
 * @var $disable_carousel
 * @var $autoplay
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Reviews
 */

$reviews_per_page = $disable_carousel = $autoplay = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$disable_carousel = $disable_carousel == 1 ? 'owl-carousel enable-owl-carousel' : '';
$autoplay = is_numeric($autoplay) && $autoplay > 0 ? $autoplay : 'false';
$owldots = ( $reviews_per_page == '2' ) ? 'review-slider-seconds' : '';

$section_cont = explode( '[/section_review]', $content );
array_pop($section_cont);
if( is_array( $section_cont ) && !empty( $section_cont ) ){
	$out_cont = '';
	foreach( $section_cont as $option ){
		$out_cont .= do_shortcode($option.'[/section_review]');
	}
}

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$out .= '
		<div class="reviews-slider ' . $owldots .  ' ' . esc_attr($disable_carousel).' owl-theme '.esc_attr($css_animation_class).'"  data-auto-play="'.esc_attr($autoplay).'"  data-min600="1" data-min800="1"  data-min1200="'.esc_attr($reviews_per_page).'">
			'.$out_cont.'
		</div>
	';

echo $out;