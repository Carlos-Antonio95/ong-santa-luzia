<?php

namespace App\Observers;

use App\Models\Idosa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IdosaObserver
{
    public function created(Idosa $idosa): void
    {
        Log::info('Idosa cadastrada', [
            'idosa_id'  => $idosa->id,
            'nome'      => $idosa->nome,
            'usuario_id' => Auth::id(),
        ]);
    }

    public function updated(Idosa $idosa): void
    {
        Log::info('Idosa atualizada', [
            'idosa_id'   => $idosa->id,
            'nome'       => $idosa->nome,
            'usuario_id' => Auth::id(),
            'alteracoes' => $idosa->getDirty(),
        ]);
    }

    public function deleted(Idosa $idosa): void
    {
        Log::warning('Idosa removida (soft delete)', [
            'idosa_id'   => $idosa->id,
            'nome'       => $idosa->nome,
            'usuario_id' => Auth::id(),
        ]);
    }
}
