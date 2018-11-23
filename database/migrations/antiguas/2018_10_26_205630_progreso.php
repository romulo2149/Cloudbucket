<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Progreso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progreso', function (Blueprint $table){
            $table->increments('id_progreso');
            $table->string('nombre_progreso');
            $table->string('descripcion');
            $table->date('fecha_entrega');
            $table->date('fecha_prorroga')->nullable();
            $table->decimal('pago_pct',8,2)->nullable();
            $table->enum('estatus',['Establecida','Pendiente', 'En Desarrollo', 'Detenida', 'Terminada'])->default('Establecida');
            $table->integer('id_proyecto')->unsigned();
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
