/**
 * Created by ROGER on 26.11.13.
 */
'use strict';
angularpressApp.directive('widgetFooter', function (widgetData, wpAjax) {

	return{
		restrict   : 'E',
		replace    : true,
		scope      : {},
		templateUrl: wpAjax.themeLocation.templateDir + '/library/scripts/directives/partials/widget-footer.html',

		link: function (scope, element, attrs) {

			element.find('.loading-spinner').spin('large-widgets');

			widgetData.getWidget(

				function (data) {
					element.find('.loading-spinner').spin(false);
					scope.widgets = data.widgets;

				}, attrs.name);

		}
	};

});
'use strict';
angularpressApp.directive('widgetSidebar', function (widgetData, wpAjax) {

	return{
		restrict   : 'E',
		replace    : true,
		scope      : {},
		templateUrl: wpAjax.themeLocation.templateDir + '/library/scripts/directives/partials/widget-sidebar.html',

		link: function (scope, element, attrs) {

			element.find('.loading-spinner').spin('large-widgets');

			widgetData.getWidget(

				function (data) {
					element.find('.loading-spinner').spin(false);
					scope.widgets = data.widgets;

				}, attrs.name);

		}
	};

});
'use strict';
angularpressApp.directive('tooltip', function ($document) {
	return {

		restrict: 'A',

		link: function () {

			return angular.element($document).foundation('tooltips');

		}
	};
});
'use strict';
angularpressApp.directive('orbit', function ($document) {
	return {

		restrict: 'A',
		scope   : {
			style: '@'
		},

		link: function () {

			return angular.element($document).foundation('orbit');

		}
	};
});
'use strict';
angularpressApp.directive('dropdown', function ($document) {
	return {

		restrict: 'A',

		link: function () {

			return angular.element($document).foundation('dropdown');

		}
	};
});
