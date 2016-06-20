<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ManageCbDatabase extends Model
{
	public static function getListArticleNames() {
		$descriptionArticles = DB::select('SELECT description AS value FROM articles;');

		$totalString = '';
		foreach ($descriptionArticles as $descriptionArticle) 
		{
			$totalString .= $descriptionArticle->value.',';
		}
		return substr($totalString, 0, -1);
	}

    
}