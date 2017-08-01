<?php
/**
 * The theme's front-page file use for displaying the home page.
 *
 * @since   0.1.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( THEME_ID . '-schedule' );
} );

get_header();
?>

<?php if ( function_exists( 'layerslider' ) && $slider = get_option( '_crossfit_home_slider' ) ) : ?>
    <section class="home-slider">
		<?php layerslider( $slider ); ?>
    </section>
<?php endif; ?>

<?php if ( $video_url = get_post_meta( get_the_ID(), '_crossfit_home_video_url', true ) ) : ?>
    <section class="home-section home-video">
		<?php if ( $video_section_title = get_post_meta( get_the_ID(), '_crossfit_home_video_title', true ) ) : ?>
            <h2 class="home-section-title">
				<?php echo $video_section_title; ?>
            </h2>
		<?php endif; ?>

        <div class="row">

            <div class="columns small-12">
				<?php echo wp_oembed_get( $video_url, array( 'width' => 970 ) ); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

    <section class="home-section action-buttons">
        <div class="row">
            <div class="columns small-12 medium-6 large-3">
                <h3>
                    <a href="#wod" class="button radius expand">
                        <span class="fa fa-cog"></span><br/>WOD
                    </a>
                </h3>

                <p>
                    Every day at CrossFit 517, we have a different workout. View it here and get ready for it!
                </p>
            </div>

            <div class="columns small-12 medium-6 large-3">
                <h3>
                    <a href="#schedule" class="button radius expand">
                        <span class="fa fa-calendar"></span><br/>Schedule
                    </a>
                </h3>

                <p>
                    We have specific class times each day. Find out when they are and sign up here.
                </p>
            </div>

            <div class="columns small-12 medium-6 large-3">
                <h3>
                    <a href="#blog" class="button radius expand">
                        <span class="fa fa-rss"></span><br/>Blog
                    </a>
                </h3>

                <p>
                    View the latest from the CrossFit 517 Blog.
                </p>
            </div>

            <div class="columns small-12 medium-6 large-3">
                <h3>
                    <a href="#" data-reveal-id="more-info" class="button radius expand">
                        <span class="fa fa-info-circle"></span><br/>More Info
                    </a>
                </h3>

                <p>
                    Get more info on CrossFit and our gym.
                </p>
            </div>
        </div>
    </section>


<?php
$wod = get_posts( array(
	'post_type'   => 'wod',
	'numberposts' => 1,
) );

/** @var $wod WP_Post */
$wod = $wod ? $wod[0] : false;

