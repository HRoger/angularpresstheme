<?php
/**
 * Nav Walkers
 * Customize the menu output for use with Foundation
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @author Ben Word (@retlehs / rootstheme.com (nav.php))
 * @link http://codex.wordpress.org/Function_Reference/Walker_Class
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Top Bar Walker
 *
 * @since 1.0.0
 */
class Top_Bar_Walker extends Walker_Nav_Menu {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 * @param array $args
	 */
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "\n<ul class=\"sub-menu dropdown\">\n";
	}

	/**
	 * @see Walker_Nav_Menu::start_el()
	 * @since 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $object
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array|object $args
	 * @param int $current_object_id
	 * @internal param object $item Menu item data object.
	 */

	function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
		$item_html = '';
		parent::start_el($item_html, $object, $depth, $args);

		$classes = empty($object->classes) ? array() : ( array )$object->classes;
//		FB::info($item_html, '$item_html');
	/*	$output .= ($depth == 0) ? '<li class="divider"></li>' : '';


		$classes[] = 'menu-item-' . $object->ID;
		$classes[] = ($depth == 0) ? 'title' : '';
		$classes[] = (in_array('current-menu-item', $classes) && !in_array('active', $classes)) ? 'active' : '';


		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $object, $args));


		$class_names = $class_names ? 'class="' . esc_attr($class_names) . '"' : '';*/


        //FB::info($object,'$object');

		if (in_array('label', $classes)) {
			$item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html);
		}

		 if (in_array('divider', $classes)) {
			$item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '', $item_html);
		}
//		$indent = ($depth) ? str_repeat("\t", $depth) : '';
//		$output .= $indent . '<li id="menu-item-' . $object->ID . ' " ng-class="$location.path()
//		" ' . $class_names . '>';
         $output .= $item_html;
//		parent::start_el($output, $object, $depth, $args);
//		FB::info($output, ' $output');
	}

	/**
	 * @see Walker::display_element()
	 * @since 1.0.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		$element->has_children = !empty($children_elements[$element->ID]);
//		$element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active
//        ' : '';
		$element->classes[] = ($element->has_children) ? 'has-dropdown' : '';

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

}

/**
 * Nav Bar Walker
 * used for horizontal section main menu
 *
 * @since 1.0.0
 */
class Nav_Bar_Walker extends Walker_Nav_Menu {

	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 * @param array $args
	 */
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= '<div class="content" data-section-content><ul class="side-nav">';
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 * @param array $args
	 */
	function end_lvl(&$output, $depth = 0, $args = array()) {
		// close .side-nav .content and .section
		$output .= '</ul></div></div>';
	}

	/**
	 * @see Walker_Nav_Menu::start_el()
	 * @since 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array|object $args
	 * @param int $id
	 */
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

		$class_names = $value = '';

		$classes = empty($item->classes) ? array() : (array)$item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = ($depth == 0) ? 'title' : '';
		$classes[] = ($args->has_children) ? 'has-dropdown' : '';
		$classes[] = (in_array('current-menu-item', $classes) && !in_array('active', $classes)) ? 'active' : '';


		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = $class_names ? 'class="' . esc_attr($class_names) . '"' : '';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';

		// create sections
		// $section_class = ( $depth == 0 && in_array('active', $classes) ) ? 'section active' : 'section';
		$section_class = 'section';
		$output .= ($depth == 0) ? '<div class="' . $section_class . '">' : '';

		// if top level use p.title else use li in dropdown
		$output .= ($depth == 0) ? '<p data-section-title' . $id . $value . $class_names . '>' : '<li' . $id . $value . $class_names . '>';

		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';

		// if top level and has dropdown do not use url
		if ($depth == 0 && $args->has_children) {
			$attributes .= ' href="#"';
		} // else use url
		elseif (!empty($item->url)) {
			$attributes .= ' href="' . esc_attr($item->url) . '"';
		}

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		// close .section if there is no dropdown
		$item_output .= ($depth == 0 && !$args->has_children) ? '</div>' : '';

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 * @param array $args
	 */
	function end_el(&$output, $item, $depth = 0, $args = array()) {
		if ($depth > 0) {
			$output .= "</li>";
		}
	}

	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		$id_field = $this->db_fields['id'];
		if (is_object($args[0])) {
			$args[0]->has_children = !empty($children_elements[$element->$id_field]);
		}
		$element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active'
			: '';

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

}

