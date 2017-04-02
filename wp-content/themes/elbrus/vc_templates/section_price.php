<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $width_type
 * @var $price_title
 * @var $price_amount
 * @var $price_date
 * @var $btntext
 * @var $btnlink
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Title
 */

$type = $price_title = $price_amount = $price_date = $btntext = $btnlink = $css_animation = '';
$attributes = array();
$a_href = $a_title = $a_target = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$href = vc_build_link( $btnlink );
$use_link = false;
if ( strlen( $href['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $href['url'];
	$a_title = $href['title'];
	$a_target = strlen( $href['target'] ) > 0 ? $href['target'] : '_self';
}

if ( $use_link ) {
	$attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
	$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
	$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
}
$attributes = implode( ' ', $attributes );

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
$add_width_class = ( $width_type == '4' ) ? 'col-md-3 col-sm-3' : 'col-md-4 col-sm-4';

$out .= '

	<div class="'. esc_attr($add_width_class) . ' vcenter">
		<div class="plan-item '. esc_attr($css_animation_class) . '  '. esc_attr($type) . '"  data-wow-delay="0.3s">
			<div class="item-heading">
				<span class="name">'.wp_kses_post($price_title).'</span>
				<div class="count">'.wp_kses_post($price_amount).'</div>
				<em>'.wp_kses_post($price_date).'</em>
			</div>
			<div class="item-body">'.do_shortcode($content).'</div>
';
if ( $use_link ) :
	$out .= '
				<div class="item-footer text-center">
					<a ' . $attributes . ' class="btn btn-default">'.wp_kses_post($btntext).'</a>
				</div>
	';
endif;
$out .= '
		</div>
	</div>

';

echo $out;