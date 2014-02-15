<?php
/**
 * Breadcrumbs
 *
 * Breadcrumb Trail is a script for showing a breadcrumb trail for any type of page.  It tries to anticipate 
 * any type of structure and display the best possible trail that matches your site's permalink structure.
 * While not perfect, it attempts to fill in the gaps left by many other breadcrumb scripts.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package Reactor
 * @version 0.4.1
 * @author Justin Tadlock <justin@justintadlock.com>
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @copyright Copyright (c) 2008 - 2011, Justin Tadlock
 * @link http://justintadlock.com/archives/2009/04/05/breadcrumb-trail-wordpress-plugin
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Shows a breadcrumb for all types of pages.  This function is formatting the final output of the 
 * breadcrumb trail.  The reactor_breadcrumbs_get_items() function returns the items and this function 
 * formats those items.
 *
 * @since 0.1.0
 * @param array $args Mixed arguments for the menu.
 * @return string Output of the breadcrumb menu.
 */
function reactor_breadcrumbs( $args = array() ) {

	/* Create an empty variable for the breadcrumb. */
	$breadcrumb = '';

	/* Set up the default arguments for the breadcrumb. */
	$defaults = array(
		'front_page' => true,
		'home_text'  => __('Home', 'reactor'),
		'echo'       => true
	);

	/* Allow singular post views to have a taxonomy's terms prefixing the trail. */
	if ( is_singular() ) {
		$post = get_queried_object();
		$defaults["singular_{$post->post_type}_taxonomy"] = false;
	}

	/* Apply filters to the arguments. */
	$args = apply_filters( 'reactor_breadcrumbs_args', $args );

	/* Parse the arguments and extract them for easy variable naming. */
	$args = wp_parse_args( $args, $defaults );

	/* Get the trail items. */
	$trail = reactor_breadcrumbs_get_items( $args );

	/* Connect the breadcrumb trail if there are items in the trail. */
	if ( !empty( $trail ) && is_array( $trail ) ) {

		/* Open the breadcrumb trail containers. */
		$breadcrumb = '<ul class="breadcrumbs">';

		/* Wrap the $trail['trail_end'] value in a container. */
		if ( !empty( $trail['trail_end'] ) ) {
			$trail['trail_end'] = '<li class="current"><a href="#">' . $trail['trail_end'] . '</a></li>';
//			$trail['trail_end'] = '<li class="current"><a href="#" ng-bind="$routeParams.primaryNav"></a></li>';
		}
		
		/* Join the individual trail items into a single string. */
		$breadcrumb .= join( "", $trail );

		/* Close the breadcrumb trail containers. */
		$breadcrumb .= '</ul>';
	}

	/* Allow developers to filter the breadcrumb trail HTML. */
	$breadcrumb = apply_filters( 'reactor_breadcrumbs', $breadcrumb, $args );

	/* Output the breadcrumb. */
	if ( $args['echo'] ) {
		echo $breadcrumb;
	} else {
		return $breadcrumb;
	}
}

/**
 * Gets the items for the breadcrumb trail.  This is the heart of the script.  It checks the current page 
 * being viewed and decided based on the information provided by WordPress what items should be
 * added to the breadcrumb trail.
 *
 * @since 0.4.0
 * @todo Build in caching based on the queried object ID.
 * @param array $args Mixed arguments for the menu.
 * @return array List of items to be shown in the trail.
 */
