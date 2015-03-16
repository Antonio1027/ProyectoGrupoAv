(function(){
	app = angular.module('AV', [
		'ngRoute',
		'ngSanitize',
		'filters',
		'directives',
		'controllers',		
		]);

	app.config(['$routeProvider',function ($routeProvider) {
		$routeProvider
		.when('/', {
			templateUrl: 'views/form-presupuestos.html',
			controller: 'PresupuestosCtrl'
		})
		.otherwise({ 
			redirectTo: '/' 
		})
	}]);
})()