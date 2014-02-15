<?php 
/**
 * Taxonomy Sub Nav
 * list taxonomy terms as a submenu
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://wp.tutsplus.com/tutorials/creating-a-filterable-portfolio-with-wordpress-and-jquery/
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */
 
if ( !function_exists('reactor_category_submenu') ) {
	function reactor_category_submenu( $args = '' ) {
		
		$defaults = array( 
			'taxonomy'   => 'category',
			'all_link'   => __('All', 'reactor'),
			'quicksand'  => false,
			'terms_args' => '',
		 );
        $args = wp_parse_args( $args, $defaults );
		
		$count = 0;
		$terms = get_terms( $args['taxonomy'], $args['terms_args'] ) ? get_terms( $args['taxonomy'], $args['terms_args'] ) : '';
		$count = count( $terms );
 
		if ( $count > 1 ) {
			$filter_class = ( $args['quicksand'] ) ? ' filter-nav' : '';
			$output  = '<div class="category-submenu"><dl class="sub-nav' . $filter_class . '"><dt>' . __('Categories: ', 'reactor') . '</dt>';
			if ( $args['quicksand'] ) {
				$output .= '<div class="category-submenu"><dd class="filter active" data-filter="all"><a>' . $args['all_link'] . '</a></dd>';
			}
			$current_category = single_cat_title('', false); $i = 2;
			foreach ( $terms as $term ) {
				$active = ( $term->name == $current_category ) ? 'active' : '';
				if ( $args['quicksand'] ) {
					$output .= '<dd class="filter" data-filter="' . $term->slug . '"><a>' . $term->name . '</a></dd>';
				} else {
					$output .= '<dd class="' . $active . '"><a href="' . get_term_link( $term->slug, $args['taxonomy'] ) . '">' . $term->name . '</a></dd>';
				}
				$i++;
			}
			$output .= '</dl></div>';
			echo apply_filters( 'reactor_category_submenu', $output, $args );
		} 
	}
}