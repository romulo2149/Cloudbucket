<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Factura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table){
            $table->increments('id_factura');
            $table->decimal('monto',10,2);
            $table->integer('id_trabajo')->unsigned();
            $table->integer('id_forma')->unsigned();
            $table->foreign('id_trabajo')->references('id_trabajo')->on('trabajo')->OnDelete('cascade');
            $table->foreign('id_forma')->references('id_forma')->on('forma_pago_cobro')->OnDelete('cascade');
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
