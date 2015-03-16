(function(){
	angular.module('filters', [])
	.filter('normalizeTitle', ['$filter', function ($filter) {
		return function (name) {
			if (typeof (name)==="string") {
				return name.replace(/([A-Z])/g, function($1){
					return $1.replace($1, ' ' + $1);
				});
			}
		};
	}]);

})()