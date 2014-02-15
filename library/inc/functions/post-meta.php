<?php 
/**
 * Reactor Post Meta
 * @author Herley Roger
 * @package Angularpress
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @credit TewentyTwelve Theme
 * @usees $post
 * @param $args Optional. Override defaults.
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Meta information for current post: categories, tags, author, and date
 */
if ( !function_exists('reactor_post_meta') ) {
	function reactor_post_meta( $args = '' ) {
		
		do_action('reactor_post_meta', $args);
		
		global $post; $meta = ''; $output = '';
		
		$defaults = array( 
			'show_author' => true,
			'show_date'   => true,
			'show_cat'    => true,
			'show_tag'    => true,
			'show_icons'  => false,
			'show_uncategorized' => false,
		 );
        $args = wp_parse_args( $args, $defaults );
		
		/*if ( 'portfolio' == get_post_type() ) {
			$categories_list = get_the_term_list( $post->ID, 'portfolio-category', '', ', ', '' );
		} else {
			// $categories_list = get_the_category_list(', ');
			$count = 0;
			$categories_list = '';
			$categories = get_the_category();			
			foreach ( $categories as $category ) {
				$count++;
				if ( $args['show_uncategorized'] ) {
					$categories_list .= '<a href="' . get_category_link( $category->term_id ) . '" title="'.sprintf( __('View all posts in %s', 'reactor'), $category->name ) . '">' . $category->name . '</a>';
					if ( $count != count( $categories ) ){
						$categories_list .= ', ';
					}
				} else {
					if ( $category->slug != 'uncategorized' || $category->name != 'Uncategorized' ) {
						$categories_list .= '<a href="' . get_category_link( $category->term_id ) . '" title="'.sprintf( __('View all posts in %s', 'reactor'), $category->name ) . '">' . $category->name . '</a>';
						if ( $count != count( $categories ) ){
							$categories_list .= ', ';
						}
					}
				}
					
			}
		}*/

		if ( 'portfolio' == get_post_type() ) {
			$categories_list = get_the_term_list( $post->ID, 'portfolio-category', '', ', ', '' );
		} else {
			// $categories_list = get_the_category_list(', ');
//			$count = 0;
			$categories_list = '';
//			$categories = get_the_category();
			$categories_list .= '<span ng-repeat="category in item.categories"><a ng-href="{{siteUrl}}/category/{{category.slug}}/" title="View all posts in {{category.title}}" ng-bind-html="category.title+\',\'"></a></span>';
		/*	foreach ( $categories as $category ) {
				$count++;
				if ( $args['show_uncategorized'] ) {
					$categories_list = '<span ng-repeat="category in item.categories"><a ng-href="{{siteUrl}}/category/{{category.slug}}/" title="View all posts in {{category.title}}" ng-bind-html="category.title "></a></span>';
					if ( $count != count( $categories ) ){
						$categories_list .= ', ';
					}
				} else {
					if ( $category->slug != 'uncategorized' || $category->name != 'Uncategorized' ) {
						$categories_list = '<span ng-repeat="category in item.categories"><a ng-href="{{siteUrl}}/category/{{category.slug}}/" title="View all posts in {{category.title}}" ng-bind-html="category.title+\',\'"></a></span>';
						if ( $count != count( $categories ) ){
							$categories_list .= ', ';
						}
					}
				}

			}*/
		}
		
		if ( 'portfolio' == get_post_type() ) {
			$tag_list = get_the_term_list( $post->ID, 'portfolio-tag', '', ', ', '' );
		} else {
			$tag_list = get_the_tag_list( '', ', ', '' );
		}
	
		/*$date = sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>',
			esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ),
			esc_attr( sprintf( __('View all posts from %s %s', 'reactor'), get_the_time('M'), get_the_time('Y') ) ),
			esc_attr( get_the_date('c') ),
			esc_html( get_the_date() )
		 );*/
		$date = sprintf('<a ng-href="{{siteUrl}}" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate ng-bind-html="item.date"></time></a>',
			esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ),
			esc_attr( sprintf( __('View all posts from %s %s', 'reactor'), get_the_time('M'), get_the_time('Y') ) ),
			esc_attr( get_the_date('c') ),
			esc_html( get_the_date() )
		);

		/*$author = sprintf('<span class="author"><a class="url fn n" ng-href="{{siteUrl}}/author/{{item.author.slug}}" title="View all posts by " rel="author" ng-bind-html="item.author.name"></a></span>',
			esc_url( get_author_posts_url( get_the_author_meta('ID') ) ),
			esc_attr( sprintf( __('View all posts by {{item.author.name}}', 'reactor'), get_the_author() ) ),
			get_the_author()
		);*/

		$author = sprintf('<span class="author"><a class="url fn n" ng-href="{{siteUrl}}/author/{{item.author.slug}}" title="%2$s" rel="author" ng-bind-html="item.author.name"></a></span>',
			esc_url( get_author_posts_url( get_the_author_meta('ID') ) ),
			esc_attr( sprintf( __('View all posts by {{item.author.name}}', 'reactor'), get_the_author() ) ),
			get_the_author()
		 );
	
		/**
		 * 1 is category, 2 is tag, 3 is the date and 4 is the author's name
		 */
	/*	if ( $date || $categories_list || $author || $tag_list ) {
			if ( $args['show_icons'] ) {
				$meta .= ( $author && $args['show_author'] ) ? '<i class="social foundicon-torso" title="Written by"></i> <span class="by-author">%4$s</span>' : '';
				$meta .= ( $date && $args['show_date'] ) ? '<i class="general foundicon-calendar" title="Publish on"></i> %3$s' : '';
				$meta .= ( $categories_list && $args['show_cat'] ) ? '<i class="general foundicon-folder" title="Posted in"></i> %1$s' : '';
				$meta .= ( $tag_list && $args['show_tag'] ) ? '<div class="entry-tags"><i class="general foundicon-flag" title="Tagged with"></i> %2$s</div>' : '';
				
				if ( $meta ) {
					$output = '<div class="entry-meta icons">' . $meta . '</div>';
				}
			} else {
				$meta .= ( $date && $args['show_date'] ) ? '%3$s ' : '';
				$meta .= ( $author && $args['show_author'] ) ? __('by', 'reactor') . ' <span class="by-author">%4$s</span> ' : '';
				$meta .= ( $categories_list && $args['show_cat'] ) ? __('in', 'reactor') . ' %1$s' : '';
				$meta .= ( $tag_list && $args['show_tag'] ) ? '<div class="entry-tags">' . __('Tags:', 'reactor') . ' %2$s</div>' : '';

				if ( $meta ) {
					$output = '<div class="entry-meta">' . __('Posted: ', 'reactor') . $meta . '</div>';
				}
			}
	
			$post_meta = sprintf( $output, $categories_list, $tag_list, $date, $author );

			echo apply_filters('reactor_post_meta', $post_meta, $defaults);
		}*/


		if ( $date || $categories_list || $author || $tag_list ) {
			if ( $args['show_icons'] ) {
				$meta .= ( $author && $args['show_author'] ) ? '<i class="social foundicon-torso" title="Written by"></i> <span class="by-author">%4$s</span>' : '';
				$meta .= ( $date && $args['show_date'] ) ? '<i class="general foundicon-calendar" title="Publish on"></i> %3$s' : '';
				$meta .= ( $categories_list && $args['show_cat'] ) ? '<i class="general foundicon-folder" title="Posted in"></i> %1$s' : '';
				$meta .= ( $tag_list && $args['show_tag'] ) ? '<div class="entry-tags"><i class="general foundicon-flag" title="Tagged with"></i> %2$s</div>' : '';

				if ( $meta ) {
					$output = '<div class="entry-meta icons">' . $meta . '</div>';
				}
			} else {
				$meta .= ( $date && $args['show_date'] ) ? '%3$s ' : '';
				$meta .= ( $author && $args['show_author'] ) ? __('by', 'reactor') . ' <span class="by-author">%4$s</span> ' : '';
				$meta .= ( $categories_list && $args['show_cat'] ) ? __('in', 'reactor') . ' %1$s' : '';
				$meta .= ( $tag_list && $args['show_tag'] ) ? '<div class="entry-tags">' . __('Tags:', 'reactor') . ' %2$s</div>' : '';

				if ( $meta ) {
					$output = '<div class="entry-meta">' . __('Posted: ', 'reactor') . $meta . '</div>';
				}
			}

			$post_meta = sprintf( $output, $categories_list, $tag_list, $date, $author );

			echo apply_filters('reactor_post_meta', $post_meta, $defaults);
		}
	}
}