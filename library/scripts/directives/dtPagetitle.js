/**
 * Created by ROGER on 20.12.13.
 */
angularpressApp.directive('pagetitle', function (page, wpAjax,$route) {

	return{

		restrict: 'E',
		replace : true,
		scope   : {
			name: '@'
		},

		templateUrl: wpAjax.themeLocation.templateDir + '/library/scripts/directives/partials/pagetitle.html',

		link: function (scope) {
			//			console.info(pageTitle.get_page_title('home'));
//			console.info(attrs.name);
			page.get_page_ID(function (data) {

				console.info(data);

				scope.title = data.page.title;



			},$route.current.params.primaryNav);

			scope.$on('$routeChangeSuccess', function () {
				/*console.info(current);
				 console.info(previous);
				 console.info(next);*/
				//			console.info(current.currentScope.$routeParams.primaryNav);
				//			$scope.title =current.currentScope.$routeParams.primaryNav;
				//			$scope.title = ;

				scope.$on('linkText', function (event, data) {
					scope.title = data;
		 	console.info(data);
					 console.info(event);

				})


			})


		}
	};

});