<?php

namespace App\Http\Controllers;

use App\Models\Doador;
use App\Models\Doacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoadorController extends Controller
{
    public function index()
    {
        $doadores = Doador::withSum('doacoes', 'valor')
            ->with('doacoes')
            ->latest()
            ->get();

        return view('doadores.index', compact('doadores'));
    }

    public function create()
    {
        return view('doadores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['nullable', 'string', 'max:20'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'tipo' => ['nullable', 'string', 'max:100'],
            'observacoes' => ['nullable', 'string'],

            'doacao_valor' => ['nullable', 'numeric', 'min:0.01'],
            'doacao_data' => ['nullable', 'date'],
            'doacao_forma_pagamento' => ['nullable', 'string', 'max:100'],
            'doacao_tipo' => ['nullable', 'string', 'max:100'],
            'doacao_descricao' => ['nullable', 'string'],
        ]);

        $temDadosDeDoacao =
            !empty($data['doacao_valor']) ||
            !empty($data['doacao_data']) ||
            !empty($data['doacao_forma_pagamento']) ||
            !empty($data['doacao_tipo']) ||
            !empty($data['doacao_descricao']);

        if ($temDadosDeDoacao) {
            $request->validate([
                'doacao_valor' => ['required', 'numeric', 'min:0.01'],
                'doacao_data' => ['required', 'date'],
                'doacao_tipo' => ['required', 'string', 'max:100'],
            ], [
                'doacao_valor.required' => 'Informe o valor da doação.',
                'doacao_data.required' => 'Informe a data da doação.',
                'doacao_tipo.required' => 'Selecione o tipo da doação.',
            ]);
        }

        DB::transaction(function () use ($data, $temDadosDeDoacao) {
            $doador = Doador::create([
                'nome' => $data['nome'],
                'cpf' => $data['cpf'] ?? null,
                'telefone' => $data['telefone'] ?? null,
                'email' => $data['email'] ?? null,
                'tipo' => $data['tipo'] ?? 'Pessoa Física',
                'observacoes' => $data['observacoes'] ?? null,
            ]);

            if ($temDadosDeDoacao) {
                Doacao::create([
                    'doador_id' => $doador->id,
                    'valor' => $data['doacao_valor'],
                    'data_doacao' => $data['doacao_data'],
                    'forma_pagamento' => $data['doacao_forma_pagamento'] ?? null,
                    'tipo_doacao' => $data['doacao_tipo'],
                    'descricao' => $data['doacao_descricao'] ?? null,
                ]);
            }
        });

        return redirect()
            ->route('dashboard')
            ->with('success', 'Doador cadastrado com sucesso!');
    }

    public function show(Doador $doador)
    {
        $doador->load('doacoes');

        return view('doadores.show', compact('doador'));
    }

    public function edit(Doador $doador)
    {
        return view('doadores.edit', compact('doador'));
    }

 public function update(Request $request, Doador $doador)
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['nullable', 'string', 'max:20'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'tipo' => ['nullable', 'string', 'max:100'],
            'observacoes' => ['nullable', 'string'],
        ]);

        $doador->update($data);

        return redirect()
            ->route('dashboard', ['doador' => $doador->id])
            ->with('success', 'Doador atualizado com sucesso!');
    }

    public function destroy($doador)
    {
        $doador = Doador::findOrFail($doador);

        DB::transaction(function () use ($doador) {
            $doador->doacoes()->delete();
            $doador->delete();
        });

        return redirect()
            ->route('dashboard')
            ->with('success', 'Doador excluído com sucesso!');
    }
}