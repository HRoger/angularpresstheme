<?php
/**
 * Meta Box Fields
 *
 * @author Tammy Hart (@tammyhart / tammyhartdesigns.com)
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


	$prefix = '_sample_';
	
	$layouts = get_theme_support( 'reactor-layouts' );
	$theme_layouts = array();
		
	if ( !is_array( $layouts[0] ) ) {
		$layouts[0] = array();
	}
	if ( in_array( '1c', $layouts[0] ) ) {   $theme_layouts['1c']   = __('One Column', 'reactor'); }
	if ( in_array( '2c-l', $layouts[0] ) ) { $theme_layouts['2c-l'] = __('Two Columns, Left', 'reactor'); }
	if ( in_array( '2c-r', $layouts[0] ) ) { $theme_layouts['2c-r'] = __('Two Columns, Right', 'reactor'); }
	if ( in_array( '3c-l', $layouts[0] ) ) { $theme_layouts['3c-l'] = __('Three Columns, Left', 'reactor'); }
	if ( in_array( '3c-r', $layouts[0] ) ) { $theme_layouts['3c-r'] = __('Three Columns, Right', 'reactor'); }
	if ( in_array( '3c-c', $layouts[0] ) ) { $theme_layouts['3c-c'] = __('Three Columns, Center', 'reactor'); }

/**
 * Variables above this line
 * --------------------------------------------
 */
 
		/**
		 * Field arrays for custom meta boxes
		 * Remember to use an underscore before the id
		 *
		 * @since 1.0.0
		 */
