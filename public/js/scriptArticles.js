var globalNameArticles;
var atStart = function() {
	globalNameArticles = $('#nameArticles').attr('data').split(',');
    addRowArticle(globalNameArticles);
};

var articleComboOnChange = function() {
	
}

var addRowArticle = function(nameArticles_list) {
	var con = document.getElementById('idArticlesContainer');
	var row = document.createElement('div');
	row.className = 'row';

	//	CREATE a combo for article
	var colArticle = document.createElement('div');
	colArticle.className = 'col-xs-12';
	var comboArticle = document.createElement('select');
	comboArticle.className = 'form-control';
	comboArticle.setAttribute('onchange', 'articleComboOnChange()');
	var option = document.createElement('option');
	option.value = '';
	option.disabled = true;
	option.selected = true;
	option.text = 'Selecione un artículo';
	comboArticle.appendChild(option);

	//	add articles descriptions
	for (var i = 0; i < nameArticles_list.length; i++) {
		var option = document.createElement('option');
		option.value = i;
		option.text = nameArticles_list[i];
		comboArticle.appendChild(option);
	}

	
	colArticle.appendChild(comboArticle);
	row.appendChild(colArticle);

	//	APPEND ALL
	con.appendChild(row);
};
