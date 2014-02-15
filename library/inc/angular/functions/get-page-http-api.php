<?php
/**
 * Created by IntelliJ IDEA.
 * User: ROGER
 * Date: 23.12.13
 * Time: 06:19
 */
if (!function_exists('angp_get_page_http_api')) {
	function angp_get_page_http_api($url, $slug) {

		$response = wp_remote_get($url);

		if (is_wp_error($response) || (200 != wp_remote_retrieve_response_code($response))) {
			wp_die('Request could not be executed.');

		}

		try {

			$result = wp_remote_retrieve_body($response);

			if ($url !== site_url()) {
				preg_match_all('/<content[^>]*>(.*?)<\/content>/is', $result, $t);
				angp_wp_to_angular_template_generator($slug, $t[1][0]);

			} else {
				preg_match_all('/<homenewsloop[^>]*>(.*?)<\/homenewsloop>/is', $result, $t);
				angp_wp_to_angular_template_generator($slug, $t[1][0]);

			}


		} catch (Exception $ex) {
			return $ex;

		}

	}

}