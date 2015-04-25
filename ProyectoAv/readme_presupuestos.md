
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

###Obtener lista de presupuestos
Solicitud [GET] /getEstimations

Respuesta
	
	Success
	{
		"data": [
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
			}
		]	
	}
		
	Error
	{
		"errors":{
			"msg": ["Error"]
		}
	}




###Obtener un presupuesto
Solicitud [GET] /getEstimation

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
Solicitud [DELETE] /deleteEstimation/{id}

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