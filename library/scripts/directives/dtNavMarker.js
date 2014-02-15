/**
 * Created by ROGER on 27.01.14.
 */
angularpressApp.directive('menuItem', function (post, wpAjax, $location, $routeParams, $rootScope) {
	//related file: walker.php. menuItem is already add by walker class hence the name
	return{
		restrict: 'C',

		link: function (scope, element, attrs) {

			$rootScope.$on('$routeChangeSuccess', function () {


				angular.element("ul.top-bar-menu li.menu-item a, nav.footer-links ul li.menu-item a").each(function () {
					angular.element(this).parents("li").removeClass('active');
					angular.element(this).css({fontWeight: 'normal'});

					var absUrl = wpAjax.themeLocation.siteUrl + $location.path();
					if (angular.element(this).attr('href') === absUrl) {

						if (angular.element(this).parents("ul.top-bar-menu")) {
							angular.element(this).parents("ul.top-bar-menu li").addClass('active');
						}
						if (angular.element(this).parents("nav.footer-links ul li.menu-item a")) {
							angular.element(this).css({fontWeight: 'bolder'});

						}

					}
				});

			});

			angular.element("ul.top-bar-menu li.menu-item a, nav.footer-links ul li.menu-item a").each(function () {

				var absUrl = wpAjax.themeLocation.siteUrl + $location.path();

				if (angular.element(this).attr('href') === absUrl) {

					if (angular.element(this).parents("ul.top-bar-menu")) {
						angular.element(this).parents("ul.top-bar-menu li").addClass('active');
					}
					if (angular.element(this).parents("nav.footer-links ul li.menu-item a")) {
						angular.element(this).css({fontWeight: 'bolder'});

					}

				}
			});

		}
	}

})
;
