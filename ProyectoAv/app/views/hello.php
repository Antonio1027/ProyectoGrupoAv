<!DOCTYPE html>
<html lang="en" ng-app="AV">
<head>
	<meta charset="UTF-8">
	<title>Grupo AV</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
</head>
<body>
	<header class="header">
		<div class="wrap">			
			<span class="btn-menu">*</span>
			<a href="#">
				<figure class="image">
					<img src="http://miguelnieva.github.io/mejorandolaconferencia/img/mejorandola.png" width="50" alt="">
				</figure>
				<h2 class="title">Grupo AV</h2>
			</a>
			<div class="menu">
				<nav class="menu-list">
					<li class="menu-item"><a href="#" class="menu-link">Presupuestos</a></li>
					<li class="menu-item"><a href="#" class="menu-link">Ordenes</a></li>
					<li class="menu-item"><a href="#" class="menu-link">Productos</a></li>
					<li class="menu-item"><a href="#" class="menu-link">Usuarios</a></li>
				</nav>
			</div>
		</div>
	</header>

	<div ng-view></div>

	<script src="lib/angular-route.min.js"></script>
	<script src="lib/angular-sanitize.min.js"></script>
	<script src="lib/jquery-2.1.3.min.js"></script>
	
	<script src="js/filters.js"></script>
	<script src="js/directives.js"></script>
	<script src="js/controllers.js"></script>
	<!-- 
	-->

	<script src="js/app.js"></script>
</body>
</html>