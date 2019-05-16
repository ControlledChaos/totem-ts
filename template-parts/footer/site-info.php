<?php
/**
 * Displays footer site info
 *
 * @package    WordPress
 * @subpackage Totem_Twenty_Seventeen
 * @since      1.0.0
 */

// Get the site name.
$site_name = esc_attr( get_bloginfo( 'name' ) );

// Copyright paragraph.
$copyright_text = sprintf(
	'<p class="copyright-text" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">&copy; <span class="screen-reader-text">%1s</span><span itemprop="copyrightYear">%2s</span> <span itemprop="copyrightHolder">%3s.</span> %4s.</p>',
	esc_html__( 'Copyright ', 'totem-ts' ),
	get_the_time( 'Y' ),
	$site_name,
	esc_html__( 'All rights reserved', 'totem-ts' )
);

// Apply a filter for customization.
$copyright = apply_filters( 'tts_copyright_text', $copyright_text );
?>
<div class="site-info">
	<?php echo $copyright ?>
</div><!-- .site-info -->
