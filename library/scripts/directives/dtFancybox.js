/**
 * Created by ROGER on 28.01.14.
 */
'use strict';
angularpressApp.directive('fancybox', function () {
	return{
		restrict: 'C',
		link    : function (scope, element) {

			 element.fancybox();


		}
	};
});
