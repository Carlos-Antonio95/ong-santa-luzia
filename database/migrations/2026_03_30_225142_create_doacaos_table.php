<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Nota: o nome deste arquivo contém um erro de digitação ('doacaos').
// A tabela criada está correta ('doacoes'). O arquivo não pode ser
// renomeado sem resetar o banco, pois o Laravel rastreia pelo nome.
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doador_id')->constrained('doadores')->onDelete('cascade');
            $table->decimal('valor', 10, 2);
            $table->date('data_doacao');
            $table->string('forma_pagamento')->nullable();
            $table->string('tipo_doacao')->default('Financeira');
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doacoes');
    }
};