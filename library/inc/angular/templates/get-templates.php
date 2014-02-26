<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 17.10.13
 * Time: 15:23
 */

/**
 * This code generates the angularjs html views templates
 * It uses HTTP-API with  wp_remote_get()
 * */
function angp_get_template_content($new_status, $old_status) {
	global $post;

	if (isset($post->post_name)) {
		$post_slug = $post->post_name;


		$file = get_template_directory() . '/library/views/pages/' . $post_slug . '.html';

		if (($old_status != 'trash' && $new_status == 'trash')) {
			if (file_exists($file))
				unlink($file);
		}
	}
	if (($old_status != 'publish' && $new_status == 'publish') || did_action('wp_insert_post') === 1) {


		angp_get_page_http_api(site_url(), 'newsloop');
		$pages = get_pages(array('sort_order' => 'asc'));

		if (!empty($pages))

			foreach ($pages as $page) {

				$slug = $page->post_name;
				$url = get_page_link($page->ID);

				angp_set_session('index.php', 'template_req');
				angp_get_page_http_api($url, $slug);

			}
	}
}


//change this wp-admin to options value and wp-login
if ($_SERVER['REQUEST_URI'] == '/wp-admin/nav-menus.php'
	|| (isset($_POST['action']) && $_POST['action'] == 'add-menu-item')
	|| (@$_POST['post_type'] == 'post')
) return;


add_action('quick_edit_custom_box', 'angp_get_template_content', 10, 2);
add_action('wp_insert_post', 'angp_get_template_content', 20, 2);
add_action('transition_post_status', 'angp_get_template_content', 20, 2);
add_action('wp_restore_post_revision', 'angp_get_template_content', 10, 2);
//add_action('admin_init', 'angp_get_template_content', 10, 3);