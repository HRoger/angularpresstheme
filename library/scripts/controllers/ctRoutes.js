'use strict';
angularpressApp.controller('MainCtrl', function ($scope, $route, $routeParams, $location, $compile, $element, $window, wpAjax) {

	if (!angular.element('body').hasClass('wp-admin')) {

		if (wpAjax.sessions.on_first_page_load !== null && $location.path() !== '/') {
			//when page other than front-page loads for the first time
			$window.location.href = wpAjax.themeLocation.siteUrl + $location.url();

		}
		/** @namespace $routeParams.primaryNav */
		$scope.title = wpAjax.themeLocation.page_title;

		$scope.$on('$routeChangeStart', function () {

			$scope.$on('linkText', function (event, data) {
				$scope.title = data;
			});
			angular.element(document).ready(function () {
				$scope.onPageFullyLoaded = true;
			});
		});
		$scope.$on('$viewContentLoaded', function () {

			$scope.$on('linkText', function (event, data) {
				$scope.title = data;
			});

			angular.element(document).ready(function () {
				$scope.onPageFullyLoaded = true;
			});
		});

		$compile(angular.element("a").bind('click', function (event, data) {

			$compile(angular.element(this).filter(function () {

				$scope.title = angular.element(this).text();

			}));

		}))($scope);

		$scope.templateDir = wpAjax.themeLocation.templateDir;
		$scope.siteUrl = wpAjax.themeLocation.siteUrl;
		$scope.$route = $route;
		$scope.$location = $location;
		$scope.$routeParams = $routeParams;

		if (angular.element('body').hasClass('admin-bar')) {
			//add ng-click event dynamically on adminbar buttons
			if (angular.element('#wp-admin-bar-root-default')) {

				angular.element('#wp-admin-bar-root-default li a').each(function () {
					$compile(angular.element(this).attr('ng-click', 'redirectToAdmin()'))($scope);

				})
			}
		}

	}

});
'use strict';
angularpressApp.controller('PrimaryNavCtrl', function ($scope, $routeParams, $location, $window, $route, $compile, $rootScope, wpAjax) {

		if (!angular.element('body').hasClass('wp-admin')) {

			var isNumeric = function (n) {
				return !isNaN(parseFloat(n)) && isFinite(n);
			};

			if ($routeParams.action === 'logout') {
				$window.location.href = wpAjax.authentication.loggedout;

			}
			else if ($location.path() === '/wp-login.php/' || $location.path() === '/wp-admin/') {
				$window.location.href = wpAjax.themeLocation.siteUrl + '/wp-admin/';

			}
			if ($location.path() === '/') {
				$scope.menuId = 'root';

			}
			else if ($routeParams.primaryNav === '404') {
				$scope.menuId = 'error404';
				$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/404.html';

			}
			else {

				$scope.menuId = '' + $routeParams.primaryNav;
				$scope.pageId = 'mainNav ';

				if ($routeParams.primaryNav === 'wp-admin' || $routeParams.primaryNav === 'wp-login.php') {
					$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/splash-screen.html';

				}
				else if ($routeParams.primaryNav !== 'wp-admin' && isNumeric($routeParams.primaryNav)) {
					//see SecondaryNavCtrl for second option
					$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/archive.html';

				}
				else if ($routeParams.primaryNav === 'search') {
					$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/search.html';

				}
				else if ($routeParams.primaryNav === 'not-found') {
					$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/not-found.html';

				}

				else if ($routeParams.primaryNav === 'category') {
					$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/404.html';

				}
				else if ($routeParams.primaryNav === 'tag') {
					$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/404.html';

				}
				else {
					$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/pages/' + $routeParams.primaryNav + '.html';

				}

				$rootScope.$on('$routeChangeError', function () {
					$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/404.html';

				});

				//Append admin bar buttons
				$scope.appendAdminBarEditButton = function () {
					if (angular.element('body').hasClass('admin-bar')) {

						var editPage = angular.element('<editpage name="{{menuId}}"></editpage>');
						var editPageDirective = $compile(editPage)($scope);

						if (angular.element('li#angp-admin-bar-edit')) {
							$rootScope.$on('$routeChangeStart', function () {
								angular.element('li#angp-admin-bar-edit').remove();

							});
						}
						angular.element("#wp-admin-bar-root-default").append(editPageDirective);
					}
				}

				$scope.appendAdminBarEditPostButton = function () {
					//see dtPostArticle.js
					if (angular.element('body').hasClass('admin-bar')) {

						var editPost = angular.element('<editpost name="{{$routeParams.secondaryNav}}"></editpost>');
						var editPostDirective = $compile(editPost)($scope);

						if (angular.element('li#angp-admin-bar-edit')) {
							$rootScope.$on('$routeChangeStart', function () {
								angular.element('li#angp-admin-bar-edit').remove();

							});
						}
						angular.element("#wp-admin-bar-root-default").append(editPostDirective);
					}
				}

			}
		}
	}
);
'use strict';
angularpressApp.controller('SecondaryNavCtrl', function ($scope, $routeParams, $window, $location, $compile, $rootScope, wpAjax) {

		if (!angular.element('body').hasClass('wp-admin')) {

			//refactor this
			var isNumeric = function (n) {
				return !isNaN(parseFloat(n)) && isFinite(n);
			};

			if ($routeParams.action === 'logout') {
				//Logout
				$window.location.href = wpAjax.authentication.loggedout;
			}

			/** @namespace $routeParams.secondaryNav */
			if ($routeParams.primaryNav === 'wp-admin' && $routeParams.secondaryNav === 'post.php') {
				//Adminbar: edit page and edit post button.
				if (!angular.element('body').hasClass('wp-admin'))
					$window.location.href = wpAjax.themeLocation.siteUrl + '/wp-admin/post.php?post=' + $routeParams.post + '&action=edit';

			}

			$scope.params = $routeParams;
			$scope.menuId = '' + $routeParams.primaryNav;
			$scope.pageId = 'subNav ' + $routeParams.secondaryNav;

			if ($routeParams.primaryNav !== 'wp-admin' && $routeParams.primaryNav !== 'category' && $routeParams.primaryNav !== 'tag' && !isNumeric($routeParams.primaryNav) && typeof $routeParams.secondaryNav !== 'undefined') {
				$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/single.html';

			}
			else if ($routeParams.primaryNav !== 'wp-admin' && isNumeric($routeParams.primaryNav) && isNumeric($routeParams.secondaryNav)) {
				$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/archive.html';

			}
			else if ($routeParams.primaryNav === 'category' && typeof $routeParams.secondaryNav !== 'undefined') {
				$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/category.html';

			}
			else if ($routeParams.primaryNav === 'tag' && typeof $routeParams.secondaryNav !== 'undefined') {
				$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/tag.html';

			}
			else if ($routeParams.primaryNav === 'wp-admin') {
				$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/templates/splash-screen.html';

			}
			else {
				$scope.templateUrl = wpAjax.themeLocation.templateDir + '/library/views/pages/' + $routeParams.secondaryNav + '.html';

			}

		}
	}
);