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

// Migrate FIRE to CLASS TYPE
if ( ! get_option( '_crossfit_migrate_fire_to_type' ) ) {

	update_option( '_crossfit_migrate_fire_to_type', true );

	$classes = get_posts( array(
		'post_type'   => 'class',
		'numberposts' => - 1,
	) );

	if ( ! empty( $classes ) ) {
		foreach ( $classes as $class ) {

			if ( get_post_meta( $class->ID, '_fire', true ) ) {

				delete_post_meta( $class->ID, '_fire' );
				update_post_meta( $class->ID, '_class_type', 'fire' );
			}

			if ( ! get_post_meta( $class->ID, '_class_type', true ) ) {
				update_post_meta( $class->ID, '_class_type', 'normal' );
			}
		}
	}
}

// Save class
if ( isset( $_POST['_crossfit_add_class_nonce'] ) &&
     wp_verify_nonce( $_POST['_crossfit_add_class_nonce'], 'add_class' )
) {

	$day  = isset( $_POST['_day'] ) ? $_POST['_day'] : false;
	$time = isset( $_POST['_time'] ) ? $_POST['_time'] : false;
	$type = isset( $_POST['_class_type'] ) ? $_POST['_class_type'] : false;

	if ( $day && $time ) {

		$ID = wp_insert_post( array(
			'post_type'   => 'class',
			'post_status' => 'publish',
			'post_title'  => "WOD $day $time",
		) );

		update_post_meta( $ID, '_day', $day );
		update_post_meta( $ID, '_time', $time );

		if ( $type ) {
			update_post_meta( $ID, '_class_type', $type );
		}

		wp_redirect(
			remove_query_arg( 'ids', $_POST['_wp_http_referer'] )
		);
		exit();
	}
}

add_action( 'admin_menu', function () {
	add_menu_page(
		'Schedule',
		'Schedule',
		'edit_posts',
		'crossfit-schedule',
		'_crossfit_page_schedule_output',
		'dashicons-list-view',
		58
	);
} );

function _crossfit_page_schedule_output() {

	// Include template
	include_once __DIR__ . '/views/html-schedule.php';
}