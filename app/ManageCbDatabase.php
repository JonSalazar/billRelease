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
    public static function getTableXById($tableName, $id) {
    	$table = DB::table($tableName)->where('id', $id)->first();
    	return $table;
    }
}