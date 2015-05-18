<?php
/**
 * CrossFit Settings page HTML.
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

	<h2>CrossFit Settings</h2>

	<form method="post" action="options.php">

		<?php settings_fields( 'crossfit-settings' ); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="_crossfit_phone">
						Phone
					</label>
				</th>
				<td>
					<input type="text" name="_crossfit_phone" id="_crossfit_phone"
					       value="<?php echo esc_attr( get_option('_crossfit_phone') ); ?>" />

					<p class="description">
						<strong>Preferred Format:</strong> 555.555.5555
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_crossfit_email">
						Email
					</label>
				</th>
				<td>
					<input type="text" name="_crossfit_email" id="_crossfit_email"
					       value="<?php echo esc_attr( get_option('_crossfit_email') ); ?>" />
				</td>
			</tr>


			<tr valign="top">
				<th scope="row">
					<label for="_crossfit_address_condensed">
						Address (condensed)
					</label>
				</th>
				<td>
					<input type="text" name="_crossfit_address_condensed" id="_crossfit_address_condensed"
					       style="max-width: 100%; width: 500px;"
					       value="<?php echo get_option('_crossfit_address_condensed'); ?>" />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_crossfit_address">
						Address
					</label>
				</th>
				<td>
					<div style="max-width: 100%; width:400px;">
						<?php
						wp_editor( get_option('_crossfit_address'), '_crossfit_address', array(
							'teeny' => true,
							'media_buttons' => false,
							'textarea_rows' => 6,
							'textarea_name' => '_crossfit_address',
						));
						?>
					</div>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_crossfit_getting_started_page">
						Getting Started Page
					</label>
				</th>
				<td>
					<?php
					$get_started_post = get_option( '_crossfit_getting_started_page' );
					wp_dropdown_pages( array(
						'id' => '_crossfit_getting_started_page',
						'name' => '_crossfit_getting_started_page',
						'selected' => $get_started_post ? $get_started_post : 0,
						'show_option_none' => '- Select a Post -',
					));
					?>
				</td>
			</tr>

		</table>

		<?php submit_button(); ?>

	</form>

</div>