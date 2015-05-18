<?php
/**
 * Class post type.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'class', 'Class', 'Classes', array(
		'menu_icon' => 'dashicons-list-view',
		'supports'  => false,
		'rewrite'   => array( 'slug' => 'classes' ),
		'public' => false,
		'show_ui' => false,
	) );
} );