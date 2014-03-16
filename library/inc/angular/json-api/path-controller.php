<?php
/**
 * Created by PhpStorm.
 * User: ROGER
 * Date: 16.03.14
 * Time: 04:10
 */


function add_portfolio_controller($controllers) {
	$controllers[] = 'portfolio';
	return $controllers;
}

add_filter('json_api_controllers', 'add_portfolio_controller');

function set_portfolio_controller_path() {
	return get_template_directory() . "/library/inc/angular/json-api/portfolio.php";
}

add_filter('json_api_portfolio_controller_path', 'set_portfolio_controller_path');