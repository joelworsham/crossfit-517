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

	<section class="home-section action-buttons">
		<div class="row">
			<div class="columns small-12 medium-4">
				<h3>
					<a href="#wod" class="button radius expand">
						<span class="fa fa-cog"></span><br/>WOD
					</a>
				</h3>

				<p>
					Every day at CrossFit 517, we have a different workout. View it here and get ready for it!
				</p>
			</div>

			<div class="columns small-12 medium-4">
				<h3>
					<a href="#schedule" class="button radius expand">
						<span class="fa fa-calendar"></span><br/>Schedule
					</a>
				</h3>

				<p>
					We have specific class times each day. Find out when they are and sign up here.
				</p>
			</div>

			<?php
			$get_started_post = get_post_meta( get_the_ID(), '_get_started_post', true );
			$get_started_url  = $get_started_post ? get_permalink( $get_started_post ) : '#';
			?>
			<div class="columns small-12 medium-4">
				<h3>
					<a href="#" data-reveal-id="getting-started" class="button radius expand">
						<span class="fa fa-check"></span><br/>Get Started
					</a>
				</h3>

				<p>
					Ready to take your life to the next level? Learn about what it takes to be a part of our family.
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
					<?php echo $wod->post_content; ?>
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

				<p class="fire-description">
					<span class="fa fa-fire"></span> - Crossfit fire class that is geared towards cardio and movement.
				</p>

				<p class="barbell-description">
					BB - Barbell club specialty class.
				</p>
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

	<div id="getting-started" class="reveal-modal" data-reveal
		<?php echo isset( $_POST['_ninja_forms_display_submit'] ) ? 'data-reveal-onload' : ''; ?>
		 aria-labelledby="modal-title" aria-hidden="true" role="dialog">

		<h2 id="modal-title">
			<?php if ( isset( $_POST['_ninja_forms_display_submit'] ) ) : ?>
				Thank you! We will contact you shortly with more information.
			<?php else: ?>
				Fill out the form and we'll be in touch
			<?php endif; ?>
		</h2>

		<?php
		if ( function_exists( 'ninja_forms_display_form' ) && $form = get_option( '_crossfit_getting_started_form' ) ) {
			ninja_forms_display_form( $form );
		} else {
			echo '<p>Huh, there should be a form here! Please try again later. Sorry about that.</p>';
		}
		?>
		<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>

<?php
get_footer();