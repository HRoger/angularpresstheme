/**
 * Created by ROGER on 19.01.14.
 */
angularpressApp.factory('search', function ($http, wpAjax,$angularCacheFactory) {
	var searchCache = $angularCacheFactory('searchCache', {storageMode: 'localStorage',verifyIntegrity: true});
	return{
		get_results: function (successcb, inputValue,page) {

			$http(
				{
					method: 'GET',
					cache : searchCache,
					url   : wpAjax.themeLocation.siteUrl + '/api/',
					params: {
						json       : 'get_search_results',
						search     : inputValue,
						page       : page,
						date_format: 'F j, Y'
					}
				})
				.success(function (data) {
					return successcb(data);

				})
				.error(function () {
					if (wpAjax.sessions.on_first_page_load === null)
					throw new Error('Network error. Search results not loaded.');
				})

		}

	}

});