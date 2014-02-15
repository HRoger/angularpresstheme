<?php
/**
 * Reactor - A WordPress Framework based on Foundation by ZURB
 * Include the necessary files for Reactor Theme
 * Some files are included based on theme support
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.1.0
 * @copyright Copyright (c) 2013, Anthony Wilhelm
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

class Reactor {

	function __construct() {
		global $reactor;

		$reactor = new stdClass;

		add_action('after_setup_theme', array(&$this, 'options'), 6);

		add_action('after_setup_theme', array(&$this, 'extensions'), 12);
		add_action('after_setup_theme', array(&$this, 'functions'), 13);
		add_action('after_setup_theme', array(&$this, 'content'), 14);

		// Begin 3rd party support for WooCommerce
		remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	}

	function options() {
		// function to get options
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/functions/get-options.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/customizer/customize.php');
	}

	function extensions() {
		// required extensions
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/extensions/comments.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/extensions/styles.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/extensions/scripts.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/metaboxes/custom-meta.php');

		// custom widgets
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/widgets/recent-posts.php');

		// if theme supports extensions
		/** @noinspection PhpIncludeInspection */
		require_if_theme_supports('reactor-menus', locate_template('/library/inc/extensions/walkers.php'));
		/** @noinspection PhpIncludeInspection */
		require_if_theme_supports('reactor-menus', locate_template('/library/inc/extensions/menus.php'));
		/** @noinspection PhpIncludeInspection */
		require_if_theme_supports('reactor-post-types', locate_template('/library/inc/extensions/post-types.php'));
		/** @noinspection PhpIncludeInspection */
		require_if_theme_supports('reactor-sidebars', locate_template('/library/inc/extensions/sidebars.php'));
		/** @noinspection PhpIncludeInspection */
		require_if_theme_supports('reactor-shortcodes', locate_template('/library/inc/shortcodes/reactor-shortcodes.php'));
		/** @noinspection PhpIncludeInspection */
		require_if_theme_supports('reactor-translation', locate_template('/library/inc/translation/language.php'));
	}

	function functions() {
		// required functions
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/functions/columns.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/functions/helpers.php');

		// optional functions
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/functions/top-bar.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/functions/slider.php');

		// if theme supports functions
		require_if_theme_supports('reactor-breadcrumbs', locate_template('/library/inc/functions/breadcrumbs.php'));
		require_if_theme_supports('reactor-custom-login', locate_template('/library/inc/functions/custom-login.php'));
		require_if_theme_supports('reactor-page-links', locate_template('/library/inc/functions/page-links.php'));
		require_if_theme_supports('reactor-post-meta', locate_template('/library/inc/functions/post-meta.php'));
		require_if_theme_supports('reactor-tumblog-icons', locate_template('/library/inc/functions/tumblog-icons.php'));
		require_if_theme_supports('reactor-taxonomy-subnav', locate_template('/library/inc/functions/taxonomy-subnav.php'));
	}

	function content() {
		// hooked content
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/extensions/hooks.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/content/content-header.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/content/content-footer.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/content/content-posts.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/content/content-pages.php');
	}



}