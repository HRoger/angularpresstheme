<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 28.10.13
 * Time: 17:20
 */


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


