<?php /*** Portfolio Single Posts template. */

$elbrus_portfolio_layout = get_post_meta( get_the_ID(), 'pix_portfolio_layout', true );
$elbrus_all_works_link = elbrus_get_option('portfolio_settings_link_to_all');


?>
<?php get_header();?>

<section class="portfolio-single-section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-sm-12">
				<div class="work-heading">
					<?php the_title( '<h3>', '</h3>' ); ?>
					<div class="category"><?php elbrus_post_terms( array( 'taxonomy' => 'portfolio_category', 'items_wrap' => '%s' ) ); ?></div>
					<div class="controls">
						<ul>
							<li><?php previous_post_link( '%link', '<span class="fa fa-angle-left"></span>', false, '', 'portfolio_category'); ?></li>
							<?php if ( $elbrus_all_works_link != '' ) : ?>
								<li><a href="<?php echo esc_url($elbrus_all_works_link); ?>"><span class="fa fa-th"></span></a></li>
							<?php else : ?>
								<li><a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>"><span class="fa fa-th"></span></a></li>
							<?php endif; ?>
							<li><?php next_post_link( '%link', '<span class="fa fa-angle-right"></span>', false, '', 'portfolio_category' ); ?></li>
						</ul>
					</div>
				</div>
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
					?>
						<?php
						$elbrus_portfolio_gallery = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_images', 'type=image&size=full') : '';
						$elbrus_portfolio_create = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_create') : '';
						$elbrus_portfolio_complete = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_complete') : '';
						$elbrus_portfolio_skills = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_skills') : '';
						$elbrus_portfolio_client = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_client') : '';
						$elbrus_portfolio_client_link = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_client_link') : '';
						$elbrus_portfolio_button_link = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_button_link') : '';

						$elbrus_portfolio_post_type = ( class_exists( 'RW_Meta_Box' ) && rwmb_meta('post_types_select') != '' ) ? rwmb_meta('post_types_select') : 'image';

						$elbrus_portfolio_full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
						$elbrus_portfolio_link = $elbrus_portfolio_full_image[0];
						?>
						<?php if ( $elbrus_portfolio_layout == '1' ) : ?>
							<div class="row">
								<div class="col-md-8">
									<div class="work-image">
										<div class="image">
											<?php
											if ( $elbrus_portfolio_post_type == 'image' ) : ?>
												<div class="single-portfolio-carousel owl-carousel enable-owl-carousel owl-theme" data-auto-play="4000" data-single-item="true">
														<div class="item">
															<?php the_post_thumbnail( $post->ID, 'full', array('class' => 'img-responsive') ); ?>
														</div>
														<?php
															if ( $elbrus_portfolio_gallery ) {
																foreach ( $elbrus_portfolio_gallery as $key => $slide ) {
																		if ( $key > 0 ) :
																?>
																<div class="item">
																	<img src="<?php echo esc_url($slide['url']); ?>" width="<?php echo esc_attr($slide['width']); ?>" height="<?php echo esc_attr($slide['height']); ?>" alt="<?php echo esc_attr($slide['alt']); ?>" title="<?php echo esc_attr($slide['title']); ?>"/>
																</div>
																<?php 	endif;
																}
															}

														 ?>
												</div>
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
												<div class="controls">
													<div class="big-view"><a href="<?php echo esc_url($elbrus_portfolio_link); ?>" rel="prettyPhoto[pp_gal_<?php echo esc_attr($post->ID); ?>]"><span class="icon icon-Search"></span></a></div>
												</div>
											<?php
											endif; ?>

											<?php
											if ( $elbrus_portfolio_post_type == 'video' ) : ?>
												<div class="item">
													<?php the_post_thumbnail( $post->ID, 'full', array('class' => 'img-responsive') ); ?>
												</div>
												<?php
												$elbrus_portfolio_video_href = ( class_exists( 'RW_Meta_Box' ) ) ? get_post_meta( get_the_ID(), 'portfolio_video_href', true ) : '';
												if ( $elbrus_portfolio_video_href != '' ) :
													$elbrus_portfolio_video_width = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_width') : '';
													$elbrus_portfolio_video_height = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_height') : '';
													?>
													<div class="controls">
														<div class="big-view"><a href="<?php echo esc_url($elbrus_portfolio_video_href.'?width='.esc_attr($elbrus_portfolio_video_width).'&amp;height='. esc_attr($elbrus_portfolio_video_height)) ?>" rel="prettyPhoto[pp_video_<?php echo esc_attr(get_the_id());?>]"><span class="icon icon-Media"></span></a></div>
													</div>
												<?php
												endif;
												?>

											<?php
											endif;?>
										</div>
									</div>
									<div class="work-body">
										<div class="work-body">
											<div class="col-md-12 col-sm-12 work-body-left">
												<h5><?php esc_html_e( 'Description', 'elbrus' ); ?></h5>
												<div class="rtd"><?php the_content(); ?></div>
												<?php if ( $elbrus_portfolio_button_link != '') : ?>
													<a href="<?php echo esc_url($elbrus_portfolio_button_link); ?>" class="btn btn-default" target="_blank"><?php esc_html_e( 'View project', 'elbrus' ); ?></a>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="work-body">
										<div class="row">
											<div class="col-md-12 col-sm-12 work-body-right">
												<h5><?php esc_html_e( 'Summary', 'elbrus' ); ?></h5>
												<div class="row summary-list">
													<?php if ( $elbrus_portfolio_create != '') : ?>
													<div class="col-md-12 clearfix">
														<div class="type-info pull-left">
															<i class="icon icon-User"></i>
															<?php esc_html_e( 'Created by', 'elbrus' ); ?>
														</div>
														<div class="info pull-right text-right">
															<p class="no-margin"><?php echo wp_kses_post($elbrus_portfolio_create); ?></p>
														</div>
													</div>
													<?php endif; ?>
													<?php if ( $elbrus_portfolio_complete != '') : ?>
													<div class="col-md-12 clearfix">
														<div class="type-info pull-left">
															<i class="icon icon-Agenda"></i>
															<?php esc_html_e( 'Completed on', 'elbrus' ); ?>
														</div>
														<div class="info pull-right text-right">
															<p class="no-margin"><?php echo wp_kses_post($elbrus_portfolio_complete); ?></p>
														</div>
													</div>
													<?php endif; ?>
													<?php if ( $elbrus_portfolio_skills != '') : ?>
													<div class="col-md-12 clearfix">
														<div class="type-info pull-left">
															<i class="icon icon-Layers"></i>
															<?php esc_html_e( 'Skills', 'elbrus' ); ?>
														</div>
														<div class="info pull-right text-right">
															<p class="no-margin"><?php echo wp_kses_post($elbrus_portfolio_skills); ?></p>
														</div>
													</div>
													<?php endif; ?>
													<?php if ( $elbrus_portfolio_client != '') : ?>
													<div class="col-md-12 clearfix">
														<div class="type-info pull-left">
															<i class="icon icon-DesktopMonitor"></i>
															<?php esc_html_e( 'Client', 'elbrus' ); ?>
														</div>
														<div class="info pull-right text-right">
															<p class="no-margin">
																<?php if ( $elbrus_portfolio_client_link != '') : ?>
																	<a href="<?php echo esc_url($elbrus_portfolio_client_link); ?>" target="_blank">
																	<?php echo wp_kses_post($elbrus_portfolio_client); ?>
																	</a>
																<?php else : ?>
																	<?php echo wp_kses_post($elbrus_portfolio_client); ?>
																<?php endif; ?>
															</p>
														</div>
													</div>
													<?php endif; ?>
													<?php if ( elbrus_get_option( 'portfolio_settings_share', 'on' ) == 'on' ) : ?>
													<div class="col-md-12 clearfix">
														<div class="type-info pull-left">
															<i class="icon icon-Antenna1"></i>
															<?php esc_html_e( 'Share', 'elbrus' ); ?>
														</div>
														<div class="info pull-right text-right">
															<?php echo do_shortcode('[share post_type="portfolio"]'); ?>
														</div>
													</div>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php else : ?>
							<div class="work-image">
								<div class="image">
									<?php
									if ( $elbrus_portfolio_post_type == 'image' ) : ?>
										<div class="single-portfolio-carousel owl-carousel enable-owl-carousel owl-theme" data-auto-play="4000" data-single-item="true">
												<div class="item">
													<?php the_post_thumbnail( $post->ID, 'full', array('class' => 'img-responsive') ); ?>
												</div>
												<?php
													if ( $elbrus_portfolio_gallery ) {
														foreach ( $elbrus_portfolio_gallery as $key => $slide ) {
																if ( $key > 0 ) :
														?>
														<div class="item">
															<img src="<?php echo esc_url($slide['url']); ?>" width="<?php echo esc_attr($slide['width']); ?>" height="<?php echo esc_attr($slide['height']); ?>" alt="<?php echo esc_attr($slide['alt']); ?>" title="<?php echo esc_attr($slide['title']); ?>"/>
														</div>
														<?php 	endif;
														}
													}

												 ?>
										</div>
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
										<div class="controls">
											<div class="big-view"><a href="<?php echo esc_url($elbrus_portfolio_link); ?>" rel="prettyPhoto[pp_gal_<?php echo esc_attr($post->ID); ?>]"><span class="icon icon-Search"></span></a></div>
										</div>
									<?php
									endif; ?>

									<?php
									if ( $elbrus_portfolio_post_type == 'video' ) : ?>
										<div class="item">
											<?php the_post_thumbnail( $post->ID, 'full', array('class' => 'img-responsive') ); ?>
										</div>
										<?php
										$elbrus_portfolio_video_href = ( class_exists( 'RW_Meta_Box' ) ) ? get_post_meta( get_the_ID(), 'portfolio_video_href', true ) : '';
										if ( $elbrus_portfolio_video_href != '' ) :
											$elbrus_portfolio_video_width = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_width') : '';
											$elbrus_portfolio_video_height = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_height') : '';
											?>
											<div class="controls">
												<div class="big-view"><a href="<?php echo esc_url($elbrus_portfolio_video_href.'?width='.esc_attr($elbrus_portfolio_video_width).'&amp;height='. esc_attr($elbrus_portfolio_video_height)) ?>" rel="prettyPhoto[pp_video_<?php echo esc_attr(get_the_id());?>]"><span class="icon icon-Media"></span></a></div>
											</div>
										<?php
										endif;
										?>

									<?php
									endif;?>
								</div>
							</div>
							<div class="work-body">
								<div class="row">
									<div class="col-md-8 col-sm-7 work-body-left">
										<h5><?php esc_html_e( 'Description', 'elbrus' ); ?></h5>
										<div class="rtd"><?php the_content(); ?></div>
										<?php if ( $elbrus_portfolio_button_link != '') : ?>
											<a href="<?php echo esc_url($elbrus_portfolio_button_link); ?>" class="btn btn-default" target="_blank"><?php esc_html_e( 'View project', 'elbrus' ); ?></a>
										<?php endif; ?>
									</div>
									<div class="col-md-4 col-sm-5 work-body-right">
										<h5><?php esc_html_e( 'Summary', 'elbrus' ); ?></h5>
										<div class="row summary-list">
											<?php if ( $elbrus_portfolio_create != '') : ?>
											<div class="col-md-12 clearfix">
												<div class="type-info pull-left">
													<i class="icon icon-User"></i>
													<?php esc_html_e( 'Created by', 'elbrus' ); ?>
												</div>
												<div class="info pull-right text-right">
													<p class="no-margin"><?php echo wp_kses_post($elbrus_portfolio_create); ?></p>
												</div>
											</div>
											<?php endif; ?>
											<?php if ( $elbrus_portfolio_complete != '') : ?>
											<div class="col-md-12 clearfix">
												<div class="type-info pull-left">
													<i class="icon icon-Agenda"></i>
													<?php esc_html_e( 'Completed on', 'elbrus' ); ?>
												</div>
												<div class="info pull-right text-right">
													<p class="no-margin"><?php echo wp_kses_post($elbrus_portfolio_complete); ?></p>
												</div>
											</div>
											<?php endif; ?>
											<?php if ( $elbrus_portfolio_skills != '') : ?>
											<div class="col-md-12 clearfix">
												<div class="type-info pull-left">
													<i class="icon icon-Layers"></i>
													<?php esc_html_e( 'Skills', 'elbrus' ); ?>
												</div>
												<div class="info pull-right text-right">
													<p class="no-margin"><?php echo wp_kses_post($elbrus_portfolio_skills); ?></p>
												</div>
											</div>
											<?php endif; ?>
											<?php if ( $elbrus_portfolio_client != '') : ?>
											<div class="col-md-12 clearfix">
												<div class="type-info pull-left">
													<i class="icon icon-DesktopMonitor"></i>
													<?php esc_html_e( 'Client', 'elbrus' ); ?>
												</div>
												<div class="info pull-right text-right">
													<p class="no-margin">
														<?php if ( $elbrus_portfolio_client_link != '') : ?>
															<a href="<?php echo esc_url($elbrus_portfolio_client_link); ?>" target="_blank">
															<?php echo wp_kses_post($elbrus_portfolio_client); ?>
															</a>
														<?php else : ?>
															<?php echo wp_kses_post($elbrus_portfolio_client); ?>
														<?php endif; ?>
													</p>
												</div>
											</div>
											<?php endif; ?>
											<?php if ( elbrus_get_option( 'portfolio_settings_share', 'on' ) == 'on' ) : ?>
											<div class="col-md-12 clearfix">
												<div class="type-info pull-left">
													<i class="icon icon-Antenna1"></i>
													<?php esc_html_e( 'Share', 'elbrus' ); ?>
												</div>
												<div class="info pull-right text-right">
													<?php echo do_shortcode('[share post_type="portfolio"]'); ?>
												</div>
											</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						<?php endif;?>

					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php
