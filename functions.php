<?php
/**
 * Reactor Theme Functions
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.1.0
 * @copyright Copyright (c) 2013, Anthony Wilhelm
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */
/** @noinspection PhpIncludeInspection */
require locate_template('/library/reactor.php');
/** @noinspection PhpIncludeInspection */
require locate_template('/library/angularpress.php');
new Angularpress();

function add_portfolio_controller($controllers) {
	$controllers[] = 'portfolio';
	return $controllers;
}
add_filter('json_api_controllers', 'add_portfolio_controller');

//FB::info(get_template_directory(),'gettemplate');
function set_portfolio_controller_path() {
	return  get_template_directory()."/library/inc/angular/json-api/portfolio.php";
}
add_filter('json_api_portfolio_controller_path', 'set_portfolio_controller_path');