/**
 * Created by ROGER on 28.02.14.
 */
'use strict';
angularpressApp.controller("SidebarCtrl", function ($scope, $compile) {

	$scope.$on('ngRepeatFinished', function () {

		//see ctRoute.js MainCtrl. Responsible to send link text value to title
		$compile(angular.element(".widget li a, .tagcloud a").on('click', function () {
			$scope.$emit('linkText', angular.element(this).text());
		}))($scope);

		$scope.test = function (data) {

			console.info(data);

		}

	});

});

'use strict';
angularpressApp.controller("SidebarFooterCtrl", function ($scope, $compile) {

	$scope.$on('ngRepeatFinished', function () {

		//see ctRoute.js MainCtrl. Responsible to send link text value to title
		$compile(angular.element(".widget li a, .tagcloud a").on('click', function () {
			$scope.$emit('linkText', angular.element(this).text());
		}))($scope);
	});

});

'use strict';
angularpressApp.controller("SidebarFrontpageCtrl", function ($scope, $compile) {

	//see ctRoute.js MainCtrl. Responsible to send link text value to title
	$scope.$on('ngRepeatFinished', function () {

		$compile(angular.element(".widget li a, .tagcloud a").on('click', function () {
			$scope.$emit('linkText', angular.element(this).text());
		}))($scope);
	});

});
