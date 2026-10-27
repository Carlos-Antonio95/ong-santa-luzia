<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlanoIndividualRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $plano = $this->route('plano');

        return [
            'idosa_id' => [
                'required',
                'exists:idosas,id',
                Rule::unique('plano_individuals', 'idosa_id')->ignore($plano->id),
            ],
            'data_ingresso' => ['nullable', 'date'],
            'numero_prontuario' => ['nullable', 'string', 'max:100'],
            'origem_residencia' => ['nullable', 'string', 'max:255'],
            'motivo_institucionalizacao' => ['nullable', 'string'],
            'renda' => ['nullable', 'numeric', 'min:0'],
            'administra_financeiro' => ['nullable', 'boolean'],
            'escolaridade' => ['nullable', 'string', 'max:255'],
            'profissao' => ['nullable', 'string', 'max:255'],
            'religiao' => ['nullable', 'string', 'max:255'],
            'diagnostico_medico' => ['nullable', 'string'],
            'grau_dependencia' => ['nullable', 'string', 'max:255'],
            'possui_plano_saude' => ['nullable', 'boolean'],
            'descricao_medicacao' => ['nullable', 'string'],
            'restricao_alimentar' => ['nullable', 'string'],
            'rotina' => ['nullable', 'string'],
        ];
    }
}