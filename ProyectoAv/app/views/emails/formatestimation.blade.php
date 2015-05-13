<!DOCTYPE html>
<html>
<head>
	<title>Presupuesto</title>
	<style type="text/css">
		body{
			font-size: 13px;
		}
		table{
			border:1px solid #CCC;
			width: 100%;			
		}		
		.table-data td span{			
			border-bottom: 1px solid #000;
			margin-left: 10px;	
			padding: 0 5px;		
		}	
		.table-data{
			margin-top: 10px;
			border: 1px solid #CCC;			
		}		
		.table-articles{
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
		.table-section td span{
			background-color: red;
			width: 30px;
		}		
	</style>
</head>
<body>	
	<div class="img" style="border-radius:50px"></div>
	<table>
		<tr>
			<td width="100px">
				<img src="images/logoav.png" height="90px" width="90px">			
			</td>
			<td>
				<p>GRUPO <strong>AV</strong></p>				
				<p>RENTA Y BANQUETES</p>
			</td>
			<td>
				<p>Fecha de elaboracion</p>
				<p>tels</p>
			</td>
			<td>
				<p>folio</p>
				<p>datos de la empresa</p>
			</td>
		</tr>		
	</table>
	<table class="table-data">
		<tr>
			<td width="59%" colspan="2">NOMBRE <span> {{$estimation->costumer_name}}</span></td>			
			<td width="40%" colspan="2">FECHA DEL EVENTO <span> {{$estimation->date_event}}</span></td>			
		</tr>
		<tr>
			<td width="99%" colspan="4">DOM. DEL EVENTO <span>{{$estimation->event_address}}</span></td>
		</tr>
		<tr>
			<td width="99%" colspan="4">DOM. DEL PARTICULAR <span>{{$estimation->home_address}}</span></td>			
		</tr>
		<tr>
			<td width="10%">TEL <span>{{$estimation->phone}}</span></td>
			<td width="40%">EMAIL <span>{{$estimation->email}}</span></td>
			<td width="25%">SURTIR <span>{{$estimation->date_range}}</span></td>
			<td width="25%">RECOGER <span>{{$estimation->date_collecting}}</span></td>
		</tr>	
		<tr>
			<td width="18%">TIPO DE EVENTO<span>{{$estimation->type}}</span></td>
			<td width="20%">No. DE PERSONAS<span>{{$estimation->number_people}}</span></td>
			<td width="30%">COLOR<span>{{$estimation->color}}</span></td>
		</tr>	
	</table>
	<table class="table table-articles">
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
	<table class="table-section">
		<tr>
			<td rowspan="5" width="57%">Mensaje</td>
			<td>SUBTOTAL</td>			
			<td class="text-right">$<span>{{number_format($estimation->subtotal,2,'.',',')}}</span></td>
		</tr>
		<tr>
			<td>DEPOSITO</td>
			<td class="text-right">$<span>{{number_format($estimation->deposit,2,'.',',')}}</span></td>
		</tr>
		<tr>
			<td>TOTAL</td>			
			<td class="text-right">$<span>{{number_format($estimation->total,2,'.',',')}}</span></td>
		</tr>
		<tr>
			<td>ANTICIPO</td>
			<td class="text-right">$<span>{{number_format($estimation->advanced_payment,2,'.',',')}}</span></td>
		</tr>
		<tr>
			<td>SALDO</td>
			<td class="text-right">$<span>{{number_format($estimation->balance,2,'.',',')}}</span></td>
		</tr>				
	</table>	
</body>
</html>