<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ManageCbDatabase extends Model
{
	public static function getListArticleNames() {
		$descriptionItems = DB::select('SELECT description AS value FROM items;');

		$totalString = '';
		foreach ($descriptionItems as $descriptionItem) 
		{
			$totalString .= $descriptionItem->value.',';
		}
		return substr($totalString, 0, -1);
	}

    public static function getTableX($tableName) {
    	$table = DB::select('SELECT * FROM items;');

    	return $table;
    }
}