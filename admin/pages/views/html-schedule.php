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
?>

<div class="wrap">

	<h2>
		Class Schedule <a href="<?php echo admin_url( 'post-new.php' ); ?>?post_type=class" class="add-new-h2" target="">Add Class</a>
	</h2>

	<?php include get_template_directory() . '/partials/class-schedule.php'; ?>

</div>