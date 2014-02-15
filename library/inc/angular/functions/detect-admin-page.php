<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 30.10.13
 * Time: 00:10
 */
if (!function_exists('is_edit_page')) {
	function is_edit_page($new_edit = null) {
		global $pagenow;

		if (!is_admin()) return false;

		switch ($new_edit) {
			case "edit":
				return in_array($pagenow, array('post.php',));
				break;
			case "new":
				return in_array($pagenow, array('post-new.php',));
				break;
			case "edit_page":
				return in_array($pagenow, array('edit.php'));
				break;
			case null:
				return in_array($pagenow, array('post.php', 'post-new.php', 'edit.php'));
				break;
		}


	}

}