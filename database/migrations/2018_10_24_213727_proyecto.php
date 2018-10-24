<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Proyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto', function (Blueprint $table){
            $table->increments('id_proyecto');
            $table->string('titulo',200);
            $table->integer('area')->unsigned();
            $table->string('descripcion',500);
            $table->decimal('presupuesto', 12, 2);
            $table->string('anexo',200)->nullable();
            $table->string('tiempo',30)->nullable();
            $table->enum('estatus',['Publicado', 'En Desarrollo', 'Terminado', 'Cancelado'])->default('Publicado');
            $table->integer('usuario')->unsigned();
            $table->foreign('usuario')->references('id')->on('users')->OnDelete('cascade');
            $table->foreign('area')->references('id_area')->on('areas')->OnDelete('cascade');
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
