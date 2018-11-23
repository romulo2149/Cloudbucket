<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mensaje extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensaje', function (Blueprint $table){
            $table->increments('id_mensaje');
            $table->integer('id_user')->unsigned();
            $table->integer('chat')->unsigned();
            $table->text('mensaje');
            $table->timestamps();
            $table->boolean('leido');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('no action');
            $table->foreign('chat')->references('id_chat')->on('chat')->onDelete('no action');
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
