<?php
if (!session_id() ) {
	session_start();
}
/**
 * Reactor Theme Functions
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.1.0
 * @copyright Copyright (c) 2013, Anthony Wilhelm
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */
/** @noinspection PhpIncludeInspection */
require locate_template('/library/reactor.php');
/** @noinspection PhpIncludeInspection */
require locate_template('/library/angularpress.php');
new Angularpress();

/*
function test() {

	global $angularpress_option;
	FB::info($angularpress_option, '$angularpress_option');
	FB::info( $angularpress_option['opt-text-login-slug'],' opt-text-login-slug');
	FB::info( $angularpress_option['opt-text-secret-key'],' opt-text-secret-key');
	FB::info( $angularpress_option['opt-text-admin-slug'],' opt-text-admin-slug');

}

add_action('admin_init', 'test');*/
