<?php
/**
 * Totem Twenty Seventeen functions
 *
 * @package    WordPress
 * @subpackage Totem_Twenty_Seventeen
 * @since      1.0.0
 */

 // If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Get plugins path to check for active plugins.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Define the companion plugin path: directory and core file name.
 *
 * This theme is designed to coordinate with a companion plugin.
 * Change the following path to the new name of the starter companion
 * plugin, found at the following link.
 *
 * @link   https://github.com/ControlledChaos/totem-plugin
 *
 * @since  1.0.0
 * @return string Returns the plugin path.
 */
if ( ! defined( 'TTS_PLUGIN' ) ) {
	define( 'TTS_PLUGIN', 'totem-plugin/totem-plugin.php' );
}

/**
 * Remove Twenty Seventeen styles & scripts
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function tts_theme_setup() {

	$GLOBALS['content_width'] =1280;

	// 16:9 HD Video.
	add_image_size( __( 'video', 'totem-ts' ), 1280, 720, true );
	add_image_size( __( 'video-md', 'totem-ts' ), 960, 540, true );
	add_image_size( __( 'video-sm', 'totem-ts' ), 640, 360, true );

	// 21:9 Cinemascope.
	add_image_size( __( 'banner', 'totem-ts' ), 1280, 549, true );
	add_image_size( __( 'banner-md', 'totem-ts' ), 960, 411, true );
	add_image_size( __( 'banner-sm', 'totem-ts' ), 640, 274, true );

	// Add image size for meta tags if companion plugin is not activated.
	if ( ! is_plugin_active( TTS_PLUGIN ) ) {
		add_image_size( __( 'meta-image', 'totem-ts' ), 1200, 630, true );
	}

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
	  */
	  add_editor_style( get_theme_file_uri( '/css/editor-style.min.css' ) );

	  // Load regular editor styles into the new block-based editor.
	  add_theme_support( 'editor-styles' );

	/**
	 * Add editor support.
	 *
	 * @since 1.0.0
	 */

	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'disable-custom-font-sizes' );

	// Color arguments.
	$color_args = [
		[
			'name'  => __( 'Oak', 'totem-ts' ),
			'slug'  => 'tts-oak',
			'color' => '#402920',
		],
		[
			'name'  => __( 'Redwood', 'totem-ts' ),
			'slug'  => 'tts-redwood',
			'color' => '#722f04',
		],
		[
			'name'  => __( 'River', 'totem-ts' ),
			'slug'  => 'tts-river',
			'color' => '#2c5290',
		],
		[
			'name'  => __( 'Snow', 'totem-ts' ),
			'slug'  => 'tts-snow',
			'color' => '#eeeeee',
		],
		[
			'name'  => __( 'Attention Red', 'totem-ts' ),
			'slug'  => 'tts-wp-error-red',
			'color' => '#dc3232',
		],
		[
			'name'  => __( 'WordPress Warning Yellow', 'totem-ts' ),
			'slug'  => 'tts-wp-warning-yellow',
			'color' => '#ffb900',
		]
	];

	// Apply a filter to editor arguments.
	$colors = apply_filters( 'tts_editor_colors', $color_args );

	// Add color support.
	add_theme_support( 'editor-color-palette', $colors );

	// Font arguments.
	$font_args = [
		[
			'name' => __( 'Small', 'totem-ts' ),
			'size' => 14,
			'slug' => 'small'
		],
		[
			'name' => __( 'Normal', 'totem-ts' ),
			'size' => 18,
			'slug' => 'normal'
		],
		[
			'name' => __( 'Large', 'totem-ts' ),
			'size' => 22,
			'slug' => 'large'
		]
	];

	// Apply a filter to editor arguments.
	$fonts = apply_filters( 'tts_editor_fonts', $font_args );

	// Add color support.
	add_theme_support( 'editor-font-sizes', $fonts );

	// Add full-width image size.
	add_theme_support( 'align-wide' );

}
add_action( 'after_setup_theme', 'tts_theme_setup', 11 );

/**
 * Remove Twenty Seventeen styles & scripts
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function tts_content_width( $content_width ) {

	// Set a new default width.
	$content_width = 1280;

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 1280;
		} elseif ( is_page() ) {
			$content_width = 960;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1280;
	}

	// Return the new conditional width.
	return $content_width;

}
add_filter( 'twentyseventeen_content_width', 'tts_content_width' );

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
 * @return mixed
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

/**
 * Enqueue styles for the block-based editor
 *
 * @since  1.0.0
 * @access public
 * @return mixed
 */
function tts_block_editor_styles() {

	// Remove Twenty Seventeen editor styles.
	wp_deregister_style( 'twentyseventeen-block-editor-style' );

	// Adobe fonts.
	wp_enqueue_style( 'tts-fonts', 'https://use.typekit.net/fuf3mvk.css', [], '', 'screen' );

	// Block styles.
	wp_enqueue_style( 'tts-block-editor-style', get_theme_file_uri( '/css/editor-blocks.min.css' ), [], '' );
}
add_action( 'enqueue_block_editor_assets', 'tts_block_editor_styles', 11 );

/**
 * Footer scripts
 *
 * @since  1.0.0
 * @access public
 * @return string Prints the scripts before the closing body tag.
 */
function tts_footer_scripts() {

	$scripts = '<script>jQuery(document).ready(function($) { $(".entry-content").fitVids(); });</script>';

	echo $scripts;

}
add_action( 'wp_footer', 'tts_footer_scripts', 20 );

/**
 * Image sizes to insert into posts.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function tts_image_size_choose( $sizes ) {

	// Access global variables.
	global $_wp_additional_image_sizes;

	// Return default sizes if no custom sizes.
	if ( empty( $_wp_additional_image_sizes ) ) {
		return $sizes;
	}

	// Capitalize custom image size names and remove hyphens.
	foreach ( $_wp_additional_image_sizes as $id => $data ) {

		if ( ! isset( $sizes[$id] ) ) {
			$sizes[$id] = ucwords( str_replace( '-', ' ', $id ) );
		}
	}

	// Return the modified array of sizes.
	return $sizes;

}
remove_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 11 );
add_filter( 'image_size_names_choose', 'tts_image_size_choose' );

/**
 * Theme dependencies.
 *
 * @since  1.0.0
 * @access private
 * @return void
 */
require_once get_theme_file_path( '/includes/template-functions.php' );