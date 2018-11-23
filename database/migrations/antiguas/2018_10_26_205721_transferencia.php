<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transferencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencia', function (Blueprint $table){
            $table->increments('id_transferencia');
            $table->string('nombre_banco');
            $table->integer('numero_sucursal')->unsigned();
            $table->string('direccion');
            $table->integer('codigo_postal')->unsigned();
            $table->integer('codigo_SWIFT')->unsigned();
            $table->string('nombre_cliente');
            $table->integer('CLABE')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
