<?php
/* Woocommerce template. */
$elbrus_id = elbrus_woo_get_page_id();
$elbrus_isProduct = false;

if ( is_single() && get_post_type() == 'product' ) {
	$elbrus_isProduct = true;
}

$elbrus_custom = $elbrus_id > 0 ? get_post_custom($elbrus_id) : array();
$elbrus_layout = isset ($elbrus_custom['pix_page_layout']) ? reset($elbrus_custom['pix_page_layout']) : '2';
$elbrus_sidebar = isset ($elbrus_custom['pix_selected_sidebar'][0]) ? reset($elbrus_custom['pix_selected_sidebar']) : 'sidebar-1';

if ( $elbrus_isProduct === true ) {
	$elbrus_useSettingsGlobal = elbrus_get_option( 'shop_settings_global_product', 'on' );
	if ( $elbrus_useSettingsGlobal == 'on' ) {
		$elbrus_layout = elbrus_get_option( 'shop_settings_sidebar_type', '2');
		$elbrus_sidebar = elbrus_get_option( 'shop_settings_sidebar_content', 'product-sidebar-1' );
	}
}

if ( ! is_active_sidebar($elbrus_sidebar) ) $elbrus_layout = '1';

get_header(); ?>


<section class="page-section">
	<div class="container">
		<div class="row">
			<main class="main-content">

				<?php elbrus_show_sidebar( 'left', $elbrus_layout, $elbrus_sidebar ); ?>

				<div class="rtd <?php if ( $elbrus_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($elbrus_layout); ?>">

					<?php  woocommerce_content(); ?>

				</div>

				<?php elbrus_show_sidebar( 'right', $elbrus_layout, $elbrus_sidebar ); ?>

			</main>

		</div>
	</div>
</section>

<?php get_footer();?>
