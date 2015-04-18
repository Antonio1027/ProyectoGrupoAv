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
			console.log(user);
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
			console.log(user);
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
			console.log(user);
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
			console.log(category);
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
			console.log(product);
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
			console.log(product);
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
			console.log(id);
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
			console.log(type);
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
			console.log(type);
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
			console.log(estimation);
			var deferred = $q.defer();
			$http.post('newestimation', estimation)
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
			postEstimation: postEstimation
		};

	}])

})();