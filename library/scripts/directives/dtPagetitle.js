/**
 * Created by ROGER on 20.12.13.
 */
angularpressApp.directive('pagetitle', function (pageTitle, wpAjax) {

	return{

		restrict: 'E',
		replace : true,
		scope   : {
			name: '@'
		},

		templateUrl: wpAjax.themeLocation.templateDir + '/library/scripts/directives/partials/pagetitle.html',

		link: function (scope, element, attrs) {
			//			console.info(pageTitle.get_page_title('home'));
			console.info(attrs.name);
			pageTitle.get_page_title(attrs.name).then(function (response) {

				console.info(response);

				//				scope.siteurl = siteUrl;
				scope.title = response;

			});

		}
	};

});