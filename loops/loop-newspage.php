<?php
/**
 * The loop for displaying posts on the news page template
 *
 * @package Reactor
 * @subpackage loops
 * @since 1.0.0
 */
?>

<?php // the get options
$number_posts = reactor_option('newspage_number_posts', 10);
$post_columns = reactor_option('newspage_post_columns', 2); ?>

<?php // start post the loop
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	'post_type' => 'post',
	'posts_per_page' => $number_posts,
	'paged' => $paged);

global $newspage_query;
$newspage_query = new WP_Query($args); ?>

<?php if ($newspage_query->have_posts()) : ?>

	<?php while ($newspage_query->have_posts()) : $newspage_query->the_post();
		global $more;
		$more = 0; ?>
		<?php // get sticky featured posts
		if (is_sticky(get_the_ID())) : ?>

			<?php // display newspage post format
			get_template_part('post-formats/format', 'standard'); ?>

		<?php endif; // end if sticky ?>
	<?php endwhile; // end of the featured post loop ?>
<?php endif;
rewind_posts(); //end have_posts() check and rewind $post
?>

<?php if ($newspage_query->have_posts() && !is_sticky(get_the_ID())) : ?>

	<?php reactor_loop_before(); ?>

	<?php // if more than one column use block-grid
	if ($post_columns != 1) echo '<ul  class="multi-column large-block-grid-' .
		$post_columns . '">'; ?>

	<!--	--><?php //while ($newspage_query->have_posts()) : $newspage_query->the_post();
	global $more;
	$more = 0; ?>
	<?php // no stickys in this loop
	if (!is_sticky(get_the_ID())) : ?>

		<?php reactor_post_before(); ?>
		<!--loop-newspage.php. Loop for the news-page template-->
		<div data-spinner-post></div>
		<?php if ($post_columns != 1) echo '<li  data-ng-repeat="item in posts" on-ang-repeat-finished>'; ?>

		<?php // display newspage post format
		get_template_part('post-formats/format', 'standard'); ?>

		<?php if ($post_columns != 1) echo '</li>'; ?>

		<?php reactor_post_after(); ?>

	<?php endif; // end if not sticky ?>
	<!--	--><?php //endwhile; // end of the post loop ?>

	<?php if ($post_columns != 1) echo '</ul>'; // close the block-grid ?>

	<?php reactor_loop_after(); ?>

<?php // if no posts are found
else : reactor_loop_else(); ?>

<?php endif; // end have_posts() check ?>