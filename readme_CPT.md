#Proyecto Grupo AV

##Usuarios

###Crear un nuevo usuario
Solicitud [POST] /newUser

	{
		"name": "Cristian",
		"email": "cristian@gmail.com",
		"password": "123",
		"password_confirmation": "123",
		"movil": "9611787547"
	}

respuesta
	
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

###Actualizar un usuario
Solicitud [UPDATE] /updateUser

	{
		"id": 2,
		"name": "Cristian",
		"email": "cristian@gmail.com",
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
			"password": "123",
			"password_confirmation": "123",
			"movil": "9611787547"
		},
		{
			"id": 2,
			"name": "Cristian",
			"email": "cristian@gmail.com",
			"password": "123",
			"password_confirmation": "123",
			"movil": "9611787547"
		}
	]

	Error
	{
		"errors":{
			"msg": ["Error"]
		}
	}

---

## Categorias

###Crear una nueva categoria
Solicitud [POST] /newCategory

	{
		"name":"Sillones"
	}

Respuesta

	Success
	{
		"id": 8,
		"name": "Sillones"
	}

	Error
	{
		"errors": {}
	}

###Actualizar categoria
Solicitud [UPDATE] /updateCategory

	{
		"id": 4,
		"name": "Silloncitos"
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

###Eliminar categoria
Solicitud [DELETE] /deleteCategory/{id}

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

---
## Productos

###Crear un nuevo producto
Solicitud [POST] /newProduct

	{
		"name": "Doble",
		"category_id": 1
	}

Respuesta
	
	Success
	{
		"id": 3,
		"name": "sillon",
		"category_id": 1
	}

	Error
	{
		"errors": {}
	}

###Actualizar producto
Solicitud [UPDATE] /updateProduct
	
	{
		"id": 3,
		"name": "sillon",
		"category_id": 1
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

###Eliminar producto
Solicitud [DELETE] /deleteProduct/{id}


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

###Obtener lista de productos
Solicitud [GET] /getListProduct/{idcategory}

Respuesta
	
	Success
	[
		{
			"id": 1,
			"name": Sencillo
		},
		{
			"id": 2,
			"name": Doble	
		}
	]

	Error
	{
		"errors":{
			"msg": ["Error"]
		}
	}
	
---

##Tipos

###Crear un nuevo tipo
Solicutud [POST] /newType

	{
		"name": "verde",
		"rental_price": 5.50,
		"product_id": 3
	}

Respuesta

	Success
	{
		"id": 6,
		"name": "verde",
		"rental_price": 5.50,
		"product_id": 3
	}

	Error
	{
		"errors": {}
	}

###Actualizar tipo
Solicitud [UPDATE] /updateType

	{
		"id": 6,
		"name": "verde",
		"rental_price": 5.50,
		"product_id": 3
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

###Eliminar tipo
Solicitud [DELETE] /deleteType/{id}

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


----

###Obtener Categorias, Productos y Tipos
Solicitud [GET] /CPT

	[
		//Categorias
		{
			"id": 1,
			"name": "mesas",
			"listproducts":[
				//Productos
				{
					"id": 1,
					"name": "sillon",
					"category_id": 1
					"types":[
						//Tipos
						{
							"id": 1,
							"name": "verde",
							"rental_price": 5.50,
						},
						{
							"id": 2,
							"name": "rojo",
							"rental_price": 5.50,
						}
					]
				}
			]
		}
	]

###Obtener lista de presupuestos
Solicitud [GET] /getlistEstimation

Respuesta
	
	Success
	[
		{
			"id":1,	
			"costumer_name":"Jose Jimenez",
			"date_event":"2015-12-12",
			"event_address":"Av. central No. 34",
			"home_address":"Av. central No. 34",
			"phone":"6533434543",
			"movil":"9612323322",
			"email":"correo@hotmail.com",
			"date_range":"2015-12-12",
			"date_collecting":"2015-12-12",
			"type":"coffy",
			"number_people":"233",
			"color":"blanco"
			"contact":"Contacto",
			"subtotal":1500,
			"deposit":500,
			"total":2000,
			"advanced_payment":400,
			"balance":1600,
			"discount":"2",
		},
		{
			"id": 2,
			"name": "4 x 3",
			"rental_price":1200,
			"getproduct":{
				"id":1,
				"name":"Sencilla",
				"getcategory":{
					"id":1,
					"name":"carpas"
				}
			},	
		}
	]

	Error
	{
		"errors":{
			"msg": ["Error"]
		}
	}
	
---
