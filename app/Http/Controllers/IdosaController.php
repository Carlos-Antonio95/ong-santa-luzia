<?php

namespace App\Http\Controllers;

use App\Models\Idosa;
use Illuminate\Http\Request;

class IdosaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $idosas = Idosa::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nome', 'like', "%{$search}%")
                    ->orWhere('cpf', 'like', '%' . preg_replace('/\D+/', '', $search) . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('idosas.index', compact('idosas', 'search'));
    }

    public function create()
    {
        return view('idosas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'data_nascimento' => ['nullable', 'date'],
            'estado_civil' => ['nullable', 'string', 'max:100'],
            'rg' => ['nullable', 'string', 'max:20'],
            'orgao_emissor' => ['nullable', 'string', 'max:50'],
            'cpf' => ['required', 'string', 'max:14', 'unique:idosas,cpf'],
            'filiacao' => ['nullable', 'string', 'max:255'],
            'naturalidade' => ['nullable', 'string', 'max:255'],
            'deficiencia' => ['nullable', 'string', 'max:255'],
            'data_abrigamento' => ['nullable', 'date'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'nome_social' => ['nullable', 'string', 'max:255'],
            'apelido' => ['nullable', 'string', 'max:255'],
        ]);

        Idosa::create($data);

        return redirect('/dashboard')
            ->with('success', 'Idosa cadastrada com sucesso.');
    }

    public function show(Idosa $idosa)
    {
        $idosa->load(['planoIndividual', 'termos.responsavel']);

        return view('idosas.show', compact('idosa'));
    }

    public function edit(Idosa $idosa)
    {
        return view('idosas.edit', compact('idosa'));
    }

    public function update(Request $request, Idosa $idosa)
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'data_nascimento' => ['nullable', 'date'],
            'estado_civil' => ['nullable', 'string', 'max:100'],
            'rg' => ['nullable', 'string', 'max:20'],
            'orgao_emissor' => ['nullable', 'string', 'max:50'],
            'cpf' => ['required', 'string', 'max:14', 'unique:idosas,cpf,' . $idosa->id],
            'filiacao' => ['nullable', 'string', 'max:255'],
            'naturalidade' => ['nullable', 'string', 'max:255'],
            'deficiencia' => ['nullable', 'string', 'max:255'],
            'data_abrigamento' => ['nullable', 'date'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'nome_social' => ['nullable', 'string', 'max:255'],
            'apelido' => ['nullable', 'string', 'max:255'],
        ]);

        $idosa->update($data);

        return redirect('/dashboard')
         ->with('success', 'Idosa cadastrada com sucesso.');
    }

    public function destroy(Idosa $idosa)
    {
        $idosa->delete();

        return redirect()
            ->route('idosas.index')
            ->with('success', 'Idosa removida com sucesso.');
    }

    public function dashboard()
    {
        $idosas = \App\Models\Idosa::with('termos.responsavel')->get();
        return view('dashboard', compact('idosas'));
    }
}