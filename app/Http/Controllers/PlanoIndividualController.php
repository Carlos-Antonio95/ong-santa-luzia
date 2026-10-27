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






    public function storeOrUpdate(Request $request, Idosa $idosa)
    {
        $data = $request->validate([
            'data_ingresso' => ['nullable', 'date'],
            'numero_prontuario' => ['nullable', 'string', 'max:255'],
            'origem_residencia' => ['nullable', 'string', 'max:255'],
            'motivo_institucionalizacao' => ['nullable', 'string'],
            'renda' => ['nullable', 'numeric'],
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
        ]);

        $data['administra_financeiro'] = $request->boolean('administra_financeiro');
        $data['possui_plano_saude'] = $request->boolean('possui_plano_saude');

        PlanoIndividual::updateOrCreate(
            ['idosa_id' => $idosa->id],
            $data
        );

        return redirect()->route('dashboard', ['idosa' => $idosa->id])
            ->with('success', 'Plano individual salvo com sucesso.');
    }
}