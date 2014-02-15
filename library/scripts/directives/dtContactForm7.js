/**
 * Created by ROGER on 28.01.14.
 */
'use strict';
angularpressApp.directive('wpcf7', function () {
	return{
		restrict: 'C',
		link    : function (scope, element) {

			element.wpcf7();

			angular.element('.wpcf7-submit').bind('click', function () {

				if (angular.element('.ajax-loader').length > 1) {

					angular.element('.ajax-loader').next().css({display: 'none'});
				}
			})
		}
	};
});