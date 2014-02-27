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
					scope.widgets =  data.widgets;

				}, attrs.name);

		}
	};

});

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


angularpressApp.directive('tooltip', function () {
	return {

		restrict: 'A',

		link: function (scope, element, attrs) {

			return angular.element(document).foundation('tooltips');

		}
	};
});

angularpressApp.directive('orbit', function () {
	return {

		restrict: 'A',
		scope   : {
			style: '@'
		},

		link: function (scope, element, attrs) {

			return angular.element(document).foundation('orbit');

		}
	};
});

angularpressApp.directive('dropdown', function () {
	return {

		restrict: 'A',

		link: function (scope, element, attrs) {

			return angular.element(document).foundation('dropdown');

		}
	};
});





