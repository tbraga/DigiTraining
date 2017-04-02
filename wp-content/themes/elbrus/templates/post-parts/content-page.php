<?php
/**
 * The default template for displaying content page
 */
//
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'rtd clearfix' ); ?>>

		<?php the_content(); ?>

</div>

<div class="more-page">
	<?php
		$args = array(
		 'link_before'      => '<span>'
		,'link_after'       => '</span>' );

		wp_link_pages( $args );
	?>
</div>