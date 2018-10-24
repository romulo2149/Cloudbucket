<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HabilidadesFreelancer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habilidad_freelancer', function (Blueprint $table){
            $table->increments('id_habilidad');
            $table->integer('user')->unsigned();
            $table->integer('habilidad')->unsigned();
            $table->foreign('user')->references('id')->on('users')->OnDelete('cascade');
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
