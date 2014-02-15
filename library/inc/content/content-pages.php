<?php
/**
 * Page Content
 * hook in the content for page templates
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

function angp_admin_editpage_link() {

	if (!is_front_page() && is_page()) {

		?>
		<editpagelink  name="{{menuId}}"></editpagelink>
	<?php
	}

}
add_action('reactor_content_before', 'angp_admin_editpage_link');

function angp_admin_editpost_link() {
	global $post;
	if (!is_front_page() && $post->post_type === 'post') {

		?>

		<editpostlink  name="{{postId}}"></editpostlink>
	<?php
	}

}
//add_action('reactor_content_before', 'angp_admin_editpost_link');
/**
 * Page Title
 * in the header of format-page
 *
 * @since 1.0.0
 */
function reactor_do_page_header_title() {
	if (!is_page_template('page-templates/front-page.php') && !is_page_template('page-templates/news-page.php')) {
		?>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->
	<?php
	}
}

add_action('reactor_page_header', 'reactor_do_page_header_title');

/**
 * Page Links
 * in the footer of format-page
 *
 * @since 1.0.0
 */
function reactor_do_page_pagelinks() {
	if (!is_page_template()) {
		wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'reactor'), 'after' => '</div>'));
	}
}

add_action('reactor_page_footer', 'reactor_do_page_pagelinks');

/**
 * Page Edit
 * in the footer of format-page
 *
 * @since 1.0.0
 */
function reactor_do_page_edit() {

	edit_post_link(__('Edit', 'reactor'), '<div class="edit-link"><span>', '</span></div>');
}

add_action('reactor_page_footer', 'reactor_do_page_edit');

/**
 * Page links
 * after the loop in page templates
 *
 * @since 1.0.0
 */
function reactor_do_page_links() {
	$pagination_type = reactor_option('page_links', 'numbered');

	if (is_page_template('page-templates/front-page.php') && current_theme_supports('reactor-page-links')) {
		$show_page_links = reactor_option('frontpage_page_links', 0);
		if ($show_page_links) {
			reactor_page_links(array('query' => 'frontpage_query', 'type' => $pagination_type));
		}
	} elseif (is_page_template('page-templates/news-page.php') && current_theme_supports('reactor-page-links')) {
		reactor_page_links(array('query' => 'newspage_query', 'type' => $pagination_type));
	} elseif (is_page_template('page-templates/portfolio.php') && current_theme_supports('reactor-page-links')) {
		$filter_type = reactor_option('portfolio_filter_type', 'jquery');
		//if ( 'jquery' != $filter_type ) {
		reactor_page_links(array('query' => 'portfolio_query', 'type' => $pagination_type));
		//}
	} elseif (current_theme_supports('reactor-page-links')) {
		reactor_page_links(array('type' => $pagination_type));
	}
}

add_action('reactor_loop_after', 'reactor_do_page_links', 1);

/**
 * WooCommerce Wrappers
 * before and after the loop in WooCommerce templates
 *
 * @since 1.0.1
 * @see http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 *
 */

function reactor_woo_wrapper_start() {
	?>
	<div class="row">
	<div class="<?php reactor_columns() ?>">
<?php
}

add_action('woocommerce_before_main_content', 'reactor_woo_wrapper_start', 10);

function reactor_woo_wrapper_end() {
	?>
	</div><!-- .columns -->
<?php
}

add_action('woocommerce_after_main_content', 'reactor_woo_wrapper_end', 10);

function reactor_woo_after_sidebar() {
	?>
	</div><!-- .row -->
<?php
}

add_action('woocommerce_sidebar', 'reactor_woo_after_sidebar', 999);
?>