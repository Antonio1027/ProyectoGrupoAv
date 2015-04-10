(function(){
	app = angular.module('AV', [
		'ngAnimate',
		'ngRoute',
		'ngSanitize',
		'filters',
		'directives',
		'services',
		'controllers'
		]);

	app.config(['$routeProvider',function ($routeProvider) {
		$routeProvider
		.when('/', {
			templateUrl: 'views/new-presupuestos.html',
			controller: 'PresupuestosCtrl'
		})
		.when('/ordenservicio', {
			templateUrl: 'views/ordenservicio.html',
			controller: 'PresupuestosCtrl'
		})
		.when('/ordenes', {
			templateUrl: 'views/list-ordenes.html',
			controller: 'PresupuestosCtrl'
		})
		.when('/presupuestos', {
			templateUrl: 'views/list-presupuestos.html',
			controller: 'PresupuestosCtrl'
		})
		.when('/administrar-productos', {
			templateUrl: 'views/admin-products.html',
			controller: 'PresupuestosCtrl'
		})
		.otherwise({ 
			redirectTo: '/' 
		})
	}]);

	$win = $(window);
	$win.scroll(function(){
		if( $win.scrollTop() == 0)
			$('.header').removeClass('alpha');
		else
			$('.header').addClass('alpha');
	});
	
})()