<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdosaRequest;
use App\Http\Requests\UpdateIdosaRequest;
use App\Models\Doacao;
use App\Models\Doador;
use App\Models\Idosa;
use App\Models\UserSetting;
use App\Models\Voluntario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(StoreIdosaRequest $request)
    {
        $data = $request->validated();

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

    public function update(UpdateIdosaRequest $request, Idosa $idosa)
    {
        $data = $request->validated();

        $idosa->update($data);

        return redirect('/dashboard')
         ->with('success', 'Idosa atualizada com sucesso.');
    }

    public function destroy(Idosa $idosa)
    {
        $idosa->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Idosa removida com sucesso.');
    }

 public function dashboard(Request $request)
{
    // Limite de 500 registros para proteger a performance do dashboard.
    // Para volumes maiores, migrar dropdowns para busca via AJAX.
    $idosas = Idosa::with(['termos.responsavel'])->latest()->take(500)->get();

    $idosaSelecionada = null;
    if ($request->filled('idosa')) {
        $idosaSelecionada = Idosa::with([
            'planoIndividual',
            'ultimoTermo.responsavel',
            'termos.responsavel',
        ])->findOrFail($request->idosa);
    }

    $doadores = Doador::with('doacoes')
        ->withSum('doacoes', 'valor')
        ->latest()
        ->take(500)
        ->get();

    $doadorSelecionado = null;
    if ($request->filled('doador')) {
        $doadorSelecionado = Doador::with('doacoes')->findOrFail($request->doador);
    }

    $voluntarios = Voluntario::latest()->take(500)->get();
    $voluntarioSelecionado = null;
    if ($request->filled('voluntario')) {
        $voluntarioSelecionado = Voluntario::findOrFail($request->voluntario);
    }

    $doacoesAgrupadas = Doacao::selectRaw('YEAR(data_doacao) as ano, MONTH(data_doacao) as mes, SUM(valor) as total')
        ->whereIn(DB::raw('YEAR(data_doacao)'), [now()->year - 1, now()->year])
        ->groupByRaw('YEAR(data_doacao), MONTH(data_doacao)')
        ->orderByRaw('YEAR(data_doacao), MONTH(data_doacao)')
        ->get();

    $dadosMesAtual = array_fill(0, 12, 0);
    $dadosAnoPassado = array_fill(0, 12, 0);

    foreach ($doacoesAgrupadas as $item) {
        $indice = $item->mes - 1;

        if ((int) $item->ano === (int) now()->year) {
            $dadosMesAtual[$indice] = (float) $item->total;
        }

        if ((int) $item->ano === (int) now()->year - 1) {
            $dadosAnoPassado[$indice] = (float) $item->total;
        }
    }
    $settings = [];

    return view('dashboard', compact(
        'idosas',
        'idosaSelecionada',
        'doadores',
        'doadorSelecionado',
        'voluntarios',
        'voluntarioSelecionado',
        'dadosMesAtual',
        'dadosAnoPassado',
        'settings'
    ));
}
}