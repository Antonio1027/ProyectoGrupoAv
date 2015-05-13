(function(){
	angular.module('filters', [])
	.filter('reorderdate', ['$filter', function ($filter) {
		return function (data) {
			if (typeof (data)==="string") {
				var date = data.split('-');
				return date[2] + '-' + date[1] + '-' + date[0];
			}
		};
	}])
	.filter('capitalize', ['$filter', function ($filter) {
		return function (data) {
			if (typeof (data)==="string") {
				return data.charAt(0).toUpperCase() + data.slice(1);
			}
		};
	}]);

})()