/**
 * Created by ROGER on 03.03.14.
 */
'use strict';
angularpressApp.filter('convertToMonthYear', function ($route) {

	//noinspection FunctionWithInconsistentReturnsJS
	return function (input) {

		if (input != undefined) {

			return input.slice(0, input.indexOf(",") - 2) + ' ' + $route.current.params.primaryNav;

		}

	};
});