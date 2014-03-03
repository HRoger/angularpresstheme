/**
 * Created by ROGER on 28.02.14.
 */
'use strict';
angularpressApp.controller("SidebarCtrl", function ($scope, $compile) {

	$scope.$on('ngRepeatFinished', function () {
		//Category
//		angular.element(".widget_archive li a").css('color', 'blue');
//		$compile(angular.element("li.cat-item a").attr('ng-click', 'filterCatItem()'))($scope);
//		$compile(angular.element(".widget_archive li a").attr('ng-click', 'filterArchiveItem()'))($scope);
//		$compile(angular.element(".widget_archive li a").attr('on-click-archive-item', ''))($scope);
	});



});

'use strict';
angularpressApp.controller("SidebarFooterCtrl", function ($scope, $compile) {

	$scope.$on('ngRepeatFinished', function () {
		//Category
//		angular.element("li.cat-item a").css('color', 'blue');
		$compile(angular.element("li.cat-item a").attr('ng-click', 'filterCatItem()'))($scope);
	});

});

'use strict';
angularpressApp.controller("SidebarFrontpageCtrl", function ($scope, $compile) {

	$scope.$on('ngRepeatFinished', function () {
		//Category
//		angular.element("li.cat-item a").css('color', 'blue');
		$compile(angular.element("li.cat-item a").attr('ng-click', 'filterCatItem()'))($scope);
	});

});