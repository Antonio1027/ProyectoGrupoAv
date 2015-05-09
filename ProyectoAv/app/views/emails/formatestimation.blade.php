<!DOCTYPE html>
<html>
<head>
	<title>Presupuesto</title>
</head>
<style type="text/css">
	body{
		font-family:sans-serif;
		-ms-text-size-adjust:100%;
		-webkit-text-size-adjust:100%;
	}
	table{		
		text-align: center;
	}
	.calculos{	
		margin-left: 70%;	
		width: 25%;
		text-align: right;
	}
</style>
<body>
<div>Presupuesto</div>
<h1>{{$estimation->id}}</h1>
	<table>	
		<thead>
			<tr>
				<th>#</th>
				<th>Articulos</th>
				<th>Cantidad</th>
				<th></th>
			</tr>	
		</thead>
		<tbody>
			@foreach($estimation->types as $index => $type)
			<tr>
				<td>{{$index + 1}}</td>
				<td>{{$type->product->category->name.' - '.$type->product->name.' - '. $type->name}}</td>
				<td>{{$type->pivot->quantity}}</td>
				<td></td>
			</tr>
			@endforeach
		</tbody>		
	</table>
	<table class="calculos">
		<tr>
			<td>SUBTOTAL</td>
			<td>${{number_format($estimation->subtotal,2,'.',',')}}</td>
		</tr>
		<tr>
			<td>DEPOSITO</td>
			<td>${{number_format($estimation->deposit,2,'.',',')}}</td>
		</tr>
		<tr>
			<td>TOTAL</td>
			<td>${{number_format($estimation->total,2,'.',',')}}</td>
		</tr>
		<tr>
			<td>ANTICIPO</td>
			<td>${{number_format($estimation->advanced_payment,2,'.',',')}}</td>
		</tr>
		<tr>
			<td>SALDO</td>
			<td>${{number_format($estimation->balance,2,'.',',')}}</td>
		</tr>
	</table>
</body>
</html>