/**
 * Created by ROGER on 28.02.14.
 */
'use strict';
angularpressApp.controller("SidebarCtrl", function ($scope, $compile) {

	$scope.$on('ngRepeatFinished', function () {
		//Category
//		angular.element(".widget li a").css('color', 'blue');

		$compile(angular.element(".widget li a, .tagcloud a").bind('click', function () {

			$compile(angular.element(this).filter(function () {
				$scope.$emit('linkText', angular.element(this).text());

			}));

		}))($scope);

	});

});

'use strict';
angularpressApp.controller("SidebarFooterCtrl", function ($scope, $compile) {

	$scope.$on('ngRepeatFinished', function () {
		//Category
//		angular.element(".widget li a,li .tagcloud a").css('color', 'blue');

		$compile(angular.element(".widget li a,.tagcloud a").bind('click', function () {

			$compile(angular.element(this).filter(function () {
				$scope.$emit('linkText', angular.element(this).text());

			}));

		}))($scope);
	});

});

'use strict';
angularpressApp.controller("SidebarFrontpageCtrl", function ($scope, $compile) {

	$scope.$on('ngRepeatFinished', function () {
		//Category
//		angular.element("li.cat-item a").css('color', 'blue');

		$compile(angular.element(".widget li a,.tagcloud a").bind('click', function () {

			$compile(angular.element(this).filter(function () {
				$scope.$emit('linkText', angular.element(this).text());

			}));

		}))($scope);
	});

});


'use strict';
angularpressApp.controller("SinglePostsCtrl", function ($scope, $compile) {

/*
	$scope.$on('ngRepeatFinished', function () {
		//Category
		angular.element("span a").css('color', 'blue');


		$compile(angular.element("span a").bind('click', function () {

			$compile(angular.element(this).filter(function () {
				$scope.$emit('linkText', angular.element(this).text());

			}));

		}))($scope);
	});
*/

});