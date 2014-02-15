/**
 * Created by ROGER on 26.11.13.
 */
'use strict';
angularpressApp.value('siteUrl', Angularpress.url);
angularpressApp.value('templateDir', Angularpress.dir);
angularpressApp.value('loggedout', Angularpress._wpnonce);
angularpressApp.value('on_first_page_load', Angularpress.on_first_page_load);
angularpressApp.value('page_for_posts', Angularpress.page_for_posts);
angularpressApp.value('posts_per_page', Angularpress.posts_per_page);

angularpressApp.service('wpAjax', function (siteUrl, templateDir, loggedout, on_first_page_load, page_for_posts, posts_per_page) {

	return {
		themeLocation  : {
			siteUrl    : siteUrl,
			templateDir: templateDir
		},
		authentication : {
			loggedout: loggedout
		},
		sessions       : {
			on_first_page_load: on_first_page_load
		},
		readingSettings: {
			page_for_posts: page_for_posts,
			posts_per_page: posts_per_page
		}


	}
});