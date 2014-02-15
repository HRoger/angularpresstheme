/**
 * Created by ROGER on 15.01.14.
 */
'use strict';
angularpressApp.directive('displayFooter', function ($location, $rootScope, wpAjax) {

	return{
		restrict: 'A',
		link    : function () {

			var styles = {
				display: "none"

			};
			angular.element('.angp-footer').css(styles);

			$rootScope.$on("$routeChangeStart", function () {

				if ($location.path() !== '/' && wpAjax.readingSettings.page_for_posts !== 0) {

					var styles = {
						display: "block"
					}

				} else {

					styles = {
						display: "none"
					}

				}
				angular.element('.angp-footer').css(styles);

			});
		}
	};
});

