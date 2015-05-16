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

get_header();
?>

<?php if ( function_exists( 'layerslider' ) ) : ?>
	<section class="home-slider">
		<?php layerslider( 1 ) ?>
	</section>
<?php endif; ?>

	<section class="action-buttons row">
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
				<a href="<?php echo $get_started_url; ?>" class="button radius expand">
					<span class="fa fa-check"></span><br/>Get Started
				</a>
			</h3>

			<p>
				Ready to take your life to the next level? Learn about what it takes to be a part of our family.
			</p>
		</div>
	</section>


<?php
$wod = get_posts( array(
	'post_type' => 'wod',
	'numberposts' => 1,
));

/** @var $wod WP_Post */
$wod = $wod ? $wod[0] : false;

if ( $wod ) :
?>
	<section id="wod">

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

	<section id="schedule">

		<h2 class="home-section-title">
			Schedule
		</h2>

		<div class="row">
			<div class="columns small-12">
			</div>
		</div>
	</section>

	<section id="about">

		<h2 class="home-section-title">
			What is CrossFit?
		</h2>

		<div class="row">
			<div class="columns small-12">
			</div>
		</div>
	</section>

	<section id="pricing">

		<h2 class="home-section-title">
			Pricing
		</h2>

		<div class="row">
			<div class="columns small-12">
			</div>
		</div>
	</section>

<?php
get_footer();