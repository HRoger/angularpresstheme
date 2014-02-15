<?php
/**
 * The loop for displaying portfolio posts on the portfolio page template
 *
 * @package Reactor
 * @subpackage loops
 * @since 1.0.0
 */
?>

<?php // get the options
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
/** @noinspection PhpParamsInspection */
$filter_type = reactor_option('portfolio_filter_type', 'jquery');
/** @noinspection PhpParamsInspection */
$post_columns = reactor_option('portfolio_post_columns', 4);
/** @noinspection PhpParamsInspection */
$order_by = reactor_option('portfolio_post_orderby', 'date');
/** @noinspection PhpParamsInspection */
$order = reactor_option('portfolio_post_order', 'DESC');
/** @noinspection PhpParamsInspection */
$number_posts = reactor_option('portfolio_number_posts', 20); ?>

<?php // start the portfolio loop
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if (is_tax('portfolio-tag')) {
	$args = array(
		'post_type'      => 'portfolio',
		'orderby'        => $order_by,
		'order'          => $order,
		'portfolio-tag'  => $term->name,
		'posts_per_page' => $number_posts,
		'paged'          => $paged
	);
} elseif (is_tax('portfolio-category')) {
	$args = array(
		'post_type'          => 'portfolio',
		'orderby'            => $order_by,
		'order'              => $order,
		'portfolio-category' => $term->name,
		'posts_per_page'     => $number_posts,
		'paged'              => $paged
	);
} else {
	$args = array(
		'post_type'      => 'portfolio',
		'orderby'        => $order_by,
		'order'          => $order,
		'posts_per_page' => $number_posts,
		'paged'          => $paged
	);
}
global $portfolio_query;
$portfolio_query = new WP_Query($args); ?>

<?php if ($portfolio_query->have_posts()) : ?>

	<?php reactor_loop_before(); ?>

	<ul id="Grid" mixitup class="multi-column filterable-grid
                    large-block-grid-<?php
	echo $post_columns ?>">

		<?php while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
			global $more;
			$more = 0; ?>

			<?php // get the categories for data-type storting
			$port_cats = '';
			$the_id = get_the_ID();
			$the_terms = get_the_terms($the_id, 'portfolio-category');
			if ($the_terms && !is_wp_error($the_terms)) :
				$cat_array = array();
				$cat_array[] = 'mix';
				foreach ($the_terms as $the_term) {
					$cat_array[] = $the_term->slug;
				}
				$port_cats = join(' ', $cat_array);
			endif; ?>

			<?php reactor_post_before(); ?>

			<li class="<?php echo $port_cats; ?>" data-name="<?php the_title(); ?>">

				<?php // display newspage post format
				get_template_part('post-formats/format', 'portfolio'); ?>

			</li>

			<?php reactor_post_after(); ?>

		<?php endwhile; // end of the portfolio loop ?>
	</ul>

	<?php reactor_loop_after(); ?>

<?php // if no posts are found
else : reactor_loop_else(); ?>

<?php endif; // end have_posts() check ?>