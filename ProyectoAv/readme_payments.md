## Control de pagos

### Lista de pagos
Solicitud [GET] /getPayments

Respuesta

	Success
	{
		"data":
			[
				{
					"id":1,
					"number":2,
					"amount":12333.34,
					"description": descripcion del pago,
					"order":{
						"id",
						"available_facture":0,
						"status":1,
						"pay":1,
						"observations": observaciones,
						"estimation_id": 2
					}
				}
			]
	}

### Nuevo pago
Solicitud [POST] /newPayment

Send data	
	{
		"amount":1233.5,
		"description": Descripcion del pago,
		"order_id":1
	}
	
Respuesta
	Success
	{
		"success":{
			"msg":["correcto"]
		}
	}
	Error
	{
		"error":[]
	}

### Obtener un pago
Solicitud [GET] /getPayment/{id}

Respuesta
	
	Success
	{
		"data":
			{
				"id":1,
				"number":2,
				"amount":12333.34,
				"description": descripcion del pago,
				"order":{
					"id",
					"available_facture":0,
					"status":1,
					"pay":1,
					"observations": observaciones,
					"estimation_id": 2
				}
			}
	}

	Error
	{
		errors:
		{
			"msg": ["error"]
		}
	}

###Eliminar pago
Solicitud [DELETE] /deletePayment/{id}
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

###Actualizar pago
Solicitud [PUT]	/updatePaymet/{id}

Send data
	{		
		"amount":1233.5,
		"description": Descripcion del pago,		
	}

	Success
	{
		"success":{
			"msg":["Correcto"]
		}
	}

	Error
	{
		"errors":{
			"msg": ["Error"]
		}
	}