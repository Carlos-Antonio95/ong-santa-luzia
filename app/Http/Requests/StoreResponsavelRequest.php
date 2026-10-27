<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResponsavelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'          => ['required', 'string', 'max:255'],
            'rg'            => ['nullable', 'string', 'max:20'],
            'orgao_emissor' => ['nullable', 'string', 'max:50'],
            'cpf'           => ['required', 'string', 'size:11', 'unique:responsaveis,cpf'],
            'telefone'      => ['nullable', 'string', 'max:11'],
            'endereco'      => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'cpf'      => preg_replace('/\D+/', '', $this->input('cpf', '')),
            'telefone' => preg_replace('/\D+/', '', $this->input('telefone', '')) ?: null,
        ]);
    }
}
