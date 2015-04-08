(function(){
	angular.module('controllers', [])
	.controller('PresupuestosCtrl', ['$scope', 'AVService' , function ($scope, AVService) {
		$scope.catalogo = {
			carpa: false,
			carpaSencilla: false,
			carpaArabe: false
		};

		var presupuesto = [];
		$scope.products = [];

		AVService.getProducts()
			.then(function(data){
				$scope.products = data;
			},
			function(error){
				console.log(error);
			})

		$scope.sendpresupuesto = function (){
			angular.forEach($scope.products, function(element, index){
				angular.forEach(element.listproducts, function(element, index){
					if(element.show == false)
						presupuesto.push(element)
				})
			})

			console.log(presupuesto);
		}

		$scope.notification = function(){
			console.log('12');
			var noti = '<div class="notification animated" ng-show="noti" ng-click="noti = !noti" ng-class="{rotateInUpRight: noti, rotateOutUpRight: !noti}">';
				noti += '<span>Transferencia correcta</span>';
				noti += '</div>';
			$scope.noti = noti;
			// $('body').append(noti);
		}
	}])
})()