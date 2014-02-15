<?php
/**
 * Translation
 * Reactor is translation ready
 * This will include the appropriate translations
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @author Eddie Machado (@eddiemachado / themeble.com/bones)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_post_type#Example
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Adding Translation Option
 *
 * @since 1.0.0
 */
load_theme_textdomain('reactor', get_template_directory() . '/library/inc/translation');
	$locale = get_locale();
	$locale_file = '/library/inc/translation/' . $locale . '.php';
if ( is_readable( $locale_file ) ) locate_template( $locale_file, true, true );
?>