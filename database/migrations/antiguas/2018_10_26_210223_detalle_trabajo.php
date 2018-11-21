<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetalleTrabajo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_trabajo', function (Blueprint $table){
            $table->increments('id_detalle_trabajo');
            $table->integer('id_progreso')->unsigned();
            $table->integer('id_req')->unsigned()->nullable();
            $table->decimal('monto', 10,2);
            $table->integer('id_trabajo')->unsigned();
            $table->foreign('id_trabajo')->references('id_trabajo')->on('trabajo')->OnDelete('cascade');
            $table->foreign('id_req')->references('id_requerimiento')->on('requerimiento')->OnDelete('cascade');
            $table->foreign('id_progreso')->references('id_progreso')->on('progreso')->OnDelete('cascade');
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
