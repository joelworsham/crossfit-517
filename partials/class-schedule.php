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
		$type = false;

		if ( $type_post_ID = get_post_meta( $class->ID, '_class_type', true ) ) {
			$type = get_the_title( $type_post_ID );
		}

		$classes[ $day ][ $time ] = array(
			'ID'   => $class->ID,
			'type' => $type,
		);

		if ( ! in_array( $time, $times ) ) {
			$times[] = $time;
		}
	}

	uasort( $times, function ( $a, $b ) {
		return strtotime( $a ) - strtotime( $b );
	} );
//	sort( $times, SORT_NUMERIC );
}

if ( $classes ) :

	crossfit_debug( $classes );

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
		<?php foreach ( $weekdays as $i => $day ) : ?>
			<div class="day <?php echo strtolower( $day ); ?>">
				<h3 class="day-name">
					<?php echo $day; ?>
				</h3>

				<?php
				foreach ( $times as $time ) :

					$class = isset( $classes[ strtolower( $day ) ][ $time ] ) ? $classes[ strtolower( $day ) ][ $time ] : false;

					if ( ! $class ) {
						continue;
					}
					?>
					<div class="class <?php echo $class ? $class['type'] : 'blank'; ?>">
						<?php
						if ( $class && is_admin() ) {
							?>
							<a href="<?php echo get_delete_post_link( $class['ID'] ); ?>">
								<?php
								echo date( 'g:iA', strtotime( $time ) );
								echo $class['type'] ? "&nbsp;($class[type])" : '';
								echo '<span class="dashicons dashicons-trash"></span>';
								?>
							</a>
							<?php
						} elseif ( $class ) {

							echo '<span class="class-time">' . date( 'g:iA', strtotime( $time ) ) . '</span>';
							echo $class['type'] ? "<br/><span class=\"class-type\">($class[type])</span>" : '';
						} else {
							echo '&nbsp;';
						}
						?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
endif;