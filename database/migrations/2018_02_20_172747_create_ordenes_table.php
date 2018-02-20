<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('user_id')->unsigned();
            $table->integer('planta_id')->unsigned();
            $table->integer('equipo_id')->unsigned();
            $table->integer('user_asignado')->unsigned();
            $table->date('Fecha_ejecucion');
            $table->timestamps();

            //relaciones
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('planta_id')->references('id')->on('plantas');
            $table->foreign('user_asignado')->references('id')->on('users');
            $table->foreign('equipo_id')->references('id')->on('equipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
