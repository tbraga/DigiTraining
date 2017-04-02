<?php
	$topFooterBlockId = false;
	$bottomFooterBlockId = false;

	$fpost = ( $wp_query->get_queried_object_id() ) ? $wp_query->get_queried_object_id() : (isset($post->ID) && $post->ID>0 ? $post->ID : '');

	$topFooterBlockId = in_array(get_post_meta($fpost, 'pix_page_top_footer_staticblock', true), array('global', '')) || $fpost == '' ? elbrus_get_option('footer_block_top') : get_post_meta($fpost, 'pix_page_top_footer_staticblock', true);
	$bottomFooterBlockId = in_array(get_post_meta($fpost, 'pix_page_footer_staticblock', true), array('global', '')) || $fpost == '' ? elbrus_get_option('footer_block') : get_post_meta($fpost, 'pix_page_footer_staticblock', true);

?>
		<!-- ========================== -->
		<!-- FOOTER -->
		<!-- ========================== -->

		<footer class="rtd" >
			<div class="container">
			<?php if ( $bottomFooterBlockId ) { elbrus_get_staticblock_content($bottomFooterBlockId); } ?>
			</div>
		</footer>

		<?php wp_footer(); ?>

		<!-- Start of HubSpot Embed Code -->
		<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/3048022.js"></script>
		<!-- End of HubSpot Embed Code -->

	</body>
</html>