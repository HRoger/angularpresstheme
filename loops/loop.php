<?php
/**
 * The main loop for displaying posts
 *
 * @package Reactor
 * @subpackage loops
 * @since 1.0.0
 */
?>

<?php if (have_posts()) : ?>

	<?php reactor_loop_before(); ?>
	<?php if (is_home() && get_option('show_on_front') !== 'page') { ?>
		<div id="primary" class="site-content">
		<div id="content" role="main">
		<div class="row">
	<?php } ?>


	<div data-ng-cloak data-ng-controller="angpPaginationCtrl">

		<ul class="multi-column">
			<?php reactor_post_before(); ?>
			<!--loop.php. Reading settings posts page-->
			<div class="loading-spinner-posts"></div>
			<?php echo '<li data-ng-repeat="item in posts" on-ang-repeat-finished >'; ?>
			<?php // get post format and display template for that format
			if (!get_post_format()) : get_template_part('post-formats/format', 'standard');
			else : get_template_part('post-formats/format', get_post_format()); endif; ?>
			<?php echo '</li>'; ?>
		</ul>

		<pagination data-ng-hide="is_link_visible" total-items="totalItems" page="currentPage"
		            max-size="maxSize"
		            on-select-page="pageChanged(page)" class="pagination"
		            items-per-page="itemsPerPage" boundary-links="true"
		            rotate="false" num-pages="numPages">
		</pagination>

	</div>



	<?php if (is_home() && get_option('show_on_front') !== 'page') { ?>
		</div>
		</div>
		</div>
	<?php } ?>


<?php // if no posts are found
else : reactor_loop_else(); ?>

<?php endif; // end have_posts() check ?>