<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>Presupuesto</title>
	<style type="text/css">
		body{
			font-size: 13px;
		}
		table{			
			width: 100%;			
		}
		.nums{					
		    margin-left: 40px;
		}	
		.capital{
			float:left;
		    color:black;		   		   
		    font-size:35px;		  
		    font-family:times;		   	  
		}	
		.phones{			
			display: inline-block;
			float: left;
			margin-top: 5px;
		}			
		.table-data td span{			
			border-bottom: 1px solid #000;
			margin-left: 10px;	
			padding: 0 5px;		
		}	
		.table-data{
			margin-top: 10px;			
		}	
		.table-data td{			
		}
		.table-articles{
			border: 1px solid #CCC; 
			text-align: center;						
			margin-top: 10px;			
		}
		.table-articles td{
			padding:5px 0;
		}		
		.table-articles tr:nth-child(even){			
			background-color: #CCC;
		}		
		.text-right{
			text-align: right;
		}
		.text-center{
			text-align: center;
		}	
		.text-left{
			text-align: left;
		}			
		.table-section{
			text-align: center;
			margin-top: 10px;
		}
		.red{
			background: #D8251B;
			color:white;
		}
		.table-section tr:first-child td:first-child p{
			font-size: 18px;
		}

		.table-section tr td:last-child{
			/*text-align: right;*/
			padding-left: -5px;
		}
		.table-section td span{
			background-color: red;
			width: 30px;
		}	
		.message{
			color: red;
			font-size: 16px;		
		}
		.border{
			border:1px solid #CCC;
		}
		footer{
			font-size: 12px;
			margin-top: 10px;
		}
		.header{
			padding-left: 10px;
		}		
		.header td p,div{
			margin: 0;
			padding: 0;
		}
		.top-data{
			margin-bottom: 10px;
		}		
		
	</style>
