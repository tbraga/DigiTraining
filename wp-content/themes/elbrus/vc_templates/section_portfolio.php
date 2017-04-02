<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $template
 * @var $cat_port
 * @var $perrow
 * @var $count
 * @var $type
 * @var $btnshow
 * @var $btntext
 * @var $css_animation
 * @var $tab_id
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Portfolio
 */
 $template = $cat_port = $count = $btnshow = $btntext = $css_animation = $tab_id = '';
 $out = $cnt = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

global $post;

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
if ( $perrow == '3' ) {
	$add_class_port_col = 'col-md-4 col-sm-4 col-xs-6';
}
elseif ( $perrow == '4' ) {
	$add_class_port_col = 'col-md-3 col-sm-4 col-xs-6';
}
else {
	$add_class_port_col = 'col-md-6 col-sm-6 col-xs-6';
}

if ( $cat_port == '' ) :
	$out .= '<p>'.esc_html__('No categories selected. To fix this, please login to your WP Admin area and set the categories you want to show by editing this shortcode and setting one or more categories in the multi checkbox field "Categories".', 'elbrus');

else:

	$out .= '<div id="portfolio-'.esc_attr($tab_id).'" class="portfolio-list-section portfolio-perrow-'.esc_attr($perrow).'">';

	if ( $content != '' ) :
		$out .= '
			<div class="section-heading text-center">
				<div class="section-subtitle">'.wp_kses_post(do_shortcode($content)).'</div>
				<div class="design-arrow"></div>
			</div>
		';
	endif;

	$port_categories = get_objects_in_term( explode( ",", $cat_port ), 'portfolio_category');

	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}

	$args = array(
				'post_type' => 'portfolio',
				'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
				'post__in' => $port_categories,
				'paged' => $paged
			);


	if ( is_numeric( $count ) && $count > 0 ) {
		$args['posts_per_page'] = $count;
	}
	else {
		$args['posts_per_page'] = -1;
	}

	$wp_query = new WP_Query( $args );

	if ( $template == 'isotop' ) :
		$out .= '
				<div class="folio-isotop-filter row">
					<div class="col-md-12">
						<ul class="folio-option-set clearfix ' . esc_attr($css_animation_class) . '" >
		';

		$categories = get_categories( array( 'type' => 'post', 'taxonomy' => 'portfolio_category', 'include' => $cat_port ) );

		$out .= '
							<li><a href="#" data-filter="*" class="selected">'.esc_html__("All", "elbrus").'</a></li>
		';
							foreach ( $categories as $category ) {
								$group = $category->slug;
								$out .= '
								<li><a href="#" data-filter=".'.$group.'">'.$category->cat_name.'</a></li>
								';
							}

		$out .= '
						</ul>
					</div>
				</div>
		';
	endif;

	if ( $wp_query->have_posts() ) :
		$out .= '
			<div class="row portfolio-masonry-holder list-works clearfix">
		';

		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();

			$elbrus_portfolio_post_type = ( class_exists( 'RW_Meta_Box' ) && rwmb_meta('post_types_select') != '' ) ? rwmb_meta('post_types_select') : 'image';

			$cats = wp_get_object_terms($post->ID, 'portfolio_category');
			$cat_slugs = '';
			if ( ! empty($cats) ) {
				foreach ( $cats as $cat ) {
					$cat_slugs .= $cat->slug . " ";
				}
			}
			$thumbnail = get_the_post_thumbnail($post->ID, 'elbrus-portfolio-thumb', array('class' => 'img-responsive'));

			// potfolio category list linked
			$portfolio_link_term = elbrus_get_post_terms( array( 'taxonomy' => 'portfolio_category', 'items_wrap' => '%s' ) );

			if ( $type == 'type_without_icons' ) :

			$out .= '

				<div class="' . esc_attr($add_class_port_col). ' item '. esc_attr($css_animation_class) . esc_attr($cat_slugs) . '" id="post-'.esc_attr(get_the_ID()).'">
					<div class="portfolio-item">
						<div class="portfolio-image">
							<a href="'.esc_url( get_permalink( get_the_ID() ) ).'">'.wp_kses_post($thumbnail).'</a>
							<div class="portfolio-item-body">
								<div class="name">'.wp_kses_post( get_the_title() ).'</div>
								<div class="under-name">'.wp_kses_post( $portfolio_link_term ).'</div>
							</div>
						</div>
					</div>
				</div>

			';

			else :

			$out .= '

				<div class="' . esc_attr($add_class_port_col). ' item '.esc_attr($cat_slugs). esc_attr($css_animation_class) . esc_attr($cat_slugs) . '" id="post-'.esc_attr(get_the_ID()).'">
					<div class="portfolio-item">
						<div class="portfolio-image">
							<a href="'.esc_url( get_permalink( get_the_ID() ) ).'">'.wp_kses_post($thumbnail).'</a>
							<div class="portfolio-item-body center-body">
								<ul>
			';
								if ( $elbrus_portfolio_post_type == 'image' ) :
									$elbrus_portfolio_gallery = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_images', 'type=image&size=full') : '';
									$elbrus_portfolio_full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', false);
									$elbrus_portfolio_full_image_link = $elbrus_portfolio_full_image[0];
								$out .= '
									<li><a href="'.esc_url($elbrus_portfolio_full_image_link).'" rel="prettyPhoto[pp_gal_'.esc_attr($post->ID).']"><span class="icon icon-Search"></span></a></li>
								';
									if ( $elbrus_portfolio_gallery ) :
										foreach ( $elbrus_portfolio_gallery as $key => $slide ) :
											if ( $key > 0 ) :
											$out .= '
												<div class="portfolio-gallery-none">
													<a href="'.esc_url($slide['url']).'" rel="prettyPhoto[pp_gal_'.esc_attr($post->ID).']" ><img src="'.esc_url($slide['url']).'" width="'.esc_attr($slide['width']).'" height="'.esc_attr($slide['height']).'" alt="'.esc_attr($slide['alt']).'" title="'.esc_attr($slide['title']).'"/></a>
												</div>
											';
											endif;
										endforeach;
									endif;
								endif;

								if ( $elbrus_portfolio_post_type == 'video' ) :
									$elbrus_portfolio_video_href = ( class_exists( 'RW_Meta_Box' ) ) ? get_post_meta( get_the_ID(), 'portfolio_video_href', true ) : '';
									if ( $elbrus_portfolio_video_href != '' ) :
										$elbrus_portfolio_video_width = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_width') : '';
										$elbrus_portfolio_video_height = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_height') : '';
									$out .= '
										<li><a href="'.esc_url($elbrus_portfolio_video_href.'?width='.esc_attr($elbrus_portfolio_video_width).'&amp;height='. esc_attr($elbrus_portfolio_video_height)).'" rel="prettyPhoto[pp_video_'.esc_attr(get_the_id()).']"><span class="icon icon-Media"></span></a></li>
									';
									endif;
								endif;

			$out .= '
									<li><a href="'.esc_url( get_permalink( get_the_ID() ) ).'"><span class="icon icon-Info"></span></a></li>
								</ul>
							</div>
						</div>
						<div class="portfolio-item-footer">
							<div class="name">'.wp_kses_post( get_the_title() ).'</div>
							<div class="under-name">'.wp_kses_post($portfolio_link_term).'</div>
						</div>
					</div>
				</div>

			';

			endif;

		endwhile;

		$out .= '
		</div>
		';

		if ( get_next_posts_link( '', $wp_query->max_num_pages ) ) {
			if ( $btnshow == 'yes' || $btnshow == "" ) {

				$out .= '
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="portfolio-pagination">
								<span data-current="'.esc_attr($paged).'" data-max-pages="'.esc_attr($wp_query->max_num_pages).'" class="load-more">' . get_next_posts_link( wp_kses_post($btntext), $wp_query->max_num_pages) . '</span>
							</div>
							<div class="portfolio-pagination-loading">
								<a href="javascript: void(0)" class="btn btn-default">'. esc_html__("Loading...", "elbrus") .'</a>
							</div>
						</div>
					</div>
				';
			}
		}

	endif;

$out .= '</div>';
endif;

wp_reset_postdata();

echo $out;