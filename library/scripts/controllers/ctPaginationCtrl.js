/**
 * Created by ROGER on 17.01.14.
 */

'use strict';
angularpressApp.controller("angpPaginationCtrl", function ($scope, post, wpAjax) {

	var status = 'publish';
	var page = 1;//first page as default

	$scope.maxSize = 5;
	$scope.itemsPerPage = wpAjax.readingSettings.posts_per_page;
	$scope.currentPage = 2;

	$scope.pageChanged = function (newPage) {

		page = newPage;

		angular.element('.loading-spinner-posts').spin('large-widgets');
		$scope.is_link_visible = true;

		post.get_post_pagination(
			function (data) {
				$scope.posts = data.posts;
				$scope.numPages = data.pages;
				$scope.totalItems = data.count_total;

				angular.element('.loading-spinner-posts').spin(false);
				$scope.is_link_visible = false;


			}, status, page);

	}

});