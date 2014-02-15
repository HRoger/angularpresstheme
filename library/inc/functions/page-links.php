<?php
/**
 * Reactor Pageinate Links
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @param $args Optional. Override defaults.
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

if (!function_exists('reactor_page_links')) {
	function reactor_page_links($args = '') {

		do_action('reactor_page_links', $args);

		$defaults = array(
			'query' => 'wp_query',
			'type' => 'numbered',
		);
		$args = wp_parse_args($args, $defaults);

		global ${$args['query']}, $wp_rewrite;
		$output = '';

		$the_query = (isset($args['query'])) ? ${$args['query']} : $wp_query;

		$pagination_base = $wp_rewrite->pagination_base;

		/* If there's not more than one page, return nothing. */
		if (1 >= $the_query->max_num_pages) {
			return;
		}

		/**
		 * Previous Next Links
		 *
		 * @since 1.0.0
		 */
		if ('prev_next' == $args['type']) {

			$output .= '<nav class="content-nav" role="navigation">' . "\n";
			$output .= "\t" . '<div class="content-nav-prev left">';
			$output .= get_next_posts_link('<span class="meta-nav meta-nav-next">&larr; ' . __('Older posts', 'reactor') . '</span>', $the_query->max_num_pages);
			$output .= '</div>';
			$output .= "\t" . '<div class="content-nav-next right">';
			$output .= get_previous_posts_link('<span class="meta-nav meta-nav-prev">' . __('Newer posts', 'reactor') . ' &rarr;</span>', $the_query->max_num_pages);
			$output .= '</div>';
			$output .= "\n" . '</nav><!-- .content-nav -->';

		} else {

			/**
			 * Numbered Pagination
			 *
			 * @link http://codex.wordpress.org/Function_Reference/paginate_links
			 * @see paginate_links
			 * @since 1.0.0
			 */

			$big = 999999999; // need an unlikely integer
			$count = 0;
			$base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));
			$total = $the_query->max_num_pages;
			$current = max(1, get_query_var('paged'));

			$defaults = array(
				'base' => $base,
				'format' => '?page=%#%',
				'total' => $total,
				'current' => $current,
				'show_all' => false,
				'prev_next' => true,
				'prev_text' => __('&laquo; Previous', 'reactor'),
				'next_text' => __('Next &raquo;', 'reactor'),
				'end_size' => 2,
				'mid_size' => 3,
				'add_args' => false,
				'add_fragment' => ''
			);

			$args = wp_parse_args($args, $defaults);
			extract($args, EXTR_SKIP);

			// Who knows what else people pass in $args
			$total = (int)$total;
			if ($total < 2)
				return;
			$current = (int)$current;
			$end_size = 0 < (int)$end_size ? (int)$end_size : 1; // Out of bounds?  Make it the default.
			$mid_size = 0 <= (int)$mid_size ? (int)$mid_size : 2;
			$add_args = is_array($add_args) ? $add_args : false;
			$r = '';
			$page_links = array();
			$n = 0;
			$dots = false;

			$output = "<ul class='pagination'>";

			if ($prev_next && $current && 1 < $current) :
				$link = str_replace('%_%', 2 == $current ? '' : $format, $base);
				$link = str_replace('%#%', $current - 1, $link);
				if ($add_args)
					$link = add_query_arg($add_args, $link);
				$link .= $add_fragment;
				$page_links[] = '<li><a class="prev page-numbers" href="' . esc_url($link) . '">' . $prev_text . '</a></li>';
			endif;
			for ($n = 1; $n <= $total; $n++) :
				$n_display = number_format_i18n($n);
				if ($n == $current) :
					$page_links[] = "<li class='current'><a class='page-numbers current'>$n_display</a></li>";
					$dots = true;
				else :
					if ($show_all || ($n <= $end_size || ($current && $n >= $current - $mid_size && $n <= $current + $mid_size) || $n > $total - $end_size)) :
						$link = str_replace('%_%', 1 == $n ? '' : $format, $base);
						$link = str_replace('%#%', $n, $link);
						if ($add_args)
							$link = add_query_arg($add_args, $link);
						$link .= $add_fragment;
						$page_links[] = "<li><a class='page-numbers' href='" . esc_url($link) . "'>$n_display</a></li>";
						$dots = true;
					elseif ($dots && !$show_all) :
						$page_links[] = '<li><a class="page-numbers dots">' . __('&hellip;', 'reactor') . '</a></li>';
						$dots = false;
					endif;
				endif;
			endfor;
			if ($prev_next && $current && ($current < $total || -1 == $total)) :
				$link = str_replace('%_%', $format, $base);
				$link = str_replace('%#%', $current + 1, $link);
				if ($add_args)
					$link = add_query_arg($add_args, $link);
				$link .= $add_fragment;
				$page_links[] = '<li><a class="next page-numbers" href="' . esc_url($link) . '">' . $next_text . '</a></li>';
			endif;

			$output .= join("\n", $page_links);
			$output .= "</ul>";
		}

		echo apply_filters('reactor_paginate_links', $output);
	}
}