<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
        	'description'	=>	'TAZA',
        	'model'			=>	'APPLE',
        	'pu'			=>	40.00
        	]);
        DB::table('items')->insert([
			'description'	=>	'MESA',
			'model'			=>	'TOSHIBA',
			'pu'			=>	360.00
			]);
        DB::table('items')->insert([
			'description'	=>	'CAMA',
			'model'			=>	'SONY',
			'pu'			=>	1024.60
			]);
        DB::table('items')->insert([
			'description'	=>	'JELLOPY',
			'model'			=>	'PRONT-FIELD01',
			'pu'			=>	0.60
			]);
        DB::table('items')->insert([
			'description'	=>	'PAPEL',
			'model'			=>	'OFFICE',
			'pu'			=>	2892.55
			]);
    }
}
