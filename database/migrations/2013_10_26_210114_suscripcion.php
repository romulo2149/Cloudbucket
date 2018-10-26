<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Suscripcion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membresia', function (Blueprint $table){
            $table->increments('id_membresia');
            $table->enum('nombre', ['Free', 'Freelancer Premium', 'Cliente Premium', 'Empresa Premium', 'Cliente GOLD', 'Empresa GOLD'])->default('Free');
            $table->enum('tipo_plan', ['Anual', 'Proyecto'])->nullable();
            $table->decimal('costo', 10,2);
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
