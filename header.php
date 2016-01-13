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

		<section class="logo-container small-only-text-center">

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

		<nav id="primary-nav">
			<?php
			$theme_locations = get_nav_menu_locations();
			$primary_menu    = get_term( $theme_locations['primary-menu'], 'nav_menu' );

			wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'container'      => 'false',
				'menu_class'     => 'menu text-center small-block-grid-' .
				                    min( $primary_menu->count, 2 ) .
				                    ' medium-block-grid-' .
				                    min( $primary_menu->count, 4 ) .
				                    ' large-block-grid-' .
				                    min( $primary_menu->count, 6 ),

			) );
			?>
		</nav>

	</header>

	<section id="site-content">