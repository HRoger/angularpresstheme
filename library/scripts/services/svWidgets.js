/**
 * Created by ROGER on 25.11.13.
 */
	//'use strict';

angularpressApp.factory('widgetData', function ($http, $angularCacheFactory, wpAjax) {

	if (wpAjax.sessions.on_first_page_load === null) {
		var widgetCache = $angularCacheFactory('widgetCache', {
			maxAge            : 90000,
			deleteOnExpire    : 'aggressive',
			storageMode       : 'localStorage',
			recycleFreq       : 10000,
			cacheFlushInterval: 3600000,
			verifyIntegrity   : true
		});

	}

	return{

		getWidget: function (successcb, sidebar_id) {
			$http({
				method: 'GET',
				cache : widgetCache,
				url   : wpAjax.themeLocation.siteUrl + '/api/widgets/get_sidebar/',
				params: {
					sidebar_id: sidebar_id
				}
			})
				.success(function (data) {
					return successcb(data);

				})
				.error(function () {
					if (wpAjax.sessions.on_first_page_load === null)
					//if something went wrong after the first page load throw error
						throw new Error('Network error. Widgets not loaded.');
				})
		}

	}

});