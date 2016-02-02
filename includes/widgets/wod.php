<?php
/**
 * Widget: WOD.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'widgets_init', function () {
	register_widget( 'CrossFit_Widget_WOD' );
} );

/**
 * Class CrossFit_Widget_WOD
 *
 * Widget for showing Images.
 *
 * @since 1.0.0
 */
class CrossFit_Widget_WOD extends WP_Widget {

	public function __construct() {

		// Build the widget
		parent::__construct(
			'crossfit_widget_wod',
			'WOD',
			array(
				'description' => 'Displays the most recent WOD.',
			)
		);
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$wod = get_posts( array(
			'post_type'   => 'wod',
			'numberposts' => 1,
		) );

		/** @var $wod WP_Post */
		$wod = $wod ? $wod[0] : false;

		if ( $wod ) {
			?>
			<p class="date text-center">
				<span class="fa fa-calendar"></span><br/><span class="date-text"><?php echo get_the_date( '', $wod ); ?></span>
			</p>

			<div class="content">
				<?php echo do_shortcode( wpautop( $wod->post_content ) ); ?>
			</div>
		<?php
		}

		echo $args['after_widget'];
	}

	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>
	<?php
	}
}