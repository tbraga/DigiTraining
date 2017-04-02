<?php /** Is coming */?>
<?php
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 );

	add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {
		function loop_columns() {
			return 3; // 3 products per row
		}
	}

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */
add_filter( 'woocommerce_output_related_products_args', 'elbrus_related_products_args' );
function elbrus_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}