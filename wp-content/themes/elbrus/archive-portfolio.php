<?php
/*** The template for displaying portfolio archive. ***/

get_header();

$elbrus_layout = elbrus_get_option('portfolio_settings_sidebar_type', '2');
$elbrus_sidebar = elbrus_get_option('portfolio_settings_sidebar_content', 'sidebar-1');

if ( ! is_active_sidebar($elbrus_sidebar) ) $elbrus_layout = '1';

$elbrus_portfolio_perrrow = elbrus_get_option('portfolio_settings_perrow', '2');
if ( $elbrus_portfolio_perrrow == '3' ) {
	$elbrus_add_class_port_col = 'col-md-4 col-sm-4 col-xs-6';
}
elseif ( $elbrus_portfolio_perrrow == '4' ) {
	$elbrus_add_class_port_col = 'col-md-3 col-sm-4 col-xs-6';
}
else {
	$elbrus_add_class_port_col = 'col-md-6 col-sm-6 col-xs-6';
}

$elbrus_portfolio_perrow = elbrus_get_option('portfolio_settings_perrow', '2');
$elbrus_portfolio_css_animation = ( elbrus_get_option('css_animation_settings_portfolio', '') != '' ) ? ' wow '.elbrus_get_option('css_animation_settings_portfolio', '') : '';
$elbrus_portfolio_type = elbrus_get_option('portfolio_settings_type', 'type_without_icons');
$elbrus_portfolio_loadmore = elbrus_get_option('portfolio_settings_loadmore', esc_html__('Load more', 'elbrus' ) );

?>

