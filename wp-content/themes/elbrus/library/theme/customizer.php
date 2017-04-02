<?php

if ( is_customize_preview()  ) {
	function elbrus_customizer_preview_css() {

		$elbrus_main_color = elbrus_get_option( 'style_settings_main_color', get_option('elbrus_default_main_color') );
        $elbrus_color_darker = elbrus_get_option( 'style_settings_additional_color_darker', get_option('elbrus_default_additional_color') );

		?>
		<style type="text/css">
			h5:after {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			ul.marker-list li:before {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.btn.btn-primary {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border: 1px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active:focus {
				background: <?php echo esc_attr($elbrus_color_darker); ?>;
				border-color: <?php echo esc_attr($elbrus_color_darker); ?>;
			}
			.btn.btn-primary-warning:hover {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			blockquote:before, .blockquote:before {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.post.sticky:after {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.header .navbar .navbar-nav > li.active > a {
				border-bottom: 1px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.header .navbar .navbar-nav > li > a:hover {
				border-bottom: 1px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.header .navbar .navbar-nav > li.current-menu-ancestor > a {
				border-bottom: 1px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.header .navbar .navbar-nav .open > a, .header .navbar .navbar-nav .open > a:focus, .header .navbar .navbar-nav .open > a:hover {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.header .navbar .navbar-nav.wrap-user-control li {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.header .navbar .navbar-nav.wrap-user-control li a {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.wrap-inside-nav {
				border-top: 2px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.wrap-inside-nav .inside-col .inside-nav li.active > a {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.wrap-inside-nav .inside-col .inside-nav li a:active, .wrap-inside-nav .inside-col .inside-nav li a:focus {
				color: <?php echo esc_attr($elbrus_main_color); ?> !important;
			}
			.wrap-inside-nav .inside-col .inside-nav li a:hover, .wrap-inside-nav .inside-col .inside-nav li a:active:hover, .wrap-inside-nav .inside-col .inside-nav li a:visited:hover, .wrap-inside-nav .inside-col .inside-nav li a:focus:hover {
				color: <?php echo esc_attr($elbrus_main_color); ?> !important;
			}
			.social-section .list-socials li a:hover {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.elbrus_flickr h5:after {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.fobox h5:after {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.fobox a:hover {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.text-white .fobox a:hover {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.sidebar .sidebar-item ul li.current-cat > a, .sidebar .sidebar-item ul li.current_page_item > a {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.sidebar .widget_archive ul li a:before, .sidebar .widget_categories ul li a:before, .sidebar .widget_pages ul li a:before, .sidebar .widget_nav_menu ul li a:before, .sidebar .widget_portfolio_category ul li a:before {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.sidebar .widget_search .icon {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.sidebar .tagcloud a:hover {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.sidebar .widget_rss .widget-title .rsswidget:hover {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.sidebar .widget_pix_totalposts .nav-tabs li.active a, .sidebar .widget_pix_totalposts .nav-tabs li:hover a {
				border-top: 1px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.latest-works-section .scroll-pane .scroll-content-item .name:before {
				border: 2px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.video-section .btn-play {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.icon-contact-block .type-info span {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.elbrus-contact-form input[type="submit"] {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border: 1px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.elbrus-contact-form input[type="submit"]:hover, .elbrus-contact-form input[type="submit"]:focus, .elbrus-contact-form input[type="submit"]:active:focus {
				background: <?php echo esc_attr($elbrus_color_darker); ?>;
				border-color: <?php echo esc_attr($elbrus_color_darker); ?>;
			}
			.elbrus-mc4wp .icon {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.portfolio-single-section .work-heading .controls ul li a:hover .fa {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.portfolio-single-section .work-image .image .controls .big-view a {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.portfolio-single-section .work-image .image .controls .big-view a:hover {
				background: <?php echo esc_attr($elbrus_color_darker); ?>;
			}
			.portfolio-single-section .work-image .owl-controls .owl-pagination .owl-page.active {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.offers-section .text-item:after {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.blog-content-section .left-column .wrap-blog-post .wrap-linked-image {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.blog-content-section .left-column .wrap-blog-post .post-body-title:after {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.blog-content-section .left-column .wrap-blog-post .list-socials li a:hover {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
				-moz-box-shadow: 0 0 1px <?php echo esc_attr($elbrus_color_darker); ?> inset;
				-webkit-box-shadow: 0 0 1px <?php echo esc_attr($elbrus_color_darker); ?> inset;
				box-shadow: 0 0 1px <?php echo esc_attr($elbrus_color_darker); ?> inset;
			}
			#page-preloader .spinner {
				border-top-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.wrap-pagination .pagination-list li a:hover {
				-moz-box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				-webkit-box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.wrap-pagination .pagination-list li.active a {
				-moz-box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				-webkit-box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.vc_row_anchor .wrap-anchor .wrap-anchor-link:hover .section-icon:after {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.twitter .slider-title i {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.twitter .wrap-section-slider .owl-controls .owl-pagination .owl-page.active {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.text-black .twitter .slider-title i {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.section-heading .design-arrow:after {
				border: 2px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.service-item:hover .wrap-service-icon .service-icon {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.text-white .service-item:hover .wrap-service-icon .service-icon {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.plan-item.active {
				border-top: 5px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.plan-item.active .item-footer .btn {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.plan-item .item-heading .name {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.plan-item .item-footer .btn:hover {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.news-item .news-body h5:after {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.news-item .image .read-more:before {
				border: 2px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.feature-item:hover .wrap-feature-icon, .feature-item.active .wrap-feature-icon {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.feature-item:hover .wrap-feature-icon .feature-icon, .feature-item.active .wrap-feature-icon .feature-icon {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_color_darker); ?>;
			}
			.feature-item .title:after {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.text-white .feature-item:hover .wrap-feature-icon, .text-white .feature-item.active .wrap-feature-icon {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.text-white .feature-item:hover .wrap-feature-icon .feature-icon, .text-white .feature-item.active .wrap-feature-icon .feature-icon {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_color_darker); ?>;
			}
			.wpb_column + .wpb_column .achieve-item:before {
				border: 2px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.step-item.invert .item-icon {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.step-item .item-icon:before {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.team-slider .slick-list .slick-track .slide-item .slide-description .contacts {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.one-team-item .slide-description .contacts {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.portfolio-item .portfolio-image .portfolio-item-body.center-body ul li a:hover {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.portfolio-item .portfolio-image .portfolio-item-body .name:before {
				border: 2px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.folio-isotop-filter ul > li a:hover {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.folio-isotop-filter ul > li a:hover:after {
				border-top-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.folio-isotop-filter ul > li a.selected {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.folio-isotop-filter ul > li a.selected:after {
				border-top-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.wrap-timeline .time-item .date {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.wrap-timeline .plus .plus-ico:hover {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.service-navigation ul li.active .navigation-icon, .service-navigation ul li:hover .navigation-icon {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.service-navigation ul li.active .navigation-icon:after, .service-navigation ul li:hover .navigation-icon:after {
				border-top-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.service-navigation ul li.active .navigation-icon span, .service-navigation ul li:hover .navigation-icon span {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_color_darker); ?>;
			}
			.service-navigation .navigation-item h5:after {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.social-list li a:hover {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
				border-color: <?php echo esc_attr($elbrus_main_color); ?>;
				-moz-box-shadow: 0 0 1px <?php echo esc_attr($elbrus_color_darker); ?> inset;
				-webkit-box-shadow: 0 0 1px <?php echo esc_attr($elbrus_color_darker); ?> inset;
				box-shadow: 0 0 1px <?php echo esc_attr($elbrus_color_darker); ?> inset;
			}
			.plan-item .item-body ul li:before {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}

			body .yp-demo-link {
				background: <?php echo esc_attr($elbrus_main_color); ?> !important;
			}

			body .yp-demo-link:hover,
			body .yp-demo-link:active,
			body .yp-demo-link:focus {
					background: <?php echo esc_attr($elbrus_color_darker); ?> !important;
			}

			/*-- woocommerce --*/
			.rtd .page-title:after, .rtd .related h2:after {
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			p.demo_store {
				background-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.woocommerce .woocommerce-error, .woocommerce .woocommerce-info, .woocommerce .woocommerce-message {
				border-top: 3px solid <?php echo esc_attr($elbrus_main_color); ?> ;
			}
			.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current {
				-moz-box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				-webkit-box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.woocommerce nav.woocommerce-pagination ul li span.current {
				-moz-box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				-webkit-box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				box-shadow: 0 0 0 1px <?php echo esc_attr($elbrus_main_color); ?> inset;
				background: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
				background-color: <?php echo esc_attr($elbrus_main_color); ?>;
				border: 1px solid <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,
			.woocommerce #respond input#submit:focus, .woocommerce a.button:focus, .woocommerce button.button:focus, .woocommerce input.button:focus {
				background-color: <?php echo esc_attr($elbrus_color_darker); ?>;
				border-color: <?php echo esc_attr($elbrus_color_darker); ?>;
			}
			.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {
				background-color: <?php echo esc_attr($elbrus_color_darker); ?>;
				border-color: <?php echo esc_attr($elbrus_color_darker); ?>;
			}
			.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover {
				background-color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
				background-color: <?php echo esc_attr($elbrus_main_color); ?> ;
			}
			.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
				background-color: <?php echo esc_attr($elbrus_main_color); ?>
			}
			.widget_product_search .icon {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}
			.sidebar .widget_product_categories ul li a:before {
				color: <?php echo esc_attr($elbrus_main_color); ?>;
			}

			<?php if ( elbrus_get_option('style_settings_custom_css') != '' ) : ?>
			<?php echo esc_html( elbrus_get_option('style_settings_custom_css') ); ?>
			<?php endif; ?>

			@media (max-width: 767px) {
				.wrap-inside-nav .wrap-inside-nav {
					border-top: 2px solid <?php echo esc_attr($elbrus_main_color); ?>;
					border-bottom: 2px solid <?php echo esc_attr($elbrus_main_color); ?>;
				}
			}
		</style>
		<?php
	}
	add_action( 'wp_head', 'elbrus_customizer_preview_css' );
}