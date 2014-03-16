<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 16.03.14
 * Time: 04:08
 */

add_action('admin_notices', 'my_admin_notice');

function my_admin_notice() {

	$set_errors = get_settings_errors();

	if (current_user_can('manage_options') && !empty($set_errors)) {

		if ($set_errors[0]['code'] == 'settings_updated' && isset($_GET['settings-updated'])) {

			if (get_option('show_on_front') == 'page') {

				echo '<div id="message" class="updated ">
                <p>Don\'t forget update your Blog page! Click here: <a href="' . admin_url
					('edit.php?post_type=page') .
					'">Edit Pages</a> </p>
						 </div>';

			} else {

				echo '<div id="message" class="updated ">
                <p>Don\'t forget update Front and Posts pages! Click here: <a href="' . admin_url
					('edit.php?post_type=page') .
					'">Edit Pages</a> </p>
						 </div>';

			}

		}

	}

}