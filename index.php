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
<div data-ng-view ></div>
<!--NG-VIEW-->

<!--WP-READING-SETTINGS-->
<div data-ng-controller="angpReadingSettingsCtrl">
	<div ng-cloak data-ng-show="is_home_visible">
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

				} elseif (is_page($angp_slug_page_on_front)) {
					/** @noinspection PhpIncludeInspection */
					include(locate_template($template_slug));
				}
			?>
		</homenewsloop>

	</div>

	<?php

	if (get_option('show_on_front') !== 'page') {

		?>

		<div data-ng-cloak data-ng-hide="true" data-ng-show="is_include_visible"
		     data-ng-include="templateDir+'/library/views/loops/newsloop.html'"></div>

	<?php } else { ?>
		<!--When we  load a page other than the index and we set in reading options to static page(front page,posts page). Then on changing route  from any page to the index, it should display the front page on the index page-->
		<div data-ng-cloak data-ng-show="is_include_visible"
		     data-ng-include="templateDir+'/library/views/pages/<?php echo $angp_slug_page_on_front . '.html'; ?>'"></div>

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

<!--	<div class="row">
		<div class="small-6 small-offset-1">
			<pre>$location.path() = {{$location.path() }}</pre>
			<pre>$location.url() = {{ $location.url() }}</pre>
			<pre>$location.absUrl() = {{ $location.absUrl() }}</pre>
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
		</div>
	</div>-->
</div>
<!--WP-READING-SETTINGS-->