if ( elbrus_get_option( 'portfolio_settings_related_show', 'on' ) == 'on' ) :
	$elbrus_portfolio_related_title = elbrus_get_option( 'portfolio_settings_related_title', esc_html__('Related projects', 'elbrus' ) );
	$elbrus_portfolio_related_desc = elbrus_get_option( 'portfolio_settings_related_desc' );
	?>
	<!-- ========================== -->
	<!-- PORTFOLIO - RELATE WORKS SECTION -->
	<!-- ========================== -->
	<?php

	$portfolio_taxterms = wp_get_object_terms( $post->ID, 'portfolio_category', array('fields' => 'ids') );
	// arguments
	$args = array(
		'post_type' => 'portfolio',
		'post_status' => 'publish',
		'posts_per_page' => 3,
		'orderby' => 'rand',
		'tax_query' => array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => $portfolio_taxterms
			)
		),
		'post__not_in' => array ($post->ID),
	);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) :

	?>
	<section class="portfolio-related-projects-section">
		<div class="container">
			<div class="vc_row_anchor js_stretch_anchor anchor-effect">
				<div class="wrap-anchor">
					<a class="wrap-anchor-link" href="#portfolio_related_posts"><div class="section-icon"><span class="icon icon-Umbrella"></span></div></a>
				</div>
			</div>
			<div class="portfolio-related-projects-section-inner" id="portfolio_related_posts">
				<div class="section-heading text-center">
					<div class="section-title"><?php echo wp_kses_post($elbrus_portfolio_related_title); ?></div>
					<div class="section-subtitle"><?php echo wp_kses_post($elbrus_portfolio_related_desc); ?></div>
					<div class="design-arrow"></div>
				</div>

				<div class="row">
					<div class="list-works clearfix">
						<?php
						while ( $the_query->have_posts() ) :
							$the_query->the_post();

							$elbrus_portfolio_thumbnail = get_the_post_thumbnail(get_the_id(), 'elbrus-portfolio-thumb', array('class' => 'img-responsive'));

							$elbrus_portfolio_full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', false);
							$elbrus_portfolio_full_image_link = $elbrus_portfolio_full_image[0];

						?>
							<div class="col-md-4 col-sm-4 col-xs-6">
								<div class="portfolio-item">
									<div class="portfolio-image">
										<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><?php echo wp_kses_post($elbrus_portfolio_thumbnail); ?></a>
										<div class="portfolio-item-body">
											<div class="name"><?php echo wp_kses_post( get_the_title() ); ?></div>
											<div class="under-name"><?php echo elbrus_get_post_terms( array( 'taxonomy' => 'portfolio_category', 'items_wrap' => '%s' ) ); ?></div>
										</div>
									</div>
								</div>
							</div>
						<?php
						endwhile;

						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	endif;
	wp_reset_postdata();
endif;
?>

<?php get_footer();?>