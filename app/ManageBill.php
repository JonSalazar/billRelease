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
			$pu = $puNeto + self::getInteresetInMonths($puNeto, 2.8, 12);
			$puString = (string)self::formatDecimalN($pu, 2);
			array_push($detailPayment['pu'], $puString);

			$subtotal = $pu * $amount;
			$subtotalString = (string)self::formatDecimalN($subtotal, 2);
			array_push($detailPayment['subtotal'], $subtotalString);

			$total += $subtotal;
		}

	// DEPOSIT
		$deposit = self::getPorcent($total, $depositPorcent);
		$depositString = (string)self::formatDecimalN($deposit, 2);
		$detailPayment['deposit'] = $depositString;
	// BONUS DEPOSIT
		$totalNeto = self::getNetoValue($total, 2.8, 12);
		$interest = $total - $totalNeto;
		$totalWithDeposit = $totalNeto - $deposit;
		
		$bonusDeposit = 0;
		$updateInterest = 0;
		// if settle the account
		if ($totalWithDeposit < 0)
		{
			$bonusDeposit = $interest;
		}
		else // else still it need to pay
		{
			$updateInterest = self::getInteresetInMonths($totalWithDeposit, 2.8, 12);
			$bonusDeposit = $interest - $updateInterest;
		}
		$bonusDepositString = (string)self::formatDecimalN($bonusDeposit, 2);
		$detailPayment['bonusDeposit'] = $bonusDepositString;
	// TOTAL DEBT
		$updateTotal = $totalWithDeposit + $updateInterest;
		$updateTotalString = (string)self::formatDecimalN($updateTotal, 2);
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
		return self::getPorcent($number, $porcent) * $months;
	}

	private static function getNetoValue($total, $porcentInterest, $months) {
		return $total / (1.0 + ($porcentInterest / 100.0) * $months);
	}


	// For Month payments
	public static function getMonthlyPaymentsGroup($total, $months) {
		$group = array(
			'monthBy'	=> array(),
			'depositBy'	=> array(),
			'debtBy'	=> array(),
			'bonusBy'	=> array()
			);
		for ($i = 0; $i < count($months); $i++)
		{
			$monthlyPayments = self::getMonthlyPayments($total, $months[$i]);
			array_push($group['monthBy'],	$monthlyPayments[0]);
			array_push($group['depositBy'],	$monthlyPayments[1]);
			array_push($group['debtBy'],	$monthlyPayments[2]);
			array_push($group['bonusBy'],	$monthlyPayments[3]);
		}
		return $group;
	}

	public static function getMonthlyPayments($total, $nMonths) {
		$totalNeto = self::getNetoValue($total, 2.8, 12);
		$updateInterest = self::getInteresetInMonths($totalNeto, 2.8, $nMonths);
		$updateTotal = $totalNeto + $updateInterest;

		$parcialPayment = $updateTotal / $nMonths;

		$interest = $total - $totalNeto;
		$bonus = $interest - $updateInterest;
		$bonus = $bonus < 0.00 ? 0.00 : $bonus;

		$parcialPaymentString	= (string)self::formatDecimalN($parcialPayment, 2);
		$updateTotalString 		= (string)self::formatDecimalN($updateTotal, 2);
		$bonusString 			= (string)self::formatDecimalN($bonus, 2);
		return array($nMonths, $parcialPaymentString, $updateTotalString, $bonusString);
	}
}
