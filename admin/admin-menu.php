<?php
/**
 * Customizes the admin menu.
 *
 * @since   {{VERSION}}
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'admin_menu', 'crossfit_customize_admin_menu', 999 );

function crossfit_customize_admin_menu() {

	if ( ! current_user_can( 'manage_options' ) ) {

		remove_menu_page( 'plugins.php' );
		remove_menu_page( 'options.php' );
		remove_menu_page( 'edit.php?post_type=wod' );
		remove_menu_page( 'tools.php' );
	}
}