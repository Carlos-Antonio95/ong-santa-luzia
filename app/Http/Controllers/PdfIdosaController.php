<?php

namespace App\Http\Controllers;

use App\Models\Idosa;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfIdosaController extends Controller
{
    public function cadastro(Idosa $idosa)
    {
        $pdf = Pdf::loadView('pdf.idosa-cadastro', compact('idosa'));
        return $pdf->download('cadastro-'.$idosa->id.'.pdf');
    }

    public function plano(Idosa $idosa)
    {
        $idosa->load('planoIndividual');

        $pdf = Pdf::loadView('pdf.idosa-plano', compact('idosa'));
        return $pdf->download('plano-'.$idosa->id.'.pdf');
    }

    public function termo(Idosa $idosa)
    {
        $idosa->load('ultimoTermo.responsavel');

        $pdf = Pdf::loadView('pdf.idosa-termo', compact('idosa'));
        return $pdf->download('termo-'.$idosa->id.'.pdf');
    }

    public function completo(Idosa $idosa)
    {
        $idosa->load([
            'planoIndividual',
            'termos.responsavel',
            'ultimoTermo.responsavel',
        ]);

        $pdf = Pdf::loadView('pdf.idosa-completo', compact('idosa'))
            ->setPaper('a4');

        return $pdf->download('prontuario-'.$idosa->id.'.pdf');
    }
}