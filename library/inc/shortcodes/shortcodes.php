<?php
/**
 * Reactor Shortcodes
 * lots of Foundation elements in shortcode form
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Table of Contents
 *
 * 1. Alerts
 * 2. Buttons
 * 3. Columns
 * 4. Flex Video
 * 5. Gallery ( custom WP shortcode )
 * 6. Glyph Icons
 * 7. Labels
 * 8. Panels
 * 9. Price Tables
 * 10. Price Table Items
 * 11. Progress Bars
 * 12. Reveal Modals
 * 13. Section Groups
 * 14. Sections
 * 15. Slider
 * 16. Tooltips
 */

/**
 * 1. Alerts
 *
 * @since 1.0.0
 */
function reactor_add_alerts( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'type'  => '',     // standard, success, alert, secondary
		'shape' => '',     // radius, round
		'close' => 'true', // add X to close alert
		'class' => ''
	 ), $atts ) );
	 
	$class_array[] = ( $shape ) ? $shape : '';
	$class_array[] = ( $type ) ? $type : '';
	$class_array[] = ( $class ) ? $class : '';
	$class_array[] = ( $class ) ? $class : '';
	$class_array = array_filter( $class_array );
	$classes = implode( ' ', $class_array );
	 
	$output  = '<div class="alert-box ' . $classes . '">';
	$output .= do_shortcode( $content );
	$output .= ( 'false' != $close ) ? '<a     class="close" href="">&times;</a>' : '';
	$output .= '</div>';
		
	return $output;
}

/** 
 * 2. Buttons
 *
 * @since 1.0.0
 */
function reactor_add_buttons( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'url'     => '#',      // target for the button
		'size'     => 'medium', // tiny, small, medium, large
		'shape'    => '',       // radius, round
		'type'     => '',       // standard, success, alert, secondary
		'disabled' => 'false',
		'expand'   => 'false',
		'class'    => '',       // optional CSS class
		'target'   => '',
	 ), $atts ) );
	
	$class_array = array();
	$class_array[] = ( $size ) ? $size : '';
	$class_array[] = ( $shape ) ? $shape : '';
	$class_array[] = ( $type ) ? $type : '';
	$class_array[] = ( $class ) ? $class : '';
	$class_array[] = ( 'true' == $disabled ) ? 'disabled' : '';
	$class_array[] = ( 'true' == $expand ) ? 'expand' : '';
	$class_array = array_filter( $class_array );
	$classes = implode( ' ', $class_array );
	
	$target = ( $target ) ? ' target="' . $target . '"' : '';
	
	$output  = '<a class="' . $classes . ' button" href="' . $url . '"' . $target .'>';
	$output .= $content;
	$output .= '</a>';
		
	return $output;
}

/**
 * 3. Columns
 *
 * @since 1.0.0
 */
function reactor_add_columns( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'first_last' => '', // first or last
		'large' => '',
		'small' => ''
		 ), $atts ) );
	 
	switch( $large ) {
		case '12'   : $large = 'large-12'; break;
		case '11'   : $large = 'large-11'; break;
		case '10'   : $large = 'large-10'; break;
		case '9'    : $large = 'large-9'; break;
		case '8'    : $large = 'large-8'; break;
		case '7'    : $large = 'large-7'; break;
		case '6'    : $large = 'large-6'; break;
		case '5'    : $large = 'large-5'; break;
		case '4'    : $large = 'large-4'; break;
		case '3'    : $large = 'large-3'; break;
		case '2'    : $large = 'large-2'; break;
		case '1'    : $large = 'large-1'; break;
	}
	
	switch( $small ) {
		case '12'   : $small = ' small-12'; break;
		case '11'   : $small = ' small-11'; break;
		case '10'   : $small = ' small-10'; break;
		case '9'    : $small = ' small-9'; break;
		case '8'    : $small = ' small-8'; break;
		case '7'    : $small = ' small-7'; break;
		case '6'    : $small = ' small-6'; break;
		case '5'    : $small = ' small-5'; break;
		case '4'    : $small = ' small-4'; break;
		case '3'    : $small = ' small-3'; break;
		case '2'    : $small = ' small-2'; break;
		case '1'    : $small = ' small-1'; break;
	}
	
	$output  = '';
	$output .= ( $first_last == 'first' || $first_last == 'both') ? '<div class="row">' : '';
	$output .= '<div class="' . $large . $small . ' columns">';
	$output .= do_shortcode( $content );
	$output .= '</div>';
	$output .= ( $first_last == 'last' || $first_last == 'both' ) ? '</div>' : '';
		
	return $output;
}

