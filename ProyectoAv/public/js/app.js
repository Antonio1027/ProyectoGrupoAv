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
			controller: 'NewPresupuestosCtrl'
		})
		.when('/ordenservicio', {
			templateUrl: 'views/ordenservicio.html',
			controller: ''
		})
		.when('/ordenes', {
			templateUrl: 'views/list-ordenes.html',
			controller: ''
		})
		.when('/presupuestos', {
			templateUrl: 'views/list-presupuestos.html',
			controller: 'ListPresupuestosCtrl'
		})
		.when('/presupuesto/:estimation_id', {
			templateUrl: 'views/presupuesto.html',
			controller: 'PresupuestoCtrl'
		})
		.when('/administrar-productos', {
			templateUrl: 'views/admin-products.html',
			controller: 'AdminProductCtrl'
		})
		.when('/administrar-usuarios', {
			templateUrl: 'views/admin-user.html',
			controller: 'AdminUserCtrl'
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