<!DOCTYPE html>
<html>
<head>
	<title>COP1</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<link rel="stylesheet" 	type="text/css" href="css/mystyle.css">
	<script src="js/scriptItems.js"></script>
</head>
<body onLoad="atStart();">
<div id="nameItems" data="<% $nameItems %>" style="display:none"></div>
<!-- Get item names -->
<div class="header"></div>
<div class="container">

<!-- List of items to edit -->
	<div class="row">
		<div id="idItemsContainer" class="col-xs-offset-2 col-xs-8">
			<!-- This will be filled with javascript -->
		</div>
		<div class="col-xs-2">
			<button type="button" class="btn btn-info" onclick="addRowItem(globalNameItems);">+</button>
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
						<p>FOLIO: </p> <!--@@-->
					</div>
				</div>
			<!-- Address | RFC | Date -->
				<div class="row">
					<div class="col-xs-8">
						<p>{{ ngaddress }} RFC: {{ ngrfc }}</p>
					</div>
					<div class="col-xs-offset-1 col-xs-2">
						<p>FECHA: </p><!--@@-->
					</div>
				</div>
			<!-- Title Detail of buy -->
				<div class="row">
					<div class="col-xs-12">
						<center><p>DETALLE DE LA COMPRA</p></center>
					</div>
					<div class="col-xs-12">
						<hr width=100%>
					</div>
					<div class="col-xs-4">
						<p>DESCRIPCIÓN DEL ARTÍCULO</p>
					</div>
					<div class="col-xs-2">
						<p>MODELO</p>
					</div>
					<div class="col-xs-2">
						<p>CANTIDAD</p>
					</div>
					<div class="col-xs-2">
						<p>P.U.</p>
					</div>
					<div class="col-xs-2">
						<p>SUBTOTAL</p>
					</div>
					<div class="col-xs-12">
						<hr width=100%>
					</div>
				</div>
		
		<!-- Summary -->
		<div class="row">
			<div class="col-xs-offset-4 col-xs-4" align="right">
				<p>Enganche: </p>
			</div>
			<div class="col-xs-4" align="left">
				<p></p><!--@@-->
			</div>

			<div class="col-xs-offset-4 col-xs-4" align="right">
				<p>Bonificación del enganche: </p>
			</div>
			<div class="col-xs-4" align="left">
				<p></p><!--@@-->
			</div>

			<div class="col-xs-offset-4 col-xs-4" align="right">
				<p>Total de Adeudo: </p>
			</div>
			<div class="col-xs-4" align="left">
				<p></p><!--@@-->
			</div>
		</div>

	<!-- Details of payments -->
		<div id="detailOfPayments" style="display:none">
		<!-- Money in words -->
			<div class="row">
				<div class="col-xs-12">
					<p>SON: </p><!--@@-->
				</div>
			</div>

		<!-- Monthly payments -->
			<div class="row">
				<div class="col-xs-12">
					<p>ABONOS MENSUALES:</p>
				</div>
			</div>
		</div>
	</div> <!-- /ng-app -->
</div><!-- /container -->
</body>
</html>