/**
 * 4. Flex Videos
 *
 * @since 1.0.0
 */
function reactor_add_flex_video( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'widescreen' => 'true',
		'vimeo'      => 'false'
	 ), $atts ) );
	
	$class_array = array();
	$class_array[] = ( $widescreen == 'true' ) ? 'widescreen' : '';
	$class_array[] = ( $vimeo == 'true' ) ? 'vimeo' : '';
	$class_array = array_filter( $class_array );
	$classes = implode( ' ', $class_array );	
	
	$output  = '<div class="flex-video ' . $classes . '">';
	$output .= $content;
	$output .= '</div>';
		
	return $output;
}

/**
 * 5. Gallery
 * customized WP shortcode (from wp-includes/media.php)
 *
 * @since 1.0.0
 */
remove_shortcode('gallery');
function reactor_add_custom_gallery( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( !empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters( 'post_gallery', '', $attr );
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract( shortcode_atts( array( 
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'ul',
		'icontag'    => 'li',
		'captiontag' => 'li',
		'columns'    => 4,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	 ), $attr ) );

	$id = intval( $id );
	if ('RAND' == $order )
		$orderby = 'none';

	if ( !empty( $include ) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	}elseif ( !empty( $exclude ) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
	}else{
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
	}

	if ( empty( $attachments ) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
		return $output;
	}

	$itemtag = tag_escape( $itemtag );
	$captiontag = tag_escape( $captiontag );
	$columns = intval( $columns );
	$itemwidth = $columns > 0 ? floor( 100/$columns ) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters('gallery_style', $gallery_div );

	$i = 0;
	$grid = $columns;
	$clearing = ( isset( $attr['link'] ) && 'file' == $attr['link'] ) ? 'data-clearing' : '';
	
	$output .= "<{$itemtag} class='large-block-grid-{$grid} small-block-grid-2 gallery-item clearing-thumbs' {$clearing}>";
	
	foreach ( $attachments as $id => $attachment ) {
		$link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );
		
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim( $attachment->post_excerpt ) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				".wptexturize( $attachment->post_excerpt )."
				</{$captiontag}>";
		}
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "</{$itemtag}>";
	$output .= "</div>\n";

	return $output;
}

/**
 * 6. Glyph Icons
 *
 * @link http://www.zurb.com/playground/foundation-icons
 * @since 1.0.0
 */
function reactor_add_glyph_icons( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'type'    => 'general', // general, enclosed, social, accessible
		'icon'    => 'star',
		'class'   => '',
		'style'   => '',
	 ), $atts ) );
	
	$class_array = array();
	$class_array[] = ( $type ) ? $type : '';
	$class_array[] = ( $icon ) ? 'fi-' . $icon : '';
	$class_array[] = ( $class ) ? $class : '';
	$class_array = array_filter( $class_array );
	$classes = implode( ' ', $class_array );
	
	$style = ( $style ) ? ' style="' . $style . '"' : '';
		
	$output  = '<i class="' . $classes . '"' . $style . '>';
	$output .= do_shortcode( $content );
	$output .= '</i>';
		
	return $output;
}

/**
 * 7. Labels
 *
 * @since 1.0.0
 */
function reactor_add_labels( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'type'  => '', // standard, success, alert, secondary
		'shape' => '', // radius, round
		'class' => ''
	 ), $atts ) );
	 
	$class_array[] = ( $shape ) ? $shape : '';
	$class_array[] = ( $type ) ? $type : '';
	$class_array[] = ( $class ) ? $class : '';
	$class_array = array_filter( $class_array );
	$classes = implode( ' ', $class_array );	
	
	$output  = '<span class="' . $classes . ' label">';
	$output .= do_shortcode( $content );
	$output .= '</span>';
		
	return $output;
}

/**
 * 8. Panels
 *
 * @since 1.0.0
 */
function reactor_add_panels( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'shape'   => '',      // square, radius
		'callout' => 'false', // true for a brighter panel
		'class'   => ''
		 ), $atts ) );
		
	$class_array = array();
	$class_array[] = ( $shape ) ? $shape : '';
	$class_array[] = ( $callout == 'true') ? 'callout' : '';
	$class_array[] = ( $class ) ? $class : '';
	$class_array = array_filter( $class_array );
	$classes = implode( ' ', $class_array );	

	$output  = '<div class="' . $classes . ' panel">';
	$output .= do_shortcode( $content );
	$output .= '</div>';
		
	return $output;	
}

