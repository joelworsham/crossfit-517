<?php
/**
 * Adds theme functions.
 *
 * @since   0.1.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

function crossfit_get_menu_by_location( $location ) {

	if ( empty( $location ) ) {
		return false;
	}

	$locations = get_nav_menu_locations();
	if ( ! isset( $locations[ $location ] ) ) {
		return false;
	}

	$menu_obj = get_term( $locations[ $location ], 'nav_menu' );

	return $menu_obj;
}

function crossfit_debug( $var ) {

	if ( ! isset( $_GET['debug'] ) ) {
		return;
	}

	echo '<pre>';
	var_dump( $var );
	echo '</pre>';
}