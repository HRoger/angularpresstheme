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

	if (!isset($_SESSION['page_for_posts']) || !isset($_SESSION['page_on_front'])) {

		$_SESSION['page_for_posts'] = get_option('page_for_posts');
		$_SESSION['page_on_front'] = get_option('page_on_front');
	}

	if (current_user_can('manage_options') && !empty($set_errors) &&
		$_SERVER['PHP_SELF'] === '/wp-admin/options-reading.php'
	) {

		if ($set_errors[0]['code'] == 'settings_updated' && isset($_GET['settings-updated']) &&
			($_SESSION['page_for_posts'] !== get_option('page_for_posts') ||
				$_SESSION['page_on_front'] !== get_option('page_on_front'))
		) {

			$_SESSION['page_for_posts'] = get_option('page_for_posts');
			$_SESSION['page_on_front'] = get_option('page_on_front');

			if (get_option('show_on_front') == 'page') {

				echo '<div id="message" class="updated ">
                <p>Please, don\'t forget to update your Blog page. Click here: <a href="' .
					admin_url
					('edit.php?post_type=page') .
					'">Edit Pages</a> </p>
						 </div>';

			} else {

				echo '<div id="message" class="updated ">
                <p>Please, don\'t forget to update Front and Posts pages. Click here: <a href="' .
					admin_url
					('edit.php?post_type=page') .
					'">Edit Pages</a> </p>
						 </div>';

			}

		}

	}

}