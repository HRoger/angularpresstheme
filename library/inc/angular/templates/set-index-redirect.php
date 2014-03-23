<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 15.12.13
 * Time: 09:22
 */

/**
 * When page (frontpage '/') loads or reloads then set a template_req session
 * at the template_redirect hook time (just before template_include).
 * After that redirect to index.php with redirect_all_pages_to_index_template() using
 * 'template_include' hook.
 *
 * */
function angp_set_index_for_redirect() {

	if (!is_front_page()) return;

	if (!isset($_SESSION['template_req'])) {
		angp_set_session('index.php', 'template_req');
	}
}

add_action('template_redirect', 'angp_set_index_for_redirect', 10);


/**
 * When pages (other then the frontpage) loads the first time  then set a
 * template_req_pages session at the wp_head(for page preview) and get_header(for frontend) hook time.
 * But redirection will just happens after page is reloaded from the second time onwards with
 * redirect_other_pages_to_index_template() using 'template_include' hook.
 *
 * */
function angp_set_index_for_pages_redirect() {

	if (is_front_page()) return;

	if (!isset($_SESSION['template_req_pages'])) {
		angp_set_session('index.php', 'template_req_pages');
	}

}

add_action('wp_head', 'angp_set_index_for_pages_redirect');
add_action('get_header', 'angp_set_index_for_pages_redirect', 20);