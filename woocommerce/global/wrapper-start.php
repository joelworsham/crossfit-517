<?php
/**
 * Content wrappers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="row">
	<article id="page-<?php the_ID(); ?>" <?php post_class( array( 'page-content', 'columns', 'small-12', 'medium-8' ) ); ?>>