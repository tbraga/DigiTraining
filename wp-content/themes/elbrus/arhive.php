<?php
/**
 * The template for displaying archive pages
 */

get_header();

$elbrus_layout = elbrus_get_option('blog_settings_sidebar_type', '2');
$elbrus_sidebar = elbrus_get_option('blog_settings_sidebar_content', 'sidebar-1');


if ( ! is_active_sidebar($elbrus_sidebar) ) $elbrus_layout = '1';

?>

<!-- ========================== -->
<!-- BLOG - CONTENT -->
<!-- ========================== -->
<section class="blog-content-section">
	<div class="container">
		<div class="row">

			<?php elbrus_show_sidebar( 'left', $elbrus_layout, $elbrus_sidebar ); ?>

			<div class="<?php if ( $elbrus_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($elbrus_layout); ?>">

				<?php
					if ( have_posts() ) :
						// Start the Loop.
						while ( have_posts() ) : the_post();

							get_template_part( 'templates/post-parts/content' );

						endwhile;

					else:
						// If no content, include the "No posts found" template.
						get_template_part( 'templates/post-parts/content', 'none' );

					endif;

				?>

				<?php elbrus_num_pagination(); ?>

			</div>

			<?php elbrus_show_sidebar( 'right', $elbrus_layout, $elbrus_sidebar ); ?>

		</div>
	</div>
</section>

<?php get_footer(); ?>