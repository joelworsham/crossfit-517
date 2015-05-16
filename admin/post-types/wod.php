<?php
/**
 * WOD post type.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'wod', 'WOD', 'WODs', array(
		'menu_icon' => 'dashicons-calendar',
		'supports'  => array( 'editor' ),
		'rewrite'   => array( 'slug' => 'wods' ),
	) );
} );

add_filter( 'manage_wod_posts_columns', function ( $column_headers ) {

	unset( $column_headers['title'] );
	$column_headers['content'] = 'WOD';

	return $column_headers;
} );

add_action( 'manage_wod_posts_custom_column', function ( $column_name, $post_ID ){

	if ( $column_name == 'content' ) {
		$post = get_post( $post_ID );
		echo $post->post_content;
	}
}, 10, 2);