<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('telefone', 12)->unique();
            $table->string('email', 120)->nullable();
            $table->string('endereco_cep', 8)->nullable();
            $table->string('endereco_rua', 150)->nullable();
            $table->string('endereco_numero', 6)->nullable();
            $table->string('endereco_complemento', 50)->nullable();
            $table->string('endereco_bairro', 20)->nullable();
            $table->string('endereco_cidade', 30)->nullable();
            $table->string('endereco_estado', 2)->nullable();
            $table->longText('notas')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
