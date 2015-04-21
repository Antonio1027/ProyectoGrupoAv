
##Presupuesto

###Comfirmar presupuesto
Solicitud [POST] /confirmestimation

	{
		"id": 4
	}

Respuesta

	Success
	{
		"success":{
			"msg":["Correcto"]
		}
	}

	Error
	{
		"errors":{
			"msg":["Error"]
		}
	}

###Crear un nuevo presupuesto
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

###Obtener presupuestos
Solicitud [GET] /getestimations

Respuesta
	
	Success
	{
		"data":[
			{
				"id": 001,
				"create_at": "2015-04-19 23:05:18",
				"date_event": "2015-05-19",
				"costumer_name": "Cristian Ramirez",
				"type": "Infantil",
				"phone": "9612783946"
			},
			{
				"id": 002,
				"create_at": "2015-04-19 23:05:18",
				"date_event": "2015-05-19",
				"costumer_name": "Cristian Ramirez",
				"type": "Infantil",
				"phone": "9612783946"
			}
		]
	}


###Obtener un presupuesto
Solicitud [GET] /getestimation

	{
		"id": 1
	}

Respuesta

	Success
	{
		"data":
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
	}

	Error
	{
		errors:{
			"msg":["Error"]
		}
	}

###Eliminar presupuesto
Solicitud [DELETE] /deleteestimation/{id}

Respuesta

	Success
	{
		"success":{
			"msg": ["Correcto"]
		}
	}

	Error
	{
		"errors": {
			"msg": ["Error"]
		}
	}