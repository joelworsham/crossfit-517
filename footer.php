<?php
/**
 * The theme's footer file that appears on EVERY page.
 *
 * @since 0.1.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<?php // #site-content ?>
</section>

<footer id="site-footer">

	<div class="row">
		<div class="columns small-12 medium-3">
			<?php dynamic_sidebar( 'footer-left' ); ?>
		</div>
		<div class="columns small-12 medium-3">
			<?php
			$menu_obj = crossfit_get_menu_by_location( 'footer-left' );
			wp_nav_menu(
				array(
					'theme_location' => 'footer-left',
					'container'      => false,
					'items_wrap'     => '<h3>' . esc_html( $menu_obj->name ) . '</h3><ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>',
				)
			);
			?>
		</div>
		<div class="columns small-12 medium-3">
			<?php
			$menu_obj = crossfit_get_menu_by_location( 'footer-right' );
			wp_nav_menu(
				array(
					'theme_location' => 'footer-right',
					'container'      => false,
					'items_wrap'     => '<h3>' . esc_html( $menu_obj->name ) . '</h3><ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>',
				)
			);
			?>
		</div>
		<div class="columns small-12 medium-3">
			<?php dynamic_sidebar( 'footer-right' ); ?>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="row">
			<div class="medium-text-left text-center columns small-12 medium-6">
				&copy <?php echo date( 'Y' ); ?> CrossFit 517
			</div>
			<div class="medium-text-right text-center columns small-12 medium-6">
				Site by <a href="http://joelworsham.com" rel="nofollow">Joel Worsham</a>
			</div>
		</div>

	</div>
</footer>

<?php // #wrapper ?>
</div>

<?php wp_footer(); ?>

</body>
</html>