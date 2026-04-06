<?php

namespace App\Http\Controllers;

use App\Models\Idosa;
use Illuminate\Http\Request;
use App\Models\Doador;
use App\Models\Doacao;
use App\Models\Voluntario;
use Illuminate\Support\Facades\DB;
use App\Models\UserSetting;

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
         ->with('success', 'Idosa atualizada com sucesso.');
    }

    public function destroy(Idosa $idosa)
    {
        $idosa->delete();

        return redirect()
            ->route('/dashboard')
            ->with('success', 'Idosa removida com sucesso.');
    }

 public function dashboard(Request $request)
{
    $idosas = Idosa::with(['termos.responsavel'])->latest()->get();

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
        ->get();

    $doadorSelecionado = null;
    if ($request->filled('doador')) {
        $doadorSelecionado = Doador::with('doacoes')->findOrFail($request->doador);
    }

    $voluntarios = Voluntario::latest()->get();
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
    $settings = UserSetting::where('user_id', auth()->id())
    ->pluck('value', 'key')
    ->toArray();

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