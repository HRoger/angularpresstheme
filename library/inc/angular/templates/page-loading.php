<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 15.12.13
 * Time: 09:18
 */

function angp_is_page_first_loaded() {
	if (!isset($_SESSION['template_req_onload'])) {
		angp_set_session('template_req_onload', 'template_req_onload');

	}
}

add_action('init', 'angp_is_page_first_loaded', 10);

function destroy_session_index_onload() {
	//cookie set in app.js
	if (isset($_COOKIE['is_page_loaded'])) {
		unset($_SESSION['template_req_onload']);

	}
}

add_action('get_header', 'destroy_session_index_onload', 20);

/*function angp_page_fully_loaded() {
	angp_set_session('page_loaded', 'page_loaded');
}
add_action('wp_footer', 'angp_page_fully_loaded');
add_action('get_footer', 'angp_page_fully_loaded', 20);*/

