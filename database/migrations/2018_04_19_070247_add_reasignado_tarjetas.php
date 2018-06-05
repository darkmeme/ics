<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReasignadoTarjetas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 
     */
    public function up()
    {
        Schema::table('tarjetas', function (Blueprint $table) {
            $table->integer('user_reasignado')->unsigned()->nullable();
            $table->foreign('user_reasignado')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarjetas', function (Blueprint $table) {
            $table->dropForeign('tarjetas_user_reasignado_foreign');
            $table->dropColumn('user_reasignado');
        });
    }
}
