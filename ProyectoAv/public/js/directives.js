(function(){
	angular.module('directives', [])
	.directive('categories', [function () {
		return {
			restrict: 'E',
			templateUrl: 'partials/categories.html'
		};
	}])
	.directive('products', [function () {
		return {
			restrict: 'E',
			templateUrl: 'partials/products.html'
		};
	}])
	.directive('notifications', [function () {
		return {
			restrict: 'E',
			templateUrl: 'partials/notifications.html'
		};
	}])
})();