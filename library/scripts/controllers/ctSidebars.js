/**
 * Created by ROGER on 28.02.14.
 */
'use strict';
angularpressApp.controller("SidebarCtrl", function ($scope, $compile, $location) {

	$scope.$on('ngRepeatFinished', function () {

		//see ctRoute.js MainCtrl. Responsible to send link text value to title
		$compile(angular.element(".widget li a, .tagcloud a").on('click', function () {
			$scope.$emit('linkText', angular.element(this).text());
		}))($scope);

		//Search input widget
		$scope.$watch($compile(angular.element("#searchform", function () {
			$scope.submit = function () {
				if ($scope.text) {
					$location.path("/search/").search({'s': $scope.text});

				}
			}

		}))($scope));

	});

});

'use strict';
angularpressApp.controller("SidebarFooterCtrl", function ($scope, $compile, $location) {

	$scope.$on('ngRepeatFinished', function () {

		//see ctRoute.js MainCtrl. Responsible to send link text value to title
		$compile(angular.element(".widget li a, .tagcloud a").on('click', function () {
			$scope.$emit('linkText', angular.element(this).text());
		}))($scope);

		//Search input widget
		$scope.$watch($compile(angular.element("#searchform", function () {
			$scope.submit = function () {
				if ($scope.text) {
					$location.path("/search/").search({'s': $scope.text});

				}
			}

		}))($scope));
	});

});

'use strict';
angularpressApp.controller("SidebarFrontpageCtrl", function ($scope, $compile, $location) {

	//see ctRoute.js MainCtrl. Responsible to send link text value to title
	$scope.$on('ngRepeatFinished', function () {

		$compile(angular.element(".widget li a, .tagcloud a").on('click', function () {
			$scope.$emit('linkText', angular.element(this).text());
		}))($scope);

		//Search input widget
		$scope.$watch($compile(angular.element("#searchform", function () {
			$scope.submit = function () {
				if ($scope.text) {
					$location.path("/search/").search({'s': $scope.text});

				}
			}

		}))($scope));
	});

});
