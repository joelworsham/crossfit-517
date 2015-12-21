<?php
/**
 * The theme's index file used for displaying an archive of blog posts.
 *
 * @since 0.1.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="row">
			<article id="page-<?php the_ID(); ?>" <?php post_class( array(
				'page-content',
				'columns',
				'small-12',
				'medium-8'
			) ); ?>>

				<h1 class="page-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h1>

				<?php the_excerpt(); ?>

				<a href="<?php the_permalink(); ?>" class="button">
					Read More
				</a>
			</article>

			<?php get_sidebar(); ?>
		</div>

	<?php endwhile; ?>
<?php endif; ?>
<?php
get_footer();