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
						<p>FOLIO: <% $folio %></p>
					</div>
				</div>
			<!-- Address | RFC | Date -->
				<div class="row">
					<div class="col-xs-8">
						<p>{{ ngaddress }} RFC: {{ ngrfc }}</p>
					</div>
					<div class="col-xs-offset-1 col-xs-2">
						<p>FECHA: <% $now %></p>
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
		<!-- Article list -->
		@for ($i = 0; $i < $nElements; $i++)
			<div class="row">
				<div class="col-xs-4">
					<p><% $articleDetail[$i] %></p>
				</div>
				<div class="col-xs-2">
					<p><% $model[$i] %></p>
				</div>
				<div class="col-xs-2">
					<p><% $amount[$i] %></p>
				</div>
				<div class="col-xs-2">
					<p><% $pu[$i] %></p>
				</div>
				<div class="col-xs-2">
					<p><% $subtotal[$i] %></p>
				</div>
			</div>	
		@endfor
		
		<!-- Summary -->
		<div class="row">
			<div class="col-xs-offset-4 col-xs-4" align="right">
				<p>Enganche: </p>
			</div>
			<div class="col-xs-4" align="left">
				<p><% $deposit %></p>
			</div>

			<div class="col-xs-offset-4 col-xs-4" align="right">
				<p>Bonificación del enganche: </p>
			</div>
			<div class="col-xs-4" align="left">
				<p><% $bonusDeposit %></p>
			</div>

			<div class="col-xs-offset-4 col-xs-4" align="right">
				<p>Total de Adeudo: </p>
			</div>
			<div class="col-xs-4" align="left">
				<p><% $totalDebt %></p>
			</div>
		</div>

		<!-- Money in words -->
		<div class="row">
			<div class="col-xs-12">
				<p>SON: (<% $totalInWords %>)</p>
			</div>
		</div>

		<!-- Monthly payments -->
		<div class="row">
			<div class="col-xs-12">
				<p>ABONOS MENSUALES:</p>
			</div>

			@for ($i = 0; $i < 4; $i++)
				<div class="col-xs-12">
					<p><% $mounthBy[$i] %> ABONOS DE $ <% $payBy[$i] %> TOTAL A PAGAR $ <% $totalBy[$i] %> SE AHORRA $ <% $bonusBy[$i] %></p>
				</div>
			@endfor
			
		</div>

	</div> <!-- /ng-app -->
</div><!-- /container -->
</body>
</html>