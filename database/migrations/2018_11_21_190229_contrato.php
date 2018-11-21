<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato', function (Blueprint $table){
            $table->increments('id_contrato');
            $table->string('firma_freelancer');
            $table->string('firma_cliente');
            $table->decimal('pago',10,2);
            $table->date('fecha_entrega');
            $table->integer('penalizacion')->unsigned();    
            $table->integer('id_proyecto')->unsigned();
            $table->timestamps();
            $table->boolean('leido');
            $table->foreign('id_proyecto')->references('id_proyecto')->on('proyecto')->OnDelete('cascade');
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
