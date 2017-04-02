<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $image
 * @var $position
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Review
 */

$title = $image = $position = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$img_id = preg_replace( '/[^\d]/', '', $image );
$img_link = wp_get_attachment_image_src( $img_id, 'elbrus-review-thumb' );
$img_link = $img_link[0];
$image_meta = elbrus_pix_wp_get_attachment($img_id);
$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];
$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$out .= '

	<div class="slide-item ' . esc_attr($css_animation_class) . '">
		<div class="media-left">
			<div class="image-block">
				<img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'" >
			</div>
		</div>
		<div class="media-body">
			<div class="description-block">
				<div class="name">
					'.wp_kses_post($title).'
					<span>'.wp_kses_post($position).'</span>
				</div>
				<div class="review">
					'.do_shortcode($content).'
				</div>
			</div>
		</div>
	</div>

';

echo $out;