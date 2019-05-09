<?php
/**
 * Totem Twenty Seventeen functions
 *
 * @package    WordPress
 * @subpackage Totem_Twenty_Seventeen
 * @since      1.0.0
 * @version    1.0.0
 */

 // If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Remove Twenty Seventeen styles & scripts
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function tts_remove_scripts() {

	// Google fonts.
	wp_dequeue_style( 'twentyseventeen-fonts' );
	wp_deregister_style( 'twentyseventeen-fonts' );

	// Block styles, since we'll use the classic editor.
	wp_dequeue_style( 'twentyseventeen-block-style' );
	wp_deregister_style( 'twentyseventeen-block-style' );
	wp_dequeue_style( 'wp-block-library' );
	wp_deregister_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_deregister_style( 'wp-block-library-theme' );

	// Dark color option.
    wp_dequeue_style( 'twentyseventeen-colors-dark' );
	wp_deregister_style( 'twentyseventeen-colors-dark' );

}
add_action( 'wp_print_styles', 'tts_remove_scripts', 20 );

/**
 * Enqueue styles & scripts
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function tts_styles() {

	/**
	 * Check if we and/or Adobe are online. If so, get Adobe fonts
	 * from their servers. Otherwise, get them from the theme directory.
	 */
	$adobe = checkdnsrr( 'adobe.com' );

	if ( $adobe ) {
		wp_enqueue_style( 'tts-fonts', 'https://use.typekit.net/fuf3mvk.css', [], '', 'screen' );
	} else {
		wp_enqueue_style( 'tts-headings', get_theme_file_uri( '/assets/fonts/roboto-slab/fonts.min.css' ), [], '', 'screen' );
		wp_enqueue_style( 'tts-body', get_theme_file_uri( '/assets/fonts/open-sans/fonts.min.css' ), [], '', 'screen' );
	}

    $parent_style = 'twentyseventeen-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

	/**
	 * Theme sylesheet
	 *
	 * This enqueues the minified stylesheet compiled from SASS (.scss) files.
	 * The main stylesheet, in the root directory, only contains the theme header but
	 * it is necessary for theme activation. DO NOT delete the main stylesheet!
	 */
	wp_enqueue_style( 'tts-min', get_theme_file_uri( '/css/style.min.css' ), [], '', 'screen' );

	// Print styles.
	wp_enqueue_style( 'tts-print', get_theme_file_uri( '/css/print.min.css' ), [], '', 'print' );

}
add_action( 'wp_enqueue_scripts', 'tts_styles' );
// add_editor_style( [ 'assets/css/editor-style.css', get_template_directory_uri() ] );

/**
 * Theme dependencies.
 *
 * @since  1.0.0
 * @access private
 * @return void
 */
require_once get_theme_file_path( '/includes/template-functions.php' );