/*		 $sample_fields = array(
			array( // Text Input
				'label'	=> 'Text Input', // <label>
				'desc'	=> 'A description for the field.', // description
				'id'	=> $prefix.'text', // field id and name
				'type'	=> 'text' // type of field
			),
			array( // Textarea
				'label'	=> 'Textarea', // <label>
				'desc'	=> 'A description for the field.', // description
				'id'	=> $prefix.'textarea', // field id and name
				'type'	=> 'textarea' // type of field
			),
			array( // Single checkbox
				'label'	=> 'Checkbox Input', // <label>
				'desc'	=> 'A description for the field.', // description
				'id'	=> $prefix.'checkbox', // field id and name
				'type'	=> 'checkbox' // type of field
			),
			array( // Textarea
				'label'	=> 'Color', // <label>
				'desc'	=> 'A description for the field.', // description
				'id'	=> $prefix.'color', // field id and name
				'type'	=> 'color' // type of field
			),
			array( // Select box
				'label'	=> 'Select Box', // <label>
				'desc'	=> 'A description for the field.', // description
				'id'	=> $prefix.'select', // field id and name
				'type'	=> 'select', // type of field
				'options' => array ( // array of options
					'one'   => 'Option One', 
					'two'   => 'Option Two',
					'three' => 'Option Three',
					)
			),
			array ( // Radio group
				'label'	=> 'Radio Group', // <label>
				'desc'	=> 'A description for the field.', // description
				'id'	=> $prefix.'radio', // field id and name
				'type'	=> 'radio', // type of field
				'options' => array ( // array of options
					'one'   => 'Option One', 
					'two'   => 'Option Two',
					'three' => 'Option Three',
					)
			),
			array ( // Checkbox group
				'label'	=> 'Checkbox Group', // <label>
				'desc'	=> 'A description for the field.', // description
				'id'	=> $prefix.'checkbox_group', // field id and name
				'type'	=> 'checkbox_group', // type of field
				'options' => array ( // array of options
					'one'   => 'Option One', 
					'two'   => 'Option Two',
					'three' => 'Option Three',
					)
			),
			array( // Taxonomy Select box
				'label'	=> 'Category', // <label>
				// the description is created in the callback function with a link to Manage the taxonomy terms
				'id'	   => $prefix.'category', // field id and name, needs to be the exact name of the taxonomy
				'type'	   => 'tax_select', // type of field
				'taxonomy' => 'category', // taxonomy to use for options
			),
			array( // Post ID select box
				'label'     => 'Post List', // <label>
				'desc'	    => 'A description for the field.', // description
				'id'	    =>  $prefix.'post_id', // field id and name
				'type'	    => 'post_select', // type of field
				'post_type' => array('post','page') // post types to display, options are prefixed with their post type
			),
			array( // jQuery UI Date input
				'label'	=> 'Date', // <label>
				'desc'	=> 'A description for the field.', // description
				'id'	=> $prefix.'date', // field id and name
				'type'	=> 'date' // type of field
			),
			array( // jQuery UI Slider
				'label'	=> 'Slider', // <label>
				'desc'	=> 'A description for the field.', // description
				'id'	=> $prefix.'slider', // field id and name
				'type'	=> 'slider', // type of field
				'min'	=> '0', // lowest possible number
				'max'	=> '100', // highest possible number
				'step'	=> '5' // how the slider steps as it is dragged
			),
			array( // Image ID field
				'label'	=> 'Image', // <label>
				'desc'	=> 'A description for the field.', // description
				'id'	=> $prefix.'image', // field id and name
				'type'	=> 'image' // type of field
			),
			array( // Repeatable & Sortable Text inputs
				'label'	=> 'Repeatable', // <label>
				'desc'	=> 'A description for the field.', // description
				'id'	=> $prefix.'repeatable', // field id and name
				'type'	=> 'repeatable', // type of field
				'sanitizer' => array( // array of sanitizers with matching kets to next array
					'featured' => 'meta_box_santitize_boolean',
					'title' => 'sanitize_text_field',
					'desc' => 'wp_kses_data'
				),
				'repeatable_fields' => array ( // array of fields to be repeated
					'featured'  => array(
						'label' => 'Featured?',
						'id'    => 'featured',
						'type'  => 'checkbox'
					),
					array( // Image ID field
						'label'	=> 'Image', // <label>
						'id'	=> 'image', // field id and name
						'type'	=> 'image' // type of field
					),
					'title' => array(
						'label' => 'Title',
						'id' => 'title',
						'type' => 'text'
					),
					'desc' => array(
						'label' => 'Description',
						'id' => 'desc',
						'type' => 'textarea'
					)
				)
			) 
		 );
*/		 
		$slide_fields = array(
		 	array(
				'label'	=> __('URL', 'reactor'),
				'desc'	=> __('A URL for the slide title to direct to (ex. http://awtheme.com)', 'reactor'),
				'id'	=> '_slide_url',
				'type'	=> 'url'
			),
		);
		
		$layout_fields = array(
		 	array(
				'label'	=> __('Select a template layout', 'reactor'),
				'desc'	=> '',
				'id'	=> '_template_layout',
				'type'	=> 'radio',
				'std'   => reactor_option('page_layout', '2c-l'),
				'options' => $theme_layouts,
			),
		);

		
/**
 * Instantiate the class to create a meta box
 *
 * @since 1.0.0
 *
 * var $id string meta box id for saving the database
 * var $title string meta box title displayed with editor
 * var $page string|array The type of Write screen on which to show the edit screen section ('post', 'page', or 'custom_post_type')
 * var $position string The part of the page where the edit screen section should be shown ('normal', 'advanced', or 'side')
 * var $priority string The priority within the context where the boxes should show ('high', 'core', 'default' or 'low')
 * var $fields array meta box fields
 */
//$sample_box = new Custom_Add_Meta_Box( '_sample_box', 'Sample Box', 'post', 'normal', 'high', $sample_fields );
$slide_meta = new Reactor_Add_Meta_Box( 'slide_meta', __('Slide Link', 'reactor'), 'slide', 'normal', 'high', $slide_fields );
$layout_meta = new Reactor_Add_Meta_Box( 'layout_meta', __('Layout', 'reactor'), array('post', 'page', 'portfolio'), 'side', 'default', $layout_fields );

