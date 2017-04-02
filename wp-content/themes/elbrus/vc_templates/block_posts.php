<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $cat_post
 * @var $columns_number
 * @var $posts_count
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Block_Posts
 */

$cat_post = $columns_number = $posts_count = $css_animation = '';
$out = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

global $post;

$colnumber = ( $columns_number == '' ) ? '3' : $columns_number;
$add_post_class = ( $colnumber == '3' ) ? 'col-md-4 col-sm-4' : 'col-md-6 col-sm-6';
$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';

$elbrus_text_readmore = elbrus_get_option( 'blog_settings_readmore', esc_html__('Read more', 'elbrus' ) );
$post_categories = get_objects_in_term( explode( ",", $cat_post ), 'category');

$args = array(
			'ignore_sticky_posts' => true,
			'post__in' => $post_categories,
		);

if ( $posts_count != '' && is_numeric($posts_count) && $posts_count > 0 ) {
	$args['posts_per_page'] = $posts_count;
}
else {
	$args['posts_per_page'] = -1;
}

$wp_query = new WP_Query( $args );

$out .= '
	<div class="row blog-masonry-holder">
';

if ( $wp_query->have_posts() ) :
	while ( $wp_query->have_posts() ) :
		$wp_query->the_post();

		$date = ( elbrus_get_option( 'blog_show_date', 'on' ) == 'on' ) ? '<div class="meta-item"><span class="icon icon-Agenda"></span><a href="' . esc_url( get_the_permalink() ) . '">'.wp_kses_post(get_the_date()).'</a></div>' : '';
		$comm = ( comments_open() ) ? '<div class="meta-item"><span class="icon icon-Message"></span><a href="'.esc_url(get_the_permalink()).'#comments">'.get_comments_number($post->id).'</a></div>' : '';
		$tags = ( has_tag() && elbrus_get_option( 'blog_show_tags', 'on' ) == 'on' ) ? '<div class="meta-item"><span class="icon icon-Tag"></span>' . wp_kses_post( elbrus_get_post_terms( array( 'taxonomy' => 'post_tag' ) ) ) . '</div>' : '';
		$posttitle = ( get_the_title() != '' ) ? '<h5 class="post-title">'.wp_kses_post(get_the_title()).'</h5>' : '';

		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'elbrus-post-thumb-home');
		$thumbnail = isset($thumb[0]) && $thumb[0] != '' ? $thumb[0] : get_template_directory_uri().'/img/noimage.jpg';

		$get_avatar = get_avatar(get_the_author_meta('ID'), 60);
		preg_match("/src=['\"](.*?)['\"]/i", $get_avatar, $matches);
		$src = !empty($matches[1]) ? $matches[1] : '';

		$author = '';
		$author .= ( elbrus_get_option( 'blog_show_author', 'on' ) == 'on' && get_the_author_meta( 'user_url' ) != '' ) ? '
			<a class="avatar" href="'.esc_url(get_the_author_meta( 'user_url' )).'">
				<img class="" src="'.esc_url($src).'" alt="'.esc_attr(get_the_author_meta( 'display_name' )).'">
			</a>
		' : '';

		$author .= ( elbrus_get_option( 'blog_show_author', 'on' ) == 'on' && get_the_author_meta( 'user_url' ) == '' ) ? '
			<a class="avatar" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ).'">
				<img class="" src="'.esc_url($src).'" alt="'.esc_attr(get_the_author_meta( 'display_name' )).'">
			</a>
		' : '';

		$out .= '
			<div class="'. esc_attr($add_post_class) . ' ' . esc_attr($css_animation_class) . ' item">
				<div class="news-item">
					<div class="meta">
						' . wp_kses_post( $tags ) . '
						' . wp_kses_post( $date ) . '
						' . wp_kses_post( $comm ) . '
					</div>
					<div class="image">
						<a href="' . esc_url( get_the_permalink() ) . '">
							<img src="'.esc_url($thumbnail).'" alt="' . esc_attr( get_the_title() ) . '" />
							<div class="image-content">
								<span class="read-more">' . esc_attr( $elbrus_text_readmore ) . '</span>
							</div>
						</a>
					</div>
					<div class="user-avatar clearfix">
					' . wp_kses_post( $author ) . '
					</div>
					<div class="news-body">
						'.$posttitle.'
						<p>'.get_the_excerpt().'</p>
					</div>
				</div>
			</div>
		';

	endwhile;
endif;

$out .= '
	</div>
';

wp_reset_postdata();

echo $out;