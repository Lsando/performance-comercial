<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemServicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cao_os', function (Blueprint $table) {
            $table->bigInteger('co_os')->autoIncrement()->primary();
            $table->integer('nu_os')->nullable();
            $table->bigInteger('co_sistema')->unsigned();
            $table->bigInteger('co_usuario')->unsigned();
            $table->integer('co_arquitetura')->default(0);
            $table->string('ds_os')->default('0');
            $table->string('ds_caracteristica')->default('0');
            $table->string('ds_requisito')->nullable();
            $table->date('dt_inicio')->nullable();
            $table->date('dt_fim')->nullable();
            $table->integer('co_status')->nullable();
            $table->integer('co_os_prospect_rel')->nullable();
            $table->string('diretoria_sol')->nullable();
            $table->string('nu_tel_sol')->nullable();
            $table->string('nu_tel_sol2')->nullable();
            $table->string('usuario_sol')->nullable();
            $table->string('co_email')->nullable();
            $table->date('dt_sol')->nullable();
            $table->date('dt_imp')->nullable();
            $table->date('dt_garantia')->nullable();
            $table->foreign('co_sistema')->references('co_sistema')->on('cao_sistema');
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
        Schema::dropIfExists('cao_os');
    }
}
