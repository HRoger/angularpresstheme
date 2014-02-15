<?php
/**
 * Reactor Shortcodes Class
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @author ThemeZilla (@themezilla / themezilla.com)
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

class ReactorShortcodes {

    function __construct() 
    {	
    	require_once( get_template_directory() . '/library/inc/shortcodes/shortcodes.php' );
    	define('REACTOR_TINYMCE_URI', get_template_directory_uri() . '/library/inc/shortcodes/tinymce');
		define('REACTOR_TINYMCE_DIR', get_template_directory() . '/library/inc/shortcodes/tinymce');
		
        add_action('init', array(&$this, 'init'));
        add_action('admin_init', array(&$this, 'admin_init'));
		add_filter('mce_external_languages', array(&$this, 'add_tinymce_lang'), 10, 1);
	}

	function add_tinymce_lang( $arr )
	{
		$arr[] = REACTOR_TINYMCE_DIR . '/langs/wp-lang.php';
		return $arr;
	}
		
	/**
	 * Registers TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function init()
	{
		if( is_admin() )
		{
			wp_enqueue_script( 'jquery-ui-accordion' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'reactor-shortcodes-lib', get_template_directory_uri() . '/library/inc/shortcodes/js/reactor-shortcodes-lib.js', array('jquery', 'jquery-ui-accordion', 'jquery-ui-tabs') );
		}
		
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	
		if ( get_user_option('rich_editing') == 'true' )
		{
			add_filter( 'mce_external_languages', array(&$this, 'wpse_44785_add_tinymce_lang'), 10, 1 );
			add_filter( 'mce_external_plugins', array(&$this, 'add_rich_plugins') );
			add_filter( 'mce_buttons', array(&$this, 'register_rich_buttons') );
		}
	}
	
	// --------------------------------------------------------------------------

	function wpse_44785_add_tinymce_lang( $arr )
	{
		$arr[] = REACTOR_TINYMCE_URI . '/langs/wp-langs.php';
		return $arr;
	}
	
	/**
	 * Defins TinyMCE rich editor js plugin
	 *
	 * @return	void
	 */
	function add_rich_plugins( $plugin_array )
	{
		$plugin_array['reactorShortcodes'] = REACTOR_TINYMCE_URI . '/plugin.js';
		return $plugin_array;
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Adds TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function register_rich_buttons( $buttons )
	{
		array_push( $buttons, "|", 'reactor_button' );
		return $buttons;
	}
	
	/**
	 * Enqueue Scripts and Styles
	 *
	 * @return	void
	 */
	function admin_init()
	{
		// css
		wp_enqueue_style( 'reactor-popup', REACTOR_TINYMCE_URI . '/css/popup.css', false, '1.0', 'all' );
		
		// js
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-livequery', REACTOR_TINYMCE_URI . '/js/jquery.livequery.js', false, '1.1.1', false );
		wp_enqueue_script( 'jquery-appendo', REACTOR_TINYMCE_URI . '/js/jquery.appendo.js', false, '1.0', false );
		wp_enqueue_script( 'reactor-popup', REACTOR_TINYMCE_URI . '/js/popup.js', false, '1.0', false );
		
		wp_localize_script( 'jquery', 'ReactorShortcodes', array('theme_folder' => get_template_directory_uri() . '/library/inc/shortcodes') );
	}
    
}

$reactor_shortcodes = new ReactorShortcodes();

?>