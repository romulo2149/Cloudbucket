<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HabilidadesProyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habilidad_proyecto', function (Blueprint $table){
            $table->increments('id_habilidad');
            $table->integer('id_proyecto')->unsigned();
            $table->integer('habilidad')->unsigned();
            $table->foreign('id_proyecto')->references('id_proyecto')->on('proyecto')->OnDelete('cascade');
            $table->foreign('habilidad')->references('id_habilidad')->on('habilidad')->OnDelete('cascade');
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
