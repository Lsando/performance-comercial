<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cao_fatura', function (Blueprint $table) {
            $table->bigInteger('co_fatura')->autoIncrement();
            $table->index(array("co_fatura"))->unsigned()->primary();
            $table->integer('co_cliente')->default(0);
            $table->integer('co_sistema')->default(0);
            $table->integer('co_os')->default(0);
            $table->integer('num_nf')->default(0);
            $table->double('total')->default(0);
            $table->double('comissao_cn')->default(0);
            $table->double('total_imp_inc')->default(0);
            $table->double('valor')->default(0);
            $table->date('data_emissao')->nullable();
            $table->text('corpo_nf');
            $table->foreign('co_cliente')->references('co_cliente')->on('cao_cliente');
            $table->foreign('co_sistema')->references('co_sistema')->on('cao_sistema');
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
        Schema::dropIfExists('cao_fatura');
    }
}
