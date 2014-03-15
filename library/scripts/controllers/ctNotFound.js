/**
 * Created by ROGER on 11.03.14.
 */
'use strict';
angularpressApp.controller("NotFoundCtrl", function ($scope, $compile, $location) {

	//Search input widget
	$scope.$watch($compile(angular.element("#searchform", function () {
		$scope.submit = function () {
			if ($scope.text) {
				$location.path("/search/").search({'s': $scope.text});

			}
		}

	}))($scope));
});
