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
		.table-section tr:first-child td:first-child{
			background: #D8251B;
			color:white;
		}
		.table-section tr:first-child td:first-child p{
			font-size: 18px;
		}

		.table-section tr td:last-child{
			text-align: right;
			padding-right: 85px;
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
				<p class="text-center" style="margin-bottom:15px; background:1px solid #EEE"><span>Fecha: </span>{{$estimation->date_created}}</p>
				<div class="nums">
					<span class="capital">61</span>
					<div class="phones">
						<span>1.22.22</span>
						<br>				
						<span>2.34.91</span>
					</div>
				</div>				
			</td>
			<td class="text-center">
				<p style="margin-bottom:10px; background:1px solid #EEE"><span>Folio: </span>{{$estimation->id}}</p>
				<div>
					<p>3A. SUR PONIENTE No. 1041</p>					
					<p>TUXTLA GUTIERREZ CHIAPAS</p>
					<p>grupoav@hotmail.com</p>
				</div>
			</td>
		</tr>		
	</table>
	<table class="table-data border">
		<tr>
			<td>NOMBRE</td>			
			<td colspan="3"> <span>{{$estimation->costumer_name}}</span></td>
			<td>FECHA DEL EVENTO</td>
			<td colspan="3"><span>{{$estimation->date_event}}</span></td>
		</tr>
		<tr>
			<td colspan="2" width="100px">DOM. DEL EVENTO</td>
			<td colspan="4"><span>{{$estimation->event_address}}</span></td>
		</tr>
		<tr>
			<td colspan="2">DOM. PARTICULAR</td>
			 <td colspan="2"><span>{{$estimation->home_address}}</span></td>
			<td>RECOGER</td>			
			<td colspan="2"><span>{{$estimation->date_collecting}}</span></td>
		</tr>
		<tr>
			<td>TEL</td>
			<td><span>{{$estimation->phone}}</span></td>
			<td>EMAIL</td>
			<td><span>{{$estimation->email}}</span></td>
			<td>SURTIR</td>			
			<td colspan="2"><span>{{$estimation->date_range}}</span></td>
		</tr>	
		<tr>
			<td colspan="2">TIPO DE EVENTO</td>
			<td><span>{{$estimation->type}}</span></td>
			<td colspan="2">No. DE PERSONAS<span>{{$estimation->number_people}}</span></td>			
			<td>COLOR</td>
			<td><span>{{$estimation->color}}</span></td>
		</tr>	
	</table>
	<table class="table table-articles border">
		<tr>
			<td></td>
			<td>ARTICULOS</td>
			<td></td>
		</tr>
		@foreach($estimation->types as $articulo)
			<tr>
				<td>{{$articulo->pivot['quantity']}}</td>
				<td>{{$articulo->product->category->name.' '.$articulo->product->name.' '.$articulo->name}}</td>
				<td>${{number_format($articulo->pivot['quantity'] * $articulo->rental_price,2,'.',',')}}</td>
			</tr>
		@endforeach
	</table>	
	<table class="message text-center border">
		<tr>
			<td colspan="3">VIDEO FILMACIONES: 961 2629 030 OFIC.: 613-86-79</td>
		</tr>
	</table>	
	<table class="table-section border">
		<tr>
		@if($estimation->iva && $estimation->discount > 0)								
			<td rowspan="9" width="57%" class="text-center">
		@elseif($estimation->iva)				
			<td rowspan="7" width="57%" class="text-center">
		@else	
			<td rowspan="5" width="57%" class="text-center">			
		@endif	
			<p>EL EQUIPO SE RENTA POR DIA EVITE RECARGOS</p>
		@if(! $estimation->iva)	
			<p>NOTA: ESTOS PRECIOS NO INCLUYEN I.V.A.</p>
		@endif	
			</td>
			@if($estimation->discount > 0)
				<td>SUBTOTAL</td>
				<td width="10%" class="text-right">$</td>			
				<td>{{number_format($estimation->subtotal + $estimation->discount,2,'.',',')}}</td>
			@else
				<td>SUBTOTAL</td>
				<td width="10%" class="text-right">$</td>			
				<td>{{number_format($estimation->subtotal,2,'.',',')}}</td>
			@endif
		</tr>
		@if($estimation->discount > 0)
		<tr>
			<td>DESCUENTO</td>
			<td width="10%" class="text-right">$</td>			
			<td>- {{number_format($estimation->discount,2,'.',',')}}</td>
		</tr>
		<tr>
			<td></td>
			<td width="10%" class="text-right">$</td>			
			<td>{{number_format($estimation->subtotal,2,'.',',')}}</td>
		</tr>
		@endif
		@if($estimation->iva)
			<tr>
				<td>IVA</td>
				<td width="10%" class="text-right">$</td>			
				<td>+ {{number_format($estimation->sub_iva,2,'.',',')}}</td>
			</tr>
			<tr>
				<td></td>
				<td width="10%" class="text-right">$</td>			
				<td>{{number_format($estimation->sub_iva + $estimation->subtotal,2,'.',',')}}</td>
			</tr>				
		@endif
		<tr>
			<td>DEPOSITO</td>
			<td width="10%" class="text-right">$</td>
			<td>+ {{number_format($estimation->deposit,2,'.',',')}}</td>
		</tr>
		<tr>
			<td>TOTAL</td>
			<td width="10%" class="text-right">$</td>			
			<td>{{number_format($estimation->total,2,'.',',')}}</td>
		</tr>
		<tr>
			<td>ANTICIPO</td>
			<td width="10%" class="text-right">$</td>
			<td>- {{number_format($estimation->advanced_payment,2,'.',',')}}</td>
		</tr>
		<tr>
			<td>SALDO</td>
			<td width="10%" class="text-right">$</td>			
			<td>{{number_format($estimation->balance,2,'.',',')}}</td>
		</tr>		
	</table>	
	<table class="border" style="border-top: 1px solid #FFF;padding:7px 5px;">
		<tr>
			<td>
				FAVOR DE REVISAR EL MOBILIARIO Y EQUIPO ESTEN COMPLETOS "NO CONFIE".
				EL COSTO DE RENTA <strong>NO</strong> INCLUYE EL SERVICION DE MONTAJE; EL EQUIPO MOJADO CAUSA RECARGOS
				(MESAS, FUNDAS, CAJAS DE CARTON O DE MADERA ETC)
				<strong>SUGERIMOS:</strong> EVITAR SUBIRSE ARRIBA DE SILLAS Y MESAS; EVITAR COLOCAR VELAS, CHOCOLATE LIQUIDO ETC; LA CERA,
				 GRASA, DAÑAN LA MANTELERIA.
				 <strong>SUGERIMOS</strong> COLOCAR CENICEROS PARA EVITAR QUEMADURAS A LA MANTELERIA; CUALQUIER DAÑO TOTAL O PARCIAL AL
				 MOBILIARIO O EQUIPO SE CARGARA A LA CUENTA DEL CONTRATANTE.
			</td>		 
		</tr>	
	</table>
</body>
</html>