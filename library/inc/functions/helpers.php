<?php 
/**
 * Clean Up WordPress Output
 *
 * @package Reactor
 * @since 1.0.0
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @author Eddie Machado (@eddiemachado / themeble.com/bones)
 * @link http://codex.wordpress.org/Function_Reference/register_post_type#Example
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * 1. Head Clean Up
 * 2. remove WP version from RSS
 * 3. remove WP version from scripts
 * 4. remove injected CSS for recent comments widget
 * 5. remove injected CSS from gallery
 * 6. remove the p tags from around images
 * 7. Change the default excerpt more link
 * 8. Change the content more link
 * 9. Custom excerpt length
 * 10. Customize the output of captions
 * 11. Better Title Display in header.php
 * 12. Add the permalink to the end of an aside posts
 * 13. Add blockquote tags around quote posts
 * 14. Add flex-video div around video posts
 * 15. Changes the CSS for the admin bar on the front end
 * 16. Remove WP CSS for Admin Bar on front end
 * 17. Add classes to a single post
 * 18. Add classes to body tag
 * 19. Return dynamic sidebar content
 * 20. Change Sticky Class
 * 21. Add Comment Reply Class
 * 22. Exclude Front Page Posts
 */

/**
 * The default wordpress head is
 * a mess. Let's clean it up by 
 * removing all the junk we don't
 * need. -Bones
 */
add_action('after_setup_theme', 'reactor_wp_helpers', 15); 
 
if ( !function_exists('reactor_wp_helpers') ) {
	function reactor_wp_helpers() {
		
		// launching operation cleanup
		add_action('init', 'reactor_head_cleanup');
		
		// remove WP version from RSS
		add_filter('the_generator', 'reactor_rss_version');
		
		// creates a nicely formatted title in the header
		add_filter('wp_title', 'reactor_wp_title', 10, 2);
		
		// remove injected css for recent comments widget
		add_filter('wp_head', 'reactor_remove_wp_widget_recent_comments_style', 1);
		// clean up comment styles in the head
		add_action('wp_head', 'reactor_remove_recent_comments_style', 1);
		// fixes CSS output for front end admin bar
		add_action('wp_head', 'reactor_admin_bar_fix', 5);
		add_action('get_header', 'reactor_remove_admin_bar_css');
		
		// adds class to body
		add_filter('body_class', 'reactor_topbar_body_class');
		
		// change sticky class
		add_filter('post_class','reactor_change_sticky_class');
		// adds class to single posts
		add_filter('post_class', 'reactor_single_post_class');
		
		// cleaning up code around images
		add_filter('the_content', 'reactor_img_unautop', 30);
		// add permalink to aside posts
		add_filter('the_content', 'reactor_add_link_to_asides', 9);
		// add blockquote tag to quote posts
		add_filter('the_content', 'reactor_add_blockquote_to_quotes');
		// add blockquote tag to quote posts
		add_filter('the_content', 'reactor_add_flexvideo_to_videos');
		
		// changes excerpt more link
		add_filter('excerpt_more', 'reactor_excerpt_more');
		// custom excerpt length
		add_filter('excerpt_length', 'reactor_excerpt_length', 999);
		// changes content more link
		add_filter('the_content_more_link', 'reactor_content_more', 10, 2); 
		
		// add html5 captions
		add_filter('img_caption_shortcode', 'reactor_cleaner_caption', 10, 3);
		
		// clean up gallery output in wp
		add_filter('gallery_style', 'reactor_gallery_style');
				
		// add comment reply class
		add_filter('comment_reply_link', 'reactor_comment_reply_class');
		
		// do shortcodes in widgets
		add_filter('widget_text', 'do_shortcode');
		
		// exclude front page posts
		add_action( 'pre_get_posts', 'exclude_category' );
		
	}
}

/**
 * 1. Head Clean Up
 *
 * @since 1.0.0
 */
function reactor_head_cleanup() {
	// category feeds
	// remove_action('wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action('wp_head', 'feed_links', 2 );
	
	// EditURI link
	remove_action('wp_head', 'rsd_link');
	// windows live writer 
	remove_action('wp_head', 'wlwmanifest_link');
	// index link
	remove_action('wp_head', 'index_rel_link');
	// WP version
	remove_action('wp_head', 'wp_generator');
	// previous link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	// start link
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	// links for adjacent posts
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// remove WP version from css
	add_filter('style_loader_src', 'reactor_remove_wp_ver_css_js', 9999);
	 // remove Wp version from scripts
	add_filter('script_loader_src', 'reactor_remove_wp_ver_css_js', 9999);
}

