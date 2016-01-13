<?php
/**
 * Customizes the admin dashboard.
 *
 * @since   {{VERSION}}
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'wp_dashboard_setup', 'crossfit_manage_dashboard_widgets' );

function crossfit_manage_dashboard_widgets() {

	if ( ! current_user_can( 'manage_options' ) ) {

		// Remove
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );

		// Add
		add_meta_box( 'crossfit_dashboard_wod', 'WOD', 'crossfit_dashboard_wod_widget', 'dashboard', 'normal' );
		add_meta_box( 'crossfit_dashboard_edit_menu', 'Edit Menus', 'crossfit_dashboard_edit_menu_widget', 'dashboard', 'normal' );
		add_meta_box( 'crossfit_dashboard_new_page', 'New Page', 'crossfit_dashboard_new_page_widget', 'dashboard', 'side' );
	}
}

function crossfit_dashboard_wod_widget() {

	$wod = get_posts( array(
			'post_type'   => 'wod',
			'numberposts' => 1,
	) );

	/** @var $wod WP_Post */
	$wod = $wod ? $wod[0] : false;

	if ( $wod ) :
		?>
		<div class="crossfit-dash-widget">
			<a href="<?php echo admin_url( 'post-new.php?post_type=wod' ); ?>"  class="crossfit-dash-widget-icon">
				<span class="dashicons dashicons-plus"></span>
			</a>

			<hr/>

			<div class="latest-wod">
				<p class="date">
					<?php echo get_the_date( '', $wod ); ?>
				</p>

				<div class="content">
					<?php echo wpautop( $wod->post_content ); ?>
				</div>
			</div>
		</div>
		<?php
	endif;
}

function crossfit_dashboard_new_page_widget() {
	?>
	<p class="crossfit-dash-widget">
		<a href="<?php echo admin_url( 'post-new.php?post_type=page' ); ?>" class="crossfit-dash-widget-icon">
			<span class="dashicons dashicons-plus"></span>
		</a>
	</p>
	<?php
}

function crossfit_dashboard_edit_menu_widget() {
	?>
	<p class="crossfit-dash-widget">
		<a href="<?php echo admin_url( 'customize.php?autofocus[panel]=nav_menus' ); ?>" class="crossfit-dash-widget-icon">
			<span class="dashicons dashicons-edit"></span>
		</a>
	</p>
	<?php
}