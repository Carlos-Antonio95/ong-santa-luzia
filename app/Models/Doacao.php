<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doacao extends Model
{
   
    protected $table = 'doacoes';

    protected $fillable = [
        'doador_id',
        'valor',
        'data_doacao',
        'forma_pagamento',
        'tipo_doacao',
        'descricao',
    ];

    protected $casts = [
        'data_doacao' => 'date',
        'valor' => 'decimal:2',
    ];

    public function doador(): BelongsTo
    {
        return $this->belongsTo(Doador::class, 'doador_id');
    }
}