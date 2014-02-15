<?php 
/**
 * Tumblog Icons
 *
 * must be used in the loop
 * gets the post format and outputs the appropriate icon
 * can be hidden within customizer
 * uses Foundation Icon Fonts 
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://www.zurb.com/playground/foundation-icons
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

if ( !function_exists('reactor_tumblog_icon') ) { 
	function reactor_tumblog_icon( $args = '' ) {
		$output = ''; $icon = '';
		$format = ( get_post_format( get_the_ID() ) ) ? get_post_format( get_the_ID() ) : 'standard';
		
		switch( $format ) {
			case 'standard' : $icon .= '<i class="fi-page-filled"></i>'; break;
			case 'aside' : $icon .= '<i class="fi-page-export"></i>'; break;
			case 'gallery' : $icon .= '<i class="fi-layout"></i>'; break;
			case 'link' : $icon .= '<i class="fi-link"></i>'; break;
			case 'image' : $icon .= '<i class="fi-photo"></i>'; break;
			case 'quote' : $icon .= '<i class="fi-quote"></i>'; break;
			case 'status' : $icon .= '<i class="fi-star"></i>'; break;
			case 'video' : $icon .= '<i class="fi-play-video"></i>'; break;
			case 'audio' : $icon .= '<i class="fi-sound"></i>'; break;
			case 'chat' : $icon .= '<i class="fi-torsos"></i>'; break;
		}
		
		$defaults = array(
			'icon' => $icon,
			'echo' => true,
			'link' => true,
		);
		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'reactor_tumblog_icon_args', $args );
		
		if ( $args['icon'] && $args['link'] ) {
			$output .= '<div class="entry-icon">';
			$output .= '<a href="' . get_permalink( get_the_ID() ) . '" title="' . get_the_title() . '" rel="bookmark">';
			$output .= $args['icon'];
			$output .= '</a></div>';
		}
		elseif ( $args['icon'] ) {
			$output .= '<div class="entry-icon">';
			$output .= $args['icon'];
			$output .= '</div>';
		}
		
		if ( $args['echo'] ) {
			echo apply_filters('reactor_tumblog_icon', $output);
		} else {
			return apply_filters('reactor_tumblog_icon', $output);
		}
	}
}