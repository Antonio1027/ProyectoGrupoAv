(function(){
	angular.module('directives', [])
	.directive('categories', [function () {
		return {
			restrict: 'E',
			templateUrl: 'partials/categories.html'
		};
	}])
	.directive('carpas', [function () {
		return {
			restrict: 'E',
			templateUrl: 'partials/carpas.html'
		};
	}])
})();