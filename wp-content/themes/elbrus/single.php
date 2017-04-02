<?php
/**
 * The Template for displaying all single posts
 */

get_header();

$elbrus_custom = isset( $wp_query ) ? get_post_custom( $wp_query->get_queried_object_id() ) : '';
$elbrus_layout = isset( $elbrus_custom['pix_page_layout'] ) ? $elbrus_custom['pix_page_layout'][0] : '2';
$elbrus_sidebar = isset( $elbrus_custom['pix_selected_sidebar'][0] ) ? $elbrus_custom['pix_selected_sidebar'][0] : 'sidebar-1';

if ( ! is_active_sidebar($elbrus_sidebar) ) $elbrus_layout = '1';

?>

<!-- =========================
	BLOG ITEMS
============================== -->
<section class="blog-content-section">
	<div class="container">
		<div class="row">

			<?php elbrus_show_sidebar( 'left', $elbrus_layout, $elbrus_sidebar ); ?>

			<!-- === BLOG ITEMS === -->

			<div class="<?php if ( $elbrus_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($elbrus_layout); ?>">

				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						get_template_part( 'templates/post-parts/content', 'single' );

					endwhile;


				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				?>

			</div>

			<?php elbrus_show_sidebar( 'right', $elbrus_layout, $elbrus_sidebar ); ?>

		</div>
	</div>
</section>

<?php get_footer(); ?>