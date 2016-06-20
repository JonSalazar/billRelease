var addRowArticle = function() {
	var con = document.getElementById('idArticlesContainer');
	var row = document.createElement('div');
	row.className = 'row';

	//	CREATE a combo for article
	var colArticle = document.createElement('div');
	colArticle.className = 'col-xs-8 col-lg-10';
	var comboArticle = document.createElement('select');
	comboArticle.className = 'form-control';
	var option = document.createElement('option');
	option.value = '';
	option.disabled = true;
	option.selected = true;
	option.text = 'Selecione un artículo';

	comboArticle.appendChild(option);
	colArticle.appendChild(comboArticle);
	row.appendChild(colArticle);

	//	CREATE a combo for amount
	var colAmount = document.createElement('div');
	colAmount.className = 'col-xs-4 col-lg-2';
	var comboAmount = document.createElement('select');
	comboAmount.className = 'form-control';

	for (var i = 1; i <= 10; i++) {
		var optionAmount = document.createElement('option');
		optionAmount.text = i;
		comboAmount.appendChild(optionAmount);
	}

	colAmount.appendChild(comboAmount);
	row.appendChild(colAmount);

	//	APPEND ALL
	con.appendChild(row);
}