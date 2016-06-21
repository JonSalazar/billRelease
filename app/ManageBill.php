<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class ManageBill extends Model
{
	public static function getDetailPayment($listIdItem) {
		// get a list of (items => amounts)
		$amounts = array();
		for ($i = 0; $i < count($listIdItem); $i++)
		{
			$key = $listIdItem[$i];
			if (empty($amounts[$key]))
			{
				$amounts[$key] = 0;
			}
			
			$plusOne = $amounts[$key] + 1;
			$newAmounts = array($key => $plusOne);
			$amounts = array_replace($amounts, $newAmounts);
		}

		// get a table items
		$itemsTable = ManageCbDatabase::getTableX('items');

		// get detailPayment
		$detailPayment = array(
			'description' 	=> array(),
			'model'			=> array(),
			'amount'		=> array(),
			'pu'			=> array(),
			'subtotal'		=> array()
			);
		foreach ($amounts as $idItem => $amount)
		{
			array_push($detailPayment['description'], $itemsTable[$idItem]->description);
			array_push($detailPayment['model'], $itemsTable[$idItem]->model);
			array_push($detailPayment['amount'], $amount);
			array_push($detailPayment['pu'], $itemsTable[$idItem]->pu);

			$subtotal = $itemsTable[$idItem]->pu * $amount;
			array_push($detailPayment['subtotal'], $subtotal);
		}

		return $detailPayment;
	}
}
