<?php
/**
 * The template for displaying pages to be used
 * as panels on the composite front page.
 *
 * Template Name: Front Panel
 * Template Post Type: page
 *
 * @package    WordPress
 * @subpackage Totem_Twenty_Seventeen
 * @since      1.0.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'panel-page' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
