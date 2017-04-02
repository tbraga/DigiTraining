<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Team
 */

$css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$out_cont = '';

preg_match_all( '/\[section_team_member([^\]]+)\]/i', $content, $matches, PREG_OFFSET_CAPTURE );
if( isset( $matches[0] ) && !empty( $matches[0] ) ){
	$i=0;
	foreach( $matches[0] as $option ){
		$i++;
		$out_cont .= do_shortcode($option[0]);
	}
}

$out .= '

	<div class="wrap-team-slider '.esc_attr($css_animation).'">
		<div class="prev-btn"><span class="icon invertX icon-Goto"></span></div>
		<div class="next-btn"><span class="icon icon-Goto"></span></div>
		<div class="team-slider enable-stick-slider" data-slick=\'{"slidesToShow": 3, "slidesToScroll": 1, "prevArrow" : ".prev-btn", "nextArrow": ".next-btn" }\'>
			'.$out_cont.'
		</div>
	</div>

';

echo $out;