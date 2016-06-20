<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;

class FrontController extends Controller
{
    public function index() {
    	$ans = Article::find();
    	//return "resultado = ".$ans;
    	return view('index');
    }
}
