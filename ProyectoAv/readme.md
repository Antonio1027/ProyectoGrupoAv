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
		"msg": "Correcto"
	}

	Error
	{
		"errors":{
			"name": "Nombre es un campo requerido",
			"email": "Email es un campo requerido"
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
		"msg": "Correcto"
	}

	Error
	{
		"errors": {}
	}

###Eliminar un usuario
Solicitud [DELETE] /deleteUser

	{
		"id": 3
	}

Respuesta

	Success
	{
		"msg": "Correcto"
	}

	Error
	{
		"msg": "Error"
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
		"msg": "Error"
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
		"msg": "Correcto"
	}

	Error
	{
		"errors": {}
	}

###Eliminar categoria
Solicitud [DELETE] /deleteCategory

	{
		"id": 3
	}

Respuesta 

	Success
	{
		"msg": "Correcto"
	}

	Error
	{
		"msg": "Error"
	}

###Obtener lista de categorias
Solicitud [GET] /getListCategory

Respuesta
	
	Success
	{
		"1": "Sillones",
		"2": "Mesas",
		"3": "Carpas"
	}

---
## Productos

###Crear un nuevo producto
Solicitud [POST] /newProduct

	{
		"name": "sillon",
		"rental_price": 5.50,
		"reserve": 5,
		"total": 10,
		"category_id": 1
	}

Respuesta
	
	Success
	{
		"id": 3,
		"name": "sillon",
		"rental_price": 5.50,
		"reserve": 5,
		"total": 10,
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
		"rental_price": 5.50,
		"reserve": 5,
		"total": 10,
		"category_id": 1
	}

Respuesta

	Success
	{
		"msg": "Correcto"
	}

	Error
	{
		"errors": {}
	}

###Eliminar producto
Solicitud [DELETE] /deleteProduct

	{
		"id": 3
	}

Respuesta

	Success
	{
		"msg": "Correcto"
	}

	Error
	{
		"msg": "Error"
	}

###Obtener lista de productos
Solicitud [GET] /getListProduct/{idcategory}

Respuesta
	
	Success
	{
		"1": "Sencillo",
		"2": "Doble"
	}

	Error
	{
		"msg": "Error"
	}
	
---

##Tipos

###Crear un nuevo tipo
Solicutud [POST] /newType

	{
		"name": "verde",
		"product_id": 3
	}

Respuesta

	Success
	{
		"id": 6,
		"name": "verde",
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
		"product_id": 3
	}

Respuesta
	
	Success
	{
		"msg": "Correcto"
	}

	Error
	{
		"errors": {}
	}

###Eliminar tipo
Solicitud [DELETE] /deleteType

	{
		"id": 5
	}

Respuesta

	Success
	{
		"msg": "Correcto"
	}

	Error
	{
		"msg": "Error"
	}

---

##Estimaciones

###Crear una nueva estimacion
Solicitud [POST] /newestimation

	[
		{
			"name": "",
			"event_date": "",
			"event_address": "",
			"home_address": "",
			"phone": "",
			"movil": "",
			"email": "",
			"date_range": "",
			"date_collecting": "",
			"type": "",
			"number_people": "",
			"color": "",
			"contact": "",
			"subtotal": "",
			"deposit": "",
			"total": "",
			"advance_payment": "",
			"balance": "",
			"discount": ""
		},
		[
			{
				"type_id": 2,
				"product_id": 2,
			},
			{
				"type_id": 1,
				"product_id": 1,
			}
		]
	]

Respuesta

	Success
	{
		"msg": "Correcto"
	}

	Error
	{
		"errors": {}
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
					"rental_price": 5.50,
					"reserve": 5,
					"total": 10,
					"category_id": 1
					"types":[
						//Tipos
						{
							"id": 1,
							"name": "verde"
						},
						{
							"id": 2,
							"name": "rojo"
						}
					]
				}
			]
		}
	]