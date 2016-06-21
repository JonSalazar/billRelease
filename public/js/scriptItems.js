var globalNameItems;
var totalAddedItems;
var atStart = function() {
	globalNameItems = $('#nameItems').attr('data').split(',');
	totalAddedItems = 0;
    addRowItem(globalNameItems);
};

var itemComboOnChange = function() {
	// fill all 
	var selectedItems = {};
	selectedItems.list = [];
	for (var i = 0; i < totalAddedItems; i++) {
		var v = $('#itemComboId' + i).val();
		if (v === null)
			continue;
		selectedItems.list.push(v);
	}

	var callback = function(data) {
		var addElement = function(nCol, description, father) {
			var col = document.createElement('div');
			col.className = 'col-xs-' + nCol;
			var p = document.createElement('p');
			var node = document.createTextNode(description);
			p.appendChild(node);
			col.appendChild(p);
			father.appendChild(col);
		};
		var removeChildrens = function(id) {
			var myNode = document.getElementById(id);
			while (myNode.firstChild) {
			    myNode.removeChild(myNode.firstChild);
			}
		};
		// build detailOfBuy
		var detailOfBuy = document.getElementById('detailOfBuy');
		removeChildrens('detailOfBuy');
		for (var i = 0; i < data.description.length; i++) {
			addElement(4, data.description[i], detailOfBuy);
			addElement(2, data.model[i], detailOfBuy);
			addElement(2, data.amount[i], detailOfBuy);
			addElement(2, data.pu[i], detailOfBuy);
			addElement(2, data.subtotal[i], detailOfBuy);
		}
		
		// set all info variables
		$('#idDeposit').		text(data.idDeposit);
		$('#idBonusDeposit').	text(data.idBonusDeposit);
		$('#idTotalDept').		text(data.idTotalDept);
		$('#idDeptInWords').	text(data.idDeptInWords);

		// build monthlyPayments
		$('#detailOfPayments').attr('style','display:block');
		var monthlyPayments = document.getElementById('monthlyPayments');
		removeChildrens('monthlyPayments');
		for (var i = 0; i < 4; i++) {
			var col = document.createElement('div');
			col.className = 'col-xs-12';
			var p = document.createElement('p');

			var completeText =
			data.monthBy[i] +
			' ABONOS DE $ ' + 
			data.depositBy[i] +
			' TOTAL A PAGAR $ '+
			data.debtBy[i] + 
			' SE AHORRA $ ' +
			data.bonusBy[i];

			var node = document.createTextNode(completeText);
			p.appendChild(node);
			col.appendChild(p);
			monthlyPayments.appendChild(col);
		}
	};

	sendByAjax('billInfo', selectedItems, callback);
};

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
	for (var i = 0; i < nameItems_list.length; i+=2) {
		var option = document.createElement('option');
		// assign id item
		option.value = nameItems_list[i];
		// assign description item
		option.text = nameItems_list[i + 1];
		comboItem.appendChild(option);
	}

	
	colItem.appendChild(comboItem);
	row.appendChild(colItem);

	//	APPEND ALL
	con.appendChild(row);

	totalAddedItems++;
};
