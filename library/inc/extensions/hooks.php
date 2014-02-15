<?php
/**
 * Reactor Content Hooks
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Register hook: angp_do_footer_widgets
 *in index.php. Used when onrouterchange to other pages
 * when page is first loaded from the index.php
 *
 * @package Angularpress
 * @since 1.0.0
 */

function angularpress_footer_inside() {
	do_action('angularpress_footer_inside');
}


/**
 * Register hook: reactor_head
 *
 * in header.php after wp_head
 * @since 1.0.0
 */
function reactor_head() {
	do_action('reactor_head');
}

/**
 * Register hook: reactor_page_before
 *
 * in header.php before #page
 * and after opening body tag
 * @since 1.0.0
 */
function reactor_body_inside() {
	do_action('reactor_body_inside');
}

/**
 * Register hook: reactor_header_before
 *
 * in header.php before header tag
 * @since 1.0.0
 */
function reactor_header_before() {
	do_action('reactor_header_before');
}

/**
 * Register hook: reactor_header_inside
 *
 * in header.php after header tag
 * @since 1.0.0
 */
function reactor_header_inside() {
	do_action('reactor_header_inside');
}

/**
 * Register hook: reactor_header_after
 *
 * in header.php after closing header tag
 * @since 1.0.0
 */
function reactor_header_after() {
	do_action('reactor_header_after');
}

/**
 * Register hook: reactor_content_before
 *
 * in page template files, index.php, home.php before #content
 * @since 1.0.0
 */
function reactor_content_before() {
	do_action('reactor_content_before');
}

/**
 * Register hook: reactor_content_after
 *
 * in page template files, index.php, home.php after #content
 * @since 1.0.0
 */
function reactor_content_after() {
	do_action('reactor_content_after');
}

/**
 * Register hook: reactor_inner_content_before
 *
 * in page template files, index.php, home.php inside #content
 * before contents starts
 * @since 1.0.0
 */
function reactor_inner_content_before() {
	do_action('reactor_inner_content_before');
}

/**
 * Register hook: reactor_inner_content_after
 *
 * in page template files, index.php, home.php inside #content
 * after contents ends
 * @since 1.0.0
 */
function reactor_inner_content_after() {
	do_action('reactor_inner_content_after');
}

/**
 * Register hook: reactor_sidebar_before
 *
 * in page template files, index.php, home.php before #sidebar
 * @since 1.0.0
 */
function reactor_sidebar_before() {
	do_action('reactor_sidebar_before');
}

/**
 * Register hook: reactor_sidebar_before
 *
 * in page template files, index.php, home.php after #sidebar
 * @since 1.0.0
 */
function reactor_sidebar_after() {
	do_action('reactor_sidebar_after');
}

/**
 * Register hook: reactor_loop_before
 *
 *
 * @since 1.0.0
 */
function reactor_loop_before() {
	do_action('reactor_loop_before');
}

/**
 * Register hook: reactor_loop_after
 *
 *
 * @since 1.0.0
 */
function reactor_loop_after() {
	do_action('reactor_loop_after');
}

/**
 * Register hook: reactor_loop_else
 *
 *
 * @since 1.0.0
 */
function reactor_loop_else() {
	do_action('reactor_loop_else');
}

/**
 * Register hook: reactor_post_before
 *
 *
 * @since 1.0.0
 */
function reactor_post_before() {
	do_action('reactor_post_before');
}

/**
 * Register hook: reactor_post_header
 *
 *
 * @since 1.0.0
 */
function reactor_post_header() {
	do_action('reactor_post_header');
}

/**
 * Register hook: reactor_post_footer
 *
 *
 * @since 1.0.0
 */
function reactor_post_footer() {
	do_action('reactor_post_footer');
}

/**
 * Register hook: reactor_post_after
 *
 *
 * @since 1.0.0
 */
function reactor_post_after() {
	do_action('reactor_post_after');
}

/**
 * Register hook: reactor_page_before
 *
 *
 * @since 1.0.0
 */
function reactor_page_before() {
	do_action('reactor_page_before');
}

/**
 * Register hook: reactor_page_header
 *
 *
 * @since 1.0.0
 */
function reactor_page_header() {
	do_action('reactor_page_header');
}

/**
 * Register hook: reactor_page_footer
 *
 *
 * @since 1.0.0
 */
function reactor_page_footer() {
	do_action('reactor_page_footer');
}

/**
 * Register hook: reactor_page_after
 *
 *
 * @since 1.0.0
 */
function reactor_page_after() {
	do_action('reactor_page_after');
}

/**
 * Register hook: reactor_footer_before
 *
 *
 * @since 1.0.0
 */
function reactor_footer_before() {
	do_action('reactor_footer_before');
}


/**
 * Register hook: reactor_footer_inside
 *
 *
 * @since 1.0.0
 */
function reactor_footer_inside() {
	do_action('reactor_footer_inside');
}

/**
 * Register hook: reactor_footer_after
 *
 *
 * @since 1.0.0
 */
function reactor_footer_after() {
	do_action('reactor_footer_after');
}

/**
 * Register hook: reactor_foot
 *
 *
 * @since 1.0.0
 */
function reactor_foot() {
	do_action('reactor_foot');
}