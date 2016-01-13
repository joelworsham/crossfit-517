<?php
/**
 * The theme's single file use for displaying single posts.
 *
 * @since 0.1.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();
?>

	<div class="row">
		<article id="page-<?php the_ID(); ?>" <?php post_class( array( 'page-content', 'columns', 'small-12', 'medium-8' ) ); ?>>

			<h1 class="page-title">
				<?php the_title(); ?>
			</h1>

			<?php the_content(); ?>
		</article>

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();