</head>
<body>		
	<table class="header">
		<tr>
			<td width="100px">
				<img src="images/logoav.png" height="90px" width="90px">			
			</td>
			<td width="150px">
				<p>GRUPO <strong>AV</strong></p>				
				<p>RENTA Y BANQUETES</p>
			</td>
			<td>				
				<div class="nums">
					<span class="capital">61</span>
					<div class="phones">
						<span>1.22.22</span>
						<br>				
						<span>2.34.91</span>
					</div>
				</div>				
				<div>
					<p>3A. SUR PONIENTE No. 1041</p>					
					<p>TUXTLA GUTIERREZ CHIAPAS</p>
					<p>grupoav@hotmail.com</p>
				</div>
			</td>
			<td class="text-center">
				<div style="border:1px solid #ccc; margin:-15 0 0 0;padding:10px 10px">
					<p>ORDEN DE SERVICIO</p>
					<p style="margin-bottom:10px; background:1px solid #EEE">{{$order->id}}</p>
				</div>
			</td>
		</tr>		
	</table>
	<table>
		<tr>
			<td class="text-center" width="33%">
				<div style="with:100%;border:1px solid #ccc; margin:5px 10px 0 0">
					<p>SURTIR</p>
					<p style="background:1px solid #EEE">{{$order->estimation->formatDate($order->estimation->date_range)}}</p>
				</div>
			</td>
			<td class="text-center" width="33%">
				<div style="with:100%;border:1px solid #ccc; margin:5px 10px 0 10px">
					<p>SIRVE</p>
					<p style="background:1px solid #EEE">{{$order->estimation->formatDate($order->estimation->date_event)}}</p>
				</div>
			</td>
			<td class="text-center" width="33%">
				<div style="with:100%;border:1px solid #ccc; margin:5px 0 0 10px">
					<p>RECOGER</p>
					<p style="background:1px solid #EEE">{{$order->estimation->formatDate($order->estimation->date_collecting)}}</p>
				</div>
			</td>
		</tr>		
	</table>
	<table class="table-data border">
		<tr>
			<td>NOMBRE</td>			
			<td colspan="2" style="border-bottom: 1px solid #FFF"><span>{{$order->estimation->costumer_name}}</span></td>			
			<td>RFC <span> {{$order->estimation->rfc}}</span></td>
		</tr>
		<tr>
			<td colspan="2" width="100px">DOM. DEL EVENTO</td>
			<td colspan="4"><span>{{$order->estimation->event_address}}</span></td>
		</tr>
		<tr>
			<td colspan="2">DOM. PARTICULAR</td>
			 <td colspan="2"><span>{{$order->estimation->home_address}}</span></td>			
		</tr>
		<tr>
			<td>TEL</td>
			<td><span>{{$order->estimation->phone}}</span></td>
			<td>EMAIL</td>
			<td><span>{{$order->estimation->email}}</span></td>			
		</tr>	
		<tr>
			<td colspan="2">TIPO DE EVENTO</td>
			<td><span>{{$order->estimation->type}}</span></td>
			<td colspan="2">No. DE PERSONAS<span>{{$order->estimation->number_people}}</span></td>			
			<td>COLOR</td>
			<td><span>{{$order->estimation->color}}</span></td>
		</tr>	
	</table>
	<table class="table table-articles border">
		<tr>
			<td>CANTIDAD</td>
			<td>CONCEPTO</td>
			<td>IMPORTE</td>
		</tr>
		@foreach($order->estimation->types as $articulo)
			<tr>
				<td>{{$articulo->pivot['quantity']}}</td>
				<td>{{$articulo->product->category->name.' '.$articulo->product->name.' '.$articulo->name}}</td>
				<td>${{number_format($articulo->pivot['quantity'] * $articulo->rental_price,2,'.',',')}}</td>
			</tr>
		@endforeach
	</table>		
	<table class="table-section border">
		<tr>
		@if($order->estimation->iva && $order->estimation->discount > 0)
			<td rowspan="9" width="70%" style="border:1px solid #ccc">
		@elseif($order->estimation->iva || $order->estimation->discount > 0)
			<td rowspan="7" width="70%" style="border:1px solid #ccc">
		@else
			<td rowspan="5" width="70%" style="border:1px solid #ccc">
		@endif
				<p class="red" style="font-size:14px;margin:0">EL EQUIPO SE RENTA POR DIA EVITE RECARGOS</p>
				<p style="font-size:10px" class="text-left">
					FAVOR DE REVISAR EL MOBILIARIO Y EQUIPO ESTEN COMPLETOS "NO CONFIE".
					EL COSTO DE RENTA <strong>NO</strong> INCLUYE EL SERVICION DE MONTAJE; EL EQUIPO MOJADO CAUSA RECARGOS
					(MESAS, FUNDAS, CAJAS DE CARTON O DE MADERA ETC)
					<strong>SUGERIMOS:</strong> EVITAR SUBIRSE ARRIBA DE SILLAS Y MESAS; EVITAR COLOCAR VELAS, CHOCOLATE LIQUIDO ETC; LA CERA,
					 GRASA, DAÑAN LA MANTELERIA.
					 <strong>SUGERIMOS</strong> COLOCAR CENICEROS PARA EVITAR QUEMADURAS A LA MANTELERIA; CUALQUIER DAÑO TOTAL O PARCIAL AL
					 MOBILIARIO O EQUIPO SE CARGARA A LA CUENTA DEL CONTRATANTE.
				</p> 
			</td>					
			<td>SUBTOTAL</td>				
			<td class="text-left">$ {{number_format($order->estimation->subtotal + $order->estimation->discount,2,'.',',')}}</td>			
		</tr>
		@if($order->estimation->discount > 0)
		<tr>
			<td>DESCUENTO</td>		
			<td class="text-left">$ -{{number_format($order->estimation->discount,2,'.',',')}}</td>
		</tr>
		<tr>
			<td></td>			
			<td class="text-left">$ {{number_format($order->estimation->subtotal,2,'.',',')}}</td>
		</tr>
		@endif
		@if($order->estimation->iva)
			<tr>
				<td>IVA</td>				
				<td class="text-left">$ +{{number_format($order->estimation->sub_iva,2,'.',',')}}</td>
			</tr>
			<tr>
				<td></td>				
				<td class="text-left">$ {{number_format($order->estimation->sub_iva + $order->estimation->subtotal - $order->estimation->discount,2,'.',',')}}</td>
			</tr>				
		@endif
		<tr>
			<td>DEPOSITO</td>
			<td class="text-left">$ +{{number_format($order->estimation->deposit,2,'.',',')}}</td>			
		</tr>
		<tr>
			<td>TOTAL</td>
			<td class="text-left">${{number_format($order->estimation->total,2,'.',',')}}</td>						
		</tr>
		<tr>
			<td>ANTICIPO</td>
			<td class="text-left">$ -{{number_format($order->estimation->advanced_payment,2,'.',',')}}</td>			
		</tr>
		<tr>
			<td>SALDO</td>
			<td class="text-left">${{number_format($order->estimation->balance,2,'.',',')}}</td>						
		</tr>				
	</table>
	<table style="margin-top:50px">
		<tr>
			<td class="text-center" width="33%">
				<div style="with:100%;border-top:1px solid #ccc; margin:5px 10px 0 0">
					<p>SURTIO NOMBRE Y FIRMA</p>					
				</div>
			</td>
			<td class="text-center" width="33%">
				<div style="with:100%;border-top:1px solid #ccc; margin:5px 10px 0 10px">
					<p>RECOGIO</p>					
				</div>
			</td>
			<td class="text-center" width="33%">
				<div style="with:100%;border-top:1px solid #ccc; margin:5px 0 0 10px">
					<p>RECIBIO EN EL ALMACEN</p>					
				</div>
			</td>
		</tr>	
	</table>	
</body>
</html>