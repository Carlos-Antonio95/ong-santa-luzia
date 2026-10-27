<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanoIndividual extends Model
{
    protected $table = 'plano_individuals';

    protected $fillable = [
        'idosa_id',
        'data_ingresso',
        'numero_prontuario',
        'origem_residencia',
        'motivo_institucionalizacao',
        'renda',
        'administra_financeiro',
        'escolaridade',
        'profissao',
        'religiao',
        'diagnostico_medico',
        'grau_dependencia',
        'possui_plano_saude',
        'descricao_medicacao',
        'restricao_alimentar',
        'rotina',
    ];

    protected $casts = [
        'data_ingresso' => 'date',
        'renda' => 'decimal:2',
        'possui_plano_saude' => 'boolean',
        'administra_financeiro' => 'boolean',
    ];

    public function idosa(): BelongsTo
    {
        return $this->belongsTo(Idosa::class, 'idosa_id');
    }

    public function scopeSearch($query, ?string $search)
    {
        if (! $search) {
            return $query;
        }

        $searchNumbers = preg_replace('/\D+/', '', $search);

        return $query->whereHas('idosa', function ($subQuery) use ($search, $searchNumbers) {
            $subQuery->where('nome', 'like', "%{$search}%")
                ->orWhere('cpf', 'like', "%{$searchNumbers}%");
        });
    }
}