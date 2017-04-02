<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $image
 * @var $name
 * @var $position
 * @var $scn1
 * @var $scn_icon1
 * @var $scn2
 * @var $scn_icon2
 * @var $scn3
 * @var $scn_icon3
 * @var $scn4
 * @var $scn_icon4
 * @var $scn5
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Team_Member
 */
$image = $name = $position = $scn1 = $scn_icon1 = $scn2 = $scn_icon2 = $scn3 =
$scn_icon3 = $scn4 = $scn_icon4 = $scn5 = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$img_id = preg_replace( '/[^\d]/', '', $image );
$img_link = wp_get_attachment_image_src( $img_id, 'large' );
$img_link = $img_link[0];
$image_meta = elbrus_pix_wp_get_attachment($img_id);
$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];

$final_scn1 = ($scn1 == '') ? '' : '<li><a href="'.esc_url($scn1).'" target="_blank"><i class="fa '.esc_attr($scn_icon1).'"></i></a></li>';
$final_scn2 = ($scn2 == '') ? '' : '<li><a href="'.esc_url($scn2).'" target="_blank"><i class="fa '.esc_attr($scn_icon2).'"></i></a></li>';
$final_scn3 = ($scn3 == '') ? '' : '<li><a href="'.esc_url($scn3).'" target="_blank"><i class="fa '.esc_attr($scn_icon3).'"></i></a></li>';
$final_scn4 = ($scn4 == '') ? '' : '<li><a href="'.esc_url($scn4).'" target="_blank"><i class="fa '.esc_attr($scn_icon4).'"></i></a></li>';
$final_scn5 = ($scn5 == '') ? '' : '<li><a href="mailto:'.esc_attr($scn5).'"><i class="fa fa-envelope"></i></a></li>';

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
$out .= '

	<div class="slide-item '.esc_attr($css_animation_class).'">
			<div class="image">
				<img src="'.esc_url($img_link).'" class="img-responsive" alt="'.esc_attr($image_alt).'">
			</div>
			<div class="slide-description">
				<div class="member-info">
					<div class="name">'.wp_kses_post($name).'</div>
					<div class="position">'.wp_kses_post($position).'</div>
				</div>
				<div class="contacts">
';

if ( $scn1 || $scn2 || $scn3 || $scn4 || $scn5 ) {
	$out .= '
						<ul>'.$final_scn1.$final_scn2.$final_scn3.$final_scn4.$final_scn5.'</ul>
	';
}

$out .= '
				</div>
			</div>
		</div>

';

echo $out;