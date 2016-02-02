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
	<div class="row">
		<div class="page-content columns small-12 medium-8">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<h1 class="post-title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h1>

					<div class="post-excerpt">
						<?php the_excerpt(); ?>
					</div>

					<p class="read-more">
						<a href="<?php the_permalink(); ?>" class="button large">
							Read More
						</a>
					</p>
				</article>

			<?php endwhile; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
<?php endif; ?>

<?php
get_footer();