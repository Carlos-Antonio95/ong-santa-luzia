<?php

namespace App\Models;

use App\Concerns\SanitizesDocuments;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsavel extends Model
{
    use SanitizesDocuments, SoftDeletes;

    protected $table = 'responsaveis';

    protected $fillable = [
        'nome',
        'rg',
        'orgao_emissor',
        'cpf',
        'telefone',
        'endereco',
    ];

    public function termos(): HasMany
    {
        return $this->hasMany(TermoAbrigamento::class, 'responsavel_id');
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
}