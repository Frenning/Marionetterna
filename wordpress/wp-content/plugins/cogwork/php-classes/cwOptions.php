<?php

class cwOptions {

	public function __construct() {

	}

	public function echoOptionsPageContent() {
?>

	<div class="wrap">

		<h2>CogWork Plugin Settings</h2>

		<form method="post" action="options.php">

			<?php settings_fields('cogwork_settings_options'); ?>
			<?php $options = get_option('cogwork_option'); ?>

			<table class="form-table">

				<tr valign="top">
					<th scope="row"><?php _e('Organisation code within CW', 'cogwork'); ?></th>
					<td><input type="text" name="cogwork_option[orgCode]" value="<?php echo $options['orgCode']; ?>" /></td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e('External CW server', 'cogwork'); ?></th>
					<td>
						<select name="cogwork_option[websiteCode]">
							<option value="minaaktiviteter" <?php if ( $options['websiteCode'] == 'minaaktiviteter' ) echo 'selected="selected"'; ?>>MinaAktiviteter.se</option>
							<option value="dans" <?php if ( $options['websiteCode'] == 'dans' ) echo 'selected="selected"'; ?>>Dans.se</option>
							<option value="idrott" <?php if ( $options['websiteCode'] == 'idrott' ) echo 'selected="selected"'; ?>>Idrott.se</option>
							<option value="test" <?php if ( $options['websiteCode'] == 'test' ) echo 'selected="selected"'; ?>>Test</option>
							<option value="local" <?php if ( $options['websiteCode'] == 'local' ) echo 'selected="selected"'; ?>>Localhost</option>
						</select>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e('CW server connection', 'cogwork'); ?></th>
					<td>
						<select name="cogwork_option[protocol]">
							<option value="https" <?php if ( $options['protocol'] == 'https' ) echo 'selected="selected"'; ?>>https (secure)</option>
							<option value="http" <?php  if ( $options['protocol'] == 'http'  ) echo 'selected="selected"'; ?>>http</option>
						</select>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e('API key', 'cogwork'); ?></th>
					<td><input type="text" name="cogwork_option[apiKey]" value="<?php echo $options['apiKey']; ?>" /></td>
				</tr>

			</table>

			<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes', 'cogwork'); ?>" /></p>

		</form>
	</div>

	<h3>Usage</h3>
	<p>To include a list of events/articles you only need to write [cw shop] on the web pages where you want it to show.
	You can also add one or more filters, e.g. [cw shop eventGroup="barn"].
	If you edit the page in HTML-mode you can place the shortcode within a div-block to prevent WP from automatically placing
	it within a p-tag. Then the html-code will be &lt;div&gt;[cw shop]&lt;/div&gt;.</p>

	<h3>More information</h3>
	<p><a href="https://minaaktiviteter.se/help/api/wordpress/" target="_blank">https://minaaktiviteter.se/help/api/wordpress/</a></p>

<?php
	}

	/**
	 * @param array $input
	 * @return array
	 *
	 * Sanitize and validate input.
	 * Accepts an array, return a sanitized array
	 */
	public static function validateInput($input) {

		// Remove any HTML tags
		$input['orgCode'    ] =  wp_filter_nohtml_kses($input['orgCode']);
		$input['websiteCode'] =  wp_filter_nohtml_kses($input['websiteCode']);

		return $input;
	}
}

?>