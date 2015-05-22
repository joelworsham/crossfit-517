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

add_action( 'add_meta_boxes', '_crossfit_add_metaboxes_home', 1 );
add_action( 'save_post', '_crossfit_save_metaboxes_home', 1 );

function _crossfit_add_metaboxes_home() {

	global $post;

	if ( $post->ID != get_option('page_on_front') ) {
		return;
	}

	remove_post_type_support( 'page', 'editor' );

	add_meta_box(
		'crossfit_mb_home_extra',
		'Home Settings',
		'_crossfit_mb_home_extra_callback',
		'page',
		'normal',
		'high'
	);
}

function _crossfit_mb_home_extra_callback() {

	global $post;

	wp_nonce_field( __FILE__, 'crossfit_mb_home_extra_nonce' );

	for ( $i = 1; $i < 4; $i ++ ) {

		$ptable_title   = get_post_meta( $post->ID, "_ptable{$i}_title", true );
		$ptable_price   = get_post_meta( $post->ID, "_ptable{$i}_price", true );
		$ptable_bullets = get_post_meta( $post->ID, "_ptable{$i}_bullets", true );
		$ptable_highlighted = get_post_meta( $post->ID, "_ptable{$i}_highlighted", true );
		?>
		<h3>Pricing Table <?php echo $i; ?></h3>
		<p>
			<label>
				Title
				<br/>
				<input type="text" class="regular-text" name="_ptable<?php echo $i; ?>_title"
				       value="<?php echo $ptable_title; ?>"/>
			</label>
		</p>
		<p>
			<label>
				Price
				<br/>
				<input type="text" class="regular-text" name="_ptable<?php echo $i; ?>_price"
				       value="<?php echo $ptable_price; ?>"/>
			</label>
		</p>
		<p>
			<label>
				Bullets
				<br/>
				<textarea name="_ptable<?php echo $i; ?>_bullets" style="height: 8em; width: 25em; max-width: 100%;"
					><?php echo $ptable_bullets; ?></textarea>
			</label>
		</p>
		<p>
			<label>
				Highighted
				<input type="checkbox" name="_ptable<?php echo $i; ?>_highlighted"
				       value="1" <?php checked( '1', $ptable_highlighted ); ?>/>
			</label>
		</p>
	<?php
	}
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
		'_ptable1_title',
		'_ptable1_price',
		'_ptable1_bullets',
		'_ptable1_highlighted',
		'_ptable2_title',
		'_ptable2_price',
		'_ptable2_bullets',
		'_ptable2_highlighted',
		'_ptable3_title',
		'_ptable3_price',
		'_ptable3_bullets',
		'_ptable3_highlighted',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}