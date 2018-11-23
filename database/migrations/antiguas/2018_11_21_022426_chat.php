<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Chat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat', function (Blueprint $table){
            $table->increments('id_chat');
            $table->integer('id_user_a')->unsigned();
            $table->integer('id_user_b')->unsigned();
            $table->foreign('id_user_a')->references('id')->on('users')->onDelete('no action');
            $table->foreign('id_user_b')->references('id')->on('users')->onDelete('no action');
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
