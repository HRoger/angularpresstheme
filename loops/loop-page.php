<?php
/**
 * The loop for displaying page content
 *
 * @package Reactor
 * @subpackage loops
 * @since 1.0.0
 */
?>

<?php // display page content when posts page is set in reading settings
if ('page' == get_option('show_on_front') && get_option('page_for_posts') && is_home()) : the_post(); ?>

	<?php
	$page_id = get_option('page_for_posts');
	setup_postdata(get_page($page_id));
	$title = get_the_title($page_id);
	$classes = get_post_class('', $page_id);
	$class = implode(' ', $classes); ?>

	<?php reactor_page_before(); ?>

	<article id="post-<?php echo $page_id; ?>" class="<?php echo $class; ?>">
		<header class="entry-header">
			<h1 class="entry-title"><?php echo $title; ?></h1>
		</header>
		<!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article><!-- #post -->

	<?php reactor_page_after(); ?>

	<?php rewind_posts(); ?>

<?php elseif (!is_home()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<?php reactor_page_before(); ?>

		<?php // get page content
		get_template_part('post-formats/format', 'page'); ?>

		<?php reactor_page_after(); ?>

	<?php endwhile; // end of the loop ?>

	<?php if (is_page_template()) {
		rewind_posts();
	} ?>

<?php endif; ?>
