/**
 * Created by ROGER on 11.01.14.
 */
angularpressApp.directive('youtube', function($sce) {
	return {
		restrict: 'EA',
		scope: { code:'=' },
		replace: true,
		template: '<div style="height:400px;"><iframe style="overflow:hidden;height:100%;width:100%" width="100%" height="100%" src="{{url}}" frameborder="0" allowfullscreen></iframe></div>',
		link: function (scope) {
			scope.$watch('code', function (newVal) {
				if (newVal) {
					scope.url = $sce.trustAsResourceUrl("http://www.youtube.com/embed/TqxotqvpIro" + newVal);
				}
			});
		}
	};
});