<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('idosas', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->index();
            $table->date('data_nascimento')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('rg')->nullable();
            $table->string('orgao_emissor')->nullable();
            $table->string('cpf')->unique();
            $table->string('filiacao')->nullable();
            $table->string('naturalidade')->nullable();
            $table->string('deficiencia')->nullable();
            $table->date('data_abrigamento')->nullable();
            $table->string('telefone')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable()->index();
            $table->string('nome_social')->nullable();
            $table->string('apelido')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idosas');
    }
};
