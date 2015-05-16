<?php
/**
 * Class post type.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'class', 'Class', 'Classes', array(
		'menu_icon' => 'dashicons-list-view',
		'supports'  => false,
		'rewrite'   => array( 'slug' => 'classes' ),
		'show_in_menu' => false,
	) );
} );


add_action( 'add_meta_boxes', function () {

	add_meta_box(
		'crossfit-class-meta',
		'Class Info',
		'_crossfit_metabox_class_meta',
		'class'
	);
} );

/**
 * The form callback for the testimonial role.
 *
 * @since  1.0.0
 * @access Private.
 *
 * @param object $post The current post object.
 */
function _crossfit_metabox_class_meta( $post ) {

	wp_nonce_field( __FILE__, 'class_meta_nonce' );

	$day = get_post_meta( $post->ID, '_day', true );
	$time = get_post_meta( $post->ID, '_time', true );
	$fire = get_post_meta( $post->ID, '_fire', true );
	?>
	<p>
		<label>
			Day
			<br/>
			<select name="_day">
				<option>- Select a Day -</option>
				<option value="sunday" <?php selected( 'sunday', $day ); ?>>Sunday</option>
				<option value="monday" <?php selected( 'monday', $day ); ?>>Monday</option>
				<option value="tuesday" <?php selected( 'tuesday', $day ); ?>>Tuesday</option>
				<option value="wednesday" <?php selected( 'wednesday', $day ); ?>>Wednesday</option>
				<option value="thursday" <?php selected( 'thursday', $day ); ?>>Thursday</option>
				<option value="friday" <?php selected( 'friday', $day ); ?>>Friday</option>
				<option value="saturday" <?php selected( 'saturday', $day ); ?>>Saturday</option>
			</select>
		</label>
	</p>

	<p>
		<label>
			Time
			<br/>
			<select name="_time">
				<option>- Select a Time -</option>
				<?php for ( $i = 6; $i <= 21; $i ++ ): ?>
					<option value="<?php echo "$i:00"; ?>" <?php selected( "$i:00", $time ); ?>>
						<?php echo date( 'h:iA', strtotime( "$i:00" ) ); ?>
					</option>

					<option value="<?php echo "$i:30"; ?>" <?php selected( "$i:30", $time ); ?>>
						<?php echo date( 'h:iA', strtotime( "$i:30" ) ); ?>
					</option>
				<?php endfor; ?>
			</select>
		</label>
	</p>

	<p>
		<label>
			Fire <input type="checkbox" name="_fire" value="1" <?php checked( '1', $fire ); ?> />
		</label>
	</p>
<?php
}

add_action( 'save_post', function ( $post_ID ) {

	if ( ! isset( $_POST['class_meta_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['class_meta_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_day',
		'_time',
		'_fire',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
} );