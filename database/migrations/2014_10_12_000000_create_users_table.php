<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('rol',['Cliente','Freelancer','Empresa']);
            $table->enum('identidad', ['Verificada', 'No Verificada'])->default('No Verificada');
            $table->string('image',200)->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellidos')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('nombre_empresa')->nullable();
            $table->string('domicilio')->nullable();
            $table->string('telefono')->nullable();
            $table->string('sitio_web')->nullable();
            $table->string('empresa')->nullable();
            $table->decimal('salario_hora',6,2)->nullable();
            $table->decimal('valoracion',4,2)->nullable();
            $table->integer('id_membresia')->unsigned()->nullable();
            $table->foreign('id_membresia')->references('id_membresia')->on('membresia')->OnDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
