<?php 
/**
 * Reactor Theme Customizer
 * Add settings to the WP Theme Customizer
 * and generates custom CSS/JS from those settings
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @author Samuel Wood (Otto) (@Otto42 / ottopress.com)
 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */
 
/**
 * Add Customizer generated CSS to header
 *
 * @since 1.0.0
 */
function reactor_customizer_css() {
	do_action('reactor_customizer_css');
		
	$output = ''; $body_css = '';
		
	if ( reactor_option('bg_color') ) {
	    $body_css .= 'background-color: ' . reactor_option('bg_color') . ';';
	}
	if ( reactor_option('bg_image') ) {
	    $body_css .= 'background-image: url("' . reactor_option('bg_image') . '");';
	}
	if ( reactor_option('bg_repeat') && reactor_option('bg_repeat') != 'repeat') {
	    $body_css .= 'background-repeat: ' . reactor_option('bg_repeat') . ';';
	}
	if ( reactor_option('bg_position') && reactor_option('bg_position') != 'left top') {
	    $body_css .= 'background-position: ' . reactor_option('bg_position') . ';';
	}
	if ( reactor_option('bg_attachment') && reactor_option('bg_attachment') != 'scroll') {
	    $body_css .= 'background-attachment: ' . reactor_option('bg_attachment') . ';';
	}
	if ( 1 == reactor_option('bg_full_window', 0) ) {
		$body_css .= '-webkit-background-size: cover';
		$body_css .= '-moz-background-size: cover';
		$body_css .= '-o-background-size: cover';
		$body_css .= 'background-size: cover';
	}
	if ( reactor_option('text_color') ) {
	    $body_css .= 'color: ' . reactor_option('text_color') . ';';
	}
	
	if ( !empty( $body_css ) ) {
	    $output .= "\n" . 'body { ' .  $body_css . ' }';
	}
	if ( 0 == reactor_option('show_title', 1) ) {
	    $output .= "\n" . '.site-title, .site-description { display: none; }';
	}
	if ( reactor_option('title_color') ) {
	    $output .= "\n" . 'h1,h2,h3,h4,h5,h6 { color: ' . reactor_option('title_color') . '; }';
	}
	if ( "'Helvetica Neue', Helvetica, Arial, sans-serif" != reactor_option('title_font', "'Helvetica Neue', Helvetica, Arial, sans-serif") ) {
	    $output .= "\n" . 'h1,h2,h3,h4,h5,h6 { font-family: ' . reactor_option('title_font') . '; }';
	}
	if ( "'Helvetica Neue', Helvetica, Arial, sans-serif" != reactor_option('content_font', "'Helvetica Neue', Helvetica, Arial, sans-serif") ) {
	    $output .= "\n" . 'body, p { font-family: ' . reactor_option('content_font') . '; }';
	}
	if ( reactor_option('link_color') ) {
	    $output .= "\n" . '#main a { color: ' . reactor_option('link_color') . '; }';
	}
	if ( reactor_option('link_hover_color') ) {
	    $output .= "\n" . '#main a:hover { color: ' . reactor_option('link_hover_color') . '; }';
	}
	
	echo ( $output ) ? '<style>' . apply_filters('reactor_customizer_css', $output) . "\n" . '</style>' . "\n" : '';
}
add_action('wp_head', 'reactor_customizer_css');

/**
 * Add Fonts
 * Checks font options to see if a Google font is selected.
 * If so, reactor_typography_enqueue_google_font is called to enqueue the font.
 *
 * http://wptheming.com/2012/06/loading-google-fonts-from-theme-options/
 */
 
// standard fonts
if ( !function_exists('reactor_typography_get_os_fonts') ) {
	function reactor_typography_get_os_fonts(){
		
		$os_faces = array(
			"Arial, Helvetica, sans-serif" => "Arial",
			"'Avant Garde', sans-serif" => "Avant Garde",
			"Cambria, Georgia, serif" => "Cambria",
			"Garamond, 'Hoefler Text', 'Times New Roman', Times, serif" => "Garamond",
			"Georgia, serif" => "Georgia",
			"'Helvetica Neue', Helvetica, Arial, sans-serif" => "Helvetica Neue",
			"Tahoma, Geneva, sans-serif" => "Tahoma",
			"'Times New Roman', Times, serif" => "Times New Roman");	
		return $os_faces;
	}
}

