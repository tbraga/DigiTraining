<?php
/**
 * This template is for displaying part of blog.
 *
 * @package elbrus
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
?>


<div class="wrap-image">
	<?php if ( is_single() ) : ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( $size = $elbrus_size_thumb, $attr = array( 'class' => "img-responsive" ) ); ?>
		<?php endif; ?>

	<?php else : ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php esc_url( the_permalink() ); ?>">
				<?php the_post_thumbnail( $size = $elbrus_size_thumb, $attr = array( 'class' => "img-responsive" ) ); ?>
			</a>
		<?php endif; ?>

	<?php endif; ?>
</div>