if ( $wod ) :
	?>
    <section id="wod" class="home-section">

        <h2 class="home-section-title">
            WOD
        </h2>

        <div class="row">
            <div class="columns small-12">
                <p class="date">
					<?php echo get_the_date( '', $wod ); ?>
                </p>

                <div class="content">
					<?php echo wpautop( $wod->post_content ); ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>

    <section id="schedule" class="home-section">

        <h2 class="home-section-title">
            Schedule
        </h2>

        <div class="row">
            <div class="columns small-12">
				<?php include __DIR__ . '/partials/class-schedule.php'; ?>

				<?php
				$specialty_classes = get_posts( array(
					'post_type'   => 'specialty-class',
					'numberposts' => - 1,
				) );

				if ( $specialty_classes && ! is_wp_error( $specialty_classes ) ) : ?>
                    <ul class="schedule-specialty-classes">
						<?php foreach ( $specialty_classes as $post ) : ?>
							<?php setup_postdata( $post ); ?>
                            <li>
                                <h3>
                                    <a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
                                    </a>
                                </h3>

								<?php the_excerpt(); ?>
                            </li>
							<?php wp_reset_postdata(); ?>
						<?php endforeach; ?>
                    </ul>
				<?php endif; ?>
            </div>
        </div>
    </section>

    <section id="blog" class="home-section">

        <h2 class="home-section-title">
            CrossFit 517 Blog
        </h2>

        <div class="row">
            <div class="columns small-12">
				<?php $posts = get_posts( array( 'posts_per_page' => 5 ) ); ?>

				<?php if ( $posts ) : ?>
					<?php foreach ( $posts as $post ): setup_postdata( $post ); ?>
                        <article <?php post_class(); ?>>
                            <h3 class="post-title">
                                <a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
                                </a>
                            </h3>

                            <div class="post-excerpt">
								<?php the_excerpt(); ?>
                            </div>

                            <p class="read-more">
                                <a href="<?php the_permalink(); ?>" class="button secondary">
                                    Read More
                                </a>
                            </p>
                        </article>
					<?php endforeach;
					wp_reset_postdata(); ?>
				<?php endif; ?>

				<?php if ( $blog_page = get_option( 'page_for_posts' ) ) : ?>
                    <a href="<?php echo get_permalink( $blog_page ); ?>" class="button large">
                        See More Posts
                    </a>
				<?php endif; ?>
            </div>
        </div>
    </section>

    <section id="about" class="home-section">

        <h2 class="home-section-title">
            What is CrossFit?
        </h2>

        <div class="row">
            <div class="columns small-12 medium-6">
                <iframe src="//www.youtube-nocookie.com/embed/mlVrkiCoKkg" frameborder="0" allowfullscreen
                        style="width: 100%; height: 300px;">
                </iframe>
            </div>

            <div class="columns small-12 medium-6">

                <p>
                    When thinking about how to explain what CrossFit is, we like to start with what CrossFit is not:
                </p>

                <p>
                    CrossFit is not...
                </p>

                <ul>
                    <li>
                        *... for people expecting results without hard work
                    </li>
                    <li>
                        *... for people unwilling to try new things
                    </li>
                    <li>
                        *... for people afraid to leave their egos at home
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section id="pricing" class="home-section">

        <h2 class="home-section-title">
            Pricing
        </h2>

        <div class="row">

			<?php
			for ( $i = 1; $i < 4; $i ++ ) :
				$highlighted = get_post_meta( get_the_ID(), "_ptable{$i}_highlighted", true ) ? true : false;
				?>

                <div class="columns small-12 medium-4">

                    <ul class="pricing-table <?php echo $highlighted ? 'highlighted' : ''; ?>">

                        <li class="title">
							<?php echo get_post_meta( get_the_ID(), "_ptable{$i}_title", true ); ?>
                        </li>

                        <li class="price">
                            $<?php echo get_post_meta( get_the_ID(), "_ptable{$i}_price", true ); ?>
                        </li>

						<?php
						$bullets = get_post_meta( get_the_ID(), "_ptable{$i}_bullets", true );
						$bullets = $bullets ? explode( "\n", $bullets ) : false;

						if ( $bullets ) {
							foreach ( $bullets as $bullet ) {
								?>
                                <li class="bullet-item"><?php echo $bullet; ?></li>
								<?php
							}
						}

						if ( $get_started_post = get_option( '_crossfit_getting_started_page' ) ) :
							?>
                            <li class="cta-button">
                                <a class="button radius" href="<?php echo get_permalink( $get_started_post ); ?>">
                                    Get Started!
                                </a>
                            </li>
						<?php endif; ?>

                    </ul>

                </div>

			<?php endfor; ?>

        </div>
    </section>

<?php $form = get_option( '_crossfit_getting_started_form' ); ?>
    <div id="more-info" class="reveal-modal" data-reveal
		<?php echo isset( $_POST['gform_submit'] ) && $_POST['gform_submit'] == $form ? 'data-reveal-onload' : ''; ?>
         aria-labelledby="modal-title" aria-hidden="true" role="dialog">

        <h2 id="modal-title">
			<?php if ( isset( $_POST['gform_submit'] ) && $_POST['gform_submit'] == $form ) : ?>
                Thank you!
			<?php else: ?>
                Fill out the form and we'll be in touch
			<?php endif; ?>
        </h2>

		<?php
		if ( function_exists( 'gravity_form' ) && $form = get_option( '_crossfit_getting_started_form' ) ) {
			gravity_form( $form );
		} else {
			echo '<p>Huh, there should be a form here! Please try again later. Sorry about that.</p>';
		}
		?>
        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>

<?php
get_footer();