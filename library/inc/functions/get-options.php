<?php
/**
 * Reactor Get Options
 * based on get_theme_mod in wp-includes/theme.php
 * retrieves an option from the database or cache
 * can also get a value from post meta
 *
 * @package Reactor
 * @since 1.0.0
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @param $name option name in database
 * @param \a|bool $default a default value if option is avialble
 * @param $meta_id post meta id to retrieve meta from database
 * @return mixed|void
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */
function reactor_option( $name, $default = false, $meta_id = null ) {
	
	// if meta_id isset get post meta
	if ( isset( $meta_id ) ) {
		$post_id = absint( get_queried_object_id() );
		
		// if posts page is set in reading settings get the page id
		if ( 'page' == get_option('show_on_front') && get_option('page_for_posts') && is_home() ) {
			the_post();
			$post_id = get_option('page_for_posts');
			wp_reset_postdata();
		}
		
		// get the meta from the database
		$meta = ( get_post_meta( $post_id, $meta_id, true ) ) ? get_post_meta( $post_id, $meta_id, true ) : null;
		
		// if meta is an array check for the name in the array
		if ( is_array( $meta ) ) {
			$meta = $meta[ $name ];
		}
		
		// if meta isset return the value
		if ( isset( $meta ) ) {
			$meta = do_shortcode( $meta );
			return apply_filters( 'reactor_option_$name', $meta );
		} 
		
	} else {
		// else get array of options
		$options = ( get_option( 'reactor_options' ) ) ? get_option( 'reactor_options' ) : null;
	}
		
	// return the option if it exists
	if ( isset( $options[ $name ] ) ) {
		return apply_filters( 'reactor_option_$name', $options[ $name ] );
	}
		
	// return default if nothing else
	return apply_filters( 'reactor_option_$name', $default );
}
