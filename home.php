<?php
/**
 * The main template file and posts page
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

	<div  id="primary" class="site-content">

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

						<?php /* get the page loop
					only works when posts page is set in the reading settings */

						get_template_part('loops/loop', 'page'); ?>

					<?php }; ?>
					<?php // get the loop

					get_template_part('loops/loop', 'index'); ?>

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