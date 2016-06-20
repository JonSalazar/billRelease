<!DOCTYPE html>
<html>
<head>
	<title>COP1</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<link rel="stylesheet" 	type="text/css" href="css/mystyle.css">
	<script src="js/scriptArticles.js"></script>
</head>
<body onLoad="atStart();">

<div class="header"></div>
<div class="container">

<!-- List of articles to edit -->
	<div class="row">
		<div id="idArticlesContainer" class="col-xs-offset-3 col-xs-6">
			<!-- This will be filled with javascript -->
		</div>
		<div class="col-xs-3">
			<button type="button" class="btn btn-info" onclick="addRowArticle();">+</button>
		</div>
	</div>


<!-- Input client info -->
	<div ng-app>
	<!-- Client name -->
		<div class="row" style="margin-top:20px">
			<div class="col-xs-2 col-xs-offset-1">
				<p>Nombre del cliente: </p>
			</div>
			<div class="col-xs-8">
				<input class="txtfield" type="text" ng-model="ngname" />
			</div>
		</div>
	<!-- Client Address -->
		<div class="row">
			<div class="col-xs-2 col-xs-offset-1">
				<p>Dirección: </p>
			</div>
			<div class="col-xs-8">
				<input class="txtfield" type="text" ng-model="ngaddress" />
			</div>
		</div>
	<!-- Client RFC-->
		<div class="row">
			<div class="col-xs-2 col-xs-offset-1">
				<p>RFC: </p>
			</div>
			<div class="col-xs-8">
				<input class="txtfield" type="text" ng-model="ngrfc" />
			</div>
		</div>
	<!-- Bill -->	
		<div class="row">
			<div class="billContainer col-xs-offset-1 col-xs-10">
			<!-- Name | Folio -->
				<div class="row">
					<div class="col-xs-8">
						<p>CLIENTE: {{ ngname }}</p>
					</div>
					<div class="col-xs-offset-1 col-xs-2">
						<label>FOLIO: <% $folio %></label>
					</div>
				</div>
			<!-- Address | RFC | Date -->
				<div class="row">
					<div class="col-xs-8">
						<p>{{ ngaddress }} RFC: {{ ngrfc }}</p>
					</div>
					<div class="col-xs-offset-1 col-xs-2">
						<label>FECHA: <% $now %></label>
					</div>
				</div>
			<!-- Detail -->
			<div class="row">
				<div class="col-xs-12">
					<center><p>DETALLE DE LA COMPRA</p></center>
				</div>
				<div class="col-xs-12">
					<hr width=100%>
				</div>
				
			</div>
						
				DESCRIPCIÓN 			MODELO 		CANTIDAD 		P.U. 			SUBTOTAL
				DEL ARTICULO
				--------------------------------------------------------------------------------------
				SALA COMEDOR 			T345 		1 				5,678.00 		5,678.00
				
														Enganche: 1,135.60
														Bonificación del enganche: 381.56
														Total de Adeudo: 4,160.84
				
				SON: (CUATRO MIL CIENTO SESENTA PESOS 84/100 M.N)
				
				ABONOS MENSUALES:
				3 ABONOS DE $ 1,125.33 TOTAL A PAGAR $ 3,376.00 SE AHORRA $ 784.84
				6 ABONOS DE $ 606.27 TOTAL A PAGAR $ 3,637.60 SE AHORRA $ 523.24
				9 ABONOS DE $ 433.24 TOTAL A PAGAR $ 3,899.20 SE AHORRA $ 261.64
				12 ABONOS DE $ 346.74 TOTAL A PAGAR $ 4,160.84 SE AHORRA $ 0.0

			</div>
		</div>
	</div>
</div>
</body>
</html>