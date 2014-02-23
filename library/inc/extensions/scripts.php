<?php
/**
 * Scripts
 * WordPress will add these scripts to the theme
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/wp_register_script
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @see wp_register_script
 * @see wp_enqueue_script
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Reactor Scripts
 *
 * @since 1.0.0
 */


add_action('wp_enqueue_scripts', 'reactor_register_scripts', 1);
add_action('wp_enqueue_scripts', 'reactor_enqueue_scripts');

function reactor_register_scripts() {
	// register scripts
//	wp_register_script('myjquery', ("http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"), false, '2.1.0');
	wp_register_script('modernizr-js', get_template_directory_uri() . '/library/js/vendor/custom.modernizr.js', array(), false, false);
	wp_register_script('foundation-js', get_template_directory_uri() . '/library/js/vendor/foundation/foundation.js', array(), false, true);
	wp_register_script('foundation-orbit-js', get_template_directory_uri() . '/library/js/vendor/foundation/foundation.orbit.js', array(), false, true);
	wp_register_script('foundation-alerts-js', get_template_directory_uri() . '/library/js/vendor/foundation/foundation.alerts.js', array(), false, true);
	wp_register_script('foundation-tooltip-js', get_template_directory_uri() . '/library/js/vendor/foundation/foundation.tooltips.js', array(), false, true);
	wp_register_script('foundation-reveal-js', get_template_directory_uri() . '/library/js/vendor/foundation/foundation.reveal.js', array(), false, true);
	wp_register_script('foundation-magellan-js', get_template_directory_uri() . '/library/js/vendor/foundation/foundation.magellan.js', array(), false, true);
	wp_register_script('foundation-dropdown-js', get_template_directory_uri() . '/library/js/vendor/foundation/foundation.dropdown.js', array(), false, true);
	wp_register_script('foundation-topbar-js', get_template_directory_uri() . '/library/js/vendor/foundation/foundation.topbar.js', array(), false, true);

	wp_register_script('angularpress-js', get_template_directory_uri() . '/library/js/angularpress.js', array(), false, true);
	wp_register_script('mixitup-js', get_template_directory_uri() . '/library/js/mixitup.min.js', array(), false, true);
	wp_register_script('spinjs-js', get_template_directory_uri() . '/library/js/spinjs.min.js', array(), false, true);

	wp_register_script('mousewheel-js', get_template_directory_uri() . '/library/js/vendor/fancybox/lib/jquery.mousewheel-3.0.6.pack.js', array(), false, true);
	wp_register_script('fancybox-js', get_template_directory_uri() . '/library/js/vendor/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"', array(), false, true);
	wp_register_script('fancybox-buttons-js', get_template_directory_uri() . '/library/js/vendor/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"', array(), false, true);
	wp_register_script('fancybox-media-js', get_template_directory_uri() . '/library/js/vendor/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"', array(), false, true);
	wp_register_script('fancybox-thumbs-js', get_template_directory_uri() . '/library/js/vendor/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"', array(), false, true);


	wp_register_script('angular-js', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular.js', false, '1.2.13', true);
	wp_register_script('angular-resource-js', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular-resource.js', false, '1.2.13', true);
	wp_register_script('angular-route-js', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular-route.js', false, '1.2.13', true);
	wp_register_script('angular-sanitize-js', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular-sanitize.js', false, '1.2.13', true);
	wp_register_script('angular-animate-js', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular-animate.js', false, '1.2.13', true);
	wp_register_script('angular-cookies-js', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular-cookies.js', false, '1.2.13', true);
	wp_register_script('ui-bootstrap-js', get_template_directory_uri() . '/library/scripts/modules/ui-bootstrap-tpls-0.10.0.js', array(), false, true);

	wp_register_script('angular-ui-utils-js', get_template_directory_uri() . '/library/js/angular-ui-utils.min.js', false, '0.0.4', true);

	wp_register_script('lodash-js', get_template_directory_uri() . '/library/js/lodash.js',
		array(), false, true);


	wp_register_script('app-js', get_template_directory_uri() . '/library/scripts/app.js', array(), false, true);
	wp_register_script('services-values-js', get_template_directory_uri() .
		'/library/scripts/services/svValues.js', array(), false, true);
	wp_register_script('services-widgets-js', get_template_directory_uri() .
		'/library/scripts/services/svWidgets.js', array(), false, true);
	wp_register_script('services-pages-js', get_template_directory_uri() .
		'/library/scripts/services/svPages.js', array(), false, true);
	wp_register_script('services-posts-js', get_template_directory_uri() .
		'/library/scripts/services/svPosts.js', array(), false, true);
	wp_register_script('services-search-js', get_template_directory_uri() .
		'/library/scripts/services/svSearch.js', array(), false, true);

	wp_register_script('controllers-routes-js', get_template_directory_uri() .
		'/library/scripts/controllers/ctRoutes.js', array(), false, true);
	wp_register_script('controllers-readingSettings-js', get_template_directory_uri() .
		'/library/scripts/controllers/ctReadingSettings.js', array(), false, true);
	wp_register_script('controllers-pagination-js', get_template_directory_uri() .
		'/library/scripts/controllers/ctPaginationCtrl.js', array(), false, true);


	wp_register_script('filters-unsafe-js', get_template_directory_uri() .
		'/library/scripts/filters/ftUnsafe.js', array(), false, true);
	wp_register_script('filters-fromUrlSlugToTitle-js', get_template_directory_uri() .
		'/library/scripts/filters/ftFromUrlSlugToTitle.js', array(), false, true);

	wp_register_script('directives-mixitup-js', get_template_directory_uri() . '/library/scripts/directives/dtMixitup.js', array(), false, true);
	wp_register_script('directives-fancybox-js', get_template_directory_uri() . '/library/scripts/directives/dtFancybox.js', array(), false, true);
	wp_register_script('directives-contactform7-js', get_template_directory_uri() . '/library/scripts/directives/dtContactForm7.js', array(), false, true);

	wp_register_script('directives-adminbar-buttons-js', get_template_directory_uri() . '/library/scripts/directives/dtAdminbar.js', array(), false, true);
	wp_register_script('directives-widgets-js', get_template_directory_uri() . '/library/scripts/directives/dtWidgets.js', array(), false, true);
	wp_register_script('directives-media-js', get_template_directory_uri() . '/library/scripts/directives/dtMedia.js', array(), false, true);
	wp_register_script('directives-spinnerPost-js', get_template_directory_uri() . '/library/scripts/directives/dtSpinnerPost.js', array(), false, true);
	wp_register_script('directives-displayFooter-js', get_template_directory_uri() . '/library/scripts/directives/dtDisplayFooter.js', array(), false, true);
	wp_register_script('directives-postArticle-js', get_template_directory_uri() . '/library/scripts/directives/dtPostArticle.js', array(), false, true);
	wp_register_script('directives-commentForm-js', get_template_directory_uri() . '/library/scripts/directives/dtCommentForm.js', array(), false, true);
	wp_register_script('directives-navMarker-js', get_template_directory_uri() . '/library/scripts/directives/dtNavMarker.js', array(), false, true);


	wp_register_script('angular-cache-js', get_template_directory_uri() . '/library/scripts/modules/angularCache.js', array(), false, true);

	wp_register_script('infiniteScroll-js', get_template_directory_uri() . '/library/scripts/modules/infiniteScroll.js', array(), false, true);

	wp_register_script('loadingBar-js', get_template_directory_uri() . '/library/scripts/modules/loading-bar.js', array(), false, true);


}


function reactor_enqueue_scripts() {
	if (!is_admin()) {
		// enqueue scripts
//		wp_deregister_script('jquery');
//		wp_enqueue_script('myjquery');
		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizr-js');
		wp_enqueue_script('angularpress-js');
		wp_enqueue_script('foundation-js');
		wp_enqueue_script('foundation-orbit-js');
		wp_enqueue_script('foundation-alerts-js');
		wp_enqueue_script('foundation-tooltip-js');
		wp_enqueue_script('foundation-reveal-js');
		wp_enqueue_script('foundation-magellan-js');
		wp_enqueue_script('foundation-dropdown-js');
		wp_enqueue_script('foundation-topbar-js');

		wp_enqueue_script('mixitup-js');
		wp_enqueue_script('spinjs-js');

		wp_enqueue_script('mousewheel-js');
		wp_enqueue_script('fancybox-js');
		wp_enqueue_script('fancybox-buttons-js');
		wp_enqueue_script('fancybox-media-js');
		wp_enqueue_script('fancybox-thumbs-js');

		wp_enqueue_script('angular-js');
		wp_enqueue_script('angular-resource-js');
		wp_enqueue_script('angular-route-js');
		wp_enqueue_script('angular-sanitize-js');
		wp_enqueue_script('angular-animate-js');
		wp_enqueue_script('angular-cookies-js');
		wp_enqueue_script('ui-bootstrap-js');
		wp_enqueue_script('lodash-js');
//		wp_enqueue_script('angular-ui-utils-js');

		wp_enqueue_script('app-js');

		wp_enqueue_script('services-values-js');
		wp_enqueue_script('services-widgets-js');
		wp_enqueue_script('services-pages-js');
		wp_enqueue_script('services-posts-js');
		wp_enqueue_script('services-search-js');

		wp_enqueue_script('controllers-routes-js');
		wp_enqueue_script('controllers-readingSettings-js');
		wp_enqueue_script('controllers-pagination-js');

		wp_enqueue_script('filters-unsafe-js');
		wp_enqueue_script('filters-fromUrlSlugToTitle-js');

		wp_enqueue_script('directives-mixitup-js');
		wp_enqueue_script('directives-contactform7-js');
		wp_enqueue_script('directives-fancybox-js');
		wp_enqueue_script('directives-adminbar-buttons-js');
		wp_enqueue_script('directives-postArticle-js');
		wp_enqueue_script('directives-widgets-js');
		wp_enqueue_script('directives-media-js');
		wp_enqueue_script('directives-spinnerPost-js');
		wp_enqueue_script('directives-displayFooter-js');
		wp_enqueue_script('directives-commentForm-js');
		wp_enqueue_script('directives-navMarker-js');

		wp_enqueue_script('angular-cache-js');
		wp_enqueue_script('infiniteScroll-js');
		wp_enqueue_script('loadingBar-js');


		angularpress_localize_scripts('services-values-js');


		// comment reply script for threaded comments
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
}




function angularpress_localize_scripts($script) {
	global $angpress_session_onload;


//	FB::info(isset($_SESSION['template_req_onload']),'template_req_onload');
//	FB::info(isset($_SESSION['template_req']),'template_req');
//	FB::info(isset($_SESSION['template_req_pages']),'template_req_pages');
//	FB::info(isset($_COOKIE['is_page_loaded']),'cookie page loaded');

	if (isset($_SESSION['template_req_onload'])) {
		$angpress_session_onload = $_SESSION['template_req_onload'];
	}

	wp_localize_script(
		$script,
		'Angularpress',
		array(
			'dir' => get_bloginfo('template_directory'),
			'url' => get_bloginfo('wpurl'),
			'page_title' => get_the_title(),
			'_wpnonce' => wp_logout_url(),
			'on_first_page_load' => $angpress_session_onload,
			'page_for_posts' => get_option('page_for_posts'),
			'posts_per_page' => get_option('posts_per_page')
		)
	);
}