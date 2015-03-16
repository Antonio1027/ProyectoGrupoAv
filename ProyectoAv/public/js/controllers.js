(function(){
	angular.module('controllers', [])
	.controller('PresupuestosCtrl', ['$scope', function ($scope) {
		$scope.catalogo = {
			carpa: false,
			carpaSencilla: false,
			carpaArabe: false
		};

		$scope.presupuesto = {};

		$scope.addToPresupuesto = function(element){
			var name = element;
			$scope.presupuesto[name] = {
				name: name,
				cuantity: 0,
				available: true
			}
			$scope.catalogo[name] = !$scope.catalogo[name];
		}

		$scope.removeFromPresupuesto = function(element){
			var name = element;
			$scope.catalogo[name] = !$scope.catalogo[name];
			$scope.presupuesto[name].available = false;
		}

		$scope.sendpresupuesto = function (){
			angular.forEach($scope.presupuesto, function(element, index){
				if(element.available == false)
					delete $scope.presupuesto[index];
			})
			console.log($scope.presupuesto);
		}
	}])
})()