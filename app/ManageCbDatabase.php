<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ManageCbDatabase extends Model
{
	public static function getListArticleNames() {
		$descriptionItems = DB::select('SELECT id, description AS value FROM items;');

		$totalString = '';
		foreach ($descriptionItems as $descriptionItem) 
		{
			$totalString .= $descriptionItem->id.','.$descriptionItem->value.',';
		}
		return substr($totalString, 0, -1);
	}

    public static function getTableX($tableName) {
    	$table = DB::table($tableName)->get();
    	return $table;
    }
    public static function getTableXById($tableName, $idName, $idValue) {
    	$table = DB::table($tableName)->where($idName, $idValue)->first();
    	return $table;
    }
    public static function insertNewBill() {
    	$val 	= array('saleTime' => DB::raw('date(now())'));
  	   	$folio 	= DB::table('bills')->insertGetId($val, 'folio');
    	return $folio;
    }
    public static function insertNewSale($idItem, $folio, $amount) {
    	DB::table('sales')->insert([
    		'idItem'	=> $idItem,
    		'folio'		=> $folio,
    		'amount'	=> $amount
    		]);
    }
}