angularpressApp.directive('postArticle', function (post, wpAjax, $location, $rootScope,$routeParams) {

	return{
		restrict   : 'E',
		replace    : true,
		templateUrl: wpAjax.themeLocation.templateDir + '/library/scripts/directives/partials/post-article.html',
		controller : 'PrimaryNavCtrl',
		link       : function (scope, element, attrs) {

			angular.element('.loading-spinner-single-posts').spin('large');

			scope.is_link_visible = true;

			scope.appendAdminBarEditPostButton();

			//$http request
			if ($routeParams.primaryNav !== 'portfolio-post') {
				post.get_post_ID(
					function (data) {

						//add  borderbottom for blog posts and remove on frontpage
						angular.element(".entry-body").css({
							borderBottom: "0.063em solid #DDDDDD"
						});

						$rootScope.$on('$routeChangeSuccess', function () {

							if ($location.path() === '/') {
								angular.element(".entry-body").css({borderBottom: "none"});
							}
						});

						angular.element('.loading-spinner-single-posts').spin(false);

						scope.$watch('$viewContentLoaded', function () {
							//responsible to site <title> on posts. See MainCtrl. Related:SidebarCtrl
							angular.element("nav a[rel=prev] span:nth-child(2),nav a[rel=next] span:nth-child(1)").on('click', function () {
								scope.$emit('linkText', angular.element(this).text());

							});

						});

						scope.siteurl = wpAjax.themeLocation.siteUrl;
						scope.postUrl = scope.siteurl + $location.path();
						/** @namespace data.previous_url */
						scope.postPreviousUrl = data.previous_url;
						/** @namespace data.next_url */
						scope.postNextUrl = data.next_url;

						scope.postId = data.post.id;
						scope.postSlug = data.post.slug;
						scope.postStatus = data.post.status;
						scope.postType = data.post.type;
						scope.postTitle = data.post.title;
						scope.postContent = data.post.content;
						scope.postDate = data.post.date;
						scope.postAuthor = data.post.author.name;

						//show footer links
						scope.is_link_visible = false;

						//is edit post link visible
						scope.is_visible = angular.element('body').hasClass('admin-bar') && scope.postid !== '';

						//show or hide previous/next link post
						scope.is_previous_visible = data.previous_url !== undefined;
						scope.is_next_visible = data.next_url !== undefined;

					}, attrs.name);
			}

			//GET PORTFOLIO POST. NEED REFACTORING
			else {

				post.get_portfolio_post(
					function (data) {

						//add  borderbottom for blog posts and remove on frontpage
						angular.element(".entry-body").css({
							borderBottom: "0.063em solid #DDDDDD"
						});

						$rootScope.$on('$routeChangeSuccess', function () {

							if ($location.path() === '/') {
								angular.element(".entry-body").css({borderBottom: "none"});
							}
						});

						angular.element('.loading-spinner-single-posts').spin(false);

						scope.$watch('$viewContentLoaded', function () {
							//responsible to site <title> on posts. See MainCtrl. Related:SidebarCtrl
							angular.element("nav a[rel=prev] span:nth-child(2),nav a[rel=next] span:nth-child(1)").on('click', function () {
								scope.$emit('linkText', angular.element(this).text());

							});

						});

						scope.siteurl = wpAjax.themeLocation.siteUrl;
						scope.postUrl = scope.siteurl + $location.path();
						/** @namespace data.previous_url */
						scope.postPreviousUrl = data.previous_url;
						/** @namespace data.next_url */
						scope.postNextUrl = data.next_url;

						scope.postId = data.posts[0].ID;
						scope.postSlug = data.posts[0].post_name;
						scope.postStatus = data.posts[0].post_status;
						scope.postType = data.posts[0].post_type;
						scope.postTitle = data.posts[0].post_title;
						scope.postContent = data.posts[0].post_content;
						scope.postDate = data.posts[0].post_date;
						scope.postAuthor = data.posts[0].post_author;

						//show footer links
						scope.is_link_visible = false;

						//is edit post link visible
						scope.is_visible = angular.element('body').hasClass('admin-bar') && scope.postid !== '';

						//show or hide previous/next link post
						scope.is_previous_visible = data.previous_url !== undefined;
						scope.is_next_visible = data.next_url !== undefined;

					}, attrs.name);

			}

		}
	}

});

