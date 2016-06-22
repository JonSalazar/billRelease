var globalNameItems;
var totalAddedItems;
var someItemAdded;
var atStart = function() {
	globalNameItems = $('#nameItems').attr('data').split(',');
	totalAddedItems = 0;
	someItemAdded = false;
    addRowItem(globalNameItems);
};

var itemComboOnChange = function() {
	// fill all 
	var selectedItems = {};
	selectedItems.list = getListItems(totalAddedItems);
	
	var depositValue = $('#txtBoxDeposit').val();
	selectedItems.depositPercent = depositValue == '' ? 0.00 : depositValue;

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
		$('#idTotalDebt').		text(data.idTotalDebt);
		$('#idDebtInWords').	text(data.idDebtInWords);

		// build monthlyPayments
		if (data.showMonthlyPayments) {
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
		} else {
			$('#detailOfPayments').attr('style','display:none');
		}
		someItemAdded = true;
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

var getListItems = function(nItems) {
	var ans = [];
	for (var i = 0; i < nItems; i++) {
		var v = $('#itemComboId' + i).val();
		if (v === null)
			continue;
		ans.push(v);
	}
	return ans;
};

var isNumber = function(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
};

var isPercent = function(evt, id) {
	if (!isNumber(evt))
		return false;

	evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    var finalNumber = $(id).val() + '' + String.fromCharCode(charCode);
    
	if (finalNumber > 100)
		return false;

	return true;
};

var finalizeBill = function() {
	if (!someItemAdded) {
		alert('No se puede finalizar la factura sin articulos');
		return;
	}
	var req 	= {};
	req.list 	= getListItems(totalAddedItems);
	req.name 	= $('#idName').val();
	req.address	= $('#idAddress').val();
	req.rfc 	= $('#idRFC').val();
	var callback = function(data) {
		if (!data.success) {
			var listErrors = 'No se finalizó por los siguientes errores: \n';
			for (var i = 0; i < data.errors.length; i++) {
				listErrors += data.errors[i] + '\n';
			}
			alert(listErrors);
			return;
		}

		$('#idFolio').text(data.idFolio);
		$('#idDate').text(data.idDate);
	};

	sendByAjax('billFinalize', req, callback);
};