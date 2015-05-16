<?php
/**
 * Provides an options page for the theme.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'admin_menu', function() {
	add_options_page(
		'CrossFit Settings',
		'CrossFit Settings',
		'manage_options',
		'crossfit-settings',
		'_crossfit_page_crossfit_settings_output'
	);
});

function _crossfit_page_crossfit_settings_output() {

	// Include template
	include_once __DIR__ . '/views/html-crossfit-settings.php';
}

// Register settings
add_action( 'admin_init', function() {

	register_setting( 'crossfit-settings', '_crossfit_phone' );
	register_setting( 'crossfit-settings', '_crossfit_email' );
	register_setting( 'crossfit-settings', '_crossfit_address' );
	register_setting( 'crossfit-settings', '_crossfit_address_condensed' );
});