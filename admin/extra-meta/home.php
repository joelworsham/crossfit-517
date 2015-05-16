<?php
/**
 * Home extra meta.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', '_crossfit_add_metaboxes_home' );
add_action( 'save_post', '_crossfit_save_metaboxes_home' );

function _crossfit_add_metaboxes_home() {

	global $post;

	if ( $post->ID != get_option('page_on_front') ) {
		return;
	}

	add_meta_box(
		'crossfit_mb_home_extra',
		'Home Settings',
		'_crossfit_mb_home_extra_callback',
		'page'
	);
}

function _crossfit_mb_home_extra_callback() {

	global $post;

	wp_nonce_field( __FILE__, 'crossfit_mb_home_extra_nonce' );

	$get_started_post = get_post_meta( $post->ID, '_get_started_post', true );
	?>

	<p>
		<label>
			Getting Started Page
			<br/>
			<?php
			wp_dropdown_pages( array(
				'id' => '_get_started_post',
				'name' => '_get_started_post',
				'selected' => $get_started_post ? $get_started_post : 0,
				'show_option_none' => '- Select a Post -',
			));
			?>
		</label>
	</p>

<?php
}

function _crossfit_save_metaboxes_home( $post_ID ) {

	if ( ! isset( $_POST['crossfit_mb_home_extra_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['crossfit_mb_home_extra_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_get_started_post',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}