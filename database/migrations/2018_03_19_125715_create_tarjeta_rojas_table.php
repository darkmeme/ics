<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarjetaRojasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjeta_rojas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->integer('equipo_id')->unsigned();
            $table->String('prioridad');
            $table->text('descripcion_reporte');
            $table->integer('user_finaliza')->unsigned()->nullable();
            $table->text('solucion_implementada')->nullable();
            $table->string('turno',3);
            $table->date('fecha_cierre',50)->nullable();
            $table->boolean('finalizado')->nullable();
            $table->string('status',30)->nullable();
            $table->integer('planta_id')->unsigned();
            $table->integer('user_asignado')->unsigned()->nullable();
            $table->timestamps();
            //relaciones
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('planta_id')->references('id')->on('plantas');
            $table->foreign('user_asignado')->references('id')->on('users');
            $table->foreign('user_finaliza')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarjeta_rojas');
    }
}
