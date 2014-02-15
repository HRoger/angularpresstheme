<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 12.12.13
 * Time: 18:17
 */

if (!function_exists('log_it')) {
	function log_it($message) {
		if (WP_DEBUG === true) {
			if (is_array($message) || is_object($message)) {
				error_log(print_r($message, true));
			} else {
				error_log($message);
			}
		}
	}
}
