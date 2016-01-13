<?php
/**
 * Article post type.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'article', 'Article', 'Articles', array(
		'menu_icon' => 'dashicons-format-aside',
		'supports'  => array( 'title', 'editor' ),
		'rewrite'   => array( 'slug' => 'articles' ),
		'public' => true,
		'show_ui' => true,
	) );
} );