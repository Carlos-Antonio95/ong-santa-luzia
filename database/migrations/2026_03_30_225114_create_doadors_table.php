<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */ public function up(): void
    {
        Schema::create('doadores', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->index();
            $table->string('cpf')->nullable()->index();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('tipo')->default('Pessoa Física');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doadores');
    }
};