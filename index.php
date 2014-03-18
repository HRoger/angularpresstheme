<?php
/**
 * The default template file
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>
<?php get_header(); ?>

<!--NG-VIEW-->
<div data-ng-view></div>
<!--NG-VIEW-->

<!--WP-READING-SETTINGS-->
<div data-ng-controller="angpReadingSettingsCtrl">
	<div data-ng-if="is_home_visible">
		<homenewsloop>
			<?php
			global $angp_slug_page_on_front;

			$angp_page_on_front_id = get_option('page_on_front');
			$post = get_post($angp_page_on_front_id);
			$angp_slug_page_on_front = $post->post_name;
			$template_slug = get_page_template_slug($angp_page_on_front_id);

			if (is_front_page() || is_home())

				if (get_option('page_for_posts') == 0) {
					get_template_part('loops/loop', 'index');

				} elseif (is_page($angp_slug_page_on_front) && $template_slug !== '') {
					/** @noinspection PhpIncludeInspection */

					include(locate_template($template_slug));
				}
			?>
		</homenewsloop>

	</div>

	<?php
	if (get_option('show_on_front') !== 'page') {
		?>

		<div ng-if="is_include_visible">
			<div data-ng-include="templateDir+'/library/views/loops/newsloop.html'"></div>
		</div>

	<?php } else { ?>
		<!--When we  load a page other than the index and we set in reading options to static page(ex:front page,posts page). Then on changing route  from any page to the index, it should display the front page on the index page-->
		<div ng-if="is_include_visible">
			<div
				data-ng-include="templateDir+'/library/views/pages/<?php echo $angp_slug_page_on_front . '.html'; ?>'"></div>
		</div>

	<?php } ?>


	<?php get_footer(); ?>

	<div display-footer>

		<div class="angp-footer">
			<?php if (is_front_page() && get_option('show_on_front') !== 'posts') {
				//when loading page is other than the frontpage and reading settings are set to 'pages'. See: dtDisplayFooter.js
				angularpress_footer_inside();
			}

			?>

		</div>
	</div>

	<!--<div class="row">
		<div class="small-6 small-offset-1">
			<pre>$location.path() = {{$location.path() }}</pre>
			<pre>$location.url() = {{ $location.url() }}</pre>
			<pre>$location.absUrl() = {{ $location.absUrl() }}</pre>
			<pre>$location.search() = {{ $location.search() }}</pre>
			<pre>$route.current.locals = {{$route.current.locals}}</pre>
			<pre>$route.current.params = {{$route.current.params}}</pre>
			<pre>$route.current.scope= {{$route.current.scope}}</pre>
			<pre>$route.current.controller= {{$route.current.controller}}</pre>
			<pre>$route.current.templateUrl= {{$route.current.templateUrl}}</pre>
			<pre>$routeParams = {{$routeParams}}</pre>
			<pre>$routeParams.primaryNav = {{$routeParams.primaryNav}}</pre>
			<pre>$routeParams.secondaryNav = {{$routeParams.secondaryNav}}</pre>
			<pre>$route.current: {{$route.current}}</pre>
			<pre>siteUrl: {{siteUrl}}</pre>
			<pre>templateDir: {{templateDir}}</pre>
			<?php
/*			echo "<pre>" . var_dump(isset($_SESSION['template_req']), 'template_req') .
				"</pre>";
			echo "<pre>" . var_dump(isset($_SESSION['template_req_pages']), 'template_req_pages') .
				"</pre>";
			echo "<pre>" . var_dump(isset($_COOKIE['is_page_loaded']), 'cookie page loaded') .
				"</pre>";
			echo "<pre>" . var_dump(isset($_SESSION['page_loaded']), 'session page_loaded') .
				"</pre>";
			echo "</br>";
			echo "<pre>" . var_dump(session_id(), 'session_id') .
				"</pre>";
			echo "<pre>" . var_dump(session_name()) .
				"</pre>";
			echo "</br>";
			*/?>
		</div>
	</div>-->
</div>
<!--WP-READING-SETTINGS-->




