#Proyecto Grupo AV

###Crear un nuevo usuario
Solicitud [POST] /newuser

	{
		"name": "Cristian",
		"email": "cristian@gmail.com",
		"password": "123",
		"movil": "9611787547"
	}

###Crear una nueva categoria
Solicitud [POST] /newcategory

	{
		"name":"Sillones"
	}

##Crear un nuevo producto
Solicitud [POST] /newproduct

	{
		"name": "sillon",
		"rental_price": 5.50,
		"reserve": 5,
		"total": 10,
		"category_id": 1
	}

###Crear un nuevo tipo
Solicutud [POST] /newtype

	{
		"name": "verde",
		"product_id": 3
	}

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