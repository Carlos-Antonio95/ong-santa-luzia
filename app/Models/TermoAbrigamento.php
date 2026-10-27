<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TermoAbrigamento extends Model
{
    protected $table = 'termo_abrigamentos';

    protected $fillable = [
        'idosa_id',
        'responsavel_id',
        'data_inicio',
        'observacoes',
        'assinado_responsavel',
        'assinado_psicologo',
        'assinado_assistente_social',
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'assinado_responsavel' => 'boolean',
        'assinado_psicologo' => 'boolean',
        'assinado_assistente_social' => 'boolean',
    ];

    public function idosa(): BelongsTo
    {
        return $this->belongsTo(Idosa::class, 'idosa_id');
    }

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(Responsavel::class, 'responsavel_id');
    }
}