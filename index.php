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
	<div class="row">
		<div class="page-content columns small-12 medium-8">

			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

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

				<?php endwhile; ?>

				<?php
				the_posts_pagination( array(
					'prev_text'          => __( 'Previous page', 'twentysixteen' ),
					'next_text'          => __( 'Next page', 'twentysixteen' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
				) );
				?>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();