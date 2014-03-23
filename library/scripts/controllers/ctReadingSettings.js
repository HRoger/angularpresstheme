/**
 * Created by ROGER on 29.12.13.
 */
'use strict';
angularpressApp.controller("angpReadingSettingsCtrl", function ($scope, $rootScope, $location, wpAjax) {
	$scope.is_home_visible = false;//newsloop
	$scope.is_include_visible = false;

	$rootScope.$on("$routeChangeStart", function () {

		if ($location.path() === '/' && angular.element('body').hasClass('page_for_posts')) {

			if (wpAjax.readingSettings.page_for_posts !== 0) {//reading settings frontpage
				$scope.is_home_visible = true;
				$scope.is_include_visible = true;
			}

		} else {
			$scope.is_include_visible = true;
		}
		if ($location.path() !== '/') {//when start loading page from /
			$scope.is_home_visible = false;
			$scope.is_include_visible = false;
			$scope.is_footer_hidden = true;
		}
	});
});