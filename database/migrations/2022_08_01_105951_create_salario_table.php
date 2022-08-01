<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cao_salario', function (Blueprint $table) {
            $table->bigInteger('co_salario')->autoIncrement();
            $table->bigInteger('co_usuario')->unsigned();
            $table->date('dt_alteracao')->nullable();
            $table->double('brut_salario');
            $table->double('liq_salario');
            $table->foreign('co_usuario')->references('co_usuario')->on('users');
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
        Schema::dropIfExists('cao_salario');
    }
}
