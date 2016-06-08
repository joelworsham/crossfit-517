<?php
/**
 * CrossFit Schedule page HTML.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$classes = get_posts( array(
	'post_type'   => 'specialty-class',
	'numberposts' => - 1,
) );
?>

<div class="wrap">

	<h2>
		Class Schedule
	</h2>

	<form method="post">

		<?php wp_nonce_field( 'add_class', '_crossfit_add_class_nonce' ); ?>

		<p>
			<label>
				<span class="screen-reader-text">Day</span>
				<select name="_day">
					<option value="0">- Select a Day -</option>
					<option value="sunday">Sunday</option>
					<option value="monday">Monday</option>
					<option value="tuesday">Tuesday</option>
					<option value="wednesday">Wednesday</option>
					<option value="thursday">Thursday</option>
					<option value="friday">Friday</option>
					<option value="saturday">Saturday</option>
				</select>
			</label>

			<label>
				<span class="screen-reader-text">Time</span>
				<select name="_time">
					<option value="0">- Select a Time -</option>
					<?php for ( $i = 6; $i <= 21; $i ++ ): ?>
						<option value="<?php echo "$i:00"; ?>">
							<?php echo date( 'h:iA', strtotime( "$i:00" ) ); ?>
						</option>

						<option value="<?php echo "$i:30"; ?>">
							<?php echo date( 'h:iA', strtotime( "$i:30" ) ); ?>
						</option>
					<?php endfor; ?>
				</select>
			</label>

			<?php if ( $classes ) : ?>
				<label>
					<span class="screen-reader-text">Type</span>
					<select name="_class_type">
						<option value="0">- Select a Class Type -</option>
						<?php foreach ( $classes as $class ) : ?>
							<option value="<?php echo $class->ID; ?>">
								<?php echo $class->post_title; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</label>
			<?php endif; ?>

			<input type="submit" class="button" value="Add Class"/>
		</p>
	</form>

	<div style="clear: both;"></div>

	<p class="description">
		Click a class to delete it
	</p>

	<?php include get_template_directory() . '/partials/class-schedule.php'; ?>

</div>