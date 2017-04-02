<?php

/** Elbrus Options Page **/

$theme_name = esc_html__( 'Elbrus', 'elbrus' );
$theme_slug = 'elbrus';
$shortname = 'pix';
$theme_version = '1.0';
$path = get_stylesheet_directory_uri();
$styles = array();
$background_options = array();
$skins = array();

if (is_dir(TEMPLATEPATH . "/css/")) {
	if ($open_dir = opendir(TEMPLATEPATH . "/css/")) {
		while (($style = readdir($open_dir)) !== false) {
			if (stristr($style, ".css") !== false) {
				$styles[] = $style;
			}
		}
	}
}


$html_desc = esc_html__( 'Enter HTML text', 'elbrus' );
$html_desc_p = esc_html__( 'Enter HTML text NOTE: Text must be between "p" tags', 'elbrus' );
$text_desc = esc_html__( 'Enter text', 'elbrus' );
$long_text = wp_kses_post( __( '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et dignissim ipsum. Nam ac interdum sem. Pellentesque diam lacus, dictum in dapibus id, hendrerit eget felis. Nunc nec turpis libero</p>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas euismod condimentum mollis. In non congue orci. Nulla nunc velit, volutpat vestibulum congue vitae, tincidunt at sem. Pellentesque tincidunt molestie mi, eu aliquam quam fringilla nec. Sed suscipit adipiscing urna, et varius libero commodo eget.</p>', 'elbrus' ) );

$upload_desc = esc_html__( 'Upload image for your theme, or specify an existing url', 'elbrus' );

// Array added for 3D Rotator
$tween_types = array(
	array( "value"=>"linear", "text"=>esc_html__( "linear", "elbrus" ) ),
	array( "value"=>"easeInSine", "text"=>esc_html__( "easeInSine", "elbrus" ) ),
	array( "value"=>"easeInSine", "text"=>esc_html__( "easeInSine", "elbrus" ) ),
	array( "value"=>"easeInOutSine", "text"=>esc_html__( "easeInOutSine", "elbrus" ) ),
	array( "value"=>"easeInCubic", "text"=>esc_html__( "easeInCubic", "elbrus" ) ),
	array( "value"=>"easeOutCubic", "text"=>esc_html__( "easeOutCubic", "elbrus" ) ),
	array( "value"=>"easeInOutCubic", "text"=>esc_html__( "easeInOutCubic", "elbrus" ) ),
	array( "value"=>"easeOutInCubic", "text"=>esc_html__( "easeOutInCubic", "elbrus" ) ),
	array( "value"=>"easeInQuint", "text"=>esc_html__( "easeInQuint", "elbrus" ) ),
	array( "value"=>"easeOutQuint", "text"=>esc_html__( "easeOutQuint", "elbrus" ) ),
	array( "value"=>"easeInOutQuint", "text"=>esc_html__( "easeInOutQuint", "elbrus" ) ),
	array( "value"=>"easeOutInQuint", "text"=>esc_html__( "easeOutInQuint", "elbrus" ) ),
	array( "value"=>"easeInCirc", "text"=>esc_html__( "easeInCirc", "elbrus" ) ),
	array( "value"=>"easeOutCirc", "text"=>esc_html__( "easeOutCirc", "elbrus" ) ),
	array( "value"=>"easeInOutCirc", "text"=>esc_html__( "easeInOutCirc", "elbrus" ) ),
	array( "value"=>"easeOutInCirc", "text"=>esc_html__( "easeOutInCirc", "elbrus" ) ),
	array( "value"=>"easeInBack", "text"=>esc_html__( "easeInBack", "elbrus" ) ),
	array( "value"=>"easeOutBack", "text"=>esc_html__( "easeOutBack", "elbrus" ) ),
	array( "value"=>"easeInOutBack", "text"=>esc_html__( "easeInOutBack", "elbrus" ) ),
	array( "value"=>"easeOutInBack", "text"=>esc_html__( "easeOutInBack", "elbrus" ) ),
	array( "value"=>"easeInQuad", "text"=>esc_html__( "easeInQuad", "elbrus" ) ),
	array( "value"=>"easeOutQuad", "text"=>esc_html__( "easeOutQuad", "elbrus" ) ),
	array( "value"=>"easeInOutQuad", "text"=>esc_html__( "easeInOutQuad", "elbrus" ) ),
	array( "value"=>"easeOutInQuad", "text"=>esc_html__( "easeOutInQuad", "elbrus" ) ),
	array( "value"=>"easeInQuart", "text"=>esc_html__( "easeInQuart", "elbrus" ) ),
	array( "value"=>"easeOutQuart", "text"=>esc_html__( "easeOutQuart", "elbrus" ) ),
	array( "value"=>"easeInOutQuart", "text"=>esc_html__( "easeInOutQuart", "elbrus" ) ),
	array( "value"=>"easeOutInQuart", "text"=>esc_html__( "easeOutInQuart", "elbrus" ) ),
	array( "value"=>"easeInExpo", "text"=>esc_html__( "easeInExpo", "elbrus" ) ),
	array( "value"=>"easeOutExpo", "text"=>esc_html__( "easeOutExpo", "elbrus" ) ),
	array( "value"=>"easeInOutExpo", "text"=>esc_html__( "easeInOutExpo", "elbrus" ) ),
	array( "value"=>"easeOutInExpo", "text"=>esc_html__( "easeOutInExpo", "elbrus" ) ),
	array( "value"=>"easeInElastic", "text"=>esc_html__( "easeInElastic", "elbrus" ) ),
	array( "value"=>"easeOutElastic", "text"=>esc_html__( "easeOutElastic", "elbrus" ) ),
	array( "value"=>"easeInOutElastic", "text"=>esc_html__( "easeInOutElastic", "elbrus" ) ),
	array( "value"=>"easeOutInElastic", "text"=>esc_html__( "easeOutInElastic", "elbrus" ) ),
	array( "value"=>"easeInBounce", "text"=>esc_html__( "easeInBounce", "elbrus" ) ),
	array( "value"=>"easeOutBounce", "text"=>esc_html__( "easeOutBounce", "elbrus" ) ),
	array( "value"=>"easeInOutBounce", "text"=>esc_html__( "easeInOutBounce", "elbrus" ) ),
	array( "value"=>"easeOutInBounce", "text"=>esc_html__( "easeOutInBounce", "elbrus" ) )
);
