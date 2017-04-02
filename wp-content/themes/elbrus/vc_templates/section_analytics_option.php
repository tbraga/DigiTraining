<?php
$out = $pos_hor = $pos_vert = '';
extract(shortcode_atts(array(
	'title' => '',
	'under_title' => '',
	'icon' => '',
	'itempos' => '',
	'itempos_vert' => '',
	'css_animation' => '',
), $atts));

$pos_hor = ( $itempos == '' ) ? "left" : $itempos;
$pos_vert = ( $itempos_vert == '' ) ? "top" : $itempos_vert;

$out = $css_animation != '' ? '<div class="wow ' . esc_attr($css_animation) . '">' : '<div>';
$out .= '

		<div class="col-md-12">
			<div class="text-item '.esc_attr($pos_vert).'-item '.esc_attr($pos_hor).'-item">
				<div class="dot-line"></div>
				<h5>'.wp_kses_post($title).'</h5>
				<em>'.wp_kses_post($under_title).'</em>
				<div class="info">'.do_shortcode($content).'</div>
			</div>
		</div>

	';
$out .= '</div>';

echo $out;