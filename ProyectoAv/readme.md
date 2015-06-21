#Proyecto Grupo AV

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

---

##Estimaciones

###Crear una nueva estimacion
Solicitud [POST] /newestimation

	[
		{
			"costumer_name": "Juan",
			"date_event": "2015-02-12",
			"event_address": "2015-02-15",
			"home_address": "Av. central Poniente No. 45",
			"phone": "6597854",
			"movil": "9611125467",
			"email": "shilong_92@hotmail.com",
			"date_range": "2015-02-10",
			"date_collecting": "2015-02-16",
			"type": "Coffe",
			"number_people": "200",
			"color": "blanco",
			"contact": "Fernando",
			"subtotal": "1200",
			"deposit": "300",
			"total": "500",
			"advanced_payment": "600",
			"balance": "1100",
			"discount": "1"
		},
		[
			{
				"id": 2,
				"quantity": 5
			},
			{
				"id": 1,
				"quantity": 1
			}
		]
	]

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
	
---