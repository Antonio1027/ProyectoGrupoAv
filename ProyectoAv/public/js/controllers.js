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
				$scope.CPT.push(data);
				$scope.datacategory = {};
				setnotification("Nueva categoria ingresada");
			},
			function(error){
				console.log(error);
			})
		}

		$scope.sendproduct = function(){
			console.log($scope.dataproduct);
			var indexcategory = findcategory($scope.dataproduct.category_id);
			$scope.CPT[indexcategory].listproducts.push($scope.dataproduct);
			$scope.dataproduct = {};
		}

		$scope.sendtype = function(){
			console.log($scope.datatype);

			var indexcategory = findcategory($scope.datatype.category_id);
			var indexproduct = findproduct(indexcategory, $scope.datatype.product_id);
			$scope.CPT[indexcategory].listproducts[indexproduct].types.push($scope.datatype);

			$scope.datatype = {};
		}

		$scope.removecategory = function(idcategory){
			$scope.CPT = $scope.CPT.filter(function(element){
				return element.id != idcategory;
			})
		}

		$scope.removeproduct = function(idcategory, idproduct){
			angular.forEach($scope.CPT, function(element, index){
				if(element.id == idcategory){
					element.listproducts = element.listproducts.filter(function(e){
						return e.id != idproduct;
					})
				}
				console.log(element);
			})
		}

		$scope.removetype = function(idcategory, idproduct, idtype){
			angular.forEach($scope.CPT, function(element, index){
				if(element.id == idcategory)
					angular.forEach(element.listproducts, function(e, i){
						if(e.id == idproduct)
							e.types = e.types.filter(function(element){
								return element.id != idtype;
							})
					})
			})
		}

		$scope.editcategory = function(idcategory){
			resetindex();
			$scope.indexcategory = findcategory(idcategory);
			console.log($scope.CPT[$scope.indexcategory]);
		}

		$scope.editproduct = function(idcategory, idproduct){
			resetindex();
			$scope.indexcategory = findcategory(idcategory);
			$scope.indexproduct = findproduct($scope.indexcategory, idproduct);
			console.log($scope.CPT[$scope.indexcategory].listproducts[$scope.indexproduct]);
		}

		$scope.edittype = function(idcategory, idproduct, idtype){
			resetindex();
			$scope.indexcategory = findcategory(idcategory);
			$scope.indexproduct = findproduct($scope.indexcategory, idproduct);
			$scope.indextype = findtype($scope.indexcategory, $scope.indexproduct, idtype);

			console.log($scope.CPT[$scope.indexcategory].listproducts[$scope.indexproduct].types[$scope.indextype]);
		}

		$scope.saveedit = function(e){
			switch(e){
				case 'C':
					console.log($scope.CPT[$scope.indexcategory]);
				break;
				case 'P':
					console.log($scope.CPT[$scope.indexcategory].listproducts[$scope.indexproduct]);
				break;
				case 'T':
					console.log($scope.CPT[$scope.indexcategory].listproducts[$scope.indexproduct].types[$scope.indextype]);
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

		AVService.getCPT()
			.then(function(data){
				$scope.CPT = data;
			},
			function(error){
				console.log(error);
			})

	}])
	.controller('UserCtrl', ['$scope', function ($scope) {
		$scope.datauser = {};

		$scope.senduser = function(){
			console.log($scope.datauser);
			$scope.datauser = {};
		}
		
	}])
	.controller('PresupuestosCtrl', ['$scope', 'AVService' , function ($scope, AVService) {
		$scope.datageneral = {};
		$scope.CPT = [];
		var listproducts = [];
		var estimacion = [];


		AVService.getProducts()
			.then(function(data){
				$scope.CPT = data;
			},
			function(error){
				console.log(error);
			})
		$scope.as = function(){
			console.log($scope.CPT);
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