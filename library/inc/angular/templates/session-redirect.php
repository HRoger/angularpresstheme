<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 28.10.13
 * Time: 17:20
 */

/**
 * when  '/' is reloaded (for the first time or not)
 * check if there is a  session key 'template_req'(that is set at template_redirect hook time
 * in angp_set_index_for_redirect()) and if yes redirect to  index.php
 *
 * */
function redirect_all_pages_to_index_template($template) {
	global $pagenow;

	if (('template_include' == current_filter()) && $pagenow
		== 'index.php'
	) {

		$key = 'template_req';
		if (isset($_SESSION[$key])) {

			$array = $_SESSION[$key];
			$req_url = $array['url'];

			$new_template = locate_template($req_url);

			if ('' != $new_template) {

				return $new_template;

			}
		}
	}

	return $template;
}

add_filter('template_include', 'redirect_all_pages_to_index_template', 10, 1);


/**
 * when a page other then '/' is reloaded (for the first time or not)
 * check if there is a  session key 'template_req_pages' and , if yes redirect to index.php
 * The session 'template_req_pages' is set in set-index-redirect.php with get_header and wp_head
 * hooks
 * */
function redirect_other_pages_to_index_template($template) {
	global $pagenow;

	if (('template_include' == current_filter()) && $pagenow
		== 'index.php'
	) {

		$key = 'template_req_pages';
		if (isset($_SESSION[$key])) {

			$array = $_SESSION[$key];
			$req_url = $array['url'];

			$new_template = locate_template($req_url);

			if ('' != $new_template) {

				return $new_template;

			}
		}
	}

	return $template;
}

add_filter('template_include', 'redirect_other_pages_to_index_template', 20, 1);