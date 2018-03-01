<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedidoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidores', function (Blueprint $table) {
            $table->increments('id');
            $table->double('nsd_220',15,2);
            $table->double('nsd_480',15,2);
            $table->double('blanqueo',15,2);
            $table->double('calderas',15,2);
            $table->double('sulfonacion',15,2);
            $table->double('oficinas',15,2);
            $table->double('daf',15,2);
            $table->double('comby',15,2);
            $table->double('saponificacion',15,2);
            $table->double('enee_principal',15,2);
            $table->double('enee_reactivo',15,2);
            $table->double('fp',15,2);
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
        Schema::dropIfExists('medidores');
    }
}
