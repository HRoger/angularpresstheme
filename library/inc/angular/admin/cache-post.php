<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 25.02.14
 * Time: 02:02
 */


function angp_on_publish_post_delete_cache() {
		angp_set_session('delete_post_cache_key','delete_post_cache_key');
}
add_action('publish_post','angp_on_publish_post_delete_cache',10);


function destroy_session_on_publish_post_delete_cache() {

	if (isset($_SESSION['delete_post_cache_key'])) {
		unset($_SESSION['delete_post_cache_key']);
	}
}
add_action('get_footer', 'destroy_session_on_publish_post_delete_cache', 20);