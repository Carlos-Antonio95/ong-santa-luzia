<?php

namespace App\Http\Controllers;

use App\Models\Doacao;
use App\Models\Doador;
use Illuminate\Http\Request;

class DoacaoController extends Controller
{
    public function index()
    {
        $doacoes = Doacao::with('doador')
            ->latest('data_doacao')
            ->get();

        return view('doacoes.index', compact('doacoes'));
    }

    public function create()
    {
        $doadores = Doador::orderBy('nome')->get();

        return view('doacoes.create', compact('doadores'));
    }

    public function store(Request $request, Doador $doador)
    {
        $data = $request->validate([
            'valor' => ['required', 'numeric', 'min:0.01'],
            'data_doacao' => ['required', 'date'],
            'forma_pagamento' => ['nullable', 'string', 'max:100'],
            'tipo_doacao' => ['nullable', 'string', 'max:100'],
            'descricao' => ['nullable', 'string'],
        ]);

        $doador->doacoes()->create($data);

        return redirect()->route('dashboard', ['doador' => $doador->id])->with('success', 'Doação cadastrada com sucesso!');
    }

    public function show(Doacao $doacao)
    {
        $doacao->load('doador');

        return view('doacoes.show', compact('doacao'));
    }

    public function edit(Doacao $doacao)
    {
        $doacao->load('doador');

        return view('doacoes.edit', compact('doacao'));
    }

    public function update(Request $request, Doacao $doacao)
    {
        $data = $request->validate([
            'valor' => ['required', 'numeric', 'min:0.01'],
            'data_doacao' => ['required', 'date'],
            'forma_pagamento' => ['nullable', 'string', 'max:100'],
            'tipo_doacao' => ['nullable', 'string', 'max:100'],
            'descricao' => ['nullable', 'string'],
        ]);

        $doacao->update($data);

        return redirect()->route('dashboard', ['doador' => $doacao->doador_id])->with('success', 'Doação atualizada com sucesso!');
    }

    public function destroy(Doacao $doacao)
    {
        $doadorId = $doacao->doador_id;

        $doacao->delete();

        return redirect()->route('dashboard', ['doador' => $doadorId])->with('success', 'Doação excluída com sucesso!');
    }
}