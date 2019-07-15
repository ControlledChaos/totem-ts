<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package    WordPress
 * @subpackage Totem_Twenty_Seventeen
 * @since      1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Prefetch font URLs
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function tts_prefetch_fonts() {

	$fonts  = '<link rel="dns-prefetch" href="//fonts.adobe.com" />';

	echo $fonts . "\n";

}
add_action( 'wp_head', 'tts_prefetch_fonts', 1 );

/**
 * Add custom classes to the array of body classes
 *
 * @param array $classes Classes for the body element.
 * @since  1.0.0
 * @access public
 * @return array
 */
function tts_theme_body_classes( $classes ) {

	// Check if we and/or Adobe are online.
	$adobe = checkdnsrr( 'adobe.com' );

	/**
	 * Add a class of no-adobe if Adobe check fails.
	 *
	 * Used for theme font conflicts with font-weights in stylesheets.
	 */
	if ( ! $adobe ) {
		$classes[] = 'no-adobe';
	}

	// Add a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;

}
add_filter( 'body_class', 'tts_theme_body_classes' );