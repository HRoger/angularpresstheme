/**
 * Created by ROGER on 06.03.14.
 */
'use strict';
angularpressApp.controller('BreadcrumbsCtrl', function ($scope, $route, $location) {

		if (!angular.element('body').hasClass('wp-admin')) {
			$scope.isActive = function (route) {
				return route === $location.path();
			}

		}
	}
);