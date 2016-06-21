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
        return response()->json([
            'es' => 'un',
            'tipo' => $request->the
            ]);
    }
}
