(function(){
	angular.module('filters', [])
	.filter('capitalize', ['$filter', function ($filter) {
		return function (data) {
			if (typeof (data)==="string") {
				return data.charAt(0).toUpperCase() + data.slice(1);
			}
		};
	}]);

})()