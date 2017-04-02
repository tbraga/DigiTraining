<?php

function elbrus_show_sidebar($type, $layout, $sidebar) {

	$layouts = array(
		1 => 'full',
		2 => 'right',
		3 => 'left',
	);

	if ( isset($layouts[$layout]) && $type === $layouts[$layout] ) {
		echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 sidebar">';
		if ( is_active_sidebar( $sidebar ) ) : dynamic_sidebar( $sidebar ); endif;
		echo '</div>';
	} else {
		echo '';
	}

}

function elbrus_limit_words( $string, $word_limit ) {

	$string = preg_replace( "#\[.*?\]#is", '', $string );
	$string = wp_trim_words( $string, $word_limit, ' [...]' );

	return $string;
}

/********************* MENU ***********************/

/* MENU WALKER */

class elbrus_Walker_Menu extends Walker_Nav_Menu {
	/**
	* Display Element
	*/
	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		$id_field = $this->db_fields['id'];

		if ( isset( $args[0] ) && is_object( $args[0] ) )
		{
		  $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
	}

	return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	* Start Element
	*/
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( is_object($args) && !empty($args->has_children) )
		{

			$link_after = $args->link_after;
			$args->link_after = ' <span class="caret"></span>';
			array_push($item->classes, "dropdown");
		}


		parent::start_el($output, $item, $depth, $args, $id);

		if ( is_object($args) && !empty($args->has_children) )
			$args->link_after = $link_after;
	}

	/**
	* Start Level
	*/
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class=\"wrap-inside-nav\">\n<div class=\"inside-col\">\n<ul class=\"inside-nav\">\n";
	}

	/**
	* End Level
	*/
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n</div>\n</div>\n";
	}

}

/* END MENU WALKER */

/********************************************/


/************* COMMENTS HOOK *************/

function elbrus_comments_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('media'); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-item">
			<div class="media-left">
				<?php
				get_avatar( $comment, $size = '80' );
				$get_avatar = get_avatar($comment);
				preg_match("/src=['\"](.*?)['\"]/i", $get_avatar, $matches);
				$src = !empty($matches[1]) ? $matches[1] : '';
				?>
				<div class="avatar"><img  alt="<?php echo get_comment_author(); ?>" src="<?php echo !empty($src) ? esc_url($src) : esc_url(get_template_directory_uri() . '/img/nouser.jpg'); ?>" ></div>
			</div>

			<div class="media-body">
				<div class="comment-title">
					<span class="name"><?php echo get_comment_author_link(); ?></span>
					<span><?php echo ' ' . esc_html__( 'says', 'elbrus' ) . ' '; ?></span>
					<em><?php printf(esc_html__('%1$s at %2$s', 'elbrus'), get_comment_date(),get_comment_time()) ?></em>
					<?php edit_comment_link(esc_html__('Edit', 'elbrus' ),'  ','') ?>
				</div>
				<div class="comment-body">
					<div class="comment-text rtd"><?php comment_text(); ?></div>
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php if ($comment->comment_approved == '0') : ?>
						<span class="not-approve"><?php esc_html_e('Your comment is awaiting moderation.', 'elbrus' ); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
<?php }

function elbrus_comments_end_callback() {
	echo '</li>';
}

add_filter('comment_reply_link', 'elbrus_replace_reply_link_class');
function elbrus_replace_reply_link_class($class){
	$class = str_replace("class='comment-reply-link", "class='comment-reply-link btn btn-default", $class);
	return $class;
}

/*****************************************/

//Change the order of the output fields comment form
add_filter('comment_form_fields', 'elbrus_reorder_comment_fields' );
function elbrus_reorder_comment_fields( $fields ){

	if ( is_single() && get_post_type() == 'post' || get_post_type() == 'page' ) {

		$new_fields = array();

		$myorder = array('author','email','url','comment');

		foreach( $myorder as $key ){
			$new_fields[ $key ] = $fields[ $key ];
			unset( $fields[ $key ] );
		}

		if( $fields )
			foreach( $fields as $key => $val )
				$new_fields[ $key ] = $val;

		return $new_fields;

	} else {

		return $fields;

	}
}

// Displays the taxonomy of the post

function elbrus_post_terms( $args = array() ) {
	$html = elbrus_get_post_terms( $args );
	echo wp_kses_post( $html );
}

function elbrus_get_post_terms( $args = array() ) {

	$html = '';

	$defaults = array(
		'post_id'    => get_the_ID(),
		'taxonomy'   => 'category',
		'text'       => '%s',
		'before'     => '',
		'after'      => '',
		'items_wrap' => '<span>%s</span>',
		'sep'        => _x( ', ', 'taxonomy terms separator', 'elbrus' )
	);

	$args = wp_parse_args( $args, $defaults );

	$terms = get_the_term_list( $args['post_id'], $args['taxonomy'], '', $args['sep'], '' );

	if ( !empty( $terms ) ) {
		$html .= $args['before'];
		$html .= sprintf( $args['items_wrap'], sprintf( $args['text'], $terms ) );
		$html .= $args['after'];
	}

	return $html;
}

