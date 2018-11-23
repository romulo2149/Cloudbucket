<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tarjeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjeta', function (Blueprint $table){
            $table->increments('id_tarjeta');
            $table->enum('operador', ['American Express', 'VISA', 'MasterCard', 'Maestro']);
            $table->string('numero');
            $table->string('terminacion');
            $table->string('codigo');
            $table->date('vencimiento');
            $table->string('nombre');
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
