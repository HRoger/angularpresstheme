/**
 * Created by ROGER on 28.02.14.
 */

angularpressApp.directive('onAngRepeatFinished', function ($timeout) {
	return {
		restrict: 'A',
		scope   : true,
		link    : function (scope) {
			if (scope.$last) {
				$timeout(function () {
					scope.$emit('ngRepeatFinished');
				});
			}
		}
	}
});


