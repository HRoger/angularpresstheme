<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 15.12.13
 * Time: 09:18
 */

/**
 * This tells the browser at the init hook phase that we are loading a page for the first time
 * ever. It works for pages other then '/'. Redirection will be done by angularjs in app.js
 * MainCtrl
 *
 * */
function angp_is_page_first_loaded() {
	if (!isset($_SESSION['template_req_onload'])) {
		angp_set_session('template_req_onload', 'template_req_onload');

	}
}

add_action('init', 'angp_is_page_first_loaded', 10);

/**
 * This tells the browser at the get_header hook phase to delete 'template_req_onload' after the
 * page is fully loaded, so that dont get into a redirection loop. It checks if $_COOKIE['is_page_loaded']
 * or $_SESSION['page_loaded'] were already set. *
 *
 * */
function destroy_session_index_onload() {
	//cookie set in app.js
	if (isset($_COOKIE['is_page_loaded']) || isset($_SESSION['page_loaded'])) {
		unset($_SESSION['template_req_onload']);

	}
}

add_action('get_header', 'destroy_session_index_onload', 20);

/**
 * Set session page_loaded when page is fully loaded
 * $_COOKIE['is_page_loaded'] does the same for google chrome canary
 *
 * */

function angp_page_fully_loaded() {
	angp_set_session('page_loaded', 'page_loaded');
}
add_action('wp_footer', 'angp_page_fully_loaded');
add_action('get_footer', 'angp_page_fully_loaded', 20);

