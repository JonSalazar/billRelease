<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ManageCbDatabase;
use App\ManageBill;

class FrontController extends Controller
{
    public function index() {
        $articleDescription = ManageCbDatabase::getListArticleNames();
    	return view('index', ['nameItems' => $articleDescription]);
    }

    public function billInfo(Request $request) {
        $detailPayment = ManageBill::getDetailPayment($request->list);

        $monthBy = ['3','6','9','12'];
        $depositBy = ['1','2','3','4'];
        $debtBy = ['5','6','7','8'];
        $bonusBy = ['9','10','11','12'];
        
        return response()->json([
            'idDeposit'     =>  '500.0',
            'idBonusDeposit'=>  '150.40',
            'idTotalDept'   =>  '300.10',
            'idDeptInWords' =>  'DOS MIL TRECIENTOS 14/100 M.N',
            'description'   =>  $detailPayment['description'],
            'model'         =>  $detailPayment['model'],
            'amount'        =>  $detailPayment['amount'],
            'pu'            =>  $detailPayment['pu'],
            'subtotal'      =>  $detailPayment['subtotal'],
            'monthBy'       =>  $monthBy,
            'depositBy'     =>  $depositBy,
            'debtBy'        =>  $debtBy,
            'bonusBy'       =>  $bonusBy
            ]);
    }
}
