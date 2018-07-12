<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReasignacionTr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarjeta_rojas', function (Blueprint $table) {
            $table->integer('user_reasignado')->unsigned()->nullable();
            $table->foreign('user_reasignado')->references('id')->on('users');
            $table->text('motivo_reasignado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarjeta_rojas', function (Blueprint $table) {
            $table->dropForeign('tarjeta_rojas_user_reasignado_foreign');
            $table->dropColumn('user_reasignado');
            $table->dropColumn('motivo_reasignado');
        });
    }
}
