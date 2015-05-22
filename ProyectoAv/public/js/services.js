(function(){
	angular.module('services', [])
	.factory('AVService',  ['$http', '$q', function ($http, $q) {

		// Products
		function getCPT(){
			var deferred = $q.defer();

			$http.get('getCPT')
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error);
			});

			return deferred.promise;
		}		

		function postUser(user){
			var deferred = $q.defer();

			$http.post('newUser',user)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});

			return deferred.promise;
		}

		function updateUser(user){
			var deferred = $q.defer();

			$http.put('updateUser',user)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function deleteUser(user){
			var deferred = $q.defer();

			$http.delete('deleteUser/' + user.id)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function getUsers(){
			var deferred = $q.defer();
			$http.get('getUsers')
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function postCategory(category){
			var deferred = $q.defer();
			$http.post('newCategory',category)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function updateCategory(category){
			var deferred = $q.defer();
			$http.put('updateCategory',category)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function deleteCategory(category){	
			var deferred = $q.defer();
			$http.delete('deleteCategory/' + category.id)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});			
			return deferred.promise;
		}

		function getListCategory(){
			var deferred = $q.defer();
			$http.get('getListCategory')
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function postProduct(product){
			var deferred = $q.defer();
			$http.post('newProduct', product)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function updateProduct(product){
			var deferred = $q.defer();
			$http.put('updateProduct', product)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function deleteProduct(product){
			var deferred = $q.defer();
			$http.delete('deleteProduct/' + product.id)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function getListProduct(id){
			var deferred = $q.defer();
			$http.get('getListProduct/'+id)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function postType(type){
			var deferred = $q.defer();
			$http.post('newType', type)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function updateType(type){
			var deferred = $q.defer();
			$http.put('updateType', type)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function deleteType(type){
			var deferred = $q.defer();
			$http.delete('deleteType/' + type.id)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function postEstimation(estimation){
			var deferred = $q.defer();
			$http.post('newEstimation', estimation)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}
		//lista de presupuestos
		function getEstimations(){
			var deferred = $q.defer();
			$http.get('getEstimations')
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function getEstimation(id){
			var deferred = $q.defer();
			$http.get('getEstimation/' + id)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function getUpdateEstimation(id){
			var deferred = $q.defer();
			$http.get('getupdateEstimation/' + id)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function updateEstimation(estimation){
			var deferred = $q.defer();
			$http.put('updateEstimation', estimation)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function deleteEstimation(id){
			var deferred = $q.defer();
			$http.delete('deleteEstimation/' + id)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function comfirmOrder(data){
			var deferred = $q.defer();
			$http.post('confirmestimation', data)
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		function getOrders(){
			var deferred = $q.defer();
			// $http.get('getOrders')
			$http.get('lib/data.json')
			.success(function(data){
				deferred.resolve(data);
			})
			.error(function(error){
				deferred.reject(error)
			});
			return deferred.promise;
		}

		return {
			getCPT: getCPT,
			postUser: postUser,
			updateUser: updateUser,
			deleteUser: deleteUser,
			getUsers: getUsers,
			postCategory: postCategory,
			updateCategory: updateCategory,
			deleteCategory: deleteCategory,
			getListCategory: getListCategory,
			postProduct: postProduct,
			updateProduct: updateProduct,
			deleteProduct: deleteProduct,
			getListProduct: getListProduct,
			postType: postType,
			updateType: updateType,
			deleteType: deleteType,
			postEstimation: postEstimation,
			getEstimations: getEstimations,
			getEstimation: getEstimation,
			getUpdateEstimation: getUpdateEstimation,
			updateEstimation: updateEstimation,
			deleteEstimation: deleteEstimation,
			comfirmOrder: comfirmOrder,
			getOrders: getOrders
		};

	}])

})();