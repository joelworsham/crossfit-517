<?php
/**
 * Displays the class schedule.
 *
 * @since   0.1.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$classes = array();
$times   = array();

$class_posts = get_posts( array(
	'post_type'   => 'class',
	'numberposts' => - 1,
) );

if ( $class_posts ) {

	foreach ( $class_posts as $class ) {

		$day  = get_post_meta( $class->ID, '_day', true );
		$time = get_post_meta( $class->ID, '_time', true );
		$fire = get_post_meta( $class->ID, '_fire', true );

		$classes[ $day ][ $time ] = array(
			'ID'   => $class->ID,
			'fire' => $fire ? true : false,
		);

		if ( ! in_array( $time, $times ) ) {
			$times[] = $time;
		}
	}

	sort( $times, SORT_NUMERIC );
}

if ( $classes ) :

	$weekdays = array(
		'Sunday',
		'Monday',
		'Tuesday',
		'Wednesday',
		'Thursday',
		'Friday',
		'Saturday',
	);
	?>
	<div class="crossfit-schedule row">
		<?php foreach ($weekdays as $i => $day) : ?>
		<div class="day <?php echo strtolower( $day ); ?>">
			<h3 class="day-name">
				<?php echo $day; ?>
			</h3>

			<?php
			foreach ( $times as $time ) :
				$class = $classes[ strtolower( $day ) ][ $time ];
				?>
				<div class="class <?php echo $class ? '' : 'blank'; echo $class['fire'] ? 'fire' : ''; ?>">

					<?php echo is_admin() ? '<a href="' . get_edit_post_link( $class['ID'] ) . '">' : '' ; ?>
					<?php echo $class ? date( 'g:iA', strtotime( $time ) ) : ''; ?>
					<?php echo is_admin() ? '</a>' : ''; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<?php endforeach; ?>
	</div>
<?php
endif;