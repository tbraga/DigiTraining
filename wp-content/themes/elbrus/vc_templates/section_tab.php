<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $icon_pixelegant
 * @var $icon_pixstrokegap
 * @var $icon_pixflaticon
 * @var $icon_pixicomoon
 * @var $icon_pixfontawesome
 * @var $icon_pixsimple
 * @var $icon_fontawesome
 * @var $icon_openiconic
 * @var $icon_typicons
 * @var $icon_entypo
 * @var $icon_linecons
 * @var $tab_id
 * @var $title
 * @var $image
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Tab
 */

$type = $icon_pixstrokegap = $icon_pixflaticon = $icon_pixfontawesome =
$icon_pixelegant = $icon_pixicomoon = $icon_pixsimple = $icon_fontawesome =
$icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';

$tab_id = $title = $image = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$img_id = preg_replace( '/[^\d]/', '', $image );
$img_link = wp_get_attachment_image_src( $img_id, 'large' );
$img_link = $img_link[0];
$image_meta = elbrus_pix_wp_get_attachment($img_id);
$image_alt = $image_meta['alt'] == '' ? $image_meta['title'] : $image_meta['alt'];

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$out .= '
		<div class="tab-pane" role="tabpanel" id="tab-' . esc_attr(( empty( $tab_id ) ? sanitize_title( $title ) : $tab_id )) . '">
			<div class="row">
';
if ( $img_link != '' ) :
	$out .= '
				<div class="col-md-4">
					<img src="'.esc_url($img_link).'" class="img-responsive" alt="'.esc_attr($image_alt).'">
				</div>
				<div class="col-md-8">
					'.do_shortcode($content).'
				</div>
	';
else :
	$out .= '
				<div class="col-md-12">
					'.do_shortcode($content).'
				</div>
	';
endif;
$out .= '
			</div>
		</div>
	';

echo $out;