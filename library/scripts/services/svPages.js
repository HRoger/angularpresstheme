'use strict';


angularpressApp.factory('page', function ($http, $angularCacheFactory, wpAjax) {

	var pageIDCache = $angularCacheFactory('pageIDCache', {storageMode: 'localStorage',verifyIntegrity: true});
	return{

		get_page_ID: function (successcb, slug) {
			$http(
				{
					method: 'GET',
					cache : pageIDCache,
					url   : wpAjax.themeLocation.siteUrl + '/api/get_page/',
					params: {slug: slug}
				})
				.success(function (data) {

				 	return successcb(data);

				})
				.error(function () {
					if (wpAjax.sessions.on_first_page_load === null)
					throw new Error('Network error. PageID factory not loaded.');

				})
		}

	}

});