// googe fonts
if ( !function_exists('reactor_typography_get_google_fonts') ) {
	function reactor_typography_get_google_fonts(){
	
		$google_faces = array(
			"'Arvo', serif" => "Arvo",
			"'Copse', sans-serif" => "Copse",
			"'Cabin', sans-serif" => "Cabin",
			"'Droid Sans', sans-serif" => "Droid Sans",
			"'Droid Serif', serif" => "Droid Serif",
			"'Josefin Slab', serif" => "Josefin Slab",
			"'Lato', sans-serif" => "Lato",
			"'Lobster', cursive" => "Lobster",
			"'Nobile', sans-serif" => "Nobile",
			"'Open Sans', sans-serif" => "Open Sans",
			"'Oswald', sans-serif" => "Oswald",
			"'Pacifico', cursive" => "Pacifico",
			"'Roboto', sans-serif" => "Roboto",
			"'Rokkitt', serif" => "Rokkit",
			"'PT Sans', sans-serif" => "PT Sans",
			"'Quattrocento', serif" => "Quattrocento",
			"'Raleway', cursive" => "Raleway",
			"'Titillium Web', sans-serif" => "Titillium Web",
			"'Ubuntu', sans-serif" => "Ubuntu",
			"'Vollkorn', serif" => "Vollkorn",
			"'Yanone Kaffeesatz', sans-serif" => "Yanone Kaffeesatz");
		return $google_faces;
	}
}

/**
 * Create an array of fonts to be enqueued
 *
 * @since 1.0.0
 */
function reactor_typography_google_fonts(){
    $all_google_fonts = array_keys( reactor_typography_get_google_fonts() );
    // Get the font face for each option and put it in an array
	$content_font = reactor_option('content_font', "'Helvetica Neue', Helvetica, Arial, sans-serif");
	$title_font = reactor_option('title_font', "'Helvetica Neue', Helvetica, Arial, sans-serif");
    $selected_fonts = array(
        $content_font,
		$title_font );
    // Remove any duplicates in the list
    $selected_fonts = array_unique( $selected_fonts );
    // Check each of the unique fonts against the defined Google fonts
    // If it is a Google font, go ahead and call the function to enqueue it
    foreach ( $selected_fonts as $font ){
        if ( in_array( $font, $all_google_fonts ) ){
            reactor_typography_enqueue_google_font( $font );
        }
    }
}
add_action('wp_enqueue_scripts', 'reactor_typography_google_fonts');

/**
 * Enqueues the Google $font that is passed
 *
 * @since 1.0.0
 */
function reactor_typography_enqueue_google_font( $font ){
	$font = explode( ',', $font );
	$font = $font[0];
	$font = preg_replace( '/[^A-Za-z0-9 ]/', '', $font );
	$font = str_replace( ' ', '+', $font );
	$handle = 'typography-' . $font;
	$src = 'http://fonts.googleapis.com/css?family=' . $font;
	wp_enqueue_style( $handle, $src, false, null, 'all' );
}

/**
 * JavaScript handlers to make Theme Customizer preview reload changes asynchronously.
 * Credit: Twenty Twelve 1.0
 *
 * @since 1.0.0
 */
function reactor_customize_preview_js() {
	wp_enqueue_script('reactor-customizer', get_template_directory_uri() . '/library/inc/customizer/js/theme-customizer.js', array('customize-preview'), '', true );
}
add_action('customize_preview_init', 'reactor_customize_preview_js');

/**
 * Add CSS to the WP Theme Customizer page
 *
 * @since 1.0.0
 */
function reactor_customize_preview_css() {
	echo '
	<style type="text/css">
		.customize-control { margin-bottom:5px; }
		.customize-control-radio { padding:0; }
		.customize-control-checkbox label { line-height:20px; }
	</style>';
}
add_action('customize_controls_print_styles', 'reactor_customize_preview_css', 99);

/**
 * Register Customizer
 *
 * @author Samuel Wood (Otto) (@Otto42 / ottopress.com)
 * @link http://ottopress.com/2012/theme-customizer-part-deux-getting-rid-of-options-pages/
 * @since 1.0.0
 */
