<?php
/**
 * The template for displaying post content
 * @author Herley Roger
 * @package Angularpress
 * @package Reactor
 * @subpackage Post-Formats
 * @since 1.0.0
 * @file content.posts.php
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-body" >
		<header class="entry-header">
			<?php reactor_post_header(); ?>
            <!--see content.posts.php-->
		</header>


		<?php if (!is_search() || !is_archive()) :?>
		<!-- Only display Excerpts for Search -->
			<div class="entry-summary">
				<div data-ng-bind-html="item.excerpt | unsafe"></div>
			</div>

		<?php elseif (is_single()) : ?>
			<div class="entry-content">
				<div data-ng-bind-html="item.content |filter:searchText | unsafe"></div>
				<?php wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'reactor'), 'after' => '</div>')); ?>

			</div>

		<?php
		else : ?>
			<div class="entry-content">
				<div data-ng-bind-html="item.content | unsafe"></div>
			</div>
		<?php endif; ?>

		<footer class="entry-footer">
			<?php reactor_post_footer(); ?>
			  <!--see content.posts.php-->
		</footer>

	</div>

</article>

