<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NuevaHabilidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nueva_habilidad', function (Blueprint $table){
            $table->increments('id_nuevah');
            $table->string('nueva_habilidad');
            $table->enum('estatus', ['Aceptada', 'Rechazada', 'En evaluación'])->default('En evaluación');
            $table->date('fecha_solicitud');
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
