<?php
$elbrus_header_image = elbrus_get_option( 'header_settings_headerimage' );
?>
<section class="top-header blog-header with-bottom-effect transparent-effect" style="background-image: url(
	<?php
	if ( is_page() ) :

		if ( has_post_thumbnail() ) :
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			echo esc_url($post_thumbnail_url); ?>);" >
		<?php
		elseif ( !empty( $elbrus_header_image ) ) :
			echo esc_url( $elbrus_header_image ); ?>);">
		<?php
		else : ?>
			);">
		<?php
		endif;

	else :

		if ( !empty( $elbrus_header_image ) ) :
			echo esc_url( $elbrus_header_image ); ?>);">
		<?php
		else : ?>
			);">
		<?php
		endif;

	endif; ?>
	<?php if ( elbrus_get_option( 'elbrus_header_settings_headerimage_overlay', 'on' ) == 'on' ) : ?>
		<span class="header-overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr( elbrus_get_option( 'header_settings_headerimage_opacity', '0.1' ) ); ?>) !important;"></span>
	<?php endif; ?>
	<div class="bottom-effect"></div>

	<?php require_once( get_template_directory() . '/templates/header/header_title.php' ); ?>
</section>