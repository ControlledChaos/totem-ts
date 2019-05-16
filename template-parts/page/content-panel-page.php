<?php
/**
 * Template part for displaying page content in front-page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    WordPress
 * @subpackage Totem_Twenty_Seventeen
 * @since      1.0.0
 */

$panel_notice = sprintf(
	'<p><strong>%1s</strong> %2s</p>',
	esc_html__( 'Note:', 'totem-ts' ),
	esc_html__( 'This page is used as a section of the composite front page and may be somewhat incoherent out of context.', 'totem-ts' )
);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php echo $panel_notice; ?>
		<?php twentyseventeen_edit_link( get_the_ID() ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->