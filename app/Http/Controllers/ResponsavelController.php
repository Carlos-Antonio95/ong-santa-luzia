<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResponsavelRequest;
use App\Http\Requests\UpdateResponsavelRequest;
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

    public function store(StoreResponsavelRequest $request)
    {
        $data = $request->validated();

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

    public function update(UpdateResponsavelRequest $request, Responsavel $responsavel)
    {
        $data = $request->validated();

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