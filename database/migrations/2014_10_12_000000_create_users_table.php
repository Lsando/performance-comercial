<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('co_usuario')->unsigned()->index();
            $table->string('no_usuario')->nullable();
            $table->string('ds_senha');
            $table->string('co_usuario_autorizacao')->nullable();
            $table->string('nu_matricula')->nullable();
            $table->string('nu_cpf')->nullable();
            $table->string('nu_rg')->nullable();
            $table->string('no_orgao_emissor')->nullable();
            $table->string('uf_orgao_emissor')->nullable();
            $table->string('ds_endereco')->nullable();
            $table->string('no_email')->nullable();
            $table->string('no_email_pessoal')->nullable();
            $table->string('nu_telefone')->nullable();
            $table->string('dt_alteracao')->nullable();
            $table->string('url_foto')->nullable();
            $table->string('instant_messenger')->nullable();
            $table->string('msn')->nullable();
            $table->string('yms')->nullable();
            $table->string('ds_bairro')->nullable();
            $table->string('nu_cep')->nullable();
            $table->string('no_cidade')->nullable();
            $table->string('uf_cidade')->nullable();
            $table->string('ds_comp_end')->nullable();
            $table->integer('icq')->nullable();
            $table->date('dt_nascimento');
            $table->date('dt_admissao_empresa');
            $table->date('dt_expiracao');
            $table->date('dt_desligamento')->nullable();
            $table->date('dt_expedicao')->nullable();
            $table->datetime('dt_inclusao')->nullable();
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
        Schema::dropIfExists('users');
    }
}
