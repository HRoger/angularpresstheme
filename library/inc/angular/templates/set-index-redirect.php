<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 15.12.13
 * Time: 09:22
 */

function angp_set_index_for_redirect() {

	if (!is_front_page()) return;

	angp_set_session('index.php', 'template_req');

}

add_action('wp_head', 'angp_set_index_for_redirect');
add_action('get_header', 'angp_set_index_for_redirect', 10);
add_action('template_redirect', 'angp_set_index_for_redirect', 10);


function angp_set_index_for_pages_redirect() {
	angp_set_session('index.php', 'template_req_pages');

}

add_action('wp_head', 'angp_set_index_for_pages_redirect');
add_action('get_header', 'angp_set_index_for_pages_redirect', 10);
