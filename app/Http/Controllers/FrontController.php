<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ManageCbDatabase;
use App\ManageBill;
use App\ManageNumbers;
use App\ManageSales;


class FrontController extends Controller
{
    public function index() {
        $articleDescription = ManageCbDatabase::getListArticleNames();
    	return view('index', ['nameItems' => $articleDescription]);
    }

    public function billInfo(Request $request) {
        $detailPayment  = ManageBill::getDetailPayment($request->list);
        $bonusInfo      = ManageBill::getBonusInfo($detailPayment['total'], $request->depositPercent);
        $totalDebt      = $bonusInfo['totalDebt'];
        
        $moneyInWords   = '';
        $monthBy        = [];
        $depositBy      = [];
        $debtBy         = [];
        $bonusBy        = [];
        if ($totalDebt > 0)
        {
            $moneyInWords   = ManageNumbers::getMoneyByWords($totalDebt);

            $groupMonthlyPayments = ManageBill::getMonthlyPaymentsGroup($totalDebt, array(3,6,9,12));
            $monthBy    = $groupMonthlyPayments['monthBy'];
            $depositBy  = $groupMonthlyPayments['depositBy'];
            $debtBy     = $groupMonthlyPayments['debtBy'];
            $bonusBy    = $groupMonthlyPayments['bonusBy'];
        }
        
        
        return response()->json([
            'idDeposit'             =>  $bonusInfo['deposit'],
            'idBonusDeposit'        =>  $bonusInfo['bonusDeposit'],
            'idTotalDebt'           =>  $totalDebt,
            'idDebtInWords'         =>  $moneyInWords,
            'description'           =>  $detailPayment['description'],
            'model'                 =>  $detailPayment['model'],
            'amount'                =>  $detailPayment['amount'],
            'pu'                    =>  $detailPayment['pu'],
            'subtotal'              =>  $detailPayment['subtotal'],
            'showMonthlyPayments'   =>  $totalDebt <= 0 ? false : true,
            'monthBy'               =>  $monthBy,
            'depositBy'             =>  $depositBy,
            'debtBy'                =>  $debtBy,
            'bonusBy'               =>  $bonusBy
            ]);
    }

    public function billFinalize(Request $request) {
        $errors = array();
        if ($request->name == '')
            array_push($errors, 'El campo nombre esta vacio');
        if ($request->address == '')
            array_push($errors, 'El campo dirección esta vacio');
        $validRfc = ManageBill::valideteRFC($request->rfc);
        if ( ! $validRfc)
            array_push($errors, 'El campo RFC es inválido');
        
        if (count($errors) > 0) {
            return response()->json([
            'success'   => false,
            'errors'    => $errors
            ]);
        }
        

        // no errors, make the bill
        $detailPayment  = ManageBill::getDetailPayment($request->list);
        $finalInfoBill  = ManageSales::finalizeBill($detailPayment['id'], $detailPayment['amount']);
        return response()->json([
        'success'   => true,
        'idFolio'   => $finalInfoBill['idFolio'],
        'idDate'    => $finalInfoBill['idDate']
        ]);
    }
}
