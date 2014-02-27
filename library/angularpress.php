<?php

/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 24.09.13
 * Time: 16:55
 *
 */
class Angularpress extends Reactor {

	public function __construct() {

		global $angularpress;
		$angularpress = new stdClass();

		/*session_regenerate_id();
		setcookie(session_name('angpSession'), session_id(), time() + 2 * 7 * 24 * 60 * 60);

		if (!session_id() and !ini_get('register_globals') and !is_admin()) {
			session_start();
			session_regenerate_id();
			setcookie(session_name('angpSession'), session_id(), time() + 2 * 7 * 24 * 60 * 60);
		}*/

		parent::__construct();
		add_action('init', array(&$this, 'init_session'), 1);
		add_action('after_setup_theme', array(&$this, 'theme_setup'), 10);
		add_action('after_setup_theme', array(&$this, 'angular_functions'), 14);
		add_action('after_setup_theme', array(&$this, 'angular_templates'), 16);
		add_action('after_setup_theme', array(&$this, 'angular_admin'), 17);

	}

	public function init_session() {
		if(!is_admin()){
			if (!session_id() ) {
				session_start();

			}
			session_regenerate_id();
			setcookie(session_name(), session_id(), time() + 2 * 7 * 24 * 60 * 60);
		}


	}


	public function angular_functions() {

		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/angular/functions/template-generator.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/angular/functions/detect-admin-page.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/angular/functions/set-session.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/angular/functions/get-page-http-api.php');

	}

	public function angular_templates() {

		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/angular/templates/session-redirect.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/angular/templates/get-templates.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/angular/templates/page-loading.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/angular/templates/set-index-redirect.php');

	}

	public function angular_admin() {
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/angular/admin/admin-bar.php');
		/** @noinspection PhpIncludeInspection */
		require_once locate_template('/library/inc/angular/admin/cache-post.php');

	}

	function theme_setup() {

		/**
		 * Reactor features
		 */
		add_theme_support(
			'reactor-menus',
			array('top-bar-l', 'top-bar-r', 'main-menu', 'side-menu', 'footer-links')
		);

		add_theme_support(
			'reactor-sidebars',
			array('primary', 'secondary', 'front-primary', 'front-secondary', 'footer')
		);

		add_theme_support(
			'reactor-layouts',
			array('1c', '2c-l', '2c-r', '3c-l', '3c-r', '3c-c')
		);

		add_theme_support(
			'reactor-post-types',
			array('slides', 'portfolio')
		);

		add_theme_support(
			'reactor-page-templates',
			array('front-page', 'news-page', 'portfolio', 'contact')
		);

		add_theme_support('reactor-backgrounds');

		add_theme_support('reactor-fonts');

		add_theme_support('reactor-breadcrumbs');

		add_theme_support('reactor-page-links');

		add_theme_support('reactor-post-meta');

		add_theme_support('reactor-shortcodes');

		add_theme_support('reactor-custom-login');

		add_theme_support('reactor-taxonomy-subnav');

		add_theme_support('reactor-tumblog-icons');

		add_theme_support('reactor-translation');

		/**
		 * WordPress features
		 */
		add_theme_support('menus');

		// different post formats for tumblog style posting
		add_theme_support(
			'post-formats',
			array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
		);

		add_theme_support('post-thumbnails');
		// thumbnail sizes - you can add more
		add_image_size('thumb-300', 300, 250, true);
		add_image_size('thumb-200', 200, 150, true);

		// RSS feed links to header.php for posts and comments.
		add_theme_support('automatic-feed-links');

		// editor stylesheet for TinyMCE
		add_editor_style('/library/css/editor.css');

		if (!isset($content_width)) $content_width = 1000;

	}

}


