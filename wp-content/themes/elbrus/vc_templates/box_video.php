<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $undertitle
 * @var $duretion
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Video
 */
$title = $undertitle = $duration = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$main_title = ( $title == "" ) ? "" : '<div class="title">'.wp_kses_post($title).'</div>';
$under_title = ($undertitle == "") ? "" : '<div class="subtitle">'.wp_kses_post($undertitle).'</div>';
$fullcontent = ($content == "") ? "" : '<div class="duration">'.do_shortcode($content).'</div>';


$out .= '

		<div class="video-section row">
			<div class="col-md-12 text-center '. esc_attr($css_animation_class) . '">
				'.$main_title.'
				'.$under_title.'
				<a href="'.esc_url($url).'&amp;autoplay=1" rel="prettyPhoto[pp_video]" class="icon icon-Play btn-play"></a>
				'.$fullcontent.'
			</div>
		</div>

';

echo $out;