if ( !function_exists('reactor_customize_register') ) {
	add_action('customize_register', 'reactor_customize_register');

	function reactor_customize_register( $wp_customize ) {
		
		do_action('reactor_customize_register', $wp_customize);
		
		class WP_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	 
			public function render_content() { ?>
				<label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
                </label>
			<?php
			}
		}
		
		/**
		 * modified dropdown-pages 
		 * from wp-includes/class-wp-customize-control.php
		 *
		 * @since 1.0.0
		 */
		class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-categories';	
		
			public function render_content() {
				$dropdown = wp_dropdown_categories( 
					array( 
						'name'             => '_customize-dropdown-categories-' . $this->id,
						'echo'             => 0,
						'hide_empty'       => false,
						'show_option_none' => '&mdash; ' . __('Select', 'reactor') . ' &mdash;',
						'hide_if_empty'    => false,
						'selected'         => $this->value(),
					 )
				 );
	
				$dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );
	
				printf( 
					'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
					$this->label,
					$dropdown
				 );
			}
		}
		
		/**
		 * modified dropdown-pages 
		 * from wp-includes/class-wp-customize-control.php
		 *
		 * @since 1.0.0
		 */
		class WP_Customize_Dropdown_Slide_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-slide-categories';	
		
			public function render_content() {
				$dropdown = wp_dropdown_categories( 
					array( 
						'name'              => '_customize-dropdown-slide-categories-' . $this->id,
						'echo'              => 0,
						'hide_empty'        => false,
						'show_option_none'  => '&mdash; ' . __('Select', 'reactor') . ' &mdash;',
						'hide_if_empty'     => false,
						'name'              => 'slide-cat',
						'taxonomy'          => 'slide-category',
						'selected'          => $this->value(),
					 )
				 );
	
				$dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );
	
				printf( 
					'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
					$this->label,
					$dropdown
				 );
			}
		}
		
		/**
		 * Remove default WP Customize sections
		 *
		 * @since 1.0.0
		 */
		$wp_customize->remove_section('title_tagline');
		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('header_image');
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('static_front_page');
		$wp_customize->remove_section('nav');
		
		/**
		 * setup customizer settings
		 *
		 * @since 1.0.0
		 */
		 
		// Header
		$wp_customize->add_section('reactor_customizer_general', array( 
			'title'    => __('General', 'reactor'),
			'priority' => 5,
		 ) );

			$wp_customize->add_setting('blogname', array( 
				'default'    => get_option('blogname'),
				'type'       => 'option',
				'capability' => 'manage_options',
				'transport'  => 'postMessage',
			 ) );
				$wp_customize->add_control('blogname', array( 
					'label'    => __('Site Title', 'reactor'),
					'section'  => 'reactor_customizer_general',
					'priority' => 1,
				 ) );

			$wp_customize->add_setting('blogdescription', array( 
				'default'    => get_option('blogdescription'),
				'type'       => 'option',
				'capability' => 'manage_options',
				'transport'  => 'postMessage',
			 ) );
				$wp_customize->add_control('blogdescription', array( 
					'label'    => __('Tagline', 'reactor'),
					'section'  => 'reactor_customizer_general',
					'priority' => 2,
				 ) );

			$wp_customize->add_setting('reactor_options[show_title]', array( 
				'default'    => 1,
				'type'       => 'option',
				'capability' => 'manage_options',
				'transport'  => 'postMessage',
			 ) );	
				$wp_customize->add_control('reactor_options[show_title]', array( 
					'label'    => __('Show Title & Tagline', 'reactor'),
					'section'  => 'reactor_customizer_general',
					'type'     => 'checkbox',
					'priority' => 3,
				 ) );

			$wp_customize->add_setting('reactor_options[logo_image]', array( 
				'default'    => '',
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'reactor_logo_image', array( 
					'label'    => __('Site Logo', 'reactor'),
					'section'  => 'reactor_customizer_general',
					'settings' => 'reactor_options[logo_image]',
					'priority' => 4,
				 ) ) );

			$wp_customize->add_setting('reactor_options[favicon_image]', array( 
				'default'    => '',
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'reactor_favicon_image', array( 
					'label'    => __('Favicon', 'reactor'),
					'section'  => 'reactor_customizer_general',
					'settings' => 'reactor_options[favicon_image]',
					'priority' => 5,
				 ) ) );

			$wp_customize->add_setting('reactor_options[footer_siteinfo]', array( 
				'default'    => '',
				'type'       => 'option',
				'capability' => 'manage_options',
				'transport'  => 'postMessage',
			 ) );
				$wp_customize->add_control( 'reactor_options[footer_siteinfo]', array( 
					'label'    => __('Footer Site Info', 'reactor'),
					'section'  => 'reactor_customizer_general',
					'priority' => 6,
				 ) );

		// Navigation
		$menus = get_theme_support('reactor-menus');
		
		if ( !is_array( $menus[0] ) ) {
			$menus[0] = array();
		}
		
		$wp_customize->add_section('reactor_customizer_nav', array( 
			'title'          => __('Navigation', 'reactor'),
			'priority'       => 10,
			'description'    => '',
			'theme_supports' => 'reactor-menus',
			 ) );
		
		if ( in_array('top-bar-l', $menus[0] ) || in_array('top-bar-r', $menus[0] ) ) {
			$wp_customize->add_setting('reactor_options[topbar_title]', array( 
				'default'        => get_bloginfo('name'),
				'type'           => 'option',
				'capability'     => 'manage_options',
				'transport'      => 'postMessage',
				'theme_supports' => 'reactor-menus',
			 ) );
				$wp_customize->add_control('reactor_options[topbar_title]', array( 
					'label'    => __('Top Bar Title', 'reactor'),
					'section'  => 'reactor_customizer_nav',
					'type'     => 'text',
					'priority' => 1,
				 ) );

			$wp_customize->add_setting('reactor_options[topbar_title_url]', array( 
				'default'        => home_url(),
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-menus',
			 ) );
				$wp_customize->add_control('reactor_options[topbar_title_url]', array( 
					'label'    => __('Top Bar Title Link', 'reactor'),
					'section'  => 'reactor_customizer_nav',
					'type'     => 'text',
					'priority' => 2,
				 ) );				 	

			$wp_customize->add_setting('reactor_options[topbar_fixed]', array( 
				'default'        => 0,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'transport'      => 'postMessage',
				'theme_supports' => 'reactor-menus',
			 ) );
				$wp_customize->add_control('reactor_options[topbar_fixed]', array( 
					'label'    => __('Fixed Top Bar', 'reactor'),
					'section'  => 'reactor_customizer_nav',
					'type'     => 'checkbox',
					'priority' => 3,
				 ) );

			$wp_customize->add_setting('reactor_options[topbar_contain]', array( 
				'default'        => 1,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'transport'      => 'postMessage',
				'theme_supports' => 'reactor-menus',
			 ) );
				$wp_customize->add_control('reactor_options[topbar_contain]', array( 
					'label'    => __('Contain Top Bar Width', 'reactor'),
					'section'  => 'reactor_customizer_nav',
					'type'     => 'checkbox',
					'priority' => 4,
				 ) );
		}
		
		if ( in_array('side-menu', $menus[0] ) ) {
			$wp_customize->add_setting('reactor_options[side_nav_type]', array( 
				'default'        => 'accordion',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-menus',
			 ) );
				$wp_customize->add_control('reactor_options[side_nav_type]', array( 
					'label'   => __('Side Menu Type', 'reactor'),
					'section' => 'reactor_customizer_nav',
					'type'    => 'radio',
					'choices' => array( 
						'accordion' => __('Accordion', 'reactor'),
						'side_nav'  => __('Side Nav', 'reactor'),
					 ),
					 'priority' => 5
				 ) );
		}
		
		if ( in_array('main-menu', $menus[0] ) ) {
			$wp_customize->add_setting('reactor_options[mobile_menu]', array( 
				'default'        => 1,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-menus',
			 ) );
				$wp_customize->add_control('reactor_options[mobile_menu]', array( 
					'label'    => __('Off Canvas Main Menu', 'reactor'),
					'section'  => 'reactor_customizer_nav',
					'type'     => 'checkbox',
					'priority' => 6
				 ) );
		}
		
		// Posts & Pages
		$layouts = get_theme_support('reactor-layouts');
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
		
		$wp_customize->add_section('reactor_customizer_posts', array( 
			'title'    => __('Posts & Pages', 'reactor'),
			'priority' => 20,
		 ) );

			$wp_customize->add_setting('reactor_options[page_layout]', array( 
				'default'    => '2c-l',
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control('reactor_options[page_layout]', array( 
					'label'    => __('Default Layout', 'reactor'),
					'section'  => 'reactor_customizer_posts',
					'type'     => 'select',
					'choices'  => $theme_layouts,
					'priority' => 4,
				 ) );

			$wp_customize->add_setting('reactor_options[page_links]', array( 
				'default'        => 'numbered',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-links',
			 ) );
				$wp_customize->add_control('reactor_options[page_links]', array( 
					'label'    => __('Page Link Type', 'reactor'),
					'section'  => 'reactor_customizer_posts',
					'type'     => 'select',
					'choices'  => array( 
						'numbered'  => __('Numbered', 'reactor'),
						'prev_next' => __('Prev / Next', 'reactor'),
						 ),
					'priority' => 5,
				 ) );	

			$wp_customize->add_setting('reactor_options[post_readmore]', array( 
				'default'    => __('Read More', 'reactor'). '&raquo;',
				'type'       => 'option',
				'capability' => 'manage_options',
				'transport'  => 'postMessage',
			 ) );
				$wp_customize->add_control('reactor_options[post_readmore]', array( 
					'label'    => __('Read More Text', 'reactor'),
					'section'  => 'reactor_customizer_posts',
					'type'     => 'text',
					'priority' => 6,
				 ) );
 		
			$wp_customize->add_setting('reactor_options[post_meta]', array( 
				'default'        => 1,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-post-meta',
			 ) );
				$wp_customize->add_control('reactor_options[post_meta]', array( 
					'label'    => __('Show Post Meta', 'reactor'),
					'section'  => 'reactor_customizer_posts',
					'type'     => 'checkbox',
					'priority' => 7,
				 ) );

			$wp_customize->add_setting('reactor_options[comment_link]', array( 
				'default'    => 1,
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control('reactor_options[comment_link]', array( 
					'label'    => __('Show Comment Link', 'reactor'),
					'section'  => 'reactor_customizer_posts',
					'type'     => 'checkbox',
					'priority' => 8,
				 ) );

			$wp_customize->add_setting('reactor_options[tumblog_icons]', array( 
				'default'        => 0,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-tumblog-icons',
			 ) );
				$wp_customize->add_control('reactor_options[tumblog_icons]', array( 
					'label'    => __('Show Tumblog Icons', 'reactor'),
					'section'  => 'reactor_customizer_posts',
					'type'     => 'checkbox',
					'priority' => 9,
				 ) );
	 
			$wp_customize->add_setting('reactor_options[breadcrumbs]', array( 
				'default'        => 1,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-breadcrumbs',
			 ) );
				$wp_customize->add_control('reactor_options[breadcrumbs]', array( 
					'label'    => __('Show Breadcrumbs', 'reactor'),
					'section'  => 'reactor_customizer_posts',
					'type'     => 'checkbox',
					'priority' => 10,
				 ) );

		// Backgrounds
		$wp_customize->add_section('reactor_customizer_background', array( 
			'title'          => __('Background', 'reactor'),
			'priority'       => 25,
			'theme_supports' => 'reactor-backgrounds',
		 ) );

			$wp_customize->add_setting('reactor_options[bg_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'transport'            => 'postMessage',
				'theme_supports'       => 'reactor-backgrounds',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'reactor_bg_color', array( 
					'label'    => __('Background Color', 'reactor'),
					'section'  => 'reactor_customizer_background',
					'settings' => 'reactor_options[bg_color]',
				 ) ) );

			$wp_customize->add_setting('reactor_options[bg_image]', array( 
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'transport'      => 'postMessage',
				'theme_supports' => 'reactor-backgrounds',
			 ) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'reactor_bg_image', array( 
					'label'    => __('Background Image', 'reactor'),
					'section'  => 'reactor_customizer_background',
					'settings' => 'reactor_options[bg_image]',
				 ) ) );

			$wp_customize->add_setting('reactor_options[bg_repeat]', array( 
				'default'        => 'repeat',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'transport'      => 'postMessage',
				'theme_supports' => 'reactor-backgrounds',
			 ) );
				$wp_customize->add_control('reactor_options[bg_repeat]', array( 
					'label'    => __('Image Repeat', 'reactor'),
					'section'  => 'reactor_customizer_background',
					'type'     => 'select',
					'choices'  => array( 
						'repeat'     => __('Tile', 'reactor'),
						'no-repeat'  => __('No Repeat', 'reactor'),
						'repeat-x'   => __('Tile Horizontally', 'reactor'),
						'repeat-y'   => __('Tile Vertically', 'reactor'),
					 ),
				 ) );

			$wp_customize->add_setting('reactor_options[bg_position]', array( 
				'default'        => 'left top',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'transport'      => 'postMessage',
				'theme_supports' => 'reactor-backgrounds',
			 ) );
				$wp_customize->add_control('reactor_options[bg_position]', array( 
					'label'    => __('Image Position', 'reactor'),
					'section'  => 'reactor_customizer_background',
					'type'     => 'select',
					'choices'  => array( 
						'left top'      => __('Left Top', 'reactor'),
						'left center'   => __('Left Center', 'reactor'),
						'left bottom'   => __('Left Bottom', 'reactor'),
						'right top'     => __('Right Top', 'reactor'),
						'right center'  => __('Right Center', 'reactor'),
						'right bottom'  => __('Right Bottom', 'reactor'),
						'center top'    => __('Center Top', 'reactor'),
						'center center' => __('Center Center', 'reactor'),
						'center bottom' => __('Center Bottom', 'reactor'),
					 ),
				 ) );

			$wp_customize->add_setting('reactor_options[bg_attachment]', array( 
				'default'        => 'scroll',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'transport'      => 'postMessage',
				'theme_supports' => 'reactor-backgrounds',
			 ) );
				$wp_customize->add_control('reactor_options[bg_attachment]', array( 
					'label'    => __('Image Attachment', 'reactor'),
					'section'  => 'reactor_customizer_background',
					'type'     => 'select',
					'choices'  => array( 
						'scroll' => __('Scroll', 'reactor'),
						'fixed'  => __('Fixed', 'reactor'),
					 ),
				 ) );

			$wp_customize->add_setting('reactor_options[bg_full_window]', array( 
				'default'        => 0,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'transport'      => 'postMessage',
				'theme_supports' => 'reactor-backgrounds',
			 ) );
				$wp_customize->add_control('reactor_options[bg_full_window]', array( 
					'label'    => __('Full Window Background', 'reactor'),
					'section'  => 'reactor_customizer_background',
					'type'     => 'checkbox',
				 ) );					 

		// Fonts 
		$font_faces = array_merge(reactor_typography_get_os_fonts() , reactor_typography_get_google_fonts());
		
		$wp_customize->add_section('reactor_customizer_fonts', array( 
			'title'          => __('Fonts & Colors', 'reactor'),
			'priority'       => 30,
			'theme_supports' => 'reactor-fonts',
		 ) );
	
			$wp_customize->add_setting('reactor_options[content_font]', array( 
				'default'        => "'Helvetica Neue', Helvetica, Arial, sans-serif",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-fonts',
			 ) );
				$wp_customize->add_control('reactor_options[content_font]', array( 
					'label'    => __('Content Font', 'reactor'),
					'section'  => 'reactor_customizer_fonts',
					'type'     => 'select',
					'choices'  => $font_faces,
				 ) );

			$wp_customize->add_setting('reactor_options[title_font]', array( 
				'default'        => "'Open Sans', sans-serif",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-fonts',
			 ) );
				$wp_customize->add_control('reactor_options[title_font]', array( 
					'label'    => __('Title Font', 'reactor'),
					'section'  => 'reactor_customizer_fonts',
					'type'     => 'select',
					'choices'  => $font_faces,
				 ) );

			$wp_customize->add_setting('reactor_options[title_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'transport'            => 'postMessage',
				'theme_supports'       => 'reactor-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'reactor_title_color', array( 
					'label'    => __('Title Color', 'reactor'),
					'section'  => 'reactor_customizer_fonts',
					'settings' => 'reactor_options[title_color]',
				 ) ) );

			$wp_customize->add_setting('reactor_options[text_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'transport'            => 'postMessage',
				'theme_supports'       => 'reactor-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'reactor_text_color', array( 
					'label'    => __('Text Color', 'reactor'),
					'section'  => 'reactor_customizer_fonts',
					'settings' => 'reactor_options[text_color]',
				 ) ) );

			$wp_customize->add_setting('reactor_options[link_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'transport'            => 'postMessage',
				'theme_supports'       => 'reactor-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'reactor_link_color', array( 
					'label'    => __('Link Color', 'reactor'),
					'section'  => 'reactor_customizer_fonts',
					'settings' => 'reactor_options[link_color]',
				 ) ) );

			$wp_customize->add_setting('reactor_options[link_hover_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'reactor-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'reactor_link_hover_color', array( 
					'label'    => __('Link Hover Color', 'reactor'),
					'section'  => 'reactor_customizer_fonts',
					'settings' => 'reactor_options[link_hover_color]',
				 ) ) );

		// Login
		$wp_customize->add_section('reactor_customizer_login', array( 
			'title'          => __('Login', 'reactor'),
			'priority'       => 45,
			'theme_supports' => 'reactor-custom-login',
		 ) );

			$wp_customize->add_setting('reactor_options[login_logo]', array( 
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-custom-login',
			 ) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'reactor_login_logo', array( 
					'label'    => __('Login Logo', 'reactor'),
					'section'  => 'reactor_customizer_login',
					'settings' => 'reactor_options[login_logo]',
				 ) ) );
				
			$wp_customize->add_setting('reactor_options[login_logo_url]', array( 
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-custom-login',
			 ) );
				$wp_customize->add_control('reactor_options[login_logo_url]', array( 
					'label'    => __('Logo Link URL', 'reactor'),
					'section'  => 'reactor_customizer_login',
					'type'     => 'text',
				 ) );

			$wp_customize->add_setting('reactor_options[login_logo_title]', array( 
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-custom-login',
			 ) );
				$wp_customize->add_control('reactor_options[login_logo_title]', array( 
					'label'    => __('Logo Title Attribute', 'reactor'),
					'section'  => 'reactor_customizer_login',
					'type'     => 'text',
				 ) );
				 
		
		$templates = get_theme_support('reactor-page-templates');
		
		if ( !is_array( $templates[0] ) ) {
			$templates[0] = array();
		}
		
		// Front Page
		if ( in_array( 'front-page', $templates[0] ) ) {
		$wp_customize->add_section('frontpage_settings', array( 
			'title'          => __('Front Page', 'reactor'),
			'priority'       => 50,
			'theme_supports' => 'reactor-page-templates'
		 ) );
		 
			$wp_customize->add_setting('reactor_options[frontpage_post_category]', array( 
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control( new WP_Customize_Dropdown_Categories_Control( $wp_customize, 'reactor_frontpage_post_category', array( 
					'label'    => __('Post Category', 'reactor'),
					'section'  => 'frontpage_settings',
					'type'     => 'dropdown-categories',
					'settings' => 'reactor_options[frontpage_post_category]',
					'priority' => 1,
				 ) ) );
				 
			$wp_customize->add_setting('reactor_options[frontpage_exclude_cat]', array( 
				'default'        => 1,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[frontpage_exclude_cat]', array( 
					'label'    => __('Exclude From Blog', 'reactor'),
					'section'  => 'frontpage_settings',
					'type'     => 'checkbox',
					'priority' => 2,
				 ) );
			 
			$wp_customize->add_setting('reactor_options[frontpage_slider_category]', array( 
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => array('reactor-page-templates', 'reactor-post-types'),
			 ) );
				$wp_customize->add_control( new WP_Customize_Dropdown_Slide_Categories_Control( $wp_customize, 'reactor_frontpage_slider_category', array( 
					'label'    => __('Slider Category', 'reactor'),
					'section'  => 'frontpage_settings',
					'type'     => 'dropdown-slide-categories',
					'settings' => 'reactor_options[frontpage_slider_category]',
					'priority' => 3,
				 ) ) );
				
			$wp_customize->add_setting('reactor_options[frontpage_post_columns]', array( 
				'default'        => '3',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[frontpage_post_columns]', array( 
					'label'   => __('Post Columns', 'reactor'),
					'section' => 'frontpage_settings',
					'type'    => 'select',
					'choices' => array( 
						'1' => __('1 Column', 'reactor'),
						'2' => __('2 Columns', 'reactor'),
						'3' => __('3 Columns', 'reactor'),
						'4' => __('4 Columns', 'reactor'),
					),
					'priority' => 4,
				 ) );
				 
			$wp_customize->add_setting('reactor_options[frontpage_number_posts]', array( 
				'default'        => 3,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[frontpage_number_posts]', array( 
					'label'    => __('Number of Posts', 'reactor'),
					'section'  => 'frontpage_settings',
					'type'     => 'text',
					'priority' => 6,
				 ) ); 
				
			$wp_customize->add_setting('reactor_options[frontpage_show_titles]', array( 
				'default'        => 1,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[frontpage_show_titles]', array( 
					'label'    => __('Show Post Titles', 'reactor'),
					'section'  => 'frontpage_settings',
					'type'     => 'checkbox',
					'priority' => 7,
				 ) );
				 
			$wp_customize->add_setting('reactor_options[frontpage_link_titles]', array( 
				'default'        => 0,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[frontpage_link_titles]', array( 
					'label'    => __('Link Post Titles', 'reactor'),
					'section'  => 'frontpage_settings',
					'type'     => 'checkbox',
					'priority' => 8,
				 ) );
				 
			$wp_customize->add_setting('reactor_options[frontpage_comment_link]', array( 
				'default'        => 0,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[frontpage_comment_link]', array( 
					'label'    => __('Show Comment Link', 'reactor'),
					'section'  => 'frontpage_settings',
					'type'     => 'checkbox',
					'priority' => 9,
				 ) ); 
				
			$wp_customize->add_setting('reactor_options[frontpage_post_meta]', array( 
				'default'        => 0,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => array('reactor-page-templates', 'reactor-post-meta'),
			 ) );
				$wp_customize->add_control('reactor_options[frontpage_post_meta]', array( 
					'label'    => __('Show Post Meta', 'reactor'),
					'section'  => 'frontpage_settings',
					'type'     => 'checkbox',
					'priority' => 10,
				 ) );
				
			$wp_customize->add_setting('reactor_options[frontpage_page_links]', array( 
				'default'        => 0,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => array('reactor-page-templates', 'reactor-page-links'),
			 ) );
				$wp_customize->add_control('reactor_options[frontpage_page_links]', array( 
					'label'    => __('Show Page Links', 'reactor'),
					'section'  => 'frontpage_settings',
					'type'     => 'checkbox',
					'priority' => 11,
				 ) );
		}
		
		// News Page
		if ( in_array( 'news-page', $templates[0] ) ) {
		$wp_customize->add_section('newspage_settings', array( 
			'title'          => __('News Page', 'reactor'),
			'priority'       => 55,
			'theme_supports' => 'reactor-page-templates'
		 ) );
		 
			$wp_customize->add_setting('reactor_options[newspage_slider_category]', array( 
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => array('reactor-page-templates', 'reactor-post-types'),
			 ) );
				$wp_customize->add_control( new WP_Customize_Dropdown_Slide_Categories_Control( $wp_customize, 'reactor_newspage_slider_category', array( 
					'label'    => __('Slider Category', 'reactor'),
					'section'  => 'newspage_settings',
					'type'     => 'dropdown-slide-categories',
					'settings' => 'reactor_options[newspage_slider_category]',
					'priority' => 1,
				 ) ) );
				 
			$wp_customize->add_setting('reactor_options[newspage_post_columns]', array( 
				'default'        => '2',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[newspage_post_columns]', array( 
					'label'   => __('Post Columns', 'reactor'),
					'section' => 'newspage_settings',
					'type'    => 'select',
					'choices' => array( 
						'1' => __('1 Column', 'reactor'),
						'2' => __('2 Columns', 'reactor'),
						'3' => __('3 Columns', 'reactor'),
					),
					'priority' => 2,
				 ) );	
				 
			$wp_customize->add_setting('reactor_options[newspage_number_posts]', array( 
				'default'        => get_option('posts_per_page'),
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[newspage_number_posts]', array( 
					'label'    => __('Number of Posts', 'reactor'),
					'section'  => 'newspage_settings',
					'type'     => 'text',
					'priority' => 4,
				 ) );	
				
			$wp_customize->add_setting('reactor_options[newspage_post_meta]', array( 
				'default'        => 1,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => array('reactor-page-templates', 'reactor-post-meta'),
			 ) );
				$wp_customize->add_control('reactor_options[newspage_post_meta]', array( 
					'label'    => __('Show Post Meta', 'reactor'),
					'section'  => 'newspage_settings',
					'type'     => 'checkbox',
					'priority' => 5,
				 ) );
				 
			$wp_customize->add_setting('reactor_options[newspage_comment_link]', array( 
				'default'        => 1,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[newspage_comment_link]', array( 
					'label'    => __('Show Comment Link', 'reactor'),
					'section'  => 'newspage_settings',
					'type'     => 'checkbox',
					'priority' => 6,
				 ) );
		}
		
		// Contact Page
		if ( in_array( 'contact', $templates[0] ) ) {
		$wp_customize->add_section('contactpage_settings', array( 
			'title'          => __('Contact Page', 'reactor'),
			'priority'       => 60,
			'theme_supports' => 'reactor-page-templates'
		 ) );
		
			$wp_customize->add_setting('reactor_options[contact_email_to]', array( 
				'default'        => get_option('admin_email'),
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[contact_email_to]', array( 
					'label'    => __('Email Address', 'reactor'),
					'section'  => 'contactpage_settings',
					'type'     => 'text',
					'priority' => 2,
				 ) );
				
			$wp_customize->add_setting('reactor_options[contact_email_subject]', array( 
				'default'        => get_bloginfo('name') . __(' - Contact Form Message', 'reactor'),
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[contact_email_subject]', array( 
					'label'    => __('Email Subject', 'reactor'),
					'section'  => 'contactpage_settings',
					'type'     => 'text',
					'priority' => 3,
				 ) );
				
			$wp_customize->add_setting('reactor_options[contact_email_sent]', array( 
				'default'        => __('Thank you! Your email was sent successfully.', 'reactor'),
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[contact_email_sent]', array( 
					'label'    => __('Send Successful Message', 'reactor'),
					'section'  => 'contactpage_settings',
					'type'     => 'text',
					'priority' => 4,
				 ) );
		}
		
		// Portfolio
		if ( in_array( 'portfolio', $templates[0] ) ) {
		$wp_customize->add_section('portfolio_settings', array( 
			'title'          => __('Portfolio Page', 'reactor'),
			'priority'       => 65,
			'theme_supports' => 'reactor-page-templates'
		 ) );
			
			$wp_customize->add_setting('reactor_options[portfolio_post_columns]', array( 
				'default'        => '4',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[portfolio_post_columns]', array( 
					'label'   => __('Post Columns', 'reactor'),
					'section' => 'portfolio_settings',
					'type'    => 'select',
					'choices' => array( 
						'1' => __('1 Column', 'reactor'),
						'2' => __('2 Columns', 'reactor'),
						'3' => __('3 Columns', 'reactor'),
						'4' => __('4 Columns', 'reactor'),
					),
					'priority' => 2,
				 ) );
				 
			$wp_customize->add_setting('reactor_options[portfolio_number_posts]', array( 
				'default'        => 20,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[portfolio_number_posts]', array( 
					'label'    => __('Number of Posts', 'reactor'),
					'section'  => 'portfolio_settings',
					'type'     => 'text',
					'priority' => 4,
				 ) );
				
			$wp_customize->add_setting('reactor_options[portfolio_filter_type]', array( 
				'default'        => 'jquery',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[portfolio_filter_type]', array( 
					'label'   => __('Filter Type', 'reactor'),
					'section' => 'portfolio_settings',
					'type'    => 'select',
					'choices' => array( 
						'jquery' => __('jQuery Filtering', 'reactor'),
						'pages'  => __('Category Pages', 'reactor'),
						 ),
					'priority' => 5,
				 ) );
				
			$wp_customize->add_setting('reactor_options[portfolio_show_titles]', array( 
				'default'        => 1,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[portfolio_show_titles]', array( 
					'label'    => __('Show Titles', 'reactor'),
					'section'  => 'portfolio_settings',
					'type'     => 'checkbox',
					'priority' => 6,
				 ) );
				 
			$wp_customize->add_setting('reactor_options[portfolio_link_titles]', array( 
				'default'        => 1,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'reactor-page-templates'
			 ) );
				$wp_customize->add_control('reactor_options[portfolio_link_titles]', array( 
					'label'    => __('Link Titles', 'reactor'),
					'section'  => 'portfolio_settings',
					'type'     => 'checkbox',
					'priority' => 7,
				 ) );	
				
			$wp_customize->add_setting('reactor_options[portfolio_post_meta]', array( 
				'default'        => 0,
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => array('reactor-page-templates', 'reactor-post-meta'),
			 ) );
				$wp_customize->add_control('reactor_options[portfolio_post_meta]', array( 
					'label'    => __('Show Meta', 'reactor'),
					'section'  => 'portfolio_settings',
					'type'     => 'checkbox',
					'priority' => 8,
				 ) );
		}
		
	}
}
?>
