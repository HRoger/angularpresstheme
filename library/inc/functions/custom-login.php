<?php
/**
 * Customize Login
 * Portfolio, Slider and custom taxonomies
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://wp.smashingmagazine.com/2012/05/17/customize-wordpress-admin-easily/
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * 1. Change logo on login page
 * 2. Custom logo link url
 * 3. Logo title attribute text
 * 4. Change the order of admin menu items
 */

/**
 * 1. Change logo on login page
 *
 * @since 1.0.0
 */
function reactor_login_logo() {
	if ( reactor_option('login_logo') ) {
		$output  = "\n" . '<style type="text/css">'; 
		$output .= "\n\t" . 'h1 a { background-image: url("' . reactor_option('login_logo') . '") !important;' . "\n\t" . 'background-size: 275px 65px !important; }' . "\n";
		$output .= '</style>' . "\n";
				
		echo $output;
	}
}
add_action('login_head', 'reactor_login_logo');

/**
 * 2. Custom logo link url
 *
 * @since 1.0.0
 */
function reactor_login_logo_url() {
	if ( reactor_option('login_logo_url') ) {
		return reactor_option('login_logo_url'); 
	}
}
add_filter('login_headerurl', 'reactor_login_logo_url');

/**
 * 3. Logo title attribute text
 *
 * @since 1.0.0
 */
function reactor_login_logo_title() {
	if ( reactor_option('login_logo_title') ) {
		return reactor_option('login_logo_title'); 
	}
}
add_filter('login_headertitle', 'reactor_login_logo_title');

/**
 * 4. Changes the order of the admin menu
 * just because I like it better!

function reactor_change_admin_links() {
	global $menu;
	$menu[6] = $menu[5];
	$menu[5] = $menu[20];
	unset( $menu[20] );
}
add_action('admin_menu', 'reactor_change_admin_links');
*/
?>