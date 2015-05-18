<?php
/**
 * The theme's search form.
 *
 * @since 0.1.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<form class="site-search" action="<?php bloginfo( 'url' ); ?>" method="get">
	<label>
		<span class="screen-reader-text">Search</span>
		<input type="text" class="s" name="s" value="<?php get_search_query(); ?>"
		       placeholder="What are you looking for?"/>
	</label>
</form>