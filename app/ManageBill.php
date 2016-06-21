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
			$item = $listIdItem[$i];
			if (empty($amounts[$item]))
			{
				$amounts[$item] = 0;
			}
			
			$plusOne = $amounts[$item] + 1;
			$newAmounts = array($item => $plusOne);
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
			$item = ManageCbDatabase::getTableXById('items', $idItem);

			array_push($detailPayment['description'], $item->description);
			array_push($detailPayment['model'], $item->model);
			array_push($detailPayment['amount'], $amount);

			$pu = $item->pu;
			$pu += ManageBill::getInteresetInMonths($pu, 2.8, 12);
			$puString = (string)ManageBill::formatDecimalN($pu, 2);
			array_push($detailPayment['pu'], $puString);

			$subtotal = $pu * $amount;
			$subtotalString = (string)ManageBill::formatDecimalN($subtotal, 2);
			array_push($detailPayment['subtotal'], $subtotalString);
		}

		return $detailPayment;
	}

	private static function formatDecimalN($number, $nDecimal) {
		return number_format((float)$number, $nDecimal, '.', '');
	}

	private static function getPorcent($number, $porcent) {
		return (float)$number * ($porcent / 100.0);
	}

	private static function getInteresetInMonths($number, $porcent, $months) {
		return ManageBill::getPorcent($number, $porcent) * $months;
	}
}
