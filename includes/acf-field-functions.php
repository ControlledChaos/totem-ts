<?php
/**
 * Functions for custom settings and other fields
 *
 * Requires the Totem plugin and ACF Pro to be active.
 *
 * @package    WordPress
 * @subpackage Totem_Twenty_Seventeen
 * @since      1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Bail if ACF Pro is not active.
if ( ! class_exists( 'acf_pro' ) && ! is_plugin_active( TOTEM_PLUGIN ) ) {
	return;
}

/**
 * Register fields
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
if ( function_exists( 'acf_add_local_field_group' ) ) :

	acf_add_local_field_group( [
		'key'    => 'group_5d2bfeae3b41e',
		'title'  => __( 'Front Page Options', 'totem-ts' ),
		'fields' => [
			[
				'key'               => 'field_5d2c0ae18a35b',
				'label'             => __( 'Front Page', 'totem-ts' ),
				'name'              => '',
				'type'              => 'tab',
				'instructions'      => __( '', 'totem-ts' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'placement'         => 'top',
				'endpoint'          => 0,
			],
			[
				'key'               => 'field_5d2bfef2b7533',
				'label'             => __( 'Front Page Sections', 'totem-ts' ),
				'name'              => 'tts_front_page_sections',
				'type'              => 'number',
				'instructions'      => __( 'Choose how many sections available for display. Defaults to five sections.', 'totem-ts' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '50',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => 5,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'min'               => 4,
				'max'               => 8,
				'step'              => 1,
			],
			[
				'key'               => 'field_5d2c0b4f47a0f',
				'label'             => __( 'Section Titles', 'totem-ts' ),
				'name'              => 'tts_front_page_section_titles',
				'type'              => 'button_group',
				'instructions'      => __( 'Choose whether the section titles display over the featured images or below them.', 'totem-ts' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '50',
					'class' => '',
					'id'    => '',
				],
				'choices'           => [
					'below_image' => __( 'Below Image', 'totem-ts' ),
					'over_image'  => __( 'Over Image', 'totem-ts' ),
				],
				'allow_null'        => 0,
				'default_value'     => 'below_image',
				'layout'            => 'horizontal',
				'return_format'     => 'value',
			],
		],
		'location' => [
			[
				[
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'totem-plugin-settings',
				],
			],
		],
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'seamless',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => __( '', 'totem-ts' ),
	] );

	acf_add_local_field_group( [
		'key'    => 'group_5ce56b09e1780',
		'title'  => __( 'Front Page Panel', 'totem-ts' ),
		'fields' => [
			[
				'key'               => 'field_5ce56b3e5d027',
				'label'             => __( 'Two Title Fields', 'totem-ts' ),
				'name'              => '',
				'type'              => 'message',
				'instructions'      => __( '', 'totem-ts' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => __( 'You are editing a page with the template for the intro panels on the front page. This template has an additional title field so that editors can use an administrative title in the field above this message to differentiate the panel page from	a corresponding page with full content.

	In the title field above write something like Panel: Wine & Beer Tasting. In the field below write the title that will be displayed to visitors, e.g. Wine & Beer Tasting.', 'totem-ts' ),
				'new_lines'         => 'wpautop',
				'esc_html'          => 0,
			],
			[
				'key'               => 'field_5ce56cca731d9',
				'label'             => __( 'Public Title', 'totem-ts' ),
				'name'              => 'totem_ts_public_title',
				'type'              => 'text',
				'instructions'      => __( '', 'totem-ts' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
		],
		'location' => [
			[
				[
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'page-templates/panel-page.php',
				],
			],
		],
		'menu_order'            => 0,
		'position'              => 'acf_after_title',
		'style'                 => 'seamless',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => __( '', 'totem-ts' ),
	] );

// End field registry.
endif;

/**
 * Front page sections
 *
 * Modifies the default number of sections: four (4).
 *
 * @since  1.0.0
 * @access public
 * @return integer Returns the number of sections.
 */
function tts_front_page_sections_field() {

	// Get the field input.
	$number = get_field( 'tts_front_page_sections', 'option' );

	// Use field number if available.
	if ( $number ) {
		$display = $number;

	// Otherwise set the number as five (5).
	} else {
		$display = 5;
	}

	// Return the number of sections.
	return $display;

}