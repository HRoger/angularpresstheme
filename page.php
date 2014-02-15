<?php
/**
 * The default template for displaying pages
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

	<div id="primary" class="site-content">

		<?php reactor_content_before(); ?>

		<div id="content" role="main">
			<div class="row">
				<div class="<?php reactor_columns(); ?>">

					<?php reactor_inner_content_before(); ?>

					<?php // get the page loop
					echo 'oi from page template';
					get_template_part('loops/loop', 'page'); ?>

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