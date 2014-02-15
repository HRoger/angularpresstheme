'use strict';

var angularpressApp = angular.module('angularpressApp',
['ngResource', 'ngRoute', 'ngSanitize', 'jmdobry.angular-cache', 'chieffancypants.loadingBar', 'ngAnimate', 'ui.bootstrap', 'ngCookies']);

angularpressApp.config(['$routeProvider', '$locationProvider', 'cfpLoadingBarProvider', function ($routeProvider, $locationProvider, cfpLoadingBarProvider) {

	cfpLoadingBarProvider.includeSpinner = false;

	$routeProvider.
		when('/', {
			controller: 'PrimaryNavCtrl',
			template  : '<div ng-include="templateUrl"  ng-cloak></div>'
		}).
		when('/:primaryNav/', {
			controller: 'PrimaryNavCtrl',
			template  : '<div ng-include="templateUrl"  ng-cloak></div>'

		}).
		when('/:primaryNav/:secondaryNav/', {
			controller: 'SecondaryNavCtrl',
			template  : '<div ng-include="templateUrl" ng-cloak></div>'

		}).
		otherwise({
			redirectTo: '/404/'
		});

	$locationProvider.html5Mode(true);

}])
;

angularpressApp.run(['$rootScope', '$route', '$angularCacheFactory', '$http', '$log', '$window','$cookies' ,  function ($rootScope, $route, $angularCacheFactory, $http, $log, $window, $cookies) {

	/*$angularCacheFactory('defaultCache', {storageMode: 'localStorage', recycleFreq: 60000, verifyIntegrity: true, capacity: 10  });
	 $http.defaults.cache = $angularCacheFactory.get('defaultCache');*/

	//	$rootScope.$apply(angular.element("content").contents().unwrap());
	//	$rootScope.$apply(angular.element("homenewsloop").contents().unwrap());

	$cookies.is_page_loaded= "pageLoaded";//see page-loading.php

 	angular.element('.fancybox').fancybox({
			openEffect : 'fade',
			closeEffect: 'fade',
			nextEffect : 'none',
			prevEffect : 'none',
			arrows     : 'true'
		});

	$rootScope.$apply(angular.element($window.document).foundation());

	$rootScope.$log = $log;



}]);