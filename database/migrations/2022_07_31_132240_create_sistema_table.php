<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cao_sistema', function (Blueprint $table) {
            $table->bigInteger('co_sistema')->autoIncrement();
            $table->index(array("co_sistema"))->unsigned()->primary();
            $table->bigInteger('co_cliente')->unsigned();
            $table->bigInteger('co_usuario')->unsigned();
            $table->integer('co_arquitetura')->default(0)->unsigned();
            $table->string('no_sistema')->nullable();
            $table->text('ds_sistema_resumo');
            $table->text('ds_caracteristica');
            $table->text('ds_requisito');
            $table->string('no_diretoria_solic')->nullable();
            $table->string('ddd_telefone_solic')->nullable();
            $table->string('nu_telefone_solic')->nullable();
            $table->string('no_usuario_solic')->nullable();
            $table->date('dt_solicitacao')->nullable();
            $table->date('dt_entrega')->nullable();
            $table->string('co_email')->nullable();
            $table->foreign('co_cliente')->references('co_cliente')->on('cao_cliente');
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
        Schema::dropIfExists('cao_sistema');
    }
}
