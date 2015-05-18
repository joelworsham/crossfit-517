<?php
/**
 * The theme's index file used for displaying an archive of blog posts.
 *
 * @since   0.1.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

if ( have_posts() ) :
	?>
	<div class="row">
		<div class="columns small-12 medium-8">
			<h1 class="page-title">
				Search results for "<?php echo get_search_query(); ?>"
			</h1>

			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="post-title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>

					<div class="post-excerpt">
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
<?php
endif;
get_footer();