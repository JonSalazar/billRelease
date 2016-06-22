<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ManageCbDatabase;
use App\ManageBill;
use App\ManageNumbers;

class FrontController extends Controller
{
    public function index() {
        $articleDescription = ManageCbDatabase::getListArticleNames();
    	return view('index', ['nameItems' => $articleDescription]);
    }

    public function billInfo(Request $request) {
        $detailPayment  = ManageBill::getDetailPayment($request->list, $request->depositPorcent);
        $totalDebt      = $detailPayment['totalDebt'];
        
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
            'idDeposit'             =>  $detailPayment['deposit'],
            'idBonusDeposit'        =>  $detailPayment['bonusDeposit'],
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
}
