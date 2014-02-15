<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 17.10.13
 * Time: 15:18
 */
if (!function_exists('wp_to_angular_template_generator')) {
	function angp_wp_to_angular_template_generator($slug, $body_response) {
//        FB::info($body_response,'body_response');
		if ($slug === 'newsloop') {
			$file = get_template_directory() . '/library/views/loops/' . $slug . '.html';
		} else {
			$file = get_template_directory() . '/library/views/pages/' . $slug . '.html';
		}

		if (!empty($body_response)) {

			try {
				global $checkfile;

				if(file_exists($file)){
					$checkfile = file_get_contents($file);

				}
				if ($body_response !== $checkfile || $checkfile === '' || !isset($checkfile)) {

					file_put_contents($file, $body_response, LOCK_EX);

					return false;
				}

			} catch (Exception $ex) {

				return 'Could not write file!';
			}


		}
	}
}