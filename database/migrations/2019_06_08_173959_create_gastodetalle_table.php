<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastodetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastodetalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idGastoEncabezado')->unsigned();
            $table->foreign('idGastoEncabezado')->references('id')->on('gastoencabezado');
            $table->string('gasto');
            $table->decimal('subtotal',8,2);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastodetalle');
    }
}
