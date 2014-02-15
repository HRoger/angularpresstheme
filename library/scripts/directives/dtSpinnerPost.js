/**
 * Created by ROGER on 11.01.14.
 */
angularpressApp.directive('spinnerPost', function (post) {

	return{
		restrict: 'A',
		replace : true,
		template:'<div class="loading-spinner-posts"></div>',

		link: function (scope) {
			angular.element('.loading-spinner-posts').spin('large');

			post.get_all_posts(function (data) {

				scope.posts = data.posts;

				angular.element('.loading-spinner-posts').spin(false);
			});
		}
	};

});
