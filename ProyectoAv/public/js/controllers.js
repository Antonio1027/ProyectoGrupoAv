(function(){
	angular.module('controllers', [])
	.controller('ordenServicioCtrl', ['$scope', '$routeParams', 'AVService', function ($scope, $routeParams, AVService) {
		$scope.order = [];

		$scope.nextStatus = function(){
			if( window.confirm('¿Desea avanzar al siguiente status?') ){
				var data = {id: $routeParams.orden_id, status:$scope.order.status}
				AVService.updateStatus(data)
					.then(function(data){
						$scope.order.status = data.success.status;
						setnotification(data.success);
					},
					function(error){
						setnotification(error.errors);
					})
			}
		}

		$scope.toggleFacture = function(id,name){
			var data = {id: id}
			if( $('#'+name).is(':checked') ){
				data.facture = false;
				updateFacture(data);
			}
			else{
				data.facture = true;
				updateFacture(data);
			}
		}

		function updateFacture(data){
			AVService.putFacture(data)
				.then(function(data){
					setnotification(data.success);
				},
				function(error){
					setnotification(error.errors);
				})
		}

		AVService.getOrder($routeParams.orden_id)
			.then(function(data){
				$scope.order = data.data[0];
			},
			function(error){
				setnotification(error.errors);
			})

		function setnotification(msg){
			$scope.msgnoti = msg;
			$scope.noti = true;
			window.setTimeout(function(){
				$scope.noti = false;
			},3000);
		}
		
	}])
	.controller('ListOrdenesCtrl', ['$scope', 'AVService', function ($scope, AVService) {
		$scope.orders = [];
		$scope.ordersfilter = [];

		getOrders();

		$scope.showall = function(){
			if( $scope.filter.hasOwnProperty('order') )
				delete $scope.filter.order.available_facture;
		}

		function getOrders(){
			AVService.getOrders()
				.then(function(data){
					angular.forEach(data.data, function(e, i){
						e.order.available_facture = e.order.available_facture == 1 ? true : false;
					})
					$scope.orders = data.data;
					$scope.ordersfilter = data.data;
				},
				function(error){
					setnotification(error.errors);
				});
		}

		$scope.filterDate = function(element){
			var date = [];
			if($scope.filterdate.datestart){
				date.start = Date.parse($scope.filterdate.datestart);
				if($scope.filterdate.dateend)
					date.end = Date.parse($scope.filterdate.dateend) + 86400000;
				else
					date.end = Date.parse($scope.filterdate.datestart) + 86400000;
				console.log(date);
				$scope.orders = $scope.ordersfilter.filter(function(element){
					if( Date.parse(element.date_range) >= date.start && Date.parse(element.date_event) < date.end )
						return element;
				});
			}
		}

		function setnotification(msg){
			$scope.msgnoti = msg;
			$scope.noti = true;
			window.setTimeout(function(){
				$scope.noti = false;
			},3000);
		}
	}])
	
	.controller('AdminProductCtrl', ['$scope', 'AVService', function ($scope, AVService) {
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
				setnotification(error.errors);
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
						setnotification(data.success)
					},
					function(error){
						
						setnotification(error.errors)
					})
				break;
				case 'P':
					AVService.updateProduct($scope.CPT[$scope.indexcategory].listproducts[$scope.indexproduct])
					.then(function(data){
						setnotification(data.success)
					},
					function(error){
						setnotification(error.errors)
					})
				break;
				case 'T':
					AVService.updateType($scope.CPT[$scope.indexcategory].listproducts[$scope.indexproduct].types[$scope.indextype])
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

	.controller('AdminUserCtrl', ['$scope', function ($scope) {
		$scope.datauser = {};

		$scope.senduser = function(){
			$scope.datauser = {};
		}
	}])

	.controller('ListPresupuestosCtrl',['$scope','AVService', function ($scope, AVService){

		$scope.search = {};

		AVService.getEstimations()			
			.then(function(data){					
				$scope.estimations = data.data;								
				$scope.estimationsfilter = data.data;
			},
			function(error){				
				setnotification(error.erros);
			})

		$scope.filterDate = function(element){
			var date = [];
			if($scope.search.datestart){
				date.start = Date.parse($scope.search.datestart);
				if($scope.search.dateend)
					date.end = Date.parse($scope.search.dateend) + 86400000;
				else
					date.end = Date.parse($scope.search.datestart) + 86400000;

				$scope.estimations = $scope.estimationsfilter.filter(function(element){
					if( Date.parse(element.date_event) >= date.start && Date.parse(element.date_event) < date.end )
						return element;
				});
			}
		}

	}])
		
	.controller('PresupuestoCtrl', ['$scope', '$routeParams', '$location', 'AVService' , function ($scope, $routeParams, $location, AVService) {
		AVService.getEstimation($routeParams.estimation_id)
			.then(function(data){
				$scope.estimation = data;
			},
			function(error){
				setnotification(error.errors);
			})

		$scope.comfirmOrder = function(id){
			var data = {id: id};
			AVService.comfirmOrder(data)
				.then(function(data){
					setnotification(data.success);
				},
				function(error){
					setnotification(error.errors);
				})
		}

		function setnotification(msg){
			$scope.msgnoti = msg;
			$scope.noti = true;
			window.setTimeout(function(){
				$scope.noti = false;
			},3000);
		}

		$scope.deleteEstimation = function(id){
			if( window.confirm('¿Seguro que quieres eliminar este presupuesto?') ){
				AVService.deleteEstimation(id)
					.then(function(data){
						setnotification(data.success);
						$location.url('/presupuestos');
					},
					function(error){
						setnotification(error.errors);
					})
			}
		}
	}])

	.controller('EditPresupuestosCtrl', ['$scope', '$routeParams', '$location', 'AVService' , function ($scope, $routeParams, $location, AVService) {
		$scope.datageneral = {};
		$scope.CPT = [];
		var listproducts = [];
		var estimacion = [];
		$scope.regex_number = /^[0-9]*$/;
		$scope.regex_float = /^[0-9]*(\.[0-9]+)?$/;

		AVService.getUpdateEstimation($routeParams.estimation_id)
			.then(function(data){
				$scope.datageneral = data.datageneral;
				$scope.datageneral.date_event = converseDate($scope.datageneral.date_event);
				$scope.datageneral.date_range = converseDate($scope.datageneral.date_range);
				$scope.datageneral.date_collecting = converseDate($scope.datageneral.date_collecting);
				$scope.CPT = data.CPT;
			},
			function(error){
				
				setnotification(error.errors);
			})
		function converseDate(date){
			return new Date(date);
		}

		$scope.calculator = function (){
			$scope.calculo = true;
			var subtotal = 0;
			var total = 0;

			angular.forEach($scope.CPT, function(element, index){
				angular.forEach(element.listproducts, function(element, index){
					angular.forEach(element.types, function(element, index){
						if(element.show == true){
							subtotal += element.rental_price * element.quantity;
						}
					})
				})
			})
			$scope.datageneral.subtotal = subtotal;

			// if(	$scope.datageneral.deposit && $scope.datageneral.advanced_payment	&& $scope.datageneral.discount	){
				$scope.datageneral.total = parseInt($scope.datageneral.subtotal) + parseInt($scope.datageneral.deposit);
				$scope.datageneral.balance = parseInt($scope.datageneral.total) - parseInt($scope.datageneral.advanced_payment);
			// }
		}


		function setnotification(msg){
			$scope.msgnoti = msg;
			$scope.noti = true;
			window.setTimeout(function(){
				$scope.noti = false;
			},3000);
		}

		$scope.sendpresupuesto = function (){
			listproducts = [];
			estimacion = [];

			angular.forEach($scope.CPT, function(element, index){
				angular.forEach(element.listproducts, function(element, index){
					angular.forEach(element.types, function(element, index){
						if(element.show == true)
							listproducts.push(element)
					})
				})
			})
			estimacion.push($scope.datageneral);
			estimacion.push(listproducts);

			AVService.updateEstimation(estimacion)
				.then(function(data){
					setnotification(data.success);
					$location.url('/presupuestos');
				},
				function(error){
					setnotification(error.errors);
				})
		}
	}])

	.controller('NewPresupuestosCtrl', ['$scope', '$routeParams', '$location', 'AVService' , function ($scope, $routeParams, $location, AVService) {
		$scope.datageneral = {};
		$scope.CPT = [];
		var listproducts = [];
		var estimacion = [];
		$scope.regex_number = /^[0-9]*$/;
		$scope.regex_float = /^[0-9]*(\.[0-9]+)?$/;
		$scope.calculo = false;

		AVService.getCPT()
			.then(function(data){
				$scope.CPT = data;
			},
			function(error){
				
				setnotification(error.errors);
			})

		$scope.calculator = function (){
			$scope.calculo = true;
			var subtotal = 0;
			var total = 0;

			angular.forEach($scope.CPT, function(element, index){
				angular.forEach(element.listproducts, function(element, index){
					angular.forEach(element.types, function(element, index){
						if(element.show == true){
							subtotal += element.rental_price * element.quantity;
						}
					})
				})
			})

			$scope.datageneral.subtotal = subtotal - parseInt($scope.datageneral.discount);
			$scope.datageneral.total = parseInt($scope.datageneral.subtotal) + parseInt($scope.datageneral.deposit);
			$scope.datageneral.balance = parseInt($scope.datageneral.total) - parseInt($scope.datageneral.advanced_payment);
		}


		function setnotification(msg){
			$scope.msgnoti = msg;
			$scope.noti = true;
			window.setTimeout(function(){
				$scope.noti = false;
			},3000);
		}

		$scope.sendpresupuesto = function (){
			listproducts = [];
			estimacion = [];

			angular.forEach($scope.CPT, function(element, index){
				angular.forEach(element.listproducts, function(element, index){
					angular.forEach(element.types, function(element, index){
						if(element.show == true)
							listproducts.push(element)
					})
				})
			})
			estimacion.push($scope.datageneral);
			estimacion.push(listproducts);

			AVService.postEstimation(estimacion)
				.then(function(data){
					setnotification(data.success);
					$location.url('/presupuesto/' + data.success.id);
				},
				function(error){
					setnotification(error.errors);
				})
		}
	}])
})()