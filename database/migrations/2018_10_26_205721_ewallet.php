<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ewallet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ewallet', function (Blueprint $table){
            $table->increments('id_wallet');
            $table->enum('operador',['PayPal', 'NETELLER', 'EntroPay', 'Skrill', 'Todito Cash', 'weex wallet', 'Amazon']);
            $table->string('cuenta');
            $table->string('clave');
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
