<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissaoSistemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ps_permissao_sistema', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('ps_id')->unsigned()->index();
            $table->bigInteger('u_id')->unsigned();
            $table->bigInteger('tipo_usuario')->unsigned()->default(0);
            $table->bigInteger('sistema')->default(0);
            $table->string('co_usuario_atualizacao')->nullable();
            $table->string('in_ativo')->default('S');
            $table->foreign('u_id')->references('co_usuario')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ps_permissao_sistema');
    }
}
