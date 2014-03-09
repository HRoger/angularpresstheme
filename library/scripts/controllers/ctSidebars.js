/**
 * Created by ROGER on 28.02.14.
 */
'use strict';
angularpressApp.controller("SidebarCtrl", function ($scope, $compile) {

	$scope.$on('ngRepeatFinished', function () {

		//		angular.element(".widget li a, .tagcloud a").css('color', 'blue');

		$compile(angular.element(".widget li a, .tagcloud a").on('click', function () {
			$scope.$emit('linkText', angular.element(this).text());
		}))($scope);

	});

});

'use strict';
angularpressApp.controller("SidebarFooterCtrl", function ($scope, $compile) {

	$scope.$on('ngRepeatFinished', function () {

		//		angular.element(".widget li a,li .tagcloud a").css('color', 'blue');

		$compile(angular.element(".widget li a, .tagcloud a").on('click', function () {
			$scope.$emit('linkText', angular.element(this).text());
		}))($scope);
	});

});

'use strict';
angularpressApp.controller("SidebarFrontpageCtrl", function ($scope, $compile) {

	$scope.$on('ngRepeatFinished', function () {

		//		angular.element("li.cat-item a").css('color', 'blue');

		$compile(angular.element(".widget li a, .tagcloud a").on('click', function () {
			$scope.$emit('linkText', angular.element(this).text());
		}))($scope);
	});

});
