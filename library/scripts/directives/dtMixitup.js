/**
 * Created by ROGER on 23.11.13.
 */
'use strict';
angularpressApp.directive('mixitup', function () {
	return{
		restrict: 'A',

		link: function (scope, element) {
			return    element.mixitup(
				{
				transitionSpeed: 600
				}
			);
		}
	};

});