/**
 * Vertical Nav Walker
 * used for accordion section side menu
 *
 * @since 1.0.0
 */
class Vertical_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 * @param array $args
	 */
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= '<div class="content" data-section-content><ul class="side-nav">';
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 * @param array $args
	 */
	function end_lvl(&$output, $depth = 0, $args = array()) {
		// close .side-nav .content and .section
		$output .= '</ul></div></div>';
	}

	/**
	 * @see Walker_Nav_Menu::start_el()
	 * @since 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array|object $args
	 * @param int $id
	 */
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

		$class_names = $value = '';

		$classes = empty($item->classes) ? array() : (array)$item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = ($depth == 0) ? 'title' : '';
		$classes[] = ($args->has_children) ? 'has-dropdown' : '';
		$classes[] = (in_array('current-menu-item', $classes) && !in_array('active', $classes)) ? 'active' : '';


		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';

		// create sections
		$section_class = ($depth == 0 && in_array('active ', $classes)) ? 'section active' :
			'section';
		//$section_class = 'section';
		$output .= ($depth == 0) ? '<div class="' . $section_class . '">' : '';

		// if top level use p.title else use li in dropdown
		$output .= ($depth == 0) ? '<p data-section-title' . $id . $value . $class_names . '>' : '<li' . $id . $value . $class_names . '>';

		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';

		// if top level and has dropdown do not use url
		if ($depth == 0 && $args->has_children) {
			$attributes .= ' href="#"';
		} // else use url
		elseif (!empty($item->url)) {
			$attributes .= ' href="' . esc_attr($item->url) . '"';
		}

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		// close .section if there is no dropdown
		$item_output .= ($depth == 0 && !$args->has_children) ? '</div>' : '';

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 * @param array $args
	 */
	function end_el(&$output, $item, $depth = 0, $args = array()) {
		if ($depth > 0) {
			$output .= "</li>";
		}
	}

	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		$id_field = $this->db_fields['id'];
		if (is_object($args[0])) {
			$args[0]->has_children = !empty($children_elements[$element->$id_field]);
		}
		$element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active  '
			: '';

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

}

/**
 * Customize the output of page list for Foundation accordion section
 *
 * @since 1.0.0
 */
class Side_Menu_Walker extends Walker_Page {

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= '<div class="content" data-section-content><ul class="side-nav">';
	}

	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= '</ul></div></div>';
	}

	function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0) {

		extract($args, EXTR_SKIP);
		$classes = array('page_item', 'page-item-' . $page->ID);

		if (!empty($current_page)) {
			$_current_page = get_page($current_page);
		}

		if (isset($_current_page->ancestors) && in_array($page->ID, ( array )$_current_page->ancestors)) {
			$classes[] = 'current_page_ancestor';
		}

		if ($page->ID == $current_page) {
			$classes[] = 'current_page_item active  ';
		} elseif ($_current_page && $page->ID == $_current_page->post_parent) {
			$classes[] = 'current_page_parent';
		} elseif ($page->ID == get_option('page_for_posts')) {
			$classes[] = 'current_page_parent';
		}

		// create sections
		$section_class = ($depth == 0 && in_array('current_page_ancestor', $classes)) ? 'section active  ' : 'section';

		$classes = implode(' ', apply_filters('page_css_class', $classes, $page));

		$output .= ($depth == 0) ? '<div class="' . $section_class . '">' : '';

		$output .= ($depth == 0) ? '<p class="' . $classes . ' title" data-section-title>' : '<li class="' . $classes . '">';
		$output .= '<a href="' . get_page_link($page->ID) . '" title="' . esc_attr(wp_strip_all_tags($page->post_title)) . '">';
		$output .= $args['link_before'] . $page->post_title . $args['link_after'];
		$output .= '</a>';
		$output .= ($depth == 0 && empty($args['has_children'])) ? '</div>' : '';
	}

	function end_el(&$output, $object, $depth = 0, $args = array()) {
		if ($depth > 0) {
			$output .= "</li>";
		}
	}

}
