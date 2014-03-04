/**
 * Created by ROGER on 24.02.14.
 */
'use strict';
(function ($, document) {

	$(document).ready(function () {

		
		$('div.widgets-sortables').bind('sortstop', function (event, ui) {

			var localStorageKey = "angular-cache.caches.widgetCache.data." + Angularpress.url + "/api/widgets/get_sidebar/?sidebar_id=" + $(this).attr('id');

			localStorage.removeItem(localStorageKey);

		});

	});

})(jQuery);