/**
 * 2. Remove WP version from RSS
 *
 * @since 1.0.0
 */
function reactor_rss_version() {return '';}

/**
 * 3. Remove WP version from scripts
 *
 * @since 1.0.0
 */
function reactor_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=') )
		$src = remove_query_arg('ver', $src );
	return $src;
}

/** 
 * 4. Remove injected CSS for recent comments widget
 *
 * @since 1.0.0
 */
function reactor_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
	  remove_filter('wp_head', 'wp_widget_recent_comments_style');
   }
}
function reactor_remove_recent_comments_style() {
  global $wp_widget_factory;
  if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
	remove_action('wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}

/**
 * 5. Remove injected CSS from gallery
 *
 * @since 1.0.0
 */
function reactor_gallery_style( $css ) {
  return preg_replace( "!<style type='text/css'>( .*? )</style>!s", '', $css );
}

/**
 * 6. Remove the p tags from around images
 *
 * @link http://blog.fublo.net/2011/05/wordpress-p-tag-removal/
 * @since 1.0.0
 */
function reactor_img_unautop( $content ) {
	$content = preg_replace( '/<p>\s*( <a .*> )?\s*( <img .* \/> )\s*( <\/a> )?\s*<\/p>/iU', '\1\2\3', $content );
	return $content;
}

/**
 * 7. Change the default excerpt more link
 *
 * @since 1.0.0
 */
function reactor_excerpt_more( $output ) {
	global $post;
	$readmore = reactor_option('post_readmore', 'Read more &raquo;');
	return '&hellip;  <a href="' . get_permalink( $post->ID ) . '" title="Read ' . get_the_title( $post->ID ) . '">' . $readmore . '</a>';
}

/**
 * 8. Change the content more link
 *
 * @since 1.0.0
 */
function reactor_content_more( $link, $link_text ) {
	$readmore = reactor_option('post_readmore', 'Read more &raquo;');
	return str_replace( $link_text, $readmore, $link );
}

/**
 * 9. Custom excerpt length
 *
 * @link http://codex.wordpress.org/Function_Reference/the_excerpt#Control_Excerpt_Length_using_Filters
 * @since 1.0.0
 */
function reactor_excerpt_length( $length ) {
	return 50;
}

/**
 * 10. Customize the output of captions
 *
 * @since 1.0.0
 */
function reactor_cleaner_caption( $output, $attr, $content ) {
	if ( is_feed() ) {
		return $output;
	}
	$defaults = array( 
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => ''
	 );
	$attr = shortcode_atts( $defaults, $attr );
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) ) {
		return $content;
	}
	$attributes = ' class="figure wp-caption ' . esc_attr( $attr['align'] ) . '"';
	$output = '<figure' . $attributes . '>';
	$output .= do_shortcode( $content );
	$output .= '<figcaption class="wp-caption-text">' . $attr['caption'] . '</figcaption>';
	$output .= '</figure>';
	return $output;
}

/**
 * 11. Better Title Display in header.php
 * from TwentyTwelve theme
 *
 * @since 1.0.0
 */
function reactor_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo('name');

	// Add the site description for the home/front page.
	$site_description = get_bloginfo('description', 'display');
	if ( $site_description && ( is_home() || is_front_page() || is_page_template('page-templates/front-page.php') ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __('Page %s', 'reactor'), max( $paged, $page ) );

	return $title;
}

/** 
 * 12. Add the permalink to the end of an aside posts
 *
 * @author Justin Tadlock 
 * @link http://justintadlock.com/archives/2012/09/06/post-formats-aside
 * @since 1.0.0
 */
function reactor_add_link_to_asides( $content ) {
	if ( has_post_format('aside') && !is_singular() )
		$content .= ' <a href="' . get_permalink() . '" rel="bookmark" title="' . esc_attr( sprintf( the_title_attribute('echo=0') ) ) . '">&#8734;</a>';
	return apply_filters('reactor_aside_format_link', $content);
}

