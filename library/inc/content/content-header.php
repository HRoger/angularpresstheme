<?php
/**
 * Header Content
 * hook in the content for header.php
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Site meta, title, and favicon
 * in header.php
 *
 * @since 1.0.0
 */
function reactor_do_reactor_head() {
	?>
	<title  data-ng-cloak  data-ng-bind="title"></title>

	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- google chrome frame for ie -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="fragment" content="!">
	<meta name="google-site-verification" content="5n1rlGu5W7ZrsmlXMbXp87fX98B_XP6UZ-gTughx21A" />
	<!-- mobile meta -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<!--	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->

	<?php /** @noinspection PhpParamsInspection */
	$favicon_uri = reactor_option('favicon_image') ? reactor_option('favicon_image') : get_template_directory_uri() . '/favicon.ico'; ?>
	<link rel="shortcut icon" href="<?php echo $favicon_uri; ?>">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<?php
}

add_action('wp_head', 'reactor_do_reactor_head', 1);

/**
 * Top bar
 * in header.php
 *
 * @since 1.0.0
 */
function reactor_do_top_bar() {
	if (has_nav_menu('top-bar-l') || has_nav_menu('top-bar-r')) {
		/** @noinspection PhpParamsInspection */
		$topbar_args = array(
			'title' => reactor_option('topbar_title', get_bloginfo('name')),
			'title_url' => reactor_option('topbar_title_url', home_url()),
			'fixed' => reactor_option('topbar_fixed', 0),
			'contained' => reactor_option('topbar_contain', 1),
		);
		reactor_top_bar($topbar_args);
	}
}

add_action('reactor_header_before', 'reactor_do_top_bar', 1);

/**
 * Site title, tagline, logo, and nav bar
 * in header.php
 *
 * @since 1.0.0
 */
function reactor_do_title_logo() {
	?>
	<div class="inner-header">
		<div class="row">
			<div class="column">
				<?php /** @noinspection PhpParamsInspection */
				if (reactor_option('logo_image')) : ?>
					<div class="site-logo">
						<a href="<?php echo esc_url(home_url('/')); ?>"
						   title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
						   rel="home">
							<img src="<?php
							/** @noinspection PhpParamsInspection */
							echo reactor_option('logo_image') ?>"
							     alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?> logo">
						</a>
					</div><!-- .site-logo -->
				<?php endif; // end if logo ?>
				<div class="title-area">
					<p class="site-title">
						<a href="<?php echo esc_url(home_url('/')); ?>"
						   title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
						   rel="home"><?php bloginfo('name'); ?></a>
						<iframe  style="float:right;margin-bottom:5px;" width="60%" height="95"
						         scrolling="no"
						        frameborder="no"
						        src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/23712435&amp;auto_play=false&amp;hide_related=false&amp;visual=false"></iframe>
					</p>

					<p class="site-description"><?php bloginfo('description'); ?></p>
				</div>
			</div>
			<!-- .column -->
		</div>
		<!-- .row -->
	</div><!-- .inner-header -->
<?php
}

add_action('reactor_header_inside', 'reactor_do_title_logo', 1);

/**
 * Nav bar and mobile nav button
 * in header.php
 *
 * @since 1.0.0
 */
function reactor_do_nav_bar() {
	if (has_nav_menu('main-menu')) {
		/** @noinspection PhpParamsInspection */
		$nav_class = (reactor_option('mobile_menu', 1)) ? 'class="hide-for-small" ' : ''; ?>
		<div class="main-nav">
			<nav id="menu" <?php echo $nav_class; ?>role="navigation">
				<div class="section-container horizontal-nav" data-section="horizontal-nav"
				     data-options="one_up:false;">
					<?php reactor_main_menu(); ?>
				</div>
			</nav>
		</div><!-- .main-nav -->

		<?php
		/** @noinspection PhpParamsInspection */
		if (reactor_option('mobile_menu', 1)) {
			?>
			<div id="mobile-menu-button" class="show-for-small">
				<button class="secondary button" id="mobileMenuButton" data-ng-href="#mobile-menu">
					<span class="mobile-menu-icon"></span>
					<span class="mobile-menu-icon"></span>
					<span class="mobile-menu-icon"></span>
				</button>
			</div><!-- #mobile-menu-button -->
		<?php
		}
	}
}

add_action('reactor_header_inside', 'reactor_do_nav_bar', 2);

/**
 * Mobile nav
 * in header.php
 *
 * @since 1.0.0
 */
function reactor_do_mobile_nav() {
	/** @noinspection PhpParamsInspection */
	if (reactor_option('mobile_menu', 1) && has_nav_menu('main-menu')) {
		?>
		<nav id="mobile-menu" class="show-for-small" role="navigation">
			<div class="section-container accordion" data-section="accordion"
			     data-options="one_up:false">
				<?php reactor_main_menu(); ?>
			</div>
		</nav>
	<?php
	}
}

add_action('reactor_header_after', 'reactor_do_mobile_nav', 1);
?>
