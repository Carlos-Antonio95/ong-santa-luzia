<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlanoIndividualRequest;
use App\Http\Requests\UpdatePlanoIndividualRequest;
use App\Models\Idosa;
use App\Models\PlanoIndividual;
use Illuminate\Http\Request;

class PlanoIndividualController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->toString();

        $planos = PlanoIndividual::with('idosa')
            ->search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('planos.index', compact('planos', 'search'));
    }

    public function create()
    {
        $idosas = Idosa::orderBy('nome')->get();

        return view('planos.create', compact('idosas'));
    }

    public function store(StorePlanoIndividualRequest $request)
    {
        $data = $request->validated();
        $data['possui_plano_saude'] = $request->boolean('possui_plano_saude');
        $data['administra_financeiro'] = $request->boolean('administra_financeiro');

        PlanoIndividual::create($data);

        return redirect()
            ->route('planos.index')
            ->with('success', 'Plano individual cadastrado com sucesso.');
    }

    public function show(PlanoIndividual $plano)
    {
        $plano->load('idosa');

        return view('planos.show', compact('plano'));
    }

    public function edit(PlanoIndividual $plano)
    {
        $idosas = Idosa::orderBy('nome')->get();

        return view('planos.edit', compact('plano', 'idosas'));
    }

    public function update(UpdatePlanoIndividualRequest $request, PlanoIndividual $plano)
    {
        $data = $request->validated();
        $data['possui_plano_saude'] = $request->boolean('possui_plano_saude');
        $data['administra_financeiro'] = $request->boolean('administra_financeiro');

        $plano->update($data);

        return redirect()
            ->route('planos.index')
            ->with('success', 'Plano individual atualizado com sucesso.');
    }

    public function destroy(PlanoIndividual $plano)
    {
        $plano->delete();

        return redirect()
            ->route('planos.index')
            ->with('success', 'Plano individual removido com sucesso.');
    }
}