<?php
/**
 * The theme's functions file that loads on EVERY page, used for uniform functionality.
 *
 * @since   0.1.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Make sure PHP version is correct
if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
	wp_die( 'ERROR in CrossFit theme: PHP version 5.3 or greater is required.' );
}

// Make sure no theme constants are already defined (realistically, there should be no conflicts)
if ( defined( 'THEME_VERSION' ) || defined( 'THEME_ID' ) || isset( $crossfit_fonts ) ) {
	wp_die( 'ERROR in CrossFit theme: There is a conflicting constant. Please either find the conflict or rename the constant.' );
}

/**
 * The theme's current version (make sure to keep this up to date!)
 */
define( 'THEME_VERSION', '1.2.0' );

/**
 * The theme's ID (used in handlers).
 */
define( 'THEME_ID', 'my_theme' );

/**
 * Fonts for the theme. Must be hosted font (Google fonts for example).
 */
$crossfit_fonts = array(
	'Font Awesome' => '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
	'Open Sans' => 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700',
);

// Extra image sizes
$crossfit_image_sizes = array(
	// 'slide' => array(
	// 	'title' => 'Slide',
	// 	'width' => 1000,
	// 	'height' => 500,
	// 	'crop' => array( 'center', 'center' ),
	// ),
);

/**
 * Setup theme properties and stuff.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function() {

	// Image sizes
	if ( ! empty( $crossfit_image_sizes ) ) {

		foreach ( $crossfit_image_sizes as $ID => $size ) {
			add_image_size( $ID, $size['width'], $size['height'], $size['crop'] );
		}

		add_filter( 'image_size_names_choose', '_meesdist_add_image_sizes' );
	}

	// Add theme support
	require_once __DIR__ . '/includes/theme-support.php';

	// Allow shortcodes in text widget
	add_filter('widget_text', 'do_shortcode');
});

/**
 * Adds support for custom image sizes.
 *
 * @since 0.1.0
 *
 * @param $sizes array The existing image sizes.
 *
 * @return array The new image sizes.
 */
function _meesdist_add_image_sizes( $sizes ) {

	global $crossfit_image_sizes;

	$new_sizes = array();
 	foreach ( $crossfit_image_sizes as $ID => $size ) {
	    $new_sizes[ $ID ] = $size['title'];
	}

	return array_merge( $sizes, $new_sizes );
}

/**
 * Register theme files.
 *
 * @since 0.1.0
 */
add_action( 'init', function () {

	global $crossfit_fonts;

	// Theme styles
	wp_register_style(
		THEME_ID,
		get_template_directory_uri() . '/style.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);

	wp_register_style(
		THEME_ID . '-schedule',
		get_template_directory_uri() . '/assets/css/schedule.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);


	// Theme script
	wp_register_script(
		THEME_ID,
		get_template_directory_uri() . '/script.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

	// Theme fonts
	if ( ! empty( $crossfit_fonts ) ) {
		foreach ( $crossfit_fonts as $ID => $link ) {
			wp_register_style(
				THEME_ID . "-font-$ID",
				$link
			);
		}
	}

	// Admin style
	wp_register_style(
		THEME_ID . '-admin',
		get_template_directory_uri() . '/admin.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);
} );

/**
 * Enqueue admin files.
 *
 * @since 0.1.0
 */
add_action( 'admin_enqueue_scripts', function () {

	// Theme styles
	wp_enqueue_style( THEME_ID . '-admin' );
	wp_enqueue_style( THEME_ID . '-schedule' );
} );

/**
 * Enqueue theme files.
 *
 * @since 0.1.0
 */
add_action( 'wp_enqueue_scripts', function () {

	global $crossfit_fonts;

	// Theme styles
	wp_enqueue_style( THEME_ID );

	// Theme script
	wp_enqueue_script( THEME_ID );

	// Theme fonts
	if ( ! empty( $crossfit_fonts ) ) {
		foreach ( $crossfit_fonts as $ID => $link ) {
			wp_enqueue_style( THEME_ID . "-font-$ID" );
		}
	}
} );

/**
 * Register nav menus.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function () {
	register_nav_menu( 'home-menu', 'Home' );
	register_nav_menu( 'top-menu', 'Top' );
	register_nav_menu( 'footer-left', 'Footer Left' );
	register_nav_menu( 'footer-right', 'Footer Right' );
} );

/**
 * Register sidebars.
 *
 * @since 0.1.0
 */
add_action( 'widgets_init', function () {

	// Page
	register_sidebar( array(
		'name' => 'Page',
		'id' => 'page',
		'description' => 'Displays on all pages.',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	// Footer Left
	register_sidebar( array(
		'name' => 'Footer Left',
		'id' => 'footer-left',
		'description' => 'Displays on the left side of the footer.',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '',
		'after_widget' => '',
	));

	// Footer Right
	register_sidebar( array(
		'name' => 'Footer Right',
		'id' => 'footer-right',
		'description' => 'Displays on the right side of the footer.',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '',
		'after_widget' => '',
	));
} );

// Extra files
require_once __DIR__ . '/includes/theme-functions.php';
require_once __DIR__ . '/admin/admin.php';

// Include shortcodes
require_once __DIR__ . '/includes/shortcodes/social.php';
require_once __DIR__ . '/includes/shortcodes/button.php';
require_once __DIR__ . '/includes/shortcodes/contact.php';

// Include widgets
require_once __DIR__ . '/includes/widgets/image.php';
require_once __DIR__ . '/includes/widgets/text-icon.php';
require_once __DIR__ . '/includes/widgets/wod.php';
require_once __DIR__ . '/includes/widgets/facebook.php';