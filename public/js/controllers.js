(function(){	
	angular.module('controllers', [])
	.controller('AuthCtrl',['$scope','$rootScope','$location','$localStorage','Auth','$routeParams',
		function ($scope,$rootScope,$location,$localStorage,Auth,$routeParams){						
			$scope.userType = {};						
			if($routeParams.status)
				Auth.logout(function(res){					
					$location.path('/');
				});


			function successAuth(res){
				$localStorage.token = res.token;
				$localStorage.user = res.user;				
				$location.path('/presupuesto');								
			}

			$scope.signin = function(){
				var credentials = {
					username:$scope.username,
					password: $scope.password
				}
				Auth.signin(credentials)
					.then(function(data){						
						successAuth(data);						
					},
					function(error){						
						setnotification(error.errors);
					});					
			};
			$scope.tokenClaims = Auth.getTokenClaims();
			$scope.user = $localStorage.user; 			

			function setnotification(msg){
				$scope.msgnoti = msg;
				$scope.noti = true;
				window.setTimeout(function(){
					$scope.noti = false;
				},3000);
			}		
	}])
	.controller('ordenServicioCtrl', ['$scope', '$routeParams', 'AVService','$rootScope','$localStorage', 
		function ($scope, $routeParams, AVService,$rootScope,$localStorage) {
		$scope.order = [];			
		$scope.newpayment = {};			
		$scope.user = $localStorage.user;		
		$scope.token = $localStorage.token;		
		getOrder();		
		
		$scope.savePayment = function(){
			$scope.newpayment.order_id = $scope.order.id;
			if( ! $scope.newpayment.amount){
				alert("Necesita introducir un monto para el nuevo pago");
				return;
			}
			if( window.confirm('Esta seguro de agregar un nuevo pago por la cantidad de $' + $scope.newpayment.amount) ){
				AVService.savePayment($scope.newpayment)
					.then(function(data){
						$scope.newpayment = {};
						getOrder();
						setnotification(data.success);
					},
					function(error){
						setnotification(error.errors);
					})
			}
		}

		$scope.saveObservations = function(){
			var data = {id: $routeParams.orden_id, observations:$scope.order.observations}
			AVService.updateObservations(data)
				.then(function(data){
					$scope.order.observations = data.observations;					
					setnotification(data.success);
				},
				function(error){
					setnotification(error.errors);
				})
		}

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

		$scope.nextPay = function(){
			if( window.confirm('¿Desea avanzar al siguiente status?') ){
				var data = {id: $routeParams.orden_id, status:$scope.order.pay}
				AVService.updatePay(data)
					.then(function(data){
						$scope.order.pay = data.pay;
						setnotification(data.success);
					},
					function(error){
						setnotification(error.errors);
					})
			}
		}

		$scope.toggleFacture = function(id,name){
			var data = {id: $routeParams.orden_id};

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

		function getOrder(){
			AVService.getOrder($routeParams.orden_id)
				.then(function(data){
					$scope.order = data.data[0];
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
		
	}])
	.controller('ListPagosCtrl', ['$scope', '$filter', 'AVService','$rootScope','$localStorage', 
		function ($scope, $filter, AVService,$rootScope,$localStorage){
		$scope.payments = [];
		$scope.paymentsresp = [];
		$scope.user = $localStorage.user;		
		getPayments();

		function getPayments(){
			AVService.getPayments()
				.then(function(data){
					$scope.payments = data.data;
					$scope.paymentsresp = data.data;					
				},
				function(error){
					setnotification(error.errors);
				});
		}

		$scope.filterDatePayment = function(){
			if($scope.filterdate){
				var date = $filter('date')($scope.filterdate, 'yyyy') + '-' + $filter('date')($scope.filterdate, 'MM') +  '-' + $filter('date')($scope.filterdate, 'dd');
				$scope.payments = $scope.paymentsresp.filter(function(e, i){
					if(date === e.created_at)
						return e;
				})
			}
			else
				$scope.payments = $scope.paymentsresp;
				


		}

		function setnotification(msg){
			$scope.msgnoti = msg;
			$scope.noti = true;
			window.setTimeout(function(){
				$scope.noti = false;
			},3000);
		}
	}])

	.controller('ListOrdenesCtrl', ['$scope', 'AVService','$rootScope','$localStorage', 
		function ($scope, AVService,$rootScope,$localStorage) {
		$scope.orders = [];
		$scope.ordersfilter = [];
		$scope.user = $localStorage.user;		
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
				$scope.orders = $scope.ordersfilter.filter(function(element){
					if( Date.parse(element.date_range) >= date.start && Date.parse(element.date_event) < date.end )
						return element;
				});
			}else{
				$scope.orders = $scope.ordersfilter;
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
	
	.controller('AdminProductCtrl', ['$scope', 'AVService','$rootScope','$localStorage', 
		function ($scope, AVService,$rootScope,$localStorage) {			
		$scope.user = $localStorage.user;		
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
			if( window.confirm("¿Esta seguro que desea eliminar la categoria?") ){
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
		}

		$scope.removeproduct = function(idcategory, idproduct){
			if( window.confirm("¿Esta seguro que desea eliminar el producto?") ){
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
		}

		$scope.removetype = function(idcategory, idproduct, idtype){
			if( window.confirm("¿Esta seguro que desea eliminar articulo?") ){
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

	.controller('AdminUserCtrl', ['$scope','$routeParams','AVService','$rootScope','$localStorage', 
		function ($scope,$routeParams,AVService,$rootScope,$localStorage) {		

		$scope.user = $localStorage.user;		
			
		$scope.datauser = {};
		$scope.users = {};
		$scope.tab = false;


		var init = function(){
			if($routeParams.user_id){
				AVService.getUser($routeParams.user_id)
					.then(function(data){					
						$scope.datauser = data;						
					},
					function(error){					
						setnotification(error.errors);
					});			
			}
			else{
				AVService.getUsers().
					then(function(data){
						$scope.users = data;				
					},
					function(error){										
					});
			}	
		}
			
		$scope.senduser = function(){			
			AVService.postUser($scope.datauser)
				.then(function(data){
					$scope.users.push(data.user);					
					setnotification(data.success);
					$scope.datauser = {};
					$scope.tab = false;
				},
				function(error){					
					setnotification(error.errors);
				});			
		}

		$scope.deleteUser = function(user){			
			if( window.confirm('¿Seguro que quieres eliminar este usuario?') ){				
				element = $scope.users.indexOf(user);								
				AVService.deleteUser(user)
					.then(function(data){
						$scope.users.splice(element,1);
						setnotification(data.success);
					},
					function(error){
						setnotification(error.errors);
					})
			}
		}

		$scope.sendupdateuser = function(){	
			AVService.updateUser($scope.datauser)
				.then(function(data){					
					setnotification(data.success);										
				},
				function(error){					
					setnotification(error.errors);
				});			
		}		

		function setnotification(msg){
			$scope.msgnoti = msg;
			$scope.noti = true;
			window.setTimeout(function(){
				$scope.noti = false;
			},3000);
		}
		

		init();
	}])

	.controller('ListPresupuestosCtrl',['$scope','AVService','$rootScope','$localStorage', 
		function ($scope, AVService,$rootScope,$localStorage){

		$scope.user = $localStorage.user;		
		$scope.search = {};

		AVService.getEstimations()			
			.then(function(data){					
				$scope.estimations = data.data;								
				$scope.estimationsfilter = data.data;
			},
			function(error){							
				setnotification(error.errors);
			});

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
			else{
				$scope.estimations = $scope.estimationsfilter;
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
		
	.controller('PresupuestoCtrl', ['$scope', '$routeParams', '$location', 'AVService','$rootScope','$localStorage', 
		function ($scope, $routeParams, $location, AVService,$rootScope,$localStorage) {
		$scope.user = $localStorage.user;
		$scope.token = $localStorage.token;	
		$scope.data = {};
		$scope.tab = false;
				
		AVService.getEstimation($routeParams.estimation_id)
			.then(function(data){
				$scope.estimation = data;
				console.log(data);
			},
			function(error){
				setnotification(error.errors);
			})

		$scope.comfirmOrder = function(id){
			var data = {id: id};
			if(window.confirm('¿Esta seguro de generar la orden?')){
				AVService.comfirmOrder(data)
					.then(function(data){
						// setnotification(data.success);
						$location.url('/ordenservicio/'+data.success.id);
					},
					function(error){
						setnotification(error.errors);
					})
			}
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

		$scope.sendextratype = function (id){			
			$scope.data.estimation_id = id;
			AVService.postExtratype($scope.data)
			.then(function(data){				
				location.reload();
			},function(){
				setnotification(error.errors);
			})
		}

		$scope.deleteExtratype = function(id){
			if( window.confirm('¿Seguro que quieres eliminar este artículo?') ){
				AVService.deleteExtratype(id)
					.then(function(data){
						setnotification(data.success);
						location.reload();
					},
					function(error){
						setnotification(error.errors);
					})
			}
		}
	}])

	.controller('EditPresupuestosCtrl', ['$scope', '$routeParams', '$location', 'AVService','$rootScope','$localStorage', 
		function ($scope, $routeParams, $location, AVService,$rootScope,$localStorage) {

		$scope.user = $localStorage.user;		
		$scope.datageneral = {};
		$scope.CPT = [];
		var listproducts = [];
		var estimacion = [];
		$scope.regex_number = /^[0-9]*$/;
		$scope.regex_float = /^[0-9]*(\.[0-9]+)?$/;
		$scope.datageneral.sub_iva = 0;
		var subtotal = 0;


		AVService.getUpdateEstimation($routeParams.estimation_id)
			.then(function(data){
				if(data.datageneral.iva == 1){
					data.datageneral.subtotal = parseFloat(data.datageneral.subtotal) + parseFloat(data.datageneral.sub_iva);
					data.datageneral.subtotal = data.datageneral.subtotal.toFixed(2);
					subtotal = data.datageneral.subtotal;
					data.datageneral.iva = true;
				}	
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
			subtotal = 0;
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

			if($scope.datageneral.iva){				
				$scope.datageneral.sub_iva = (parseFloat(subtotal) - parseFloat($scope.datageneral.discount)) * 0.16;								
				$scope.datageneral.subtotal = parseFloat($scope.datageneral.sub_iva) + parseFloat(subtotal) - parseFloat($scope.datageneral.discount);						
			}
			else{	
				$scope.datageneral.sub_iva = 0;		
				$scope.datageneral.subtotal = subtotal - parseFloat($scope.datageneral.discount);
			}

			$scope.datageneral.total = parseFloat($scope.datageneral.subtotal) + parseFloat($scope.datageneral.deposit);
			$scope.datageneral.balance = parseFloat($scope.datageneral.total) - parseFloat($scope.datageneral.advanced_payment);
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
			$scope.calculator();
			$scope.datageneral.subtotal = subtotal - $scope.datageneral.discount;
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

	.controller('NewPresupuestosCtrl', ['$scope', '$routeParams', '$location', 'AVService','$localStorage' , 
		function ($scope, $routeParams, $location, AVService,$localStorage) {
		$scope.user = $localStorage.user;		
		$scope.datageneral = {};		
		$scope.CPT = [];
		var listproducts = [];
		var estimacion = [];
		$scope.regex_number = /^[0-9]*$/;
		$scope.regex_float = /^[0-9]*(\.[0-9]+)?$/;
		$scope.calculo = false;
		$scope.datageneral.sub_iva = 0;
		var subtotal = 0;


		AVService.getCPT()
			.then(function(data){
				$scope.CPT = data;
			},
			function(error){
				
				setnotification(error.errors);
			})

		$scope.calculator = function (){
			$scope.calculo = true;
			var total = 0;
			subtotal = 0;

			angular.forEach($scope.CPT, function(element, index){
				angular.forEach(element.listproducts, function(element, index){
					angular.forEach(element.types, function(element, index){
						if(element.show == true){
							subtotal += element.rental_price * element.quantity;
						}
					})
				})
			})			

			if($scope.datageneral.iva){				
				$scope.datageneral.sub_iva = (parseFloat(subtotal) - parseFloat($scope.datageneral.discount)) * 0.16;								
				$scope.datageneral.subtotal = parseFloat($scope.datageneral.sub_iva) + parseFloat(subtotal) - parseFloat($scope.datageneral.discount);						
			}
			else{	
				$scope.datageneral.sub_iva = 0;		
				$scope.datageneral.subtotal = subtotal - parseFloat($scope.datageneral.discount);
			}

			$scope.datageneral.total = parseFloat($scope.datageneral.subtotal) + parseFloat($scope.datageneral.deposit);
			$scope.datageneral.balance = parseFloat($scope.datageneral.total) - parseFloat($scope.datageneral.advanced_payment);
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
			$scope.calculator();
			$scope.datageneral.subtotal = subtotal - $scope.datageneral.discount;
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