'use strict';

var angularpressApp = angular.module('angularpressApp',
	['ngResource', 'ngRoute', 'ngSanitize', 'jmdobry.angular-cache', 'chieffancypants.loadingBar', 'ngAnimate', 'ui.bootstrap', 'ngCookies', 'lodash']);

angularpressApp.config(['$routeProvider', '$locationProvider', 'cfpLoadingBarProvider', function ($routeProvider, $locationProvider, cfpLoadingBarProvider) {

	cfpLoadingBarProvider.includeSpinner = false;

	$routeProvider.
		when('/', {
			controller: 'PrimaryNavCtrl',
			template  : '<div ng-include="templateUrl"  ng-cloak>Loading...</div>'
		}).
		when('/:primaryNav/', {
			controller: 'PrimaryNavCtrl',
			template  : '<div ng-include="templateUrl"  ng-cloak>Loading...</div>'

		}).
		when('/:primaryNav/:secondaryNav/', {
			controller: 'SecondaryNavCtrl',
			template  : '<div ng-include="templateUrl" ng-cloak>Loading...</div>'

		}).
		otherwise({
			redirectTo: '/404/'
		});

	$locationProvider.html5Mode(true);

}])
;

angularpressApp.run(['$rootScope', '$route', '$http', '$log', '$window', '$cookies', '$anchorScroll', function ($rootScope, $route, $http, $log, $window, $cookies, $anchorScroll) {

	//	$rootScope.$apply(angular.element("content").contents().unwrap());
	//	$rootScope.$apply(angular.element("homenewsloop").contents().unwrap());

	$rootScope.$on('$routeChangeSuccess', function () {
		$anchorScroll();
	});

	$cookies.is_page_loaded = "pageLoaded";//see page-loading.php


	angular.element('.fancybox').fancybox({
		openEffect : 'elastic',
		closeEffect: 'elastic',
		nextEffect : 'none',
		prevEffect : 'none',
		arrows     : 'true'
	});

	$rootScope.$apply(angular.element($window.document).foundation());

	$rootScope.$log = $log;

}]);