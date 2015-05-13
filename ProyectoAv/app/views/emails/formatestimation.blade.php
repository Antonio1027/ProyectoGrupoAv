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
			border-radius: 50px;
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
		footer{
			font-size: 12px;
			margin-top: 10px;
		}		
		
	</style>
</head>
<body>		
	<table style="border-radius:10px">
		<tr>
			<td width="100px">
				<img src="images/logoav.png" height="90px" width="90px">			
			</td>
			<td width="150px">
				<p>GRUPO <strong>AV</strong></p>				
				<p>RENTA Y BANQUETES</p>
			</td>
			<td>
				<span class="text-center">Fecha {{$estimation->created_at}}</span>
				<div class="nums">
					<span class="capital">61</span>
					<div class="phones">
						<span>1.22.22</span>
						<br>				
						<span>2.34.91</span>
					</div>
				</div>				
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
	<table class="message text-center">
		<tr>
			<td colspan="3">VIDEO FILMACIONES: 961 2629 030 OFIC.: 613-86-79</td>
		</tr>
	</table>	
	<table class="table-section">
		<tr>
			<td rowspan="5" width="57%" class="text-center">
				<p>EL EQUIPO SE RENTA POR DIA EVITE RECARGOS</p>
				<p>NOTA: ESTOS PRECIOS NO INCLUYEN I.V.A.</p>
			</td>
			<td>SUBTOTAL</td>
			<td width="10%" class="text-right">$</td>			
			<td>{{number_format($estimation->subtotal,2,'.',',')}}</td>
		</tr>
		<tr>
			<td>DEPOSITO</td>
			<td width="10%" class="text-right">$</td>
			<td>{{number_format($estimation->deposit,2,'.',',')}}</td>
		</tr>
		<tr>
			<td>TOTAL</td>
			<td width="10%" class="text-right">$</td>			
			<td>{{number_format($estimation->total,2,'.',',')}}</td>
		</tr>
		<tr>
			<td>ANTICIPO</td>
			<td width="10%" class="text-right">$</td>
			<td>{{number_format($estimation->advanced_payment,2,'.',',')}}</td>
		</tr>
		<tr>
			<td>SALDO</td>
			<td width="10%" class="text-right">$</td>			
			<td>{{number_format($estimation->balance,2,'.',',')}}</td>
		</tr>				
	</table>	
	<table>
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