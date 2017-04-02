<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $image
 * @var $date
 * @var $title
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Timeline_Option
 */

$title = $type = $image = $date = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$img_id = preg_replace( '/[^\d]/', '', $image );
$img_link = wp_get_attachment_image_src( $img_id, 'full' );
$img_link = $img_link[0];
$image_meta = elbrus_pix_wp_get_attachment($img_id);
$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];
$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

if ( $type == 'right' ) :

$out .= '
	<div class="row right-row ' . esc_attr($css_animation_class) . '">
		<div class="round-ico big"></div>
		<div class="col-md-6 col-sm-6"></div>
		<div class="col-md-6 col-sm-6 time-item" data-wow-duration="2s" >
			<div class="date">'.wp_kses_post($date).'</div>
			<div class="title">'.wp_kses_post($title).'</div>
';
if ( $img_link != '' ) :
	$out .= '
			<div class="time-image">
				<img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'" >
			</div>
	';
endif;
$out .= '
			<div class="time-content">'.do_shortcode($content).'</div>
		</div>
	</div>
';

else :

$out .= '
	<div class="row left-row ' . esc_attr($css_animation_class) . '">
		<div class="round-ico little"></div>
		<div class="col-md-6 col-sm-6 time-item" data-wow-duration="2s" >
			<div class="date">'.wp_kses_post($date).'</div>
			<div class="title">'.wp_kses_post($title).'</div>
';
if ( $img_link != '' ) :
	$out .= '
			<div class="time-image">
				<img src="'.esc_url($img_link).'" alt="'.esc_attr($image_alt).'" >
			</div>
	';
endif;
$out .= '
			<div class="time-content">'.do_shortcode($content).'</div>
		</div>
	</div>
';

endif;

echo $out;