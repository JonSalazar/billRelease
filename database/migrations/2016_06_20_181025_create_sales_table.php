<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('idItem');
            $table->integer('folio');
            $table->integer('amount');
        });
        Schema::table('sales', function ($table) {
            $table->foreign('idItem')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('folio')->references('folio')->on('bills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales');
    }
}
