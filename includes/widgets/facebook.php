<?php
/**
 * Widget: Facebook.
 *
 * @since   1.0.0
 * @package CrossFit
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'widgets_init', function () {
	register_widget( 'CrossFit_Widget_Facebook' );
} );

/**
 * Class CrossFit_Widget_Facebook
 *
 * Widget for showing Images.
 *
 * @since 1.0.0
 */
class CrossFit_Widget_Facebook extends WP_Widget {

	public function __construct() {

		// Build the widget
		parent::__construct(
			'crossfit_widget_facebook',
			'Facebook Feed',
			array(
				'description' => 'Displays Facebook feed for CrossFit 517.',
			)
		);
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		echo '<iframe class="sidebar-facebook" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fcrossfit517&amp;width&amp;height=395&amp;colorscheme=dark&amp;show_faces=false&amp;header=false&amp;stream=true&amp;show_border=false&amp;appId=633397130065284" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:395px;" allowTransparency="true"></iframe>';

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