function reactor_breadcrumbs_get_items( $args = array() ) {
	global $wp_rewrite;

	/* Set up an empty trail array and empty path. */
	$trail = array();
	$path = '';

	/* If $home_text is set and we're not on the front page of the site, link to the home page. */
	if ( !is_front_page() && $args['home_text'] ) {
		$trail[] = '<li><a href="' . home_url() . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" class="trail-begin">' . $args['home_text'] . '</a></li>';
	}

	/* If viewing the front page of the site. */
	if ( is_front_page() && $args['home_text'] && $args['front_page'] ) {
			$trail['trail_end'] = "{$args['home_text']}";
	}

	/* If viewing the "home"/posts page. */
	elseif ( is_home() ) {
		if ( 'page' == get_option('show_on_front') && get_option('page_for_posts') ) {
			the_post();
			$page_id = get_option('page_for_posts');
			setup_postdata( get_page( $page_id ) );
			$trail['trail_end'] = get_the_title( $page_id );
		} else {
			$home_page = get_page( get_queried_object_id() );
			$trail = array_merge( $trail, reactor_breadcrumbs_get_parents( $home_page->post_parent, '' ) );
			$trail['trail_end'] = get_the_title( $home_page->ID );
		}
	}

	/* If viewing a singular post (page, attachment, etc.). */
	elseif ( is_singular() ) {

		/* Get singular post variables needed. */
		$post = get_queried_object();
		$post_id = absint( get_queried_object_id() );
		$post_type = $post->post_type;
		$parent = absint( $post->post_parent );

		/* Get the post type object. */
		$post_type_object = get_post_type_object( $post_type );

		/* If viewing a singular 'post'. */
		if ( 'post' == $post_type ) {
		
			if ( 'page' == get_option('show_on_front') && get_option('page_for_posts') ) {
				the_post();
				$page_id = get_option('page_for_posts');
				setup_postdata( get_page( $page_id ) );
				$path .= get_the_title( $page_id );
			}
			
			/* If $front has been set, add it to the $path. */
			$path .= trailingslashit( $wp_rewrite->front );

			/* If there's a path, check for parents. */
			if ( !empty( $path ) ) {
				$trail = array_merge( $trail, reactor_breadcrumbs_get_parents( '', $path ) );
			}
			
		}

		/* If viewing a singular 'attachment'. */
		elseif ( 'attachment' == $post_type ) {

			/* If $front has been set, add it to the $path. */
			$path .= trailingslashit( $wp_rewrite->front );

			/* If there's a path, check for parents. */
			if ( !empty( $path ) ) {
				$trail = array_merge( $trail, reactor_breadcrumbs_get_parents( '', $path ) );
			}
			
			/* Map the post (parent) permalink structure tags to actual links. */
			$trail = array_merge( $trail, reactor_breadcrumbs_map_rewrite_tags( $post->post_parent, get_option( 'permalink_structure' ), $args ) );
		}

		/* If a custom post type, check if there are any pages in its hierarchy based on the slug. */
		elseif ( 'page' !== $post_type ) {

			/* If $front has been set, add it to the $path. */
			if ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front ) {
				$path .= trailingslashit( $wp_rewrite->front );
			}
			
			/* If there's a slug, add it to the $path. */
			//if ( !empty( $post_type_object->rewrite['slug'] ) )
			//	$path .= $post_type_object->rewrite['slug'];

			/* If there's a path, check for parents. */
			//if ( !empty( $path ) )
			//	$trail = array_merge( $trail, reactor_breadcrumbs_get_parents( '', $path ) );

			/* If there's an archive page, add it to the trail. */
			//if ( !empty( $post_type_object->has_archive ) )
			//	$trail[] = '<li><a href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . //$post_type_object->labels->name . '</a></li>';
		}

		/* If the post type path returns nothing and there is a parent, get its parents. */
		if ( ( empty( $path ) && 0 !== $parent ) || ( 'attachment' == $post_type ) ) {
			$trail = array_merge( $trail, reactor_breadcrumbs_get_parents( $parent, '' ) );
		}	

		/* Or, if the post type is hierarchical and there's a parent, get its parents. */
		elseif ( 0 !== $parent && is_post_type_hierarchical( $post_type ) ) {
			$trail = array_merge( $trail, reactor_breadcrumbs_get_parents( $parent, '' ) );
		}
		
		/* Display terms for specific post type taxonomy if requested. */
		$taxonomy = ( 'post' !== $post_type ) ? $post_type . '-category' : 'category';
		$categories = get_the_terms( $post_id, $taxonomy );
		if ( is_array( $categories ) ) {
			$categories = array_reverse( $categories );
		
			foreach ( $categories as $category ) {
				$trail[] = '<li><a href="' . get_term_link( $category->slug, $taxonomy ) . '" title="' . sprintf( __('View all posts in %s', 'reactor'), $category->name ) . '">' . $category->name . '</a></li>';
			}
		}
		
		/* End with the post title. */
		$post_title = get_the_title();
		if ( !empty( $post_title ) ) {
			$trail['trail_end'] = $post_title;
		}
	}

	/* If viewing a taxonomy term archive. */
	if ( is_tax() || is_category() || is_tag() ) {

		/* Get some taxonomy and term variables. */
		$term = get_queried_object();
		$taxonomy = get_taxonomy( $term->taxonomy );

		/* Get the path to the term archive. Use this to determine if a page is present with it. */
		if ( is_category() ) {
			$path = get_option( 'category_base' );
		} elseif ( is_tag() ) {
			$path = get_option( 'tag_base' );
		} elseif ( $taxonomy->rewrite['with_front'] && $wp_rewrite->front ) {
			$path = trailingslashit( $wp_rewrite->front );
			$path .= $taxonomy->rewrite['slug'];
		}

		/* Get parent pages by path if they exist. */
		if ( $path ) {
			$trail = array_merge( $trail, reactor_breadcrumbs_get_parents( '', $path ) );
		}
		
		/* If the taxonomy is hierarchical, list its parent terms. */
		if ( isset( $term ) && ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) ) {
			$trail = array_merge( $trail, reactor_breadcrumbs_get_term_parents( $term->parent, $term->taxonomy ) );
		}
		
		/* Add the term name to the trail end. */
		$trail['trail_end'] = single_term_title( '', false );
	}

	/* If viewing a post type archive. */
	elseif ( is_post_type_archive() ) {

		/* Get the post type object. */
		$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

		/* If $front has been set, add it to the $path. */
		if ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front ) {
			$path .= trailingslashit( $wp_rewrite->front );
		}
			
		/* If there's a slug, add it to the $path. */
		if ( !empty( $post_type_object->rewrite['slug'] ) ) {
			$path .= $post_type_object->rewrite['slug'];
		}
			
		/* If there's a path, check for parents. */
		if ( !empty( $path ) ) {
			$trail = array_merge( $trail, reactor_breadcrumbs_get_parents( '', $path ) );
		}
			
		/* Add the post type [plural] name to the trail end. */
		$trail['trail_end'] = $post_type_object->labels->name;
	}

	/* If viewing an author archive. */
	elseif ( is_author() ) {

		/* If $front has been set, add it to $path. */
		if ( !empty( $wp_rewrite->front ) ) {
			$path .= trailingslashit( $wp_rewrite->front );
		}
			
		/* If an $author_base exists, add it to $path. */
		if ( !empty( $wp_rewrite->author_base ) ) {
			$path .= $wp_rewrite->author_base;
		}
			
		/* If $path exists, check for parent pages. */
		if ( !empty( $path ) ) {
			$trail = array_merge( $trail, reactor_breadcrumbs_get_parents( '', $path ) );
		}
			
		/* Add the author's display name to the trail end. */
		$trail['trail_end'] = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
	}

	/* If viewing a time-based archive. */
	elseif ( is_time() ) {

		if ( get_query_var( 'minute' ) && get_query_var( 'hour' ) ) {
			$trail['trail_end'] = get_the_time( __( 'g:i a', 'reactor' ) );
		} elseif ( get_query_var( 'minute' ) ) {
			$trail['trail_end'] = sprintf( __( 'Minute %1$s', 'reactor' ), get_the_time( __( 'i', 'reactor' ) ) );
		} elseif ( get_query_var( 'hour' ) ) {
			$trail['trail_end'] = get_the_time( __( 'g a', 'reactor' ) );
		}
	}

	/* If viewing a date-based archive. */
	elseif ( is_date() ) {

		/* If $front has been set, check for parent pages. */
		if ( $wp_rewrite->front ) {
			$trail = array_merge( $trail, reactor_breadcrumbs_get_parents( '', $wp_rewrite->front ) );
		}

		if ( is_day() ) {
			$trail[] = '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'reactor' ) ) . '">' . get_the_time( __( 'Y', 'reactor' ) ) . '</a></li>';
			$trail[] = '<li><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( esc_attr__( 'F', 'reactor' ) ) . '">' . get_the_time( __( 'F', 'reactor' ) ) . '</a></li>';
			$trail['trail_end'] = get_the_time( __( 'd', 'reactor' ) );
		} elseif ( get_query_var( 'w' ) ) {
			$trail[] = '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'reactor' ) ) . '">' . get_the_time( __( 'Y', 'reactor' ) ) . '</a></li>';
			$trail['trail_end'] = sprintf( __( 'Week %1$s', 'reactor' ), get_the_time( esc_attr__( 'W', 'reactor' ) ) );
		} elseif ( is_month() ) {
			$trail[] = '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'reactor' ) ) . '">' . get_the_time( __( 'Y', 'reactor' ) ) . '</a></li>';
			$trail['trail_end'] = get_the_time( __( 'F', 'reactor' ) );
		} elseif ( is_year() ) {
			$trail['trail_end'] = get_the_time( __( 'Y', 'reactor' ) );
		}
	}

	/* If viewing search results. */
	elseif ( is_search() ) {
		$trail['trail_end'] = sprintf( __( 'Search results for &quot;%1$s&quot;', 'reactor' ), esc_attr( get_search_query() ) );
	}
	
	/* If viewing a 404 error page. */
	elseif ( is_404() ) {
		$trail['trail_end'] = __( '404 Not Found', 'reactor' );
	}
	
	/* Allow devs to step in and filter the $trail array. */
	return apply_filters( 'reactor_breadcrumbs_items', $trail, $args );
}

