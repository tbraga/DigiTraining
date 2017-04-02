<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $count
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Timeline
 */

$count = $css_animation = '';
$out = '';
$per_page_count = $count_group = '';
$count_item = 0;
$out_cont = array();
$out_cont_2 = array();

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$section_cont = explode( '[/section_timeline_option]', $content );
array_pop($section_cont);
if( is_array($section_cont) && !empty($section_cont) ) {
	foreach( $section_cont as $option ) {
		$out_cont[$count_item] = '';
		$out_cont[$count_item] .= do_shortcode($option.'[/section_timeline_option]');
		$count_item++;
	}
}

$per_page_count = is_numeric($count) && $count > 0 ? $count : $count_item;

$count_group = ceil( $count_item / $per_page_count );
if ( $count_group && is_array($out_cont) && !empty( $out_cont ) ) {
	for ( $i = 0; $i < $count_group; $i++ ) {
		$out_cont_2[$i] = '';
		for ( $j = 0; $j < $per_page_count; $j++ ) {
			if ( ! isset($out_cont[$per_page_count*$i + $j]) ) { $out_cont[$per_page_count*$i + $j] = ''; }
			$out_cont_2[$i] .= $out_cont[$per_page_count*$i + $j];
		}

	}
}

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$out .= '
	<div class="wrap-timeline '.esc_attr($css_animation_class).'">
		<div class="container-timeline">
			<div class="row top-row">
				<div class="col-md-12">
					<div class="time-title" id="timel"> <br />
					</div>
				</div>
			</div>
';

foreach ($out_cont_2 as $key => $value) {
	if ( $key === 0 ) {
		$out .= '<div>'.$value.'</div>';
	} else {
		$out .= '<div class="hidden">'.$value.'</div>';
	}
}

if ( $per_page_count < $count_item ) :

$out .= '
		<div class="plus">
			<span data-group="' . esc_attr($count_group) . '" class="plus-ico">+</span>
		</div>
';

else :

$out .= '
		<span class="plus">
			<span class="plus-ico inactive"></span>
		</span>
';
endif;

$out .= '
		</div>
	</div>
';

echo $out;