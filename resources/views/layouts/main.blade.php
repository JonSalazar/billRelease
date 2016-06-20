<!DOCTYPE html>
<html>
<head>
	<title>COP1</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" 	type="text/css" href="css/mystyle.css">
	<script src="js/scriptArticles.js"></script>
</head>
<body onLoad="addRowArticle();">

<div class="header"></div>
<div class="container">

<!-- List of articles to edit -->
	<div class="row">
		<div id="idArticlesContainer" class="col-xs-6 col-xs-push-3">
			<!-- This will be filled with javascript -->
		</div>
		<div class="col-xs-3 col-xs-push-3">
			<button type="button" class="btn btn-info" onclick="addRowArticle();">+</button>
		</div>
	</div>

<!-- Bill -->
	<div class="row">
		<div class="billContainer col-xs-10 col-xs-push-1">
			
		</div>
	</div>
</div>
</body>
</html>