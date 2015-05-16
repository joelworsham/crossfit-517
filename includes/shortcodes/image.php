<?php
/**
 * Shortcode: Image.
 *
 * Displays an image.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'init', function () {
	add_shortcode( 'image', 'crossfit_sc_image' );
} );

function crossfit_sc_image( $atts = array(), $content = '' ) {

	$atts = shortcode_atts( array(
		'id' => false,
		'link' => false,
		'size' => 'full',
	), $atts );

	$html = '';

	$html .= $atts['link'] !== false ? "<a href=\"{$atts['link']}\">" : '';
	$html .= wp_get_attachment_image( $atts['id'], $atts['size'] );
	$html .= '</a>';

	return $html;
}