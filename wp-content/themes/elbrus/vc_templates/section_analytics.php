<?php
$out = $image = $pos_hor = $pos_vert = '';
extract(shortcode_atts(array(
	'image' => $image,
	"css_animation" => '',
), $atts));

$img = wp_get_attachment_image_src( $image, 'full' );
$img_output = $img[0];
$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
$options_left = $options_right = array();

// Extract tab titles
$section_cont = explode( '[/section_analytics_option]', $content );
array_pop($section_cont);

$out .= '<div class="offers-section ' . esc_attr($css_animation) . '"><div class="row offers-list">';

if ( is_array( $section_cont ) && !empty( $section_cont ) ) {
	$i=0;
	foreach( $section_cont as $option ) {
		$i++;
		preg_match_all( '/section_analytics_option([^\]]+)/i', $option, $matches, PREG_OFFSET_CAPTURE );
		$opt_atts = shortcode_parse_atts( $matches[1][0][0] );
		$pos_hor = ( ! isset( $opt_atts['itempos'] ) ) ? "left" : $opt_atts['itempos'];

		$out_cont = do_shortcode($option.'[/section_analytics_option]');

		if ( $pos_hor == "left" ) {
			$options_left[] = $out_cont;
		} else {
			$options_right[] = $out_cont;
		}
	}
}

if ( is_array( $options_left ) && !empty( $options_left ) ) {
	$out .= '
			<div class="col-md-4">
			'.implode( "\n", $options_left ).'
			</div>
	';
}
$out .= '
			<div class="col-md-4 col-image">
				<img src="'.esc_url($img_output).'" alt="" class=" hidden-xs hidden-sm" />
			</div>
	';
if( is_array( $options_right ) && !empty( $options_right ) ) {
	$out .= '
			<div class="col-md-4">
			'.implode( "\n", $options_right ).'
			</div>
	';
}

$out .= '</div></div>';
echo $out;