/**
 * Created by ROGER on 25.11.13.
 */
'use strict';
angularpressApp.filter('unsafe', function ($sce) {
	return function (val) {
		return $sce.trustAsHtml(val);
	};
});
