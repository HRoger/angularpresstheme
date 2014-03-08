/**
 * Created by ROGER on 26.11.13.
 */
'use strict';
angular.module('lodash', []).constant('lodash', window._);

angularpressApp.value('siteUrl', Angularpress.url);
angularpressApp.value('templateDir', Angularpress.dir);
angularpressApp.value('loggedout', Angularpress._wpnonce);
angularpressApp.value('on_first_page_load', Angularpress.on_first_page_load);
angularpressApp.value('angp_session_delete_post_cache_key', Angularpress.angp_session_delete_post_cache_key);
angularpressApp.value('page_for_posts', Angularpress.page_for_posts);
angularpressApp.value('posts_per_page', Angularpress.posts_per_page);
angularpressApp.value('is_user_logged_in', Angularpress.is_user_logged_in);
angularpressApp.value('page_title', Angularpress.page_title);

angularpressApp.service('wpAjax', function (siteUrl, templateDir, loggedout, on_first_page_load, page_for_posts, posts_per_page, angp_session_delete_post_cache_key, is_user_logged_in, page_title) {

	return {
		themeLocation  : {
			siteUrl    : siteUrl,
			templateDir: templateDir,
			page_title : page_title
		},
		authentication : {
			loggedout        : loggedout,
			is_user_logged_in: is_user_logged_in
		},
		sessions       : {
			on_first_page_load                : on_first_page_load,
			angp_session_delete_post_cache_key: angp_session_delete_post_cache_key
		},
		readingSettings: {
			page_for_posts: page_for_posts,
			posts_per_page: posts_per_page
		}


	}
});