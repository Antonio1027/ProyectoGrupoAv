# Configuracion JWT en laravel para acceso de usuarios
## Configuracion del archivo composer.json

require: 		
		 "tymon/jwt-auth": "0.4.*",
		 "barryvdh/laravel-cors":"0.2.x"	

ejecutar "composer update" para instalar dependencias

##Configuracion del archivo config/app.php
###Providers

[
	'Tymon\JWTAuth\Providers\JWTAuthServiceProvider'	
	'Barryvdh\Cors\CorsServiceProvider'
]

###Aliases
[
	'JWTAuth' 	 => 'Tymon\JWTAuth\Facades\JWTAuth',
	'JWTFactory' => 'Tymon\JWTAuth\Facades\JWTFactory'
]

###comandos para dependencias

secrete key para generacion de tokens
	"php artisan config:publish tymon/jwt-auth"
	"php artisan jwt:generate"  

Documentacion para uso de la libreria
https://github.com/tymondesigns/jwt-auth/wiki

dependencia para CORS
	"php artisan config:publish barryvdh/laravel-cors"

Documentacion para el uso de la libreria
https://github.com/barryvdh/laravel-cors/tree/0.2

##Configuracion del archivo app/public/.htaccess

###Agregar las siguientes lineas
Para insertar el token en el header de cada peticion
[
	RewriteCond %{HTTP:Authorization} ^(.*)
	RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
]

##Configuracion del filtro para validacion del token

Route::filter('jwt-auth',function($event){
	Event::listen('tymon.jwt.absent',$event);
	//...
});

##Configuracion del filtro en el archivo routes.php

Route::group(array('before' => 'jwt-auth'),function(){
	//routes
});

##Configuracion del archivo app/config/packages/tymon/jwt-auth/config.php

'user' => 'Notaria\Entities\User',

##Configuracion del archivo app/config/auth.php

'model' => 'Notaria\Entities\User',

##Vista
###Crear la vista login.html
###Crear partial menu.html para crear directiva

##Archivos JS

### Crear la directiva menu en el archivo directives.js
	
	.directive('menu', [function () {
		return {					
			templateUrl: 'partials/menu.html'
		};
	}])

### Agregar directiva a cada vista que podra acceder el usuario

<!-- <menu></menu> -->

### Cargar librerias

[
	<!-- <script src="lib/ngStorage.js"></script> --> : para almecenamiento de tokens y datos del usuario,
	<!-- <script src="lib/loading-bar.js"></script> --> : para mostrar una barra en cada peticion http	
]

##Importar librerias a  app.js

###Dependencias
	[
	'ngStorage',
	'angular-loading-bar'
	]

###Paramentros en la configuracion
	app.config(['$routeProvider','$httpProvider',function ($routeProvider,$httpProvider){...}

###Crear un interceptor para inyectar el token de authenticacion en cada peticion http

		$httpProvider.interceptors.push(['$q', '$location', '$localStorage', function ($q, $location, $localStorage) {          
	       return {
	           'request': function (config) {
	               config.headers = config.headers || {};                   
	               if ($localStorage.token) {                      
	                   config.headers.Authorization = 'Bearer ' + $localStorage.token;                       
	               }
	               return config;
	           },
	           'responseError': function (response) {
	               if (response.status === 401 || response.status === 403) {
	                   $location.path('/login');
	               }
	               return $q.reject(response);
	           }
	       };
	    }]);

###Definir controlador para las funciones para control de accesso
AuthCrtl

functions
[
	successAuth,
	signin,
	logout
]

###definir factory para las peticiones http

Auth

functions
[
	urlBase64Decode,
	getClaimsFromToken,
	signin,
	logout
]

##login laravel
Solicitud [post] /signin

data
[
	
]

-------------------------------------------------------------------

## Campos para la tabla de usuarios
### Campos
[
	id
	name
	email
	type
	username
	password
	movil
]

#Usuarios
##Creacion de usuario
Solicitud [POST] /newUser

data
{
	"name":"Jose",
	"email":"jose@gmail.com",
	"type":"administrador",
	"username":"jose102",
	"password":"123",
	"movil":"96112354"
}

Respuesta
	Success
	{
		"success"{
			"msg": ["Correcto"]
		}
	}

	Error
	{
		"errors":{
			"name": ["Nombre es un campo requerido"],
			"email": ["Email es un campo requerido"]
		}
	}

##Actualizar un usuario
Solicitud [UPDATE] /updateUser

	{
		"id": 2,
		"name": "Cristian",
		"email": "cristian@gmail.com",
		"username":"jose102",
		"password": "123",
		"password_confirmation": "123",
		"movil": "9611787547"
	}

Respuesta
	
	Success
	{
		"success":{
			"msg": ["Correcto"]
		}
	}

	Error
	{
		"errors": {}
	}

###Eliminar un usuario
Solicitud [DELETE] /deleteUser/{id}

Respuesta

	Success
	{
		"success":{
			"msg": ["Correcto"]
		}
	}

	Error
	{
		"errors":{
			"msg": ["Error"]
		}
	}

###Obtener usuarios
Solicitud [GET] /getUsers

Respuesta

	Success	
	[
		{
			"id": 1,
			"name": "Cristian",
			"email": "cristian@gmail.com",
			"username":"jose102",
			"password": "123",						
			"movil": "9611787547"
		},
		{
			"id": 2,
			"name": "Cristian",
			"email": "cristian@gmail.com",
			"username":"jose102",
			"password": "123",			
			"movil": "9611787547"
		}
	]

	Error
	{
		"errors":{
			"msg": ["Error"]
		}
	}

###Obtener usuario
Solicitud [GET] /getUser/id

Respuesta

	Success
	{
			"id": 1,
			"name": "Cristian",
			"email": "cristian@gmail.com",
			"username":"jose102",
			"password": "123",						
			"movil": "9611787547"			
	}

	Error
	{
		"errors":{
			"msg": ["Error"]
		}
	}






