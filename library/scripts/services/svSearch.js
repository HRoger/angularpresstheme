/**
 * Created by ROGER on 19.01.14.
 */
angularpressApp.factory('search', function ($http, wpAjax) {

	return{
		get_results: function (successcb, inputValue) {

			$http(
				{
					method: 'GET',
					cache : true,
					url   : wpAjax.themeLocation.siteUrl + '/api/',
					params: {
						json       : 'get_search_results',
						search     : inputValue,
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