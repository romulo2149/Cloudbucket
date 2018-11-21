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
            $table->string('firma_freelancer')->nullable();
            $table->string('firma_cliente')->nullable();
            $table->decimal('pago',10,2);
            $table->date('fecha_entrega');
            $table->integer('penalizacion')->unsigned();    
            $table->integer('solicitud')->unsigned();
            $table->timestamps();
            $table->boolean('leido');
            $table->foreign('solicitud')->references('id_solicitud')->on('solicitud')->OnDelete('cascade');
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