/**
 * 9. Price Tables
 *
 * @since 1.0.0
 */
function reactor_add_price_tables( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'title' => 'Title',
		'price' => '0.00',
		'desc'  => '',
		'url'   => '#',
		'button' => 'Buy Now'
	 ), $atts ) );
	 
	$output  = '<ul class="pricing-table">';
	$output .= '<li class="title">' . $title . '</li>';
	$output .= '<li class="price">' . $price . '</li>';
	$output .= ( $desc ) ? '<li class="description">' . $desc . '</li>' : '';
	$output .= do_shortcode( $content );
	$output .= '<li class="cta-button"><a class="button" href="' . $url . '">' . $button . '</a></li>';
	$output .= '</ul>';
		
	return $output;
}

/**
 * 10. Price Table Items
 *
 * @since 1.0.0
 */
function reactor_add_pt_items( $atts, $content = null ) {
	extract( shortcode_atts( array( 
	 ), $atts ) );
	 
	$output  = '<li class="bullet-item">';
	$output .= do_shortcode( $content );
	$output .= '</li>';
		
	return $output;
}

/**
 * 11. Progress Bars
 *
 * @since 1.0.0
 */
function reactor_add_progress_bars( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'shape'   => '', // square, radius, round
		'type'    => '', // standard, success, alert, secondary
		'columns' => '', // number of grid columns for overall length
		'fill'    => ''  // width of the fill meter in percent
	 ), $atts ) );
	
	$class_array = array();
	$class_array[] = ( $shape ) ? $shape : '';
	$class_array[] = ( $type ) ? $type : '';
	$class_array[] = ( $columns ) ? 'large-' . $columns : '';
	$class_array = array_filter( $class_array );
	$classes = implode( ' ', $class_array );
	
	$output  = '<div class="progress ' . $classes . '">';
	$output .= '<span class="meter" style="width:' . $fill . '">';
	$output .= do_shortcode( $content );
	$output .= '</span>';
	$output .= '</div>';
		
	return $output;
}

/**
 * 12. Reveal Modals
 *
 * @since 1.0.0
 */
function reactor_add_reveal_modals( $atts, $content = null ) {
	global $post;
	extract( shortcode_atts( array( 
		'button'         => 'false', // whether or not the link is a button
		'text'           => 'Click here', // text for link or button
		'size'           => '' // tiny, small, medium, large, xlarge
		 ), $atts ) );
		
	$unique_id = $post->ID . '-' . rand( 1000, 9999 );
	$class = ( $button == 'true') ? 'class="button"' : '';
	$output  = '<a href="#" ' . $class . ' data-reveal-id="' . $unique_id . '">' . $text . '</a>';
        
	$reveal_output  = '<div data-reveal id="' . $unique_id . '" class="reveal-modal ' . $size . ' shortcode-modal">';
	$reveal_output .= do_shortcode( $content );
	$reveal_output .= '<a class="close-reveal-modal">&#215;</a>';
	$reveal_output .= '</div>';

	$GLOBALS['reveal_content'][] = $reveal_output;
		
	return $output;
}

add_action('wp_footer', 'reveal_footer_content');
function reveal_footer_content() {
    if ( !empty( $GLOBALS['reveal_content'] ) ) {
        echo "\n".'<!-- [reveal_modal] shortcode output -->';
       
	    foreach ( $GLOBALS['reveal_content'] as $output ) {
            echo "\n" . $output;
        }
       
	    echo "\n" . '<!-- / end [reveal_modal] output -->' . "\n";
    }
}

/**
 * 13. Section Groups
 *
 * @link http://michaelwender.com/blog/2010/11/01/creating-wordpress-shortcodes-for-jquery-tools-tabs/
 * @since 1.0.0
 */
