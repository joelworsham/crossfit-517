<?php
/**
 * Shortcodes: Phone, Email, Address.
 *
 * Displays company phone number.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'init', function () {

	add_shortcode( 'phone', 'crossfit_sc_phone' );
	add_shortcode( 'email', 'crossfit_sc_email' );
	add_shortcode( 'address', 'crossfit_sc_address' );
} );

function crossfit_sc_phone() {

	$phone = get_option( '_crossfit_phone', '' );
	return wp_is_mobile() ? "<a href=\"tel:$phone\">$phone</a>" : $phone;
}

function crossfit_sc_email() {

	$email = get_option( '_crossfit_email', '' );
	return "<a href=\"mailto:$email\">$email</a>";
}

function crossfit_sc_address( $atts = array() ) {

	$atts = shortcode_atts( array(
		'condensed' => 'no',
	), $atts );

	if ( $option = $atts['condensed'] == 'yes' ) {
		$address = get_option( '_crossfit_address_condensed', '' );
		return do_shortcode( $address );
	}

	$address = get_option( '_crossfit_address', '' );
	return wpautop( do_shortcode( $address ) );
}