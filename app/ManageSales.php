<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageSales extends Model
{
	public static function finalizeBill($listIdItems, $listAmountItems) {
		// new Bill
		$folio			= ManageCbDatabase::insertNewBill();
		$filledFolio	= str_pad($folio, 16, "0", STR_PAD_LEFT);

		$row			= ManageCbDatabase::getTableXById('bills', 'folio', $folio);
    	$date 			= $row->saleTime;
    	
    	
		// new Sales
		for ($i = 0; $i < count($listIdItems); $i++)
		{
			ManageCbDatabase::insertNewSale($listIdItems[$i], $folio, $listAmountItems[$i]);
		}
		

		// return final bill info
		return array(
    		'idFolio'	=> $filledFolio,
    		'idDate'	=> $date
    		);
	}
}
