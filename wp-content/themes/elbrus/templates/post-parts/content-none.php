<?php
/**
 * The template for displaying a "No posts found" message
 *
 */
?>

<div class="wrap-blog-post">
	<div class="post-body">
		<div class="post-body-title">
			<h2><?php esc_html_e( 'Nothing Found', 'elbrus' ) ?></h2>
		</div>

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php echo esc_html__( 'Ready to publish your first post?', 'elbrus' );?></p>
		<p><?php printf( '<a href="%1$s">' . esc_html__( 'Get started here', 'elbrus' ) . '</a>', esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'elbrus' ); ?></p>
		<?php get_search_form(); ?>

		<?php else : ?>

		<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'elbrus' ); ?></p>
		<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</div>
