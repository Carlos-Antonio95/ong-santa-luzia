<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIdosaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $idosaId = $this->route('idosa')?->id;

        return [
            'nome'             => ['required', 'string', 'max:255'],
            'data_nascimento'  => ['nullable', 'date'],
            'estado_civil'     => ['nullable', 'string', 'max:100'],
            'rg'               => ['nullable', 'string', 'max:20'],
            'orgao_emissor'    => ['nullable', 'string', 'max:50'],
            'cpf'              => ['required', 'string', 'size:11', 'unique:idosas,cpf,' . $idosaId],
            'filiacao'         => ['nullable', 'string', 'max:255'],
            'naturalidade'     => ['nullable', 'string', 'max:255'],
            'deficiencia'      => ['nullable', 'string', 'max:255'],
            'data_abrigamento' => ['nullable', 'date'],
            'telefone'         => ['nullable', 'string', 'max:11'],
            'endereco'         => ['nullable', 'string', 'max:255'],
            'bairro'           => ['nullable', 'string', 'max:255'],
            'cidade'           => ['nullable', 'string', 'max:255'],
            'nome_social'      => ['nullable', 'string', 'max:255'],
            'apelido'          => ['nullable', 'string', 'max:255'],
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