/**
 * 13. Add blockquote tags around quote posts if not in the content
 *
 * @author Justin Tadlock
 * @link http://justintadlock.com/archives/2012/08/27/post-formats-quote
 * @since 1.0.0
 */
function reactor_add_blockquote_to_quotes( $content ) {
	if ( has_post_format('quote') ) {
		preg_match( '/<blockquote.*?>/', $content, $matches );
		if ( empty( $matches ) )
			$content = '<blockquote>'.$content.'</blockquote>';
	}
	return apply_filters('reactor_quote_format_blockquote', $content);
}

/**
 * 14. Add flex-video div around video posts if not in the content
 *
 * @since 1.0.0
 */
function reactor_add_flexvideo_to_videos( $content ) {
	if ( has_post_format('video') ) {
		preg_match( '/<div.*?class="flex-video.*?>/', $content, $matches );
		if ( empty( $matches ) )
			$content = '<div class="flex-video">'.$content.'</div>';
	}
	return apply_filters('reactor_add_flexvideo_to_videos', $content);
}

/**
 * 15. Changes the CSS for the admin bar on the front end
 *
 * @since 1.0.0
 */
function reactor_admin_bar_fix() {
	if ( !is_admin() && is_admin_bar_showing() ) {
		$output  = '<style type="text/css">'."\n\t";
		$output .= 'body.admin-bar { padding-top: 28px; }' . "\n";
		$output .= '</style>' . "\n";
	echo $output;
	}
}

/**
 * 16. Remove default CSS for WP admin bar on front end
 *
 * @since 1.2.0
 */
function reactor_remove_admin_bar_css() {
	if ( !is_admin() && is_admin_bar_showing() ) {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}
}

/**
 * 17. Add classes to a single post
 *
 * @link http://codex.wordpress.org/Function_Reference/post_class#Add_Classes_By_Filters
 * @since 1.0.0
 */
function reactor_single_post_class( $classes ) {
	if ( is_single() ) {
		$classes[] = 'single';
	}
	if ( is_single() && 'portfolio' == get_post_type()) {
		$classes[]  = 'single';
		$classes[] .= 'single-portfolio';
	}
	return $classes;
}

/**
 * 18. Add classes to body tag
 *
 * @since 1.0.0
 */
function reactor_topbar_body_class( $classes ) {
	if ( has_nav_menu('top-bar-l') || has_nav_menu('top-bar-r') ) {
		$classes[] = 'has-top-bar';
	}
	if ( is_page_template('page-templates/front-page.php') ) {
		$classes[] = 'front-page';
	}
	if ( is_page_template('page-templates/news-page.php') ) {
		$classes[] = 'news-page';
	}
	if ( is_page_template('page-templates/portfolio.php') ) {
		$classes[] = 'portfolio';
	}
	if ( is_page_template('page-templates/contact.php') ) {
		$classes[] = 'contact-page';
	}
	return $classes;
}

/**
 * 19. Return dynamic sidebar content
 * for some reason this isn't in WP
 *
 * @link http://core.trac.wordpress.org/ticket/13169
 * @since 1.0.0
 */
function get_dynamic_sidebar( $index = 1 ) {
	$sidebar_contents = '';
	ob_start();
	dynamic_sidebar( $index );
	$sidebar_contents = ob_get_clean();
	return $sidebar_contents;
}

/**
 * 20. Change Sticky Class
 * sticky class on posts conflicts with Foundation js
 *
 * @since 1.0.0
 */
function reactor_change_sticky_class( $classes ) {
	$count = count( $classes );
	for ( $i=0; $i < $count; $i++ ) {
		if ( $classes[$i] == 'sticky' ) {
			$classes[$i] = 'sticky-post';
			$classes[] = 'featured';
		}
	}
	return $classes;
}

/**
 * 21. Add Comment Reply Class
 * add the button class to the reply link in comments
 *
 * @since 1.0.0
 */  
function reactor_comment_reply_class( $link ) {
	return str_replace("class='comment-reply-link'", "class='comment-reply-link button small'", $link);
}

/**
 * 22. Exclude Front Page Posts
 * If option is set in customizer to exlude front page posts
 * then remove them from the main query
 *
 * @since 1.0.0
 */ 
function exclude_category( $query ) {
	$exclude = ( reactor_option('frontpage_exclude_cat', 1) ) ? -reactor_option('frontpage_post_category', '') : '';
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', $exclude );
    }
}
?>
