<?php
/**
 * Custom Post Types
 * Portfolio, Slider and custom taxonomies
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @author Eddie Machado (@eddiemachado / themeble.com/bones)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_post_type#Example
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


add_action('after_setup_theme', 'reactor_register_post_types', 16); 
 
function reactor_register_post_types() { 
	$post_types = get_theme_support('reactor-post-types'); 

	if ( !is_array( $post_types[0] ) ) {
		return;
	}

	/**
	 * Register slide post type
	 * Do not use before init
	 *
	 * @see register_post_type
	 * @since 1.0.0
	 */
	if ( in_array('slides', $post_types[0] ) ) {
		function reactor_slide_register() {
				
			$labels = array( 
				'name'               => __('Slideshow', 'reactor'),
				'singular_name'      => __('Slide', 'reactor'),
				'add_new'            => __('Add New', 'reactor'),
				'add_new_item'       => __('Add New Slide', 'reactor'),
				'edit_item'          => __('Edit Slide', 'reactor'),
				'new_item'           => __('New Slide', 'reactor'),
				'all_items'          => __('All Slides', 'reactor'),
				'view_item'          => __('View Slide', 'reactor'),
				'search_items'       => __('Search Slides', 'reactor'),
				'not_found'          => __('Nothing found', 'reactor'),
				'not_found_in_trash' => __('Nothing found in Trash', 'reactor'),
				'parent_item_colon'  => '',
				'menu_name'          => __('Slides', 'reactor')
			 );
			 
			$args = array( 
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'menu_icon'          => get_template_directory_uri() . '/library/img/admin/admin-slides.png',
				'rewrite'	         => true,
				'capability_type'    => 'post',
				'taxonomies'         => array('slide-category'),
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => 7,
					'rewrite'    => array(  
					'slug'       => __('slideshow-post', 'reactor'),
					'with_front' => false,  
					'feed'       => true,  
					'pages'      => true ),
				'supports'           => array('title','editor','thumbnail', 'excerpt')
			  ); 
		 
			register_post_type('slide' , $args );
		}
		add_action('init', 'reactor_slide_register');

		/**
		 * Create slide taxonomies
		 * Do not use before init
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
		 * @see register_taxonomy
		 * @since 1.0.0
		 */
		function reactor_slide_taxonomies() {
		  // Add new taxonomy, make it hierarchical ( like categories )
		  $labels = array( 
			'name'              => __('Slide Categories', 'reactor'),
			'singular_name'     => __('Slide Category', 'reactor'),
			'search_items'      => __('Search Slide Categories', 'reactor'),
			'all_items'         => __('All Slide Categories', 'reactor'),
			'parent_item'       => __('Parent Slide Category', 'reactor'),
			'parent_item_colon' => __('Parent Slide Category:', 'reactor'),
			'edit_item'         => __('Edit Slide Category', 'reactor'), 
			'update_item'       => __('Update Slide Category', 'reactor'),
			'add_new_item'      => __('Add New Slide Category', 'reactor'),
			'new_item_name'     => __('New Slide Category Name', 'reactor'),
			'menu_name'         => __('Categories', 'reactor'),
		  ); 	
			
		  register_taxonomy('slide-category', array('slide'), 
		  array( 
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		  ));
		}
		add_action('init', 'reactor_slide_taxonomies', 0);
	}

	/**
	 * Register portfolio post type
	 * Do not use before init
	 *
	 * @see register_post_type
	 * @since 1.0.0
	 */
	if ( in_array('portfolio', $post_types[0] ) ) { 
		function reactor_portfolio_register() {
			 
			$labels = array( 
				'name'               => __('Portfolio', 'reactor'),
				'singular_name'      => __('Portfolio Post', 'reactor'),
				'add_new'            => __('Add New', 'reactor'),
				'add_new_item'       => __('Add New Portfolio Post', 'reactor'),
				'edit_item'          => __('Edit Portfolio Post', 'reactor'),
				'new_item'           => __('New Portfolio Post', 'reactor'),
				'all_items'          => __('All Portfolio Posts', 'reactor'),
				'view_item'          => __('View Portfolio Post', 'reactor'),
				'search_items'       => __('Search Portfolio', 'reactor'),
				'not_found'          => __('Nothing found', 'reactor'),
				'not_found_in_trash' => __('Nothing found in Trash', 'reactor'),
				'parent_item_colon'  => '',
				'menu_name'          => __('Portfolio', 'reactor')
			 );
			 
			$args = array( 
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'menu_icon'          => get_template_directory_uri() . '/library/img/admin/admin-folio.png',
				'rewrite'	         => false,
				'capability_type'    => 'post',
				'taxonomies'         => array('portfolio-category', 'portfolio-tag'),
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 8,
				'rewrite'            => array(  
					'slug'       => __('portfolio-post', 'reactor'),  
					'with_front' => false,  
					'feed'       => true,  
					'pages'      => true ),
				'supports'           => array('title','editor','thumbnail', 'excerpt', 'comments')
			  ); 
			 
			register_post_type('portfolio' , $args );
				
			// this ads your post categories to your custom post type
			  // register_taxonomy_for_object_type('category', 'portfolio');
				
			// this ads your post tags to your custom post type
			  // register_taxonomy_for_object_type('post_tag', 'portfolio');
		}
		add_action('init', 'reactor_portfolio_register');
			
		/**
		 * Create portfolio taxonomies
		 * Do not use before init
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
		 * @see register_taxonomy
		 * @since 1.0.0
		 */
		function reactor_portfolio_taxonomies() {
		  // Add new taxonomy, make it hierarchical ( like categories )
			$labels = array( 
				'name' => __('Portfolio Categories', 'reactor'),
				'singular_name'     => __('Portfolio Category', 'reactor'),
				'search_items'      => __('Search Portfolio Categories', 'reactor'),
				'all_items'         => __('All Portfolio Categories', 'reactor'),
				'parent_item'       => __('Parent Portfolio Category', 'reactor'),
				'parent_item_colon' => __('Parent Portfolio Category:', 'reactor'),
				'edit_item'         => __('Edit Portfolio Category', 'reactor'), 
				'update_item'       => __('Update Portfolio Category', 'reactor'),
				'add_new_item'      => __('Add New Portfolio Category', 'reactor'),
				'new_item_name'     => __('New Portfolio Category Name', 'reactor'),
				'menu_name'         => __('Categories', 'reactor'),
			); 	
			
			register_taxonomy('portfolio-category', array('portfolio'), 
			array( 
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
			));
			
			// Add new taxonomy, NOT hierarchical ( like tags )
			$labels = array( 
				'name'                       => __('Portfolio Tags', 'reactor'),
				'singular_name'              => __('Tag', 'reactor'),
				'search_items'               => __('Search Portfolio Tags', 'reactor'),
				'popular_items'              => __('Popular Portfolio Tags', 'reactor'),
				'all_items'                  => __('All Portfolio Tags', 'reactor'),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item'                  => __('Edit Tag', 'reactor'), 
				'update_item'                => __('Update Tag', 'reactor'),
				'add_new_item'               => __('Add New Tag', 'reactor'),
				'new_item_name'              => __('New Tag Name', 'reactor'),
				'separate_items_with_commas' => __('Separate Portfolio Tags with commas', 'reactor'),
				'add_or_remove_items'        => __('Add or remove Portfolio Tags', 'reactor'),
				'choose_from_most_used'      => __('Choose from the most used Portfolio Tags', 'reactor'),
				'menu_name'                  => __('Tags', 'reactor'),
			  ); 
			
			register_taxonomy('portfolio-tag', array('portfolio'), 
			array( 
				'hierarchical'          => false,
				'labels'                => $labels,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var'             => true,
			));
		}
		add_action('init', 'reactor_portfolio_taxonomies', 0);
	}
}