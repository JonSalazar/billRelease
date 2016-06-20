<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public static function find() {
    	return "soy un modelo";
    }
}
