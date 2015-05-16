<?php
/**
 * Provides an options page for the schedule.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'admin_menu', function() {
	add_menu_page(
		'Schedule',
		'Schedule',
		'manage_options',
		'crossfit-schedule',
		'_crossfit_page_schedule_output',
		'dashicons-list-view',
		59
	);
});

function _crossfit_page_schedule_output() {

	// Include template
	include_once __DIR__ . '/views/html-schedule.php';
}