<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ManageCbDatabase;

class FrontController extends Controller
{
    public function index() {
    	//$ans = Article::find();
        $articleDescription     =   ManageCbDatabase::getListArticleNames();

    	//return "resultado = ".$ans;
    	return view('index', [
    		'now'                 =>	'20/06/2016',
    		'folio'			      =>	'000000001',
    		'nElements'           =>	3,
            'nameArticles'        =>    $articleDescription,
    		'articleDetail'       =>	['onex','twox','truex'],
    		'model'               =>	['onex','twox','truex'],
    		'amount'              =>	['oney','twoy','truey'],
    		'pu'			      =>	['onez','twoz','truez'],
    		'subtotal'		      =>	['oner','twor','truer'],
    		'deposit'		      =>	'5000.00',
    		'bonusDeposit'	      =>	'1344.31',
    		'totalDebt'		      =>	'4105.34',
    		'totalInWords'	      =>	'CIENTO CUARENTA Y OCHO 24/100 M.N.',
    		'payBy'			      =>	[1,2,3,4],
    		'totalBy'		      =>	[5,6,7,8],
    		'bonusBy'		      =>	[9,10,11,12],
    		'mounthBy'		      =>	[3,6,9,12],
            'showDetailsPayments' =>    false
    		]);
    }
}
