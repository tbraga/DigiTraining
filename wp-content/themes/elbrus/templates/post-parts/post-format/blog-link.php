<?php
/**
 * This template is for displaying part of blog format video.
 *
 * @package Elbrus
 * @since 1.0
 */

$elbrus_postpage_id = get_option( 'page_for_posts' );
$elbrus_frontpage_id = get_option( 'page_on_front' );
$elbrus_page_id = isset($wp_query) ? $wp_query->get_queried_object_id() : '';

if ( ( $elbrus_page_id == $elbrus_postpage_id && $elbrus_postpage_id != $elbrus_frontpage_id ) || is_single() ) :
	$elbrus_custom = isset ($wp_query) ? get_post_custom($wp_query->get_queried_object_id()) : '';
	$elbrus_layout = isset ($elbrus_custom['elbrus_page_layout']) ? $elbrus_custom['elbrus_page_layout'][0] : '2';
else :
	$elbrus_layout = elbrus_get_option('blog_settings_sidebar_type', '2');
endif;

$elbrus_size_thumb = ( $elbrus_layout == '1' ) ? 'elbrus-post-thumb-large' : 'elbrus-post-thumb-middle';



$elbrus_link_url = rwmb_meta('post_link_url');
$elbrus_link_text = rwmb_meta('post_link_text');
$elbrus_link_bg = rwmb_meta('post_link_bg', 'type=image&size='.$elbrus_size_thumb.'');

if ( $elbrus_link_bg && $elbrus_link_bg != '' && count( $elbrus_link_bg ) == 1 ) :
	foreach ( $elbrus_link_bg as $slide ) {
		$elbrus_link_bg_url = esc_url( $slide['url'] );
	}
endif;

?>

<div class="wrap-linked-image" style="background-image: url(<?php echo esc_url( $elbrus_link_bg_url ); ?>);">
	<span class="wrap-linked-image-overlay"></span>
	<a href="<?php echo esc_url( $elbrus_link_url ); ?>" target="_blank">
		<span class="icon icon-Unlinked"></span>
		<?php echo wp_kses_post( $elbrus_link_text ); ?>
	</a>
</div>
