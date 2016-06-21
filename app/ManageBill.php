<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class ManageBill extends Model
{
	public static function getDetailPayment($listIdItem, $depositPorcent) {
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

		$total = 0.00;
		foreach ($amounts as $idItem => $amount)
		{
			$item = ManageCbDatabase::getTableXById('items', $idItem);

			array_push($detailPayment['description'], $item->description);
			array_push($detailPayment['model'], $item->model);
			array_push($detailPayment['amount'], $amount);

			$puNeto = $item->pu;
			$pu = $puNeto + ManageBill::getInteresetInMonths($puNeto, 2.8, 12);
			$puString = (string)ManageBill::formatDecimalN($pu, 2);
			array_push($detailPayment['pu'], $puString);

			$subtotal = $pu * $amount;
			$subtotalString = (string)ManageBill::formatDecimalN($subtotal, 2);
			array_push($detailPayment['subtotal'], $subtotalString);

			$total += $subtotal;
		}

	// DEPOSIT
		$deposit = ManageBill::getPorcent($total, $depositPorcent);
		$depositString = (string)ManageBill::formatDecimalN($deposit, 2);
		$detailPayment['deposit'] = $depositString;
	// BONUS DEPOSIT
		$totalNeto = ManageBill::getNetoValue($total, 2.8, 12);
		$interest = $total - $totalNeto;
		$totalWithDeposit = $totalNeto - $deposit;
		
		$bonusDeposit = 0;
		$updateInterest = 0;
		// if settle the account
		if ($totalWithDeposit < 0)
		{
			$totalWithDeposit = 0;
			$bonusDeposit = $interest;
		}
		else // else still it need to pay
		{
			$updateInterest = ManageBill::getInteresetInMonths($totalWithDeposit, 2.8, 12);
			$bonusDeposit = $interest - $updateInterest;
		}
		$bonusDepositString = (string)ManageBill::formatDecimalN($bonusDeposit, 2);
		$detailPayment['bonusDeposit'] = $bonusDepositString;
	// TOTAL DEBT
		$updateTotal = $totalWithDeposit + $updateInterest;
		$updateTotalString = (string)ManageBill::formatDecimalN($updateTotal, 2);
		$detailPayment['totalDebt'] = $updateTotalString;

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

	private static function getNetoValue($total, $porcentInterest, $months) {
		return $total / (1.0 + ($porcentInterest / 100.0) * $months);
	}
}
