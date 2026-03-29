<?php

namespace App\Models;

use App\Concerns\SanitizesDocuments;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Idosa extends Model
{
    use SanitizesDocuments;

    protected $table = 'idosas';

    protected $fillable = [
        'nome',
        'data_nascimento',
        'estado_civil',
        'rg',
        'orgao_emissor',
        'cpf',
        'filiacao',
        'naturalidade',
        'deficiencia',
        'data_abrigamento',
        'telefone',
        'endereco',
        'bairro',
        'cidade',
        'nome_social',
        'apelido',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'data_abrigamento' => 'date',
    ];

    public function planoIndividual(): HasOne
    {
        return $this->hasOne(PlanoIndividual::class, 'idosa_id');
    }

    public function termos(): HasMany
    {
        return $this->hasMany(TermoAbrigamento::class, 'idosa_id');
    }
    public function ultimoTermo()
{
    return $this->hasOne(TermoAbrigamento::class, 'idosa_id')->latestOfMany();
}


    public function scopeSearch($query, ?string $search)
    {
        if (! $search) {
            return $query;
        }

        $searchNumbers = preg_replace('/\D+/', '', $search);

        return $query->where(function ($q) use ($search, $searchNumbers) {
            $q->where('nome', 'like', "%{$search}%")
                ->orWhere('cpf', 'like', "%{$searchNumbers}%");
        });
    }

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatCpf($value),
            set: fn ($value) => $this->onlyNumbers($value),
        );
    }

    protected function telefone(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatPhone($value),
            set: fn ($value) => $this->onlyNumbers($value),
        );
    }

    protected function rg(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => $this->onlyNumbers($value),
        );
    }

    protected function idade(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->data_nascimento?->age,
        );
    }
}