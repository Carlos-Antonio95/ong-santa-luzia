<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoluntarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:voluntarios,email,' . $this->route('voluntario'),
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
            'skills' => 'nullable|string|max:1000',
            'observacoes' => 'nullable|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Nome é obrigatório.',
            'email.required' => 'Email é obrigatório.',
            'email.email' => 'Email deve ser válido.',
        ];
    }
}
