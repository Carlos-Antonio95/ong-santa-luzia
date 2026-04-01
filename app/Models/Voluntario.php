<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voluntario extends Model
{
    use HasFactory;

    protected $table = 'voluntarios';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'data_nascimento',
        'skills',
        'observacoes',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];
}
