(function(){
	angular.module('controllers', [])
	.controller('AdminCtrl', ['$scope', 'AVService', function ($scope, AVService) {
		//JSON POST
		$scope.datacategory = {};
		$scope.dataproduct = {};
		$scope.datatype = {};
		//Array GET
		$scope.CPT = [];
		//Utils
		$scope.indexcategory = null;
		$scope.indexproduct =  null;
		$scope.indextype = null;

		$scope.regex_number = /^[0-9]*$/;
		$scope.regex_float = /^[0-9]*(\.[0-9]+)?$/;

		$scope.msgnoti = "";
		$scope.noti = false;

		function setnotification(msg){
			$scope.msgnoti = msg;
			$scope.noti = true;
			window.setTimeout(function(){
				$scope.noti = false;
			},3000);
		}

		$scope.sendcategory = function(){
			AVService.postCategory($scope.datacategory)
			.then(function(data){
				data.data.listproducts = [];
				$scope.CPT.push(data.data);
				$scope.datacategory = {};
				setnotification(data.success);
			},
			function(error){
				console.log(error);
			})
		}

		$scope.sendproduct = function(){
			$scope.dataproduct.category_id = $scope.dataproduct.category_id.id;

			AVService.postProduct($scope.dataproduct)
			.then(function(data){
				data.data.types = [];
				var indexcategory = findcategory($scope.dataproduct.category_id);
				$scope.CPT[indexcategory].listproducts.push(data.data);
				$scope.dataproduct = {};
				setnotification(data.success);
			},
			function(error){
				setnotification(error.errors);
			})
		}

		$scope.sendtype = function(){
			$scope.datatype.category_id = $scope.datatype.category_id.id;
			$scope.datatype.product_id = $scope.datatype.product_id.id;
			
			AVService.postType($scope.datatype)
			.then(function(data){
				var indexcategory = findcategory($scope.datatype.category_id);
				var indexproduct = findproduct(indexcategory, $scope.datatype.product_id);
				$scope.CPT[indexcategory].listproducts[indexproduct].types.push(data.data);
				$scope.datatype = {};
				setnotification(data.success);
			},
			function(error){
				setnotification(error.errors);
			})
		}

		$scope.removecategory = function(idcategory){
			AVService.deleteCategory({"id":idcategory})
			.then(function(data){
				$scope.CPT = $scope.CPT.filter(function(element){
					return element.id != idcategory;
				})
				setnotification(data.success)				
			},
			function(error){
				console.log(error);
				setnotification(error.errors)
			})
		}

		$scope.removeproduct = function(idcategory, idproduct){
			AVService.deleteProduct({"id":idproduct})
			.then(function(data){
				angular.forEach($scope.CPT, function(element, index){
					if(element.id == idcategory){
						element.listproducts = element.listproducts.filter(function(e){
							return e.id != idproduct;
						})
					}
				})
				setnotification(data.success)				
			},
			function(error){
				setnotification(error.errors)
			})
		}

		$scope.removetype = function(idcategory, idproduct, idtype){
			AVService.deleteType({"id":idtype})
			.then(function(data){
				angular.forEach($scope.CPT, function(element, index){
					if(element.id == idcategory)
						angular.forEach(element.listproducts, function(e, i){
							if(e.id == idproduct)
								e.types = e.types.filter(function(element){
									return element.id != idtype;
								})
						})
				})
				setnotification(data.success)				
			},
			function(error){
				setnotification(error.errors)
			})
		}

		$scope.editcategory = function(idcategory){
			resetindex();
			$scope.indexcategory = findcategory(idcategory);
		}

		$scope.editproduct = function(idcategory, idproduct){
			resetindex();
			$scope.indexcategory = findcategory(idcategory);
			$scope.indexproduct = findproduct($scope.indexcategory, idproduct);
		}

		$scope.edittype = function(idcategory, idproduct, idtype){
			resetindex();
			$scope.indexcategory = findcategory(idcategory);
			$scope.indexproduct = findproduct($scope.indexcategory, idproduct);
			$scope.indextype = findtype($scope.indexcategory, $scope.indexproduct, idtype);
		}

		$scope.saveedit = function(e){
			switch(e){
				case 'C':
					// var category = $scope.CPT[$scope.indexcategory];
					// delete category.listproducts;
					AVService.updateCategory($scope.CPT[$scope.indexcategory])
					.then(function(data){
						console.log(data);
						setnotification(data.success)
					},
					function(error){
						console.log(error);
						setnotification(error.errors)
					})
				break;
				case 'P':
					AVService.updateProduct($scope.CPT[$scope.indexproduct])
					.then(function(data){
						setnotification(data.success)
					},
					function(error){
						setnotification(error.errors)
					})
				break;
				case 'T':
					AVService.updateType($scope.CPT[$scope.indextype])
					.then(function(data){
						setnotification(data.success)
					},
					function(error){
						setnotification(error.errors)
					})
				break;
			}
			resetindex();
		}

		function resetindex(){
			$scope.indexcategory = null;
			$scope.indexproduct = null;
			$scope.indextype = null;
		}

		function findtype (indexcategory, indexproduct, id){
			var indextype;
			var i = $scope.CPT[indexcategory].listproducts[indexproduct].types.some(function(element, index){
				if(element.id == id){
					indextype = index;
					return true;
				}
			})
			return indextype;
		}

		function findproduct (indexcategory, id){
			var indexproduct;
			var i = $scope.CPT[indexcategory].listproducts.some(function(element, index){
				if(element.id == id){
					indexproduct = index;
					return true;
				}
			})
			return indexproduct;
		}

		function findcategory (id){
			var indexcategory;
			var i = $scope.CPT.some(function(element, index){
				if(element.id == id){
					indexcategory = index;
					return true;
				}
			})
			return indexcategory;
		}

		$scope.searchListProduct = function(){
			AVService.getListProduct($scope.datatype.category_id.id)
				.then(function(data){
					$scope.listProducts = data;
				},
				function(error){
					$scope.listProducts = [];
					setnotification(error.errors);
				})
		}

		AVService.getCPT()
			.then(function(data){
				$scope.CPT = data;
			},
			function(error){
			})

	}])
	.controller('UserCtrl', ['$scope', function ($scope) {
		$scope.datauser = {};

		$scope.senduser = function(){
			$scope.datauser = {};
		}
		
	}])
	.controller('PresupuestosCtrl', ['$scope', 'AVService' , function ($scope, AVService) {
		$scope.datageneral = {};
		$scope.CPT = [];
		var listproducts = [];
		var estimacion = [];


		AVService.getCPT()
			.then(function(data){
				$scope.CPT = data;
			},
			function(error){
			})
		$scope.as = function(){
		}

		$scope.sendpresupuesto = function (){
			listproducts = [];
			estimacion = [];

			angular.forEach($scope.CPT, function(element, index){
				angular.forEach(element.listproducts, function(element, index){
					if(element.show == false)
						listproducts.push(element)
				})
			})

			estimacion.push($scope.datageneral);
			estimacion.push(listproducts);
			console.log(estimacion);

		}
	}])
})()