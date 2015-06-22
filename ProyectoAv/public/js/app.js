(function(){
	app = angular.module('AV', [
		'ngAnimate',
		'ngRoute',
		'ngSanitize',
		'filters',
		'directives',
		'services',
		'controllers',
		'ngStorage',
		'angular-loading-bar'
		])

	.constant('urls',{
		BASE:'http://localhost:8080/ProyectoGrupoAv/ProyectoAv/public/',
		BSE_API: 'http://localhost:8080/ProyectoGrupoAv/ProyectoAv/public/'
	})

	.config(['$routeProvider','$httpProvider',function ($routeProvider,$httpProvider) {
		$routeProvider
		.when('/', {
           templateUrl: 'views/login.html',
           controller: 'AuthCtrl'
         })	
        .when('/logout/:status', {
           templateUrl: 'views/login.html',
           controller: 'AuthCtrl'
        })		
		.when('/presupuesto', {
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
		});

		$httpProvider.interceptors.push(['$q', '$location', '$localStorage', function ($q, $location, $localStorage) {          			
	       return {
	           'request': function (config) {
	               config.headers = config.headers || {};                   	           	   
	               if ($localStorage.token) {                      
	                   config.headers.Authorization = 'Bearer ' + $localStorage.token;
	               }
	               else 
	               		$location.path('/');

	               return config;
	           },
	           'responseError': function (response) {	           			               
	               if (response.status === 401 || response.status === 403 || response.status === 404 || response.status === 500 || response.status === 400) {
                       $location.path('/logout/true');
                   }
	               return $q.reject(response);
	           }
	       };
	    }]);	
	}]);

	$win = $(window);
	$win.scroll(function(){
		if( $win.scrollTop() == 0)
			$('.header').removeClass('alpha');
		else
			$('.header').addClass('alpha');
	}); 	
	
})()