// numbered pagination
function elbrus_num_pagination( $pages = '', $range = 2 ) {
	 $showitems = ( $range * 2 ) + 1;

	 global $paged;
	 if ( empty( $paged ) )  { $paged = 1; }

	 if ( $pages == '' )
	 {
		 global $wp_query;
		 $pages = $wp_query->max_num_pages;
		 if ( ! $pages ) { $pages = 1; }
	 }

	 if ( 1 != $pages )
	 {
		 echo '<div class="row wrap-pagination"><div class="col-md-12"><ul class="pagination-list clearfix">';

		 if ( $paged > 1 && $showitems < $pages ) echo '<li><a href="' . esc_url( get_pagenum_link( esc_html( $paged ) - 1 ) ) . '"><i class="fa-chevron-left"></i></a></li>';

		 for ( $i = 1; $i <= $pages; $i++ )
		 {
			 if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) )
			 {
				echo ( $paged == $i ) ? '<li class="active"><a href="#">' . $i . '</a></li>' : '<li><a href="' . esc_url( get_pagenum_link($i) ) . '">' . esc_html( $i ) . '</a></li>';
			 }
		 }

		 if ( $paged < $pages && $showitems < $pages ) echo '<li><a href="' . esc_url( get_pagenum_link( esc_html( $paged ) + 1 ) ) . '"><i class="fa-chevron-right"></i></a></li>';

		 echo '</ul></div></div>';
	 }
}


function elbrus_pix_wp_get_attachment( $attachment_id ) {
	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

// Add class to links generated by next_posts_link and previous_posts_link
add_filter( 'next_posts_link_attributes', 'elbrus_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'elbrus_posts_link_attributes' );

function elbrus_posts_link_attributes() {
	return 'class="btn btn-default"';
}

// pagination custom post type
function elbrus_category_portfolio_per_page( $query ) {
	if ( is_admin()  )
		return;

	if ( is_tax( 'portfolio_category' ) ) {
		$portfolio_perpage = elbrus_get_option('portfolio_settings_perpage');
		if ( is_numeric( $portfolio_perpage ) && $portfolio_perpage > 0 ) {
			$perpage = $portfolio_perpage;
		}
		else {
			$perpage = -1;
		}
		// Display n posts for a custom post type 'portfolio' on page portfolio category taxonomy
		$query->set( 'posts_per_page', $perpage );
		return;
	}
}
add_action( 'pre_get_posts', 'elbrus_category_portfolio_per_page' );


function elbrus_change_posttype() {
  if ( is_tax( 'portfolio_category' ) && !is_admin() ) {
	set_query_var( 'post_type', array( 'post', 'portfolio' ) );
  }
  return;
}
add_action( 'parse_query', 'elbrus_change_posttype' );

//page comment open by default
function elbrus_open_comments_for_page( $status, $post_type, $comment_type ) {
	if ( 'page' === $post_type ) {
		return 'open';
	}

	// You could be more specific here for different comment types if desired
	return $status;
}

add_filter( 'get_default_comment_status', 'elbrus_open_comments_for_page', 10, 3 );

// meta box
if ( ! function_exists( 'rwmb_meta' ) ) {
	function rwmb_meta( $key, $args = '', $post_id = null ) {
		return false;
	}
}

// Enqueue the Google fonts
function elbrus_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Montserrat, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$montserrat = esc_html_x( 'on', 'Montserrat font: on or off', 'elbrus' );

	/* Translators: If there are characters in your language that are not
	* supported by Playfair, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$playfair = esc_html_x( 'on', 'Playfair font: on or off', 'elbrus' );

	/* Translators: If there are characters in your language that are not
	* supported by Raleway, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$raleway = esc_html_x( 'on', 'Raleway font: on or off', 'elbrus' );

	if ( 'off' !== $montserrat || 'off' !== $playfair || 'off' !== $raleway ) {
		$font_families = array();

		if ( 'off' !== $montserrat ) {
			$font_families[] = 'Montserrat:400,700';
		}

		if ( 'off' !== $playfair ) {
			$font_families[] = 'Playfair+Display:400,400italic,700,700italic';
		}

		if ( 'off' !== $raleway ) {
			$font_families[] = 'Raleway:400,700,300';
		}

		$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' )
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'elbrus_is_woocommerce_activated' ) ) {
	function elbrus_is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}