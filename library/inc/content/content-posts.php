<?php
/**
 * Post Content
 * hook in the content for post formats
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */
/**
 * Post Tumblog Icons
 * in all formats when tumblog icons are enabled
 *
 * @since 1.0.0
 */
function reactor_do_tumblog_icons() {
	/** @noinspection PhpParamsInspection */
	if (reactor_option('tumblog_icons', false) && (is_home() || is_archive()) && current_theme_supports('reactor-tumblog-icons')) {
		$output = reactor_tumblog_icon();
		echo $output;
	}
}

add_action('reactor_post_header', 'reactor_do_tumblog_icons', 1);

/**
 * Post featured tag
 * in format-standard
 *
 * @since 1.0.0
 */
function reactor_do_standard_format_sticky() {
	if (is_sticky()) {
		?>
		<div class="entry-featured">
			<span
				class="label secondary"><?php echo apply_filters('reactor_featured_post_title', __('Featured Post', 'reactor')); ?></span>
		</div>
	<?php
	}
}

add_action('reactor_post_header', 'reactor_do_standard_format_sticky', 2);

/**
 * Post header
 * in format-standard
 * @author: Herley Roger
 * Changed to Angularpress
 * @since 1.0.0
 */
function reactor_do_standard_header_titles() {
	/** @noinspection PhpParamsInspection */
	$show_titles = reactor_option('frontpage_show_titles', 1);
	/** @noinspection PhpParamsInspection */
	$link_titles = reactor_option('frontpage_link_titles', 0);

	if (is_page_template('page-templates/front-page.php') && $show_titles) {
		?>
		<?php if (!$link_titles) { ?>
			<h2 class="entry-title" ng-if="item.categories.length===0">

				<a
					ng-href="{{siteUrl}}/uncategorized/{{item.slug}}/"
					title="{{item.title}}" rel="bookmark" ng-bind="item.title"></a>
			</h2>
			<h2 class="entry-title">
				<span ng-repeat="category in item.categories "
				      ng-if="$last">
				<a
					ng-href="{{siteUrl}}/{{category.slug}}/{{item.slug}}/"
					title="{{item.title}}" rel="bookmark" ng-bind="item.title"></a>
			</span>
			</h2>


		<?php } else { ?>
			<h2 class="entry-title">

			<span ng-repeat="category in item.categories "
			      ng-if="$last">
				<a
					ng-href="{{siteUrl}}/{{category.slug}}/{{item.slug}}/"
					title="{{item.title}}" rel="bookmark" ng-bind="item.title"></a>
			</span>
			</h2>
		<?php

		}
	} elseif (!is_page_template('page-templates/front-page.php')) { //!get_post_format() &&
		?>
		<?php if (is_single()) { ?>
			<h1 class="entry-title" ng-bind="item.title"></h1>
		<?php } else { ?>
			<h2 class="entry-title" ng-if="item.categories.length===0">

				<a
					ng-href="{{siteUrl}}/uncategorized/{{item.slug}}/"
					title="{{item.title}}" rel="bookmark" ng-bind="item.title"></a>
			</h2>
			<h2 class="entry-title">

              <span ng-repeat="category in item.categories "
                    ng-if="$last">
				<a
					ng-href="{{siteUrl}}/{{category.slug}}/{{item.slug}}/"
					title="{{item.title}}" rel="bookmark" ng-bind="item.title"></a>
              </span>
			</h2>
		<?php } ?>
	<?php
	}
}

add_action('reactor_post_header', 'reactor_do_standard_header_titles', 3);

/**
 * Post thumbnail
 * in format-standard
 *
 * @since 1.0.0
 */
function reactor_do_standard_thumbnail() {
	/** @noinspection PhpParamsInspection */
	$link_titles = reactor_option('frontpage_link_titles', 0);

	if (has_post_thumbnail()) {
		?>
		<div class="entry-thumbnail">
			<?php if (is_page_template('page-templates/front-page.php') && !$link_titles) {
				the_post_thumbnail();
			} else {
				?>
				<a href="<?php the_permalink(); ?>" rel="bookmark"
				   title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
			<?php } ?>
		</div>
	<?php
	}
}

add_action('reactor_post_header', 'reactor_do_standard_thumbnail', 4);

/**
 * Post footer title
 * in format-audio, format-gallery, format-image, format-video
 *
 * @since 1.0.0
 */
