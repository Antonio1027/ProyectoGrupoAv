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
	}])
	.filter('setDecimal', function ($filter) {
    return function (input, places) {
        if (isNaN(input)) return input;
        // If we want 1 decimal place, we want to mult/div by 10
        // If we want 2 decimal places, we want to mult/div by 100, etc
        // So use the following to create that factor
        var factor = "1" + Array(+(places > 0 && places + 1)).join("0");
        return Math.round(input * factor) / factor;
    };
	});

})()