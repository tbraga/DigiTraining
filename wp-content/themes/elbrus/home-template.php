<?php
/**
 * The template for displaying Home page (full width).
 *
 * @package Elbrus
 * @since 1.0
 *
 * Template Name: Home Full Width
 */

get_header(); ?>

<div class="home-section">
	<div class="container rtd">
	<?php
	if ( have_posts() ) :
		 while ( have_posts() ) : the_post();

			the_content();

		endwhile;
	endif;
	?>

	</div>
</div>

<?php get_footer(); ?>