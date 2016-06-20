<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/** Change the blade tags
*	this is for we can use angular {{}} in blade.php
**/
Blade::setContentTags('<%', '%>');
Blade::setEscapedContentTags('<%%', '%%>');

Route::get(		'/',			'FrontController@index');
Route::resource('article',		'ArticleController');



/*Rute::get('nombre/{name?}/{ak?}', function($n = '30', $x = 'no') {
	return 'hallo? '.$n.' '.$x;
});

Route::get('index/{v}','BillController@index');*/

