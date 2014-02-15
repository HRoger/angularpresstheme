<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 16.12.13
 * Time: 11:47
 */
function angp_admin_bar() {
	global $wp_admin_bar;

	$wp_admin_bar->remove_node('edit');
}

add_action('wp_before_admin_bar_render', 'angp_admin_bar', 10);

