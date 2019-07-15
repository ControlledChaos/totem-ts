<?php
/**
 * Admin notice that this theme is best with its companion plugin.
 *
 * @package    WordPress
 * @subpackage Totem_Twenty_Seventeen
 * @since      1.0.0
 *
 * @link       https://github.com/ControlledChaos/totem-plugin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

?>
<div class="notice notice-error">
	<?php
	echo sprintf(
		'<p>%1s <a href="%2s">%3s</a> %4s</p>',
		esc_html__( 'Please activate the', 'totem-ts' ),
		esc_url( admin_url( 'plugins.php?s=Totem Market & Gifts&plugin_status=all' ) ),
		'Totem Market & Gifts',
		esc_html__( 'plugin.', 'totem-ts' )
	); ?>
</div>