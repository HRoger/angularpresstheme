<?php

/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 14.03.14
 * Time: 17:49
 */
class JSON_API_Portfolio_Controller {

	function get_portfolio_post() {
		global $portfolio_query, $json_api;


		$term = get_term_by('ID', 'slug', get_query_var('term'), get_query_var('taxonomy'));

		/** @noinspection PhpParamsInspection */
		$order_by = reactor_option('portfolio_post_orderby', 'date');
		/** @noinspection PhpParamsInspection */
		$order = reactor_option('portfolio_post_order', 'DESC');
		/** @noinspection PhpParamsInspection */
		$number_posts = reactor_option('portfolio_number_posts', 20);


		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


		if (is_tax('portfolio-tag')) {
			$args = array(
				'post_type' => 'portfolio',
				'orderby' => $order_by,
				'order' => $order,
				'portfolio-tag' => $term->name,
				'posts_per_page' => $number_posts,
				'paged' => $paged
			);
		} elseif (is_tax('portfolio-category')) {
			$args = array(
				'post_type' => 'portfolio',
				'orderby' => $order_by,
				'order' => $order,
				'portfolio-category' => $term->name,
				'posts_per_page' => $number_posts,
				'paged' => $paged
			);
		} else {

			$args = array(
				'post_type' => 'portfolio',
				'orderby' => $order_by,
				'order' => $order,
				'posts_per_page' => $number_posts,
				'paged' => $paged,
				'p' => $json_api->query->id,
				'name' => $json_api->query->slug

			);
		}

		/*
		 * todo thumbnails next and previous posts
		*/
		$portfolio_query = new WP_Query($args);

		return array(
			'posts' => $portfolio_query->posts
		);

	}


}

/*public function get_post() {
	global $json_api, $post;
	$post = $json_api->introspector->get_current_post();
	if ($post) {
		$previous = get_adjacent_post(false, '', true);
		$next = get_adjacent_post(false, '', false);
		$response = array(
			'post' => new JSON_API_Post($post)
		);
		if ($previous) {
			$response['previous_url'] = get_permalink($previous->ID);
		}
		if ($next) {
			$response['next_url'] = get_permalink($next->ID);
		}
		return $response;
	} else {
		$json_api->error("Not found.");
	}
}*/