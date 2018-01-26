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

	if ( $post->ID != get_option( 'page_on_front' ) ) {
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
	?>
    <h3>Home Video</h3>
    <p>
        <label>
            Video URL<br/>
            <input type="text" class="regular-text" name="_crossfit_home_video_url"
                   value="<?php echo esc_attr( get_post_meta( $post->ID, '_crossfit_home_video_url', true ) ); ?>"/>
        </label>
    </p>
    <p>
        <label>
            Video Section Title<br/>
            <input type="text" class="regular-text" name="_crossfit_home_video_title"
                   value="<?php echo esc_attr( get_post_meta( $post->ID, '_crossfit_home_video_title', true ) ); ?>"/>
        </label>
    </p>
	<?php

	$tables = array(
		'gold'     => 'Gold',
		'platinum' => 'Platinum',
		'premium'  => 'Premium',
	);
	foreach ( $tables as $table_ID => $table_name ) {

		$ptable_price   = get_post_meta( $post->ID, "ptable_{$table_ID}_price", true );
		$ptable_bullets = get_post_meta( $post->ID, "ptable_{$table_ID}_bullets", true );
		?>
        <h3>Pricing Table <?php echo $table_name ?></h3>
		<?php if ( $table_ID === 'premium' ) : ?>
			<?php $ptable_title   = get_post_meta( $post->ID, "ptable_{$table_ID}_title", true ); ?>
			<?php $ptable_original_price   = get_post_meta( $post->ID, "ptable_{$table_ID}_original_price", true ); ?>
			<?php $ptable_description   = get_post_meta( $post->ID, "ptable_{$table_ID}_description", true ); ?>
            <hr/>
            <p class="description">
                Premium Table Custom Options
            </p>
            <p>
                <label>
                    Title
                    <br/>
                    <input type="text" class="regular-text" name="ptable_<?php echo $table_ID; ?>_title"
                           value="<?php echo $ptable_title; ?>"/>
                </label>
                <br/>
            </p>
            <p>
                <label>
                    Description
                    <br/>
                    <textarea name="ptable_<?php echo $table_ID; ?>_description" style="height: 8em; width: 25em; max-width: 100%;"
                    ><?php echo $ptable_description; ?></textarea>
                </label>
                <br/>
            </p>
            <p>
                <label>
                    Original Price
                    <br/>
                    <input type="text" class="regular-text" name="ptable_<?php echo $table_ID; ?>_original_price"
                           value="<?php echo $ptable_original_price; ?>"/>
                </label>
                <br/>
            </p>
            <hr/>
		<?php endif; ?>
        <p>
            <label>
                Price
                <br/>
                <input type="text" class="regular-text" name="ptable_<?php echo $table_ID; ?>_price"
                       value="<?php echo $ptable_price; ?>"/>
            </label>
        </p>
        <p>
            <label>
                Bullets
                <br/>
                <textarea name="ptable_<?php echo $table_ID; ?>_bullets" style="height: 8em; width: 25em; max-width: 100%;"
                ><?php echo $ptable_bullets; ?></textarea>
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
		'ptable_gold_price',
		'ptable_gold_bullets',
		'ptable_platinum_price',
		'ptable_platinum_bullets',
		'ptable_premium_price',
		'ptable_premium_bullets',
		'ptable_premium_original_price',
		'ptable_premium_description',
		'ptable_premium_title',
		'_crossfit_home_video_url',
		'_crossfit_home_video_title',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}