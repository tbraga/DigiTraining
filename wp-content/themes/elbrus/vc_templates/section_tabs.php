<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Tabs
 */

$css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';


preg_match_all( '/section_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}

$tabs_nav = '';
$tabs_nav .= '
	<div class="service-navigation">
		<ul class="row" role="tablist">
';
$i=0;
foreach ( $tab_titles as $tab ) {
	$i++;
	$tab_atts = shortcode_parse_atts( $tab[0] );

	$icon = $tabs_type = '';
	$tabs_icon_pixelegant = $tabs_icon_pixstrokegap = $tabs_icon_pixflaticon = $tabs_icon_pixicomoon
	= $tabs_icon_pixfontawesome = $tabs_icon_pixsimple = $tabs_icon_fontawesome = $tabs_icon_openiconic = $tabs_icon_typicons
	= $tabs_icon_entypo = $tabs_icon_linecons = '';

	// parse attr icon
	$tabs_icon_pixelegant = ( isset( $tab_atts['icon_pixelegant'] ) ) ? $tab_atts['icon_pixelegant'] : '';
	$tabs_icon_pixstrokegap = ( isset( $tab_atts['icon_pixstrokegap'] ) ) ? $tab_atts['icon_pixstrokegap'] : '';
	$tabs_icon_pixflaticon = ( isset( $tab_atts['icon_pixflaticon'] ) ) ? $tab_atts['icon_pixflaticon'] : '';
	$tabs_icon_pixicomoon = ( isset( $tab_atts['icon_pixicomoon'] ) ) ? $tab_atts['icon_pixicomoon'] : '';
	$tabs_icon_pixfontawesome = ( isset( $tab_atts['icon_pixfontawesome'] ) ) ? $tab_atts['icon_pixfontawesome'] : '';
	$tabs_icon_pixsimple = ( isset( $tab_atts['icon_pixsimple'] ) ) ? $tab_atts['icon_pixsimple'] : '';
	$tabs_icon_fontawesome = ( isset( $tab_atts['icon_fontawesome'] ) ) ? $tab_atts['icon_fontawesome'] : '';
	$tabs_icon_openiconic = ( isset( $tab_atts['icon_openiconic'] ) ) ? $tab_atts['icon_openiconic'] : '';
	$tabs_icon_typicons = ( isset( $tab_atts['icon_typicons'] ) ) ? $tab_atts['icon_typicons'] : '';
	$tabs_icon_entypo = ( isset( $tab_atts['icon_entypo'] ) ) ? $tab_atts['icon_entypo'] : '';
	$tabs_icon_linecons = ( isset( $tab_atts['icon_linecons'] ) ) ? $tab_atts['icon_linecons'] : '';


	$tabs_type = ( isset( $tab_atts['type'] ) ) ? esc_attr($tab_atts['type']) : 'pixstrokegap';

	 // Enqueue needed icon font.
	vc_icon_element_fonts_enqueue( $tabs_type );
	$icon = isset( ${"tabs_icon_" . $tabs_type} ) ? esc_attr( ${"tabs_icon_" . $tabs_type} ) : '';

	//title tab
	$tab_title = ( isset( $tab_atts['title'] ) ) ? '<h5>'.$tab_atts['title'].'</h5>' : '';

	if ( isset( $tab_atts['title'] ) || $icon != '' ) {
		$class = $i==1 ? 'active' : '';
		$aria = $i==1 ? 'true' : 'false';
		$tabs_css_animation = ( isset( $tab_atts['css_animation'] ) ) ? 'wow '.esc_attr($tab_atts['css_animation']) : '';
		$tabs_tab_id = ( isset( $tab_atts['tab_id'] ) ) ? esc_attr($tab_atts['tab_id']) : sanitize_title( $tab_atts['title'] );
		$tabs_nav .= '
		<li role="presentation" class="'.esc_attr($class).'">
			<a href="#tab-'.esc_attr($tabs_tab_id).'" aria-controls="tab-'.esc_attr($tabs_tab_id).'" role="tab" data-toggle="tab">
				<div class="col-md-3 col-sm-3 col-xs-3 '.esc_attr($tabs_css_animation).'" data-wow-delay="0.2s">
					<div class="navigation-item">
						<div class="navigation-icon">
							<span class="'.esc_attr($icon).'"></span>
						</div>
						' . wp_kses_post($tab_title) . '
					</div>
				</div>

			</a>
		</li>';
	}
}
$tabs_nav .= '
		</ul>
	</div>' . "\n"
;

$section_cont = explode( '[/section_tab]', $content );
array_pop($section_cont);
if( is_array( $section_cont ) && !empty( $section_cont ) ){
	$i=0;
	$out_cont = '';
	foreach( $section_cont as $option ){
		$i++;
		$out_cont .= $i==1 ? str_replace('tab-pane', 'tab-pane active', do_shortcode($option.'[/section_tab]')) : do_shortcode($option.'[/section_tab]');
	}
}

$out .= '
		<div class="elbrus-tabs '.esc_attr($css_animation_class).'">
			' . $tabs_nav . '
			<div class="tab-content">
				'. $out_cont .'
			</div>
		</div>
	';

echo $out;