function reactor_do_post_footer_title() {
	$format = (get_post_format()) ? get_post_format() : 'standard';

	switch ($format) {
		case 'audio' :
		case 'gallery' :
		case 'image' :
		case 'video' :
			?>

			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>"
				   title="<?php echo esc_attr(sprintf(__('%s', 'reactor'), the_title_attribute('echo=0'))); ?>"
				   rel="bookmark"><?php the_title(); ?></a>
			</h2>

			<?php break;
	}
}

add_action('reactor_post_footer', 'reactor_do_post_footer_title', 1);

/**
 * Post footer meta
 * in all formats
 *
 * @since 1.0.0
 */
function reactor_do_post_footer_meta() {

	if (is_page_template('page-templates/front-page.php')) {
		/** @noinspection PhpParamsInspection */
		$post_meta = reactor_option('frontpage_post_meta', 1);
	} elseif (is_page_template('page-templates/news-page.php')) {
		/** @noinspection PhpParamsInspection */
		$post_meta = reactor_option('newspage_post_meta', 1);
	} else {
		/** @noinspection PhpParamsInspection */
		$post_meta = reactor_option('post_meta', 1);
	}

	if ($post_meta && current_theme_supports('reactor-post-meta')) {
		reactor_post_meta();
	}
}

add_action('reactor_post_footer', 'reactor_do_post_footer_meta', 2);

/**
 * Post footer comments link
 * in all formats
 *
 * @since 1.0.0
 */
function reactor_do_post_footer_comments_link() {

	if (is_page_template('page-templates/front-page.php')) {
		/** @noinspection PhpParamsInspection */
		$comments_link = reactor_option('frontpage_comment_link', 1);
	} elseif (is_page_template('page-templates/news-page.php')) {
		/** @noinspection PhpParamsInspection */
		$comments_link = reactor_option('newspage_comment_link', 1);
	} else {
		/** @noinspection PhpParamsInspection */
		$comments_link = reactor_option('comment_link', 1);
	}

	if (comments_open() && $comments_link) {
		?>

		<div class="comments-link">
			<i class="icon social foundicon-chat" title="Comments"></i>

			<span class="entry-title" ng-if="item.categories.length===0">
				<a
					ng-href="{{siteUrl}}/uncategorized/{{item.slug}}/"
					title="{{item.title}}" rel="bookmark" >
					<span class="leave-comment">Leave a Comment</span>
				</a>
			</span>

            <span ng-repeat="category in item.categories " ng-if="$last">
				<a
					ng-href="{{siteUrl}}/{{category.slug}}/{{item.slug}}/"
					title="{{item.title}}" rel="bookmark" >
					<span class="leave-comment">Leave a Comment</span>

				</a>
			</span>

		</div>
		<!-- .comments-link -->
	<?php
	}
}

add_action('reactor_post_footer', 'reactor_do_post_footer_comments_link', 3);

/**
 * Post footer edit
 * in single.php
 *
 * @since 1.0.0
 */
function reactor_do_post_edit() {
	if (is_single()) {
		edit_post_link(__('Edit', 'reactor'), '<div class="edit-link"><span>', '</span></div>');
	}
}

add_action('reactor_post_footer', 'reactor_do_post_edit', 4);


/**
 * Single post nav
 * in single.php
 *
 * @since 1.0.0
 */
function reactor_do_nav_single() {
	if (is_single()) {
		/** @noinspection PhpParamsInspection */
		$exclude = (reactor_option('frontpage_exclude_cat', 1)) ? reactor_option('frontpage_post_category', '') : ''; ?>
		<nav class="nav-single">
            <span class="nav-previous alignleft">
            <?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'reactor') . '</span> %title', false, $exclude); ?>
            </span>
            <span class="nav-next alignright">
            <?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'reactor') . '</span>', false, $exclude); ?>
            </span>
		</nav><!-- .nav-single -->
	<?php
	}
}

add_action('reactor_post_after', 'reactor_do_nav_single', 1);

/**
 * Comments
 * in single.php
 *
 * @since 1.0.0
 */
function reactor_do_post_comments() {
	// If comments are open or we have at least one comment, load up the comment template
	if (is_single() && (comments_open() || '0' != get_comments_number())) {
		comments_template('', true);
	}
}

add_action('reactor_post_after', 'reactor_do_post_comments', 2);

/**
 * No posts format
 * loop else in page templates
 *
 * @since 1.0.0
 */
function reactor_do_loop_else() {
	get_template_part('post-formats/format', 'none');
}

add_action('reactor_loop_else', 'reactor_do_loop_else', 1);
?>
