<?php
/**
 * The theme's header file that appears on EVERY page.
 *
 * @since   0.1.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/vendor/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( strpos( $_SERVER['HTTP_HOST'], '.dev' ) === false && ! is_user_logged_in() && ! current_user_can( 'manage_options' ) ) : ?>
	<script>
		(function (i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function () {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
			a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

		ga('create', 'UA-71586566-1', 'auto');
		ga('send', 'pageview');
	</script>
<?php endif; ?>

<div id="wrapper">

	<header id="site-header">

		<nav class="top-nav">
			<?php
			wp_nav_menu( array(
				'theme_location'  => 'top-menu',
				'container_class' => 'row',
				'menu_class'      => 'menu columns small-12',
			) );
			?>
		</nav>

		<section class="logo-container">

			<div class="row">
				<div class="columns small-12 medium-6">
					<a href="<?php bloginfo( 'url' ); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-header.png"
						     class="logo" alt="crossfit 517"/>
					</a>
				</div>

				<div class="columns small-12 medium-6 medium-text-right">
					<p class="address">
						<?php echo crossfit_sc_address( array( 'condensed' => 'yes' ) ); ?>
					</p>

					<p class="phone">
						<?php echo crossfit_sc_phone(); ?>
					</p>

					<p class="get-started">
						<?php if ( $get_started_post = get_option( '_crossfit_getting_started_page' ) ) : ?>
							<a href="<?php echo get_permalink( $get_started_post ); ?>" class="button radius large">
								Get Started
							</a>
						<?php endif; ?>
					</p>
				</div>
			</div>

		</section>

		<?php if ( is_front_page() ) : ?>

			<?php
			$academy_page_ID = get_option( '_crossfit_athletic_academy_page', - 1 );
			$count           = get_post( $academy_page_ID ) ? 5 : 4;
			?>
			<nav id="home-nav">
				<ul class="menu row expand <?php echo $count == 5 ? 'five' : ''; ?>">
					<li class="menu-item columns small-12 medium-6">
						<a href="#wod">
							WOD
						</a>
					</li>
					<li class="menu-item columns small-12 medium-6">
						<a href="#schedule">
							Schedule
						</a>
					</li>
					<li class="menu-item columns small-12 medium-6">
						<a href="#about">
							What is CrossFit?
						</a>
					</li>
					<li class="menu-item columns small-12 medium-6">
						<a href="#pricing">
							Pricing
						</a>
					</li>

					<?php if ( $count == 5 ) : ?>
						<li class="menu-item columns small-12 medium-6">
							<a href="<?php echo get_permalink( $academy_page_ID ); ?>">
								517 Athletic Academy
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</nav>
		<?php endif; ?>

	</header>

	<section id="site-content">