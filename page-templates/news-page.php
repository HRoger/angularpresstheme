<?php
/**
 * Template Name: News Page
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @since 1.0.0
 */
update_option('current_page_template', 'news-page');
?>

<?php // get the options
$slider_category = reactor_option('newspage_slider_category', ''); ?>

<?php get_header(); ?>

	<div id="primary" class="site-content">

		<?php reactor_content_before(); ?>

		<div id="content" role="main">
			<div class="row">

				<div class="<?php reactor_columns(); ?>">

					<?php reactor_inner_content_before(); ?>
					<?php
					//Angularpress: just show the posts page content when "posts page is set in the reading settings.
					$page_id = get_queried_object_id();
					if (get_option('page_for_posts') != $page_id) {

						?>
						<?php // slider function passing category from options and id
						reactor_slider(array('category' => $slider_category, 'slider_id' => 'slider-news-page')); ?>

						<?php // get the page loop
						get_template_part('loops/loop', 'page'); ?>

						<?php // get the news page loop
						get_template_part('loops/loop', 'newspage'); ?>
					<?php }; ?>
					<?php reactor_inner_content_after(); ?>

				</div>
				<!-- .columns -->

				<?php get_sidebar(); ?>

			</div>
			<!-- .row -->
		</div>
		<!-- #content -->

		<?php reactor_content_after(); ?>

	</div><!-- #primary -->

<?php get_footer(); ?>