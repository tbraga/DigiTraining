<?php
/**
* Header Template
*
* Here we setup all logic and XHTML that is required for the header section of all screens.
*
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> data-scrolling-animations="true">

		<?php
		if ( ( elbrus_get_option('general_settings_loader', 'off') == 'usemain' && is_front_page() ) || elbrus_get_option('general_settings_loader', 'off') == 'useall' ) {
		echo '<div id="page-preloader"><span class="spinner"></span></div>';
		}
		?>

		<!-- ========================== -->
		<!-- Navigation -->
		<!-- ========================== -->
		<header class="header scrolling-header">
			<nav id="nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container relative-nav-container">
					<a class="toggle-button visible-xs-block" data-toggle="collapse" data-target="#navbar-collapse">
						<i class="fa fa-navicon"></i>
					</a>
					<?php
					$elbrus_logo = elbrus_get_option( 'general_settings_logo' );
					$elbrus_logo_inverse = elbrus_get_option( 'general_settings_logo_inverse' );
					$elbrus_logo_mobile = elbrus_get_option( 'general_settings_logo_mobile' );
					?>
					<a class="navbar-brand scroll" title="<?php echo esc_attr( bloginfo( 'name' ) ); ?>" href="<?php echo esc_url( home_url('/') ); ?>">
						<?php if ( ! empty( $elbrus_logo ) ) : ?>
							<img class="normal-logo hidden-xs" src="<?php echo esc_url($elbrus_logo); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
						<?php else : ?>
							<img class="normal-logo hidden-xs" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
						<?php endif; ?>
						<?php if ( ! empty( $elbrus_logo_inverse ) ) : ?>
							<img class="scroll-logo hidden-xs" src="<?php echo esc_url($elbrus_logo_inverse); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
						<?php else : ?>
							<img class="scroll-logo hidden-xs" src="<?php echo get_template_directory_uri(); ?>/img/logo-dark.png" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
						<?php endif; ?>
						<?php if ( ! empty( $elbrus_logo_mobile ) ) : ?>
							<img class="scroll-logo visible-xs-block" src="<?php echo esc_url($elbrus_logo_mobile); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
						<?php else : ?>
							<img class="scroll-logo visible-xs-block" src="<?php echo get_template_directory_uri(); ?>/img/logo-free.png" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
						<?php endif; ?>
					</a>
			
					<ul class="nav navbar-nav navbar-right nav-icons wrap-user-control">
						<li>
							<a href="tel:800.555.5555">
								<i class="fa fa-phone"></i>&nbsp;
								<strong>
									<span>800.555.5555</span>
								</strong>
							</a>
						</li>
					</ul>
					
					<div class="navbar-collapse collapse floated" id="navbar-collapse">
						<?php
						if ( has_nav_menu( 'primary_menu' ) ) {
							wp_nav_menu(array(
								'theme_location'  => 'primary_menu',
								'container'       => 'ul',
								'menu_class'      => 'nav navbar-nav navbar-with-inside clearfix navbar-right with-border',
								'walker'          => new elbrus_Walker_Menu(),
							));
						} else {
						?>
						<ul class="nav navbar-nav navbar-with-inside clearfix navbar-right ">
						    <li><a target="_blank" href="<?php echo esc_url( admin_url() . 'nav-menus.php#locations-primary_menu' ) ?>">
						<?php esc_html_e( 'Please, set Primary Menu.', 'elbrus' ); ?>
                                </a></li>
						</ul>
						<?php
						}
						?>
					</div>
				</div>
				<div class="navbar-search ">
					<div class="container">
						<form action="<?php echo esc_url( site_url() ); ?>" role="search" method="get">
							<div class="input-group">
								<input type="text" class="form-control" name="s" id="global-search" value="<?php esc_attr(the_search_query()); ?>" placeholder="<?php esc_attr_e('Type your search...', 'elbrus');?>" autocomplete="off">
								<span class="input-group-btn">
									<button type="reset" class="btn search-close" id="search-close">
										<i class="fa fa-close"></i>
									</button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</nav>
		</header><!--./navigation -->

<?php if ( ! is_page_template('home-template.php') ) { require_once( get_template_directory() .'/templates/header/header.php' ); } ?>