<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Asesoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesoria', function (Blueprint $table){
            $table->increments('id_asesoria');
            $table->string('descripcion');
            $table->date('fecha_inicial');
            $table->date('fecha_limite');
            $table->enum('tipo', ['Presencial', 'Videoconferencia']);
            $table->enum('estatus', ['Solicitada', 'En Proceso de aceptación', 'Aceptada', 'Terminada'])->default('Solicitada');
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
