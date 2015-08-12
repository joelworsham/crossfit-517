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
					       class="regular-text"
					       value="<?php echo esc_attr( get_option( '_crossfit_phone' ) ); ?>"/>

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
					       class="regular-text"
					       value="<?php echo esc_attr( get_option( '_crossfit_email' ) ); ?>"/>
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
					       class="regular-text"
					       value="<?php echo get_option( '_crossfit_address_condensed' ); ?>"/>
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
						wp_editor( get_option( '_crossfit_address' ), '_crossfit_address', array(
							'teeny'         => true,
							'media_buttons' => false,
							'textarea_rows' => 6,
							'textarea_name' => '_crossfit_address',
						) );
						?>
					</div>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_crossfit_home_slider">
						Home Slider ID
					</label>
				</th>
				<td>
					<input type="text" name="_crossfit_home_slider" id="_crossfit_home_slider"
					       class="regular-text"
					       value="<?php echo get_option( '_crossfit_home_slider' ); ?>"/>
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
						'id'               => '_crossfit_getting_started_page',
						'name'             => '_crossfit_getting_started_page',
						'selected'         => $get_started_post ? $get_started_post : 0,
						'show_option_none' => '- Select a Post -',
					) );
					?>
				</td>
			</tr>

			<?php if ( function_exists( 'Ninja_Forms' ) ) : ?>
				<?php
				$all_forms = Ninja_Forms()->forms()->get_all();

				if ( ! empty( $all_forms ) ) :

					$getting_started_form = get_option( '_crossfit_getting_started_form' );
					?>
					<tr valign="top">
						<th scope="row">
							<label for="_crossfit_getting_started_form">
								Getting Started Form
							</label>
						</th>
						<td>
							<select id="_crossfit_getting_started_form" name="_crossfit_getting_started_form">
								<?php
								foreach ( $all_forms as $form_id ) :
									$title = Ninja_Forms()->form( $form_id )->get_setting( 'form_title' );
									?>
									<option value="<?php echo $form_id; ?>"
										<?php selected( $form_id, $getting_started_form ); ?>>
										<?php echo $title; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<?php
				endif;
			endif;
			?>

		</table>

		<?php submit_button(); ?>

	</form>

</div>