<!-- ========================== -->
<!-- BLOG - CONTENT -->
<!-- ========================== -->
<section class="page-section">
	<div class="container">
		<div class="row">

			<?php elbrus_show_sidebar( 'left', $elbrus_layout, $elbrus_sidebar ); ?>

			<div class="<?php if ( $elbrus_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($elbrus_layout); ?>">

				<div id="portfolio-category-section" class="portfolio-list-section portfolio-perrow-<?php echo esc_attr($elbrus_portfolio_perrow); ?>">

					<div class="section-heading text-center">
						<div class="section-subtitle"><?php esc_html_e( 'All categories', 'elbrus' ); ?></div>
						<div class="design-arrow"></div>
					</div>

				<?php

					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$elbrus_portfolio_perpage = elbrus_get_option('portfolio_settings_perpage');
					if ( is_numeric( $elbrus_portfolio_perpage ) && $elbrus_portfolio_perpage > 0 ) {
						$elbrus_archive_perpage = $elbrus_portfolio_perpage;
					}
					else {
						$elbrus_archive_perpage = -1;
					}

					$args = array(
								'post_type' => 'portfolio',
								'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
								'paged' => $paged,
								'posts_per_page' => $elbrus_archive_perpage
							);

					$wp_query = new WP_Query( $args );

					if ( $wp_query->have_posts() ) : ?>

						<div class="row portfolio-masonry-holder list-works clearfix">
						<?php
						while ( $wp_query->have_posts() ) :
							$wp_query->the_post();

							$elbrus_portfolio_post_type = ( class_exists( 'RW_Meta_Box' ) && rwmb_meta('post_types_select') != '' ) ? rwmb_meta('post_types_select') : 'image';

							$cats = wp_get_object_terms(get_the_id(), 'portfolio_category');
							$elbrus_cat_slugs = '';
							if ( ! empty($cats) ) {
								foreach ( $cats as $cat ) {
									$elbrus_cat_slugs .= $cat->slug . " ";
								}
							}
							$elbrus_portfolio_thumbnail = get_the_post_thumbnail(get_the_id(), 'elbrus-portfolio-thumb', array('class' => 'img-responsive'));

							// potfolio category list linked
							$elbrus_portfolio_linked_list_cats = elbrus_get_post_terms( array( 'taxonomy' => 'portfolio_category', 'items_wrap' => '%s' ) );

							if ( $elbrus_portfolio_type == 'type_without_icons' ) : ?>

									<div class="<?php echo esc_attr($elbrus_add_class_port_col); ?> item <?php echo esc_attr($elbrus_portfolio_css_animation); ?> <?php echo esc_attr($elbrus_cat_slugs); ?>" id="post-<?php echo esc_attr(get_the_ID()); ?>">
										<div class="portfolio-item">
											<div class="portfolio-image">
												<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><?php echo wp_kses_post($elbrus_portfolio_thumbnail); ?></a>
												<div class="portfolio-item-body">
													<div class="name"><?php echo wp_kses_post( get_the_title() ); ?></div>
													<div class="under-name"><?php echo wp_kses_post( $elbrus_portfolio_linked_list_cats ); ?></div>
												</div>
											</div>
										</div>
									</div>

							<?php
							else : ?>

									<div class="<?php echo esc_attr($elbrus_add_class_port_col); ?> item <?php echo esc_attr($elbrus_portfolio_css_animation); ?> <?php echo esc_attr($elbrus_cat_slugs); ?>" id="post-<?php echo esc_attr(get_the_ID()); ?>">
										<div class="portfolio-item">
											<div class="portfolio-image">
												<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><?php echo wp_kses_post($elbrus_portfolio_thumbnail); ?></a>
												<div class="portfolio-item-body center-body">
													<ul>
														<?php
														if ( $elbrus_portfolio_post_type == 'image' ) :
															$elbrus_portfolio_gallery = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_images', 'type=image&size=full') : '';
															$elbrus_portfolio_full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', false);
															$elbrus_portfolio_full_image_link = $elbrus_portfolio_full_image[0];
															?>
															<li><a href="<?php echo esc_url($elbrus_portfolio_full_image_link); ?>"  rel="prettyPhoto[pp_gal_<?php echo esc_attr(get_the_id());?>]"><span class="icon icon-Search"></span></a></li>
															<?php
															if ( $elbrus_portfolio_gallery ) :
																foreach ( $elbrus_portfolio_gallery as $key => $slide ) :
																	if ( $key > 0 ) :
																	?>
																		<div class="portfolio-gallery-none">
																			<a href="<?php echo esc_url($slide['url']); ?>" rel="prettyPhoto[pp_gal_<?php echo esc_attr($post->ID); ?>]" ><img src="<?php echo esc_url($slide['url']); ?>" width="<?php echo esc_attr($slide['width']); ?>" height="<?php echo esc_attr($slide['height']); ?>" alt="<?php echo esc_attr($slide['alt']); ?>" title="<?php echo esc_attr($slide['title']); ?>"/></a>
																		</div>
																	<?php
																	endif;
																endforeach;
															endif;
														 ?>
														<?php
														endif; ?>
														<?php
														if ( $elbrus_portfolio_post_type == 'video' ) :
															$elbrus_portfolio_video_href = ( class_exists( 'RW_Meta_Box' ) ) ? get_post_meta( get_the_ID(), 'portfolio_video_href', true ) : '';
															if ( $elbrus_portfolio_video_href != '' ) :
																$elbrus_portfolio_video_width = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_width') : '';
																$elbrus_portfolio_video_height = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_height') : '';
																?>
																<li><a href="<?php echo esc_url($elbrus_portfolio_video_href.'?width='.esc_attr($elbrus_portfolio_video_width).'&amp;height='. esc_attr($elbrus_portfolio_video_height)) ?>" rel="prettyPhoto[pp_video_<?php echo esc_attr(get_the_id());?>]"><span class="icon icon-Media"></span></a></li>
															<?php
															endif;
														endif;
														?>
															<li><a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><span class="icon icon-Info"></span></a></li>
														<?php



														?>
													</ul>
												</div>
											</div>
											<div class="portfolio-item-footer">
												<div class="name"><?php echo wp_kses_post( get_the_title() ); ?></div>
												<div class="under-name"><?php echo wp_kses_post($elbrus_portfolio_linked_list_cats); ?></div>
											</div>
										</div>
									</div>

							<?php
							endif;

						endwhile; ?>
						</div>

						<?php
						if ( get_next_posts_link( '', $wp_query->max_num_pages ) ) {

							echo '
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="portfolio-pagination">
											<span data-current="'.esc_attr($paged).'" data-max-pages="'.esc_attr($wp_query->max_num_pages).'" class="load-more">' . get_next_posts_link( wp_kses_post($elbrus_portfolio_loadmore), $wp_query->max_num_pages) . '</span>
										</div>
										<div class="portfolio-pagination-loading">
											<a href="javascript: void(0)" class="btn btn-default">'. esc_html__("Loading...", "elbrus") .'</a>
										</div>
									</div>
								</div>
							';
						}
						?>

					<?php
					endif;
				?>
				</div>

			</div>

			<?php elbrus_show_sidebar( 'right', $elbrus_layout, $elbrus_sidebar ); ?>

		</div>
	</div>
</section>

<?php get_footer(); ?>