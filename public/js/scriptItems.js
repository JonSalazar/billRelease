var globalNameItems;
var totalAddedItems;
var atStart = function() {
	globalNameItems = $('#nameItems').attr('data').split(',');
	totalAddedItems = 0;
    addRowItem(globalNameItems);
};

var itemComboOnChange = function() {
	var selectedItems = {};
}

var addRowItem = function(nameItems_list) {
	var con = document.getElementById('idItemsContainer');
	var row = document.createElement('div');
	row.className = 'row';

	//	CREATE a combo for item
	var colItem = document.createElement('div');
	colItem.className = 'col-xs-12';
	var comboItem = document.createElement('select');
	comboItem.setAttribute('id', 'itemComboId' + totalAddedItems);
	comboItem.className = 'form-control';
	comboItem.setAttribute('onchange', 'itemComboOnChange()');
	var option = document.createElement('option');
	option.value = '';
	option.disabled = true;
	option.selected = true;
	option.text = 'Selecione un artículo';
	comboItem.appendChild(option);

	//	add items descriptions
	for (var i = 0; i < nameItems_list.length; i++) {
		var option = document.createElement('option');
		option.value = i;
		option.text = nameItems_list[i];
		comboItem.appendChild(option);
	}

	
	colItem.appendChild(comboItem);
	row.appendChild(colItem);

	//	APPEND ALL
	con.appendChild(row);

	totalAddedItems++;
};
