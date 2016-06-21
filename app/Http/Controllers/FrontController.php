<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ManageCbDatabase;

class FrontController extends Controller
{
    public function index() {
        $articleDescription = ManageCbDatabase::getListArticleNames();
    	return view('index', ['nameItems' => $articleDescription]);
    }

    public function billInfo(Request $request) {
        $description = ['dos','toneladas','sr','ahhahahah','>:(','dos','toneladas','sr','ahhahahah','>:('];
        $model = ['dos','toneladas','sr','ahhahahah','>:(','dos','toneladas','sr','ahhahahah','>:('];
        $amount = ['dos','toneladas','sr','ahhahahah','>:(','dos','toneladas','sr','ahhahahah','>:('];
        $pu = ['dos','toneladas','sr','ahhahahah','>:(','dos','toneladas','sr','ahhahahah','>:('];
        $subtotal = ['dos','toneladas','sr','ahhahahah','>:(','dos','toneladas','sr','ahhahahah','>:('];

        $monthBy = ['dos','toneladas','sr','ahhahahah'];
        $depositBy = ['dos','toneladas','sr','ahhahahah'];
        $debtBy = ['dos','toneladas','sr','ahhahahah'];
        $bonusBy = ['dos','toneladas','sr','ahhahahah'];
        
        return response()->json([
            'idDeposit'     =>  '500.0',
            'idBonusDeposit'=>  '150.40',
            'idTotalDept'   =>  '300.10',
            'idDeptInWords' =>  'DOS MIL TRECIENTOS 14/100 M.N',
            'description'   =>  $description,
            'model'         =>  $model,
            'amount'        =>  $amount,
            'pu'            =>  $pu,
            'subtotal'      =>  $subtotal,
            'monthBy'       =>  $monthBy,
            'depositBy'     =>  $depositBy,
            'debtBy'        =>  $debtBy,
            'bonusBy'       =>  $bonusBy
            ]);
    }
}
