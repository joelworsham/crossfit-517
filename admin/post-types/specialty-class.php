<?php
/**
 * Specialty Class post type.
 *
 * @since   {{VERSION}}
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'specialty-class', 'Specialty Class', 'Specialty Classes', array(
		'menu_icon' => 'dashicons-welcome-learn-more',
		'supports'  => array( 'title', 'editor' ),
		'rewrite'   => array( 'slug' => 'specialty-classes' ),
		'public' => true,
		'show_ui' => true,
	) );
} );