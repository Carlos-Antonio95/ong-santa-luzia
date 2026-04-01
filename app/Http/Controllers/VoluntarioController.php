<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoluntarioRequest;
use App\Models\Voluntario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VoluntarioController extends Controller
{
    public function index(): Response
    {
        $voluntarios = Voluntario::orderBy('created_at', 'desc')->get();

        return response()->json(['data' => $voluntarios]);
    }

    public function store(StoreVoluntarioRequest $request): RedirectResponse
    {
        $dados = $request->validated();

        Voluntario::create($dados);

        return redirect()->back()->with('success', 'Voluntário cadastrado com sucesso.');
    }

    public function show(Voluntario $voluntario): Response
    {
        return response()->json(['data' => $voluntario]);
    }

    public function update(StoreVoluntarioRequest $request, Voluntario $voluntario): RedirectResponse
    {
        $dados = $request->validated();

        $voluntario->update($dados);

        return redirect()->back()->with('success', 'Voluntário atualizado com sucesso.');
    }

    public function destroy(Voluntario $voluntario): RedirectResponse
    {
        $voluntario->delete();

        return redirect()->back()->with('success', 'Voluntário excluído com sucesso.');
    }
}