/**
 * Gets parent pages of any post type or taxonomy by the ID or Path.  The goal of this function is to create 
 * a clear path back to home given what would normally be a "ghost" directory.  If any page matches the given 
 * path, it'll be added.  But, it's also just a way to check for a hierarchy with hierarchical post types.
 *
 * @since 0.3.0
 * @param int $post_id ID of the post whose parents we want.
 * @param string $path Path of a potential parent page.
 * @return array $trail Array of parent page links.
 */
function reactor_breadcrumbs_get_parents( $post_id = '', $path = '' ) {

	/* Set up an empty trail array. */
	$trail = array();

	/* Trim '/' off $path in case we just got a simple '/' instead of a real path. */
	$path = trim( $path, '/' );

	/* If neither a post ID nor path set, return an empty array. */
	if ( empty( $post_id ) && empty( $path ) ) {
		return $trail;
	}
	
	/* If the post ID is empty, use the path to get the ID. */
	if ( empty( $post_id ) ) {

		/* Get parent post by the path. */
		$parent_page = get_page_by_path( $path );

		/* If a parent post is found, set the $post_id variable to it. */
		if ( !empty( $parent_page ) ) {
			$post_id = $parent_page->ID;
		}
	}

	/* If a post ID and path is set, search for a post by the given path. */
	if ( $post_id == 0 && !empty( $path ) ) {

		/* Separate post names into separate paths by '/'. */
		$path = trim( $path, '/' );
		preg_match_all( "/\/.*?\z/", $path, $matches );

		/* If matches are found for the path. */
		if ( isset( $matches ) ) {

			/* Reverse the array of matches to search for posts in the proper order. */
			$matches = array_reverse( $matches );

			/* Loop through each of the path matches. */
			foreach ( $matches as $match ) {

				/* If a match is found. */
				if ( isset( $match[0] ) ) {

					/* Get the parent post by the given path. */
					$path = str_replace( $match[0], '', $path );
					$parent_page = get_page_by_path( trim( $path, '/' ) );

					/* If a parent post is found, set the $post_id and break out of the loop. */
					if ( !empty( $parent_page ) && $parent_page->ID > 0 ) {
						$post_id = $parent_page->ID;
						break;
					}
				}
			}
		}
	}

	/* While there's a post ID, add the post link to the $parents array. */
	while ( $post_id ) {

		/* Get the post by ID. */
		$page = get_page( $post_id );

		/* Add the formatted post link to the array of parents. */
		$parents[]  = '<li><a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></li>';

		/* Set the parent post's parent to the post ID. */
		$post_id = $page->post_parent;
	}

	/* If we have parent posts, reverse the array to put them in the proper order for the trail. */
	if ( isset( $parents ) ) {
		$trail = array_reverse( $parents );
	}
	
	/* Return the trail of parent posts. */
	return $trail;
}

