(function(){
	angular.module('services', [])
	.factory('AVService',  ['$http', '$q', function ($http, $q) {

		// Products
		function getProducts(){
			var deferred = $q.defer();

			$http.get('lib/data.json')
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error);
			});

			return deferred.promise;
		}

		return {
			getProducts: getProducts,
		};
	}])

})();