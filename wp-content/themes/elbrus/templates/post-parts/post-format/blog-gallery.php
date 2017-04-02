<?php
/**
 * The template includes blog post format gallery.
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

// get the gallery images
$gallery = rwmb_meta('post_gallery', 'type=image&size='.$elbrus_size_thumb.'');

$argsThumb = array(
	'order'          => 'ASC',
	'post_type'      => 'attachment',
	'post_parent'    => $post->ID,
	'post_mime_type' => 'image',
	'post_status'    => null,
	//'exclude' => get_post_thumbnail_id()
);
$attachments = get_posts($argsThumb);


if ( $gallery && $gallery != '' && count( $gallery ) > 1 || $attachment && $attachment != '' && count( $attachment ) > 1 ) : ?>

<div id="carousel-example-generic-<?php esc_attr( the_ID() ); ?>" class="carousel slide" data-ride="carousel">
	<!-- Wrapper for slides -->
	<div class="carousel-inner">
	<?php
	$i = 1;
		if ( $gallery ) :
			foreach ( $gallery as $slide ) {
				$elbrus_gallery_class = ( $i == 1 ) ? 'active' : '';
				echo '<div class="item ' . $elbrus_gallery_class . '">';
				echo '<img src="' . esc_url( $slide['url'] ) . '" width="' . esc_attr( $slide['width'] ) . '" height="' . esc_attr( $slide['height'] ) . '" alt="' .esc_attr( $slide['alt'] ).'" title="' .esc_attr( $slide['title'] ). '" class="img-responsive" >';
				echo '</div>';
				$i++;
			}
		elseif ( $attachments ) :
			foreach ( $attachments as $attachment ) {
				$elbrus_gallery_class = ( $i == 1 ) ? 'active' : '';
				echo '<div class="item ' . $elbrus_gallery_class . '">';
				echo '<img src="'.esc_url( wp_get_attachment_url( $attachment->ID, 'full', false, false ) ).'" alt="'.esc_attr( get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) ).'" title="'.esc_attr( get_post_meta( $attachment->ID, '_wp_attachment_image_title', true ) ).'" class="img-responsive" >';
				echo '</div>';
				$i++;
			}
		endif;
	?>

	</div>
	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic-<?php esc_attr( the_ID() ); ?>" data-slide="prev">
		<i class="fa fa-angle-left"></i>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic-<?php esc_attr( the_ID() ); ?>" data-slide="next">
		<i class="fa fa-angle-right"></i>
	</a>
</div>

<?php
elseif ( $gallery && $gallery != '' && count( $gallery ) == 1 || $attachment && count( $attachment ) == 1 ) : ?>

	<div class="wrap-image">

		<?php
			if ( $gallery ) :
				foreach ( $gallery as $slide ) {
					if ( is_single() ) :
						echo '<img src="' . esc_url( $slide['url'] ) . '" width="' . esc_attr( $slide['width'] ) . '" height="' . esc_attr( $slide['height'] ) . '" alt="' .esc_attr( $slide['alt'] ).'" title="' .esc_attr( $slide['title'] ). '" class="img-responsive">';
					else :
						echo '<a href="'.esc_url( get_the_permalink() ).'">';
						echo '<img src="' . esc_url( $slide['url'] ) . '" width="' . esc_attr( $slide['width'] ) . '" height="' . esc_attr( $slide['height'] ) . '" alt="' .esc_attr( $slide['alt'] ).'" title="' .esc_attr( $slide['title'] ). '" class="img-responsive">';
						echo '</a>';
					endif;
				}
			elseif ( $attachments ) :
				foreach ( $attachments as $attachment ) {
					echo '<img src="'.esc_url( wp_get_attachment_url( $attachment->ID, 'full', false, false ) ).'" alt="'.esc_attr( get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) ).'" title="'.esc_attr( get_post_meta( $attachment->ID, '_wp_attachment_image_title', true ) ).'" class="img-responsive">';
				}
			endif;

		?>

	</div>

	<?php
else : ?>
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
<?php
endif;