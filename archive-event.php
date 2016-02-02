<?php
/**
 * The theme's index file used for displaying an archive of blog posts.
 *
 * @since 0.1.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();
?>

<?php
global $post;

// Get date to use
$view_day = (int) isset( $_REQUEST['cal_day'] )
	? (int) $_REQUEST['cal_day']
	: date_i18n( 'j' );

$view_month = (int) isset( $_REQUEST['cal_month'] )
	? (int) $_REQUEST['cal_month']
	: date_i18n( 'n' );

$view_year = (int) isset( $_REQUEST['cal_year'] )
	? (int) $_REQUEST['cal_year']
	: date_i18n( 'Y' );

// Get timestamp
$view_timestamp        = mktime( 0, 0, 0, $view_month, 1, $view_year );
$view_month_maxday     = date_i18n( 't', $view_timestamp );
$view_month_properties = getdate( $view_timestamp );
$view_weekday_start    = $view_month_properties['wday'];

// Get today
$today_month = date_i18n( 'n' );
$today_day   = date_i18n( 'j' );
$today_year  = date_i18n( 'Y' );
$is_month    = $today_month == $view_month && $today_year == $view_year;

// Get events
$view_start = "{$view_year}-{$view_month}-01 00:00:00";
$view_end   = "{$view_year}-{$view_month}-31 00:00:00";

$month_events = array();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		$event_all_day      = get_post_meta( get_the_ID(), 'wp_event_calendar_all_day', true );
		$event_start        = get_post_meta( get_the_ID(), 'wp_event_calendar_date_time', true );
		$event_end          = get_post_meta( get_the_ID(), 'wp_event_calendar_end_date_time', true );
		$event_day_of_month = date_i18n( 'j', strtotime( $event_start ) );

		if ( ! isset( $month_events[ $event_day_of_month ] ) ) {
			$month_events[ $event_day_of_month ] = array();
		}

		$event_start_day = (int) date_i18n( 'j', strtotime( $event_start ) );
		$event_end_day   = (int) date_i18n( 'j', strtotime( $event_end ) );

		$day_iterator = $event_start_day;
		while ( $day_iterator <= $event_end_day ) {

			$month_events[ $day_iterator ][ get_the_ID() ] = array(
				'title'     => get_the_title(),
				'permalink' => get_permalink(),
				'all_day'   => $event_all_day,
				'event_end' => $event_end,
			);

			$day_iterator ++;
		}
	}
}
?>

	<div id="jc-calendar" class="row">
		<div class="columns small-12">
			<div class="calendar-pagination">
				<?php
				$previous_timestamp = strtotime( "-1 month", $view_timestamp );
				$next_timestamp     = strtotime( "+1 month", $view_timestamp );

				$next_month     = date_i18n( 'n', $next_timestamp );
				$previous_month = date_i18n( 'n', $previous_timestamp );

				$previous_year = date_i18n( 'Y', $previous_timestamp );
				$next_year     = date_i18n( 'Y', $next_timestamp );

				$previous_args = array( 'cal_year' => $previous_year, 'cal_month' => $previous_month );
				$next_args     = array( 'cal_year' => $next_year, 'cal_month' => $next_month );

				$previous_link = add_query_arg( $previous_args );
				$next_link     = add_query_arg( $next_args );
				?>

				<span class="current-month">
			<?php echo date( 'F', $view_timestamp ); ?>
		</span>

				<a href="<?php echo $previous_link; ?>" class="previous-link">
					<< <?php echo date( 'F', $previous_timestamp ); ?>
				</a>

				<a href="<?php echo $next_link; ?>" class="next-link">
					<?php echo date( 'F', $next_timestamp ); ?> >>
				</a>
			</div>

			<table class="calendar-table">
				<thead>
				<tr>
					<th>Sunday</th>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Wednesday</th>
					<th>Thursday</th>
					<th>Friday</th>
					<th>Saturday</th>
				</tr>
				</thead>
				<tbody>
				<?php for ( $week = 1; $week <= 5; $week ++ ) : ?>
					<tr class="week week-<?php echo $week; ?>">
						<?php for ( $weekday = 1; $weekday <= 7; $weekday ++ ) : ?>
							<?php
							// Establish day information
							$view_day     = ( ( $week - 1 ) * 7 ) + $weekday;
							$day_of_month = (int) ( $view_day - (int) $view_weekday_start );
							$is_in_month  = $day_of_month > 0 && $day_of_month <= $view_month_maxday;

							// Get classes for this day
							$day_events = isset( $month_events[ $day_of_month ] ) ? $month_events[ $day_of_month ] : array();

							$classes = "day day-$view_day weekday-$weekday" .
							           ( ! $is_month ? ' outside-month' : '' ) .
							           ( $is_month && $today_day == $day_of_month ? ' today' : '' ) .
							           ( $day_events ? ' has-events' : ' no-events' );
							?>
							<td class="<?php echo $classes; ?>">
								<div class="day-container">
									<?php if ( $is_in_month ) : ?>
										<span class="day-indicator"><?php echo $day_of_month; ?></span>
									<?php endif; ?>

									<?php if ( $day_events ) : ?>
										<ul class="day-events">
											<?php foreach ( $day_events as $day_event_ID => $day_event ) : ?>
												<li>
													<a href="<?php echo $day_event['permalink']; ?>">
														<?php echo $day_event['title']; ?>
													</a>

													<div class="event-tooltip">
														<p class="event-title">
															<a href="<?php echo $day_event['permalink']; ?>">
																<span class="fa fa-link"></span>
																<?php echo $day_event['title']; ?>
															</a>
														</p>

														<?php
														$post = get_post( $day_event_ID );
														setup_postdata( $post );

														$event_all_day = get_post_meta( get_the_ID(), 'wp_event_calendar_all_day', true );
														$event_start   = get_post_meta( get_the_ID(), 'wp_event_calendar_date_time', true );
														$event_end     = get_post_meta( get_the_ID(), 'wp_event_calendar_end_date_time', true );

														$event_location = get_post_meta( get_the_ID(), 'wp_event_calendar_location', true );
														?>

														<div class="event-details">
															<div class="event-details-row event-date">
																<div class="event-icon">
																	<p class="fa fa-calendar"></p>
																</div>
																<div class="event-meta">
																	<?php echo date( get_option( 'date_format' ), strtotime( $event_start ) ); ?>
																</div>
															</div>

															<?php if ( ! $event_all_day ) : ?>
																<div class="event-details-row event-time">
																	<div class="event-icon">
																		<p class="fa fa-clock-o"></p>
																	</div>
																	<div class="event-meta">
																		<?php echo date( get_option( 'time_format' ), strtotime( $event_start ) ); ?>
																	</div>
																</div>
															<?php endif; ?>

															<?php if ( $event_location ) : ?>
																<div class="event-details-row event-location">
																	<div class="event-icon">
																		<p class="fa fa-map-marker"></p>
																	</div>
																	<div class="event-meta">
																		<?php echo do_shortcode( wpautop( $event_location ) ); ?>
																	</div>
																</div>
															<?php endif; ?>
														</div>
														<?php wp_reset_postdata(); ?>
													</div>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</div>
							</td>
						<?php endfor; ?>
					</tr>
				<?php endfor; ?>
				</tbody>
			</table>
		</div>
	</div>

<?php
get_footer();