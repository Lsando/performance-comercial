<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cao_cliente', function (Blueprint $table) {
            $table->bigInteger('co_cliente')->autoIncrement();
            $table->index(array("co_cliente"))->unsigned()->primary();
            $table->string('no_razao')->nullable();
            $table->string('no_fantasia')->nullable();
            $table->string('no_contato')->nullable();
            $table->string('nu_telefone')->nullable();
            $table->string('nu_ramal')->nullable();
            $table->string('nu_cnpj')->nullable();
            $table->string('ds_endereco')->nullable();
            $table->string('ds_complemento')->nullable();
            $table->string('no_bairro')->nullable();
            $table->string('nu_cep')->nullable();
            $table->integer('nu_numero')->nullable();
            $table->string('no_pais')->nullable();
            $table->string('ds_site')->nullable();
            $table->string('ds_email')->nullable();
            $table->string('ds_cargo_contato')->nullable();
            $table->string('nu_fax')->nullable();
            $table->string('ddd2')->nullable();
            $table->string('telefone2')->nullable();
            $table->string('ds_referencia')->nullable();
            $table->char('tp_cliente',2)->nullable();
            $table->bigInteger('co_ramo')->nullable();
            $table->bigInteger('co_cidade')->nullable();
            $table->integer('co_status')->nullable()->unsigned();
            $table->integer('co_complemento_status')->nullable()->unsigned();
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
        Schema::dropIfExists('cao_cliente');
    }
}
