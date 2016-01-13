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

add_action( 'register_post_type_args', 'crossfit_modify_events_cpt', 10, 2 );
add_filter( 'pre_get_posts', 'crossfit_events_archive_query', 999 );

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

function crossfit_modify_events_cpt( $args, $post_type ) {

	if ( $post_type != 'event' ) {
		return $args;
	}

	$args['has_archive']         = true;
	$args['exclude_from_search'] = false;
	$args['publicly_queryable']  = true;
	$args['rewrite']['slug']     = 'events';

	return $args;
}

function crossfit_events_archive_query( $wp_query ) {

	if ( is_admin() || ! $wp_query->is_post_type_archive( 'event' ) || ! $wp_query->is_main_query() ) {
		return;
	}

	// Get date to use
	$view_day = (int) isset( $_REQUEST['cal_day'] )
		? (int) $_REQUEST['cal_day']
		: date_i18n( 'j' );

	$view_month = (int) isset( $_REQUEST['cal_month'] )
		? (int) $_REQUEST['cal_month']
		: date_i18n( 'n' );

	$view_year = (int) isset( $_REQUEST['cal_year'] )
		? (int) $_REQUEST['cal_year']
		: date_i18n( 'Y' );

	// Get timestamp
	$view_timestamp        = mktime( 0, 0, 0, $view_month, 1, $view_year );
	$view_month_maxday     = date_i18n( 't', $view_timestamp );
	$view_month_properties = getdate( $view_timestamp );
	$view_weekday_start    = $view_month_properties['wday'];

	// Get today
	$today_month = date_i18n( 'n' );
	$today_day   = date_i18n( 'j' );
	$today_year  = date_i18n( 'Y' );
	$is_month    = $today_month == $view_month && $today_year == $view_year;

	// Get events
	$view_start = "{$view_year}-{$view_month}-01 00:00:00";
	$view_end   = "{$view_year}-{$view_month}-31 00:00:00";

	$wp_query->set( 'numberposts', -1 );
	$wp_query->set( 'posts_per_page', -1 );
	$wp_query->set( 'post_status', array( 'publish' ) );
	$wp_query->set( 'orderby', 'meta_value' );
	$wp_query->set( 'order', 'DSC' );
	$wp_query->set( 'hiearchical', false );
	$wp_query->set( 'ignore_sticky_posts', true );
	$wp_query->set( 'meta_query', array(
		array(
			'key'     => 'wp_event_calendar_date_time',
			'value'   => array( $view_start, $view_end ),
			'type'    => 'DATETIME',
			'compare' => 'BETWEEN',
		)
	) );
}