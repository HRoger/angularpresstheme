<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 15.12.13
 * Time: 08:50
 */

if (!function_exists('angp_set_session')) {

	function angp_set_session($key_name, $template_req_name) {

		$template_req = $key_name;
		$key = $template_req_name;
		$_SESSION[$key]['url'] = $template_req;

	}
}