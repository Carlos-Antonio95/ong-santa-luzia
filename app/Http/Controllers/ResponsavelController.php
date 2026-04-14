<?php

namespace App\Http\Controllers;

use App\Models\Responsavel;
use Illuminate\Http\Request;

class ResponsavelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $responsaveis = Responsavel::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nome', 'like', "%{$search}%")
                    ->orWhere('cpf', 'like', '%' . preg_replace('/\D+/', '', $search) . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('responsaveis.index', compact('responsaveis', 'search'));
    }

    public function create()
    {
        return view('responsaveis.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'cpf'      => preg_replace('/\D+/', '', $request->input('cpf', '')),
            'telefone' => preg_replace('/\D+/', '', $request->input('telefone', '')) ?: null,
        ]);

        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'rg' => ['nullable', 'string', 'max:20'],
            'orgao_emissor' => ['nullable', 'string', 'max:50'],
            'cpf' => ['required', 'string', 'size:11', 'unique:responsaveis,cpf'],
            'telefone' => ['nullable', 'string', 'max:11'],
            'endereco' => ['nullable', 'string', 'max:255'],
        ]);

        Responsavel::create($data);

        return redirect()
            ->route('responsaveis.index')
            ->with('success', 'Responsável cadastrado com sucesso.');
    }

    public function show(Responsavel $responsavel)
    {
        $responsavel->load(['termos.idosa']);

        return view('responsaveis.show', compact('responsavel'));
    }

    public function edit(Responsavel $responsavel)
    {
        return view('responsaveis.edit', compact('responsavel'));
    }

    public function update(Request $request, Responsavel $responsavel)
    {
        $request->merge([
            'cpf'      => preg_replace('/\D+/', '', $request->input('cpf', '')),
            'telefone' => preg_replace('/\D+/', '', $request->input('telefone', '')) ?: null,
        ]);

        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'rg' => ['nullable', 'string', 'max:20'],
            'orgao_emissor' => ['nullable', 'string', 'max:50'],
            'cpf' => ['required', 'string', 'size:11', 'unique:responsaveis,cpf,' . $responsavel->id],
            'telefone' => ['nullable', 'string', 'max:11'],
            'endereco' => ['nullable', 'string', 'max:255'],
        ]);

        $responsavel->update($data);

        return redirect()
            ->route('responsaveis.index')
            ->with('success', 'Responsável atualizado com sucesso.');
    }

    public function destroy(Responsavel $responsavel)
    {
        $responsavel->delete();

        return redirect()
            ->route('responsaveis.index')
            ->with('success', 'Responsável removido com sucesso.');
    }
}