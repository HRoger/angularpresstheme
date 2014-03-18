/**
 * Created by ROGER on 26.11.13.
 */
'use strict';
angular.module('lodash', []).constant('lodash', window._);

angularpressApp.value('siteUrl', Angularpress.url);
angularpressApp.value('templateDir', Angularpress.dir);
angularpressApp.value('loggedout', Angularpress._wpnonce);
angularpressApp.value('on_first_page_load', Angularpress.on_first_page_load);
angularpressApp.value('is_first_load', Angularpress.is_first_load);
angularpressApp.value('angp_session_delete_post_cache_key', Angularpress.angp_session_delete_post_cache_key);
angularpressApp.value('page_for_posts', Angularpress.page_for_posts);
angularpressApp.value('posts_per_page', Angularpress.posts_per_page);
angularpressApp.value('is_user_logged_in', Angularpress.is_user_logged_in);
angularpressApp.value('page_title', Angularpress.page_title);
angularpressApp.value('login_slug', Angularpress.login_slug);
angularpressApp.value('register_slug', Angularpress.register_slug);
angularpressApp.value('admin_slug', Angularpress.admin_slug);
angularpressApp.value('key_slug', Angularpress.key_slug);//refactor security

console.info(Angularpress.login_slug);
console.info(Angularpress.register_slug);
console.info(Angularpress.admin_slug);
console.info(Angularpress.key_slug);
angularpressApp.service('wpAjax', function (siteUrl, templateDir, loggedout, on_first_page_load, page_for_posts, posts_per_page, angp_session_delete_post_cache_key, is_user_logged_in, page_title, lodash, is_first_load, login_slug, register_slug, admin_slug, key_slug) {

	return {
		themeLocation  : {
			siteUrl    : siteUrl,
			templateDir: templateDir,
			page_title : page_title
		},
		authentication : {
			loggedout        : loggedout,
			is_user_logged_in: is_user_logged_in,
			login_slug       : login_slug,
			register_slug    : register_slug,
			admin_slug       : admin_slug,
			key_slug         : key_slug
		},
		sessions       : {
			on_first_page_load                : on_first_page_load,
			is_first_load                     : is_first_load,
			angp_session_delete_post_cache_key: angp_session_delete_post_cache_key
		},
		readingSettings: {
			page_for_posts: page_for_posts,
			posts_per_page: posts_per_page
		}


	}
});