/**
 * Searches for term parents of hierarchical taxonomies.  This function is similar to the WordPress 
 * function get_category_parents() but handles any type of taxonomy.
 *
 * @since 0.3.0
 * @param int $parent_id The ID of the first parent.
 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
 * @return array $trail Array of links to parent terms.
 */
function reactor_breadcrumbs_get_term_parents( $parent_id = '', $taxonomy = '' ) {

	/* Set up some default arrays. */
	$trail = array();
	$parents = array();

	/* If no term parent ID or taxonomy is given, return an empty array. */
	if ( empty( $parent_id ) || empty( $taxonomy ) ) {
		return $trail;
	}
	
	/* While there is a parent ID, add the parent term link to the $parents array. */
	while ( $parent_id ) {

		/* Get the parent term. */
		$parent = get_term( $parent_id, $taxonomy );

		/* Add the formatted term link to the array of parent terms. */
		$parents[] = '<li><a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a></li>';

		/* Set the parent term's parent as the parent ID. */
		$parent_id = $parent->parent;
	}

	/* If we have parent terms, reverse the array to put them in the proper order for the trail. */
	if ( !empty( $parents ) ) {
		$trail = array_reverse( $parents );
	}
	
	/* Return the trail of parent terms. */
	return $trail;
}
?>
