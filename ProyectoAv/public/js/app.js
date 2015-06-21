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
		.when('/ordenservicio/:orden_id', {
			templateUrl: 'views/ordenservicio.html',
			controller: 'ordenServicioCtrl'
		})
		.when('/ordenes', {
			templateUrl: 'views/list-ordenes.html',
			controller: 'ListOrdenesCtrl'
		})
		.when('/pagos', {
			templateUrl: 'views/list-pagos.html',
			controller: 'ListPagosCtrl'
		})
		.when('/presupuestos', {
			templateUrl: 'views/list-presupuestos.html',
			controller: 'ListPresupuestosCtrl'
		})
		.when('/presupuesto/:estimation_id', {
			templateUrl: 'views/presupuesto.html',
			controller: 'PresupuestoCtrl'
		})
		.when('/update-presupuesto/:estimation_id', {
			templateUrl: 'views/update-presupuesto.html',
			controller: 'EditPresupuestosCtrl'
		})
		.when('/administrar-productos', {
			templateUrl: 'views/admin-products.html',
			controller: 'AdminProductCtrl'
		})
		.when('/administrar-usuarios', {
			templateUrl: 'views/admin-user.html',
			controller: 'AdminUserCtrl'
		})
		.when('/administrar-usuarios/:user_id', {
			templateUrl: 'views/update-user.html',
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