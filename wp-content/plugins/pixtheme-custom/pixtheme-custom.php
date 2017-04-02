<?php
/***********************************

	Plugin Name:  PixthemeCustom
	Plugin URI:   http://pix-theme.com/plugins/pixtheme-custom
	Description:  Additional functionality for Elbrus theme
	Version:      1.0
	Author:       PixTheme
	Author URI:   http://pix-theme.com
	License:      GPLv2 or later
	Text Domain:  PixTheme
	Domain Path:  /languages/

***********************************/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // disable direct access
}

add_action('plugins_loaded', 'pixtheme_load_textdomain');
function pixtheme_load_textdomain() {
	load_plugin_textdomain( 'PixTheme', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

if ( ! class_exists( 'PixthemeCustom' ) ) :

	class PixthemeCustom {

		public function __construct( ) {
			// Register the post type and taxonomy.
			add_action( 'init', array( $this, 'pixtheme_init_staticblocks' ) );
			add_action( 'init', array( $this, 'pixtheme_portfolio_register' ) );
			add_filter( 'manage_edit-portfolio_columns', array( $this, 'pixtheme_portfolio_edit_columns') );
			add_action( 'manage_posts_custom_column',  array( $this, 'pixtheme_portfolio_custom_columns') );
			add_filter( 'post_type_link', array( $this, 'pixtheme_post_type_link_filter_function' ), 1, 3 );
			add_action( 'admin_menu', array( $this, 'pixtheme_register_portfolio_menu' ) );
			add_action( 'wp_ajax_pixtheme_portfolio_update_post_order', array( $this, 'pixtheme_portfolio_update_post_order' ) );
			add_shortcode( 'share', array( $this, 'pixtheme_pix_share_buttons' ) );
			add_action('admin_enqueue_scripts', array( $this, 'pixtheme_custom_admin_enqueue_scripts' ));
		}

		/************* STATICBLOCK ***************/
		public function pixtheme_init_staticblocks(){
			$labels = array(
				'name'               => esc_html_x( 'Static Blocks', 'post type general name', 'PixTheme' ),
				'singular_name'      => esc_html_x( 'Static Block', 'post type singular name', 'PixTheme' ),
				'menu_name'          => esc_html_x( 'Static Blocks', 'admin menu', 'PixTheme' ),
				'name_admin_bar'     => esc_html_x( 'Static Block', 'add new on admin bar', 'PixTheme' ),
				'add_new'            => esc_html_x( 'Add New', 'book', 'PixTheme' ),
				'add_new_item'       => esc_html__( 'Add New Block', 'PixTheme' ),
				'new_item'           => esc_html__( 'New Block', 'PixTheme' ),
				'edit_item'          => esc_html__( 'Edit Block', 'PixTheme' ),
				'view_item'          => esc_html__( 'View Block', 'PixTheme' ),
				'all_items'          => esc_html__( 'All Blocks', 'PixTheme' ),
				'search_items'       => esc_html__( 'Search Block', 'PixTheme' ),
				'parent_item_colon'  => esc_html__( 'Parent Block:', 'PixTheme' ),
				'not_found'          => esc_html__( 'No blocks found.', 'PixTheme' ),
				'not_found_in_trash' => esc_html__( 'No blocks found in Trash.', 'PixTheme' )
			);

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'staticblock' ),
				'capability_type'    => 'post',
				'has_archive'        => 'staticblocks',
				'hierarchical'       => false,
				'menu_position'      => 8,
				'supports'           => array( 'title', 'editor',  'thumbnail', 'page-attributes', 'comments' ),
				'menu_icon'			 => plugins_url( '/img/pix-static.png', __FILE__ )
			);


			register_post_type( 'staticblocks', $args );
		}

		/************* PORTFOLIO ***************/
		public function pixtheme_portfolio_register() {

			if ( ! post_type_exists( 'portfolio' ) ) {
				register_post_type( 'portfolio' ,
									array(
										'label' => 'Portfolio',
										'singular_label' => 'Portfolio',
										'exclude_from_search' => true,
										'publicly_queryable' => true,
										'menu_position' => null,
										'show_ui' => true,
										'public'  =>   true,
										'show_in_menu'  =>   true,
										'show_in_nav_menus' => true,
										'menu_icon'     =>   plugins_url( '/img/pix-portfolio.png', __FILE__ ),
										'query_var' => true,
										'capability_type' => 'page',
										'hierarchical' => false,
										'has_archive' => true,
										'edit_item' => esc_html__( 'Edit Work', 'PixTheme'),
										'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
									)
								);
			}

			$labels = array(
				'name'              => esc_html__( 'Portfolio categories', 'PixTheme' ),
				'singular_name'     => esc_html__( 'Portfolio category', 'PixTheme' ),
				'search_items'      => esc_html__( 'Search Portfolio categories', 'PixTheme' ),
				'all_items'         => esc_html__( 'All Portfolio categories', 'PixTheme' ),
				'parent_item'       => esc_html__( 'Parent Portfolio category', 'PixTheme' ),
				'parent_item_colon' => esc_html__( 'Parent Portfolio category:', 'PixTheme' ),
				'edit_item'         => esc_html__( 'Edit Portfolio category', 'PixTheme' ),
				'update_item'       => esc_html__( 'Update Portfolio category', 'PixTheme' ),
				'add_new_item'      => esc_html__( 'Add New Portfolio category', 'PixTheme' ),
				'new_item_name'     => esc_html__( 'New Portfolio category Name', 'PixTheme' ),
				'menu_name'         => esc_html__( 'Portfolio category', 'PixTheme' ),
			);

			$args = array(
				'label'                 => '',
				'labels'                => $labels,
				'public'                => true,
				'show_in_nav_menus'     => true,
				'show_tagcloud'         => false,
				'hierarchical'          => true,
				'rewrite' => array('slug' => 'portfolio_category' , 'with_front' => false),
				'query_var' => true
			);

			register_taxonomy( 'portfolio_category', array('portfolio'), $args );

		}

		function pixtheme_portfolio_edit_columns($columns){
			$columns = array(
				'cb' => '<input type="checkbox" />',
				'portfolio_image' => 'Image Preview',
				'title' => 'Title',
				'portfolio_category' => 'Category',
				'portfolio_description' => 'Description',

			);

			return $columns;
		}

		function pixtheme_portfolio_custom_columns($column){
			global $post;
			switch ($column)
			{
				case "portfolio_category":
					echo get_the_term_list($post->ID, 'portfolio_category', '', ', ','');
					break;

				case 'portfolio_description':
					the_excerpt();
					break;

				case 'portfolio_image':
					the_post_thumbnail( array(100, 100) );
					break;
			}
		}

		public function pixtheme_post_type_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {
			if ( strpos('%portfolio_category%', $post_link)  < 0 ) {
			  return $post_link;
			}
			$post = get_post($id);
			if ( !is_object($post) || $post->post_type != 'portfolio' ) {
			  return $post_link;
			}
			$terms = wp_get_object_terms($post->ID, 'portfolio_category');
			if ( !$terms ) {
			  return str_replace('portfolio/category/%portfolio_category%/', '', $post_link);
			}
			return str_replace('%portfolio_category%', $terms[0]->slug, $post_link);
		}

		public function pixtheme_register_portfolio_menu() {
			add_submenu_page(
				'edit.php?post_type=portfolio',
				'Order portfolio',
				'Sort items',
				'edit_pages', 'portfolio-order',
				 array( $this, 'pixtheme_portfolio_order_page' )
			);
		}

		public function pixtheme_portfolio_order_page() {
			?></pre>
			<div class="wrap">
				<h2>Sort Items</h2>
				Simply drag the items up or down and they will be saved in that order.

				<?php $slides = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ) ) ); ?>
				<table id="sortable-table-portfolio" class="wp-list-table widefat fixed posts">
					<thead>
						<tr>
							<th class="column-order">Order</th>
							<th class="column-title">Title</th>
							<th class="column-thumbnail">Thumbnail</th>

						</tr>
					</thead>
					<tbody data-post-type="portfolio"><!--?php while( $products--->
						<?php if( $slides->have_posts() )  : ?>
							<?php while ($slides->have_posts()): $slides->the_post(); ?>
								<tr id="post-<?php esc_attr(the_ID()); ?>">
									<td class="column-order"><img title="" src="<?php echo esc_url(plugins_url( '/img/move-icon-vertical.png', __FILE__ )); ?>" alt="Move Icon" height="32" /></td>
									<td class="column-title"><strong><?php the_title(); ?></strong></td>
									<td class="column-thumbnail"><?php the_post_thumbnail( 'thumbnail' ); ?></td>
								 </tr>
							<?php endwhile; ?>
						<?php else : ?>
							No portfolio items found, make sure you create one.
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>
					</tbody>
					<tfoot>
						<tr>
							<th class="column-order">Order</th>
							<th class="column-title">Title</th>
							<th class="column-thumbnail">Thumbnail</th>
						</tr>
					</tfoot>
				</table>
			</div>
			<pre>
			<!-- .wrap -->
			<?php
		}

		public function pixtheme_portfolio_update_post_order() {
			global $wpdb;

			$post_type    = $_POST['postType'];
			$order        = $_POST['order'];

			/**
			*    Expect: $sorted = array(
			*                menu_order => post-XX
			*            );
			*
			*/

			foreach ($order as $menu_order => $post_id) {
				$post_id        = intval( str_ireplace( 'post-', '', $post_id ) );
				$menu_order     = intval( $menu_order );

				wp_update_post( array( 'ID' => $post_id, 'menu_order' => $menu_order ) );

			}

			die( '1' );
		}

		public function pixtheme_pix_share_buttons($atts, $content=NULL) {

			extract(shortcode_atts(array(
				'post_type'=>'',
			), $atts));

			global $post;
			if ( ! isset($post->ID) ) return;
			$permalink = get_permalink($post->ID);
			$image =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'elbrus-preview-thumb' );

			$post_title = rawurlencode( get_the_title($post->ID) );

			$out='
					<ul class="list-socials">
						<li><a href="https://twitter.com/share?url='.esc_url($permalink).'&text='.esc_attr($post_title).'" title="'.esc_attr__('Twitter', 'PixTheme').'" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<li><a href="http://www.facebook.com/sharer.php?u='.esc_url($permalink).'&amp;images='.esc_url($image[0]).'" title="'.esc_attr__('Facebook', 'PixTheme').'" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li><a href="http://plus.google.com/share?url='.esc_url($permalink).'&title='.esc_attr($post_title).'" title="'.esc_attr__('Google +', 'PixTheme').'" target="_blank"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="http://pinterest.com/pin/create/button/?url='.esc_url($permalink).'&amp;media='.esc_url($image[0]).'&amp;description='.esc_attr($post_title).'" title="'.esc_attr__('Pinterest', 'PixTheme').'" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
					</ul>
			';

			return $out;
		}

		//Load Admin Scripts
		public function pixtheme_custom_admin_enqueue_scripts() {
			wp_register_script('pixtheme_plugin_admin_script', plugins_url( '/js/admin.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script('pixtheme_plugin_admin_script');

			wp_register_style('pixtheme_plugin_admin_style', plugins_url( '/css/admin.css', __FILE__ ), array(), '1.0.0', 'screen, all' );
			wp_enqueue_style('pixtheme_plugin_admin_style');
		}


	}

endif;

new PixthemeCustom();

add_action('init', 'pixtheme_twitter_register');
function pixtheme_twitter_register(){
	require_once( 'twitteroauth/twitteroauth.php' );
}