function reactor_add_section_groups( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'type' => 'tabs', // tabs, accordion, veritcal-nav, horizontal-nav
		'options' => ''
		 ), $atts ) );
	
	$GLOBALS['tab_count'] = 1;
	$GLOBALS['tabs'] = '';
	$output = ''; $count = 1;
	
	$type = ( 'vertical' == $type ) ? 'vertical-nav' : $type;
	$data_options = ( $options ) ? ' data-options="' . $options . '"' : '';
	
	do_shortcode( $content );

	if ( is_array( $GLOBALS['tabs'] ) ) {
		foreach ( $GLOBALS['tabs'] as $tab ) {
			$tabs[] = '<div  class="section' . $tab['active'] .'">
			<p class="title' . $tab['active'] . '"><a class="" href="#panel' . $count . '">' . $tab['title'] . '</a></p>
			<div class="content" data-slug="panel' . $count . '">' . $tab['content'] . '</div>
			</div>';
			$count++;
		}
		$output .= '<div data-section class="section-container ' . $type . '" data-section="' . $type . '"' . $data_options . '>';
		$output .= implode( "\n", $tabs );
		$output .= '</div>';
	}
	return $output;
}


/**
 * 14. Sections
 *
 * @since 1.0.0
 */
function reactor_add_sections( $atts, $content = null ) {
extract( shortcode_atts( array( 
	'active' => 'false',
	'title'  => 'Section %d'
	 ), $atts ) );
	 
	$active = ( $active == 'true' ) ? ' active' : '';
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array('active' => $active, 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content);
	$GLOBALS['tab_count']++;
}

/**
 * 15. Slider
 *
 * @since 1.0.0
 */
function reactor_add_orbit_slider( $atts, $content = null ) {
	extract( shortcode_atts( array( 
			'orderby'  => 'date',
			'order'    => 'DESC',
			'category' => '',
			'field'    => 'id',
			'slides'   => -1,
			'id'       => '',
		 ), $atts ) );
		
	$args = array(
		'orderby'        => $orderby,
		'order'          => $order,
		'category'       => $category,
		'field'          => $field,
		'posts_per_page' => $slides,
		'slider_id'      => $id,
		'echo'           => false
	);
		 
	$output = reactor_slider( $args );
	
	return $output;
}

/**
 * 16. Tooltips
 *
 * @since 1.0.0
 */
function reactor_add_tooltips( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'position' => '', // bottom ( deftault ), top, right, left
		'width'    => '', // set the width
		'class'    => '',
		'text'     => 'Add some tooltip text'// add text to the tooltip
	 ), $atts ) );
	
	$class_array = array();
	$class_array[] = ( $position ) ? 'tip-' . $position : '';
	$class_array[] = ( $class ) ? $class : '';
	$class_array = array_filter( $class_array );
	$classes = implode( ' ', $class_array );
	
	$output  = '<span data-tooltip class="has-tip ' . $classes . '"';
	if ( $width ) {$output .= ' data-width="' . $width . '"';}
	$output .= 'title="' . $text . '">';
	$output .= do_shortcode( $content );
	$output .= '</span>';
		
	return $output;
}

function register_shortcodes() {
   add_shortcode('alert', 'reactor_add_alerts');
   add_shortcode('button', 'reactor_add_buttons');
   add_shortcode('column', 'reactor_add_columns');
   add_shortcode('flex_video', 'reactor_add_flex_video');
   add_shortcode('gallery', 'reactor_add_custom_gallery');
   add_shortcode('glyph_icon', 'reactor_add_glyph_icons');
   add_shortcode('label', 'reactor_add_labels');
   add_shortcode('panel', 'reactor_add_panels');
   add_shortcode('price_table', 'reactor_add_price_tables');
	add_shortcode('pt_item', 'reactor_add_pt_items');
   add_shortcode('progress_bar', 'reactor_add_progress_bars');
   add_shortcode('reveal_modal', 'reactor_add_reveal_modals');
   add_shortcode('section_group', 'reactor_add_section_groups');
	add_shortcode('section', 'reactor_add_sections');
   add_shortcode('orbit_slider', 'reactor_add_orbit_slider');
   add_shortcode('tooltip', 'reactor_add_tooltips');
}
add_action('init', 'register_shortcodes');

/**
 * Remove br and p tags around shorcodes
 *
 * @link http://www.wpexplorer.com/snippet/clean-wordpress-shortcodes
 * @since 1.0.0
 */
if ( !function_exists('reactor_clean_shortcodes') ) {
	function reactor_clean_shortcodes( $content ) {   
		$array = array ( 
			'<p>['    => '[', 
			']</p>'   => ']', 
			']<br />' => ']'
		);
		$content = strtr( $content, $array );
		return $content;
	}
	add_filter('the_content', 'reactor_clean_shortcodes');
}
