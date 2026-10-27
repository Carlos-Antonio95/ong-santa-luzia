<?php

namespace App\Http\Controllers;

use App\Models\Idosa;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfIdosaController extends Controller
{
    public function cadastro(Idosa $idosa)
    {
        $pdf = Pdf::loadView('pdf.idosa-cadastro', compact('idosa'))
            ->setOptions([
                'isRemoteEnabled' => false,
            ])
            ->setPaper('a4');

        return $pdf->stream('cadastro-'.$idosa->id.'.pdf');
    }

    public function plano(Idosa $idosa)
    {
        $idosa->load('planoIndividual');

        $pdf = Pdf::loadView('pdf.idosa-plano', compact('idosa'))
            ->setOptions([
                'isRemoteEnabled' => false,
            ])
            ->setPaper('a4');

        return $pdf->stream('plano-'.$idosa->id.'.pdf');
    }

    public function termo(Idosa $idosa)
    {
        $idosa->load('ultimoTermo.responsavel');

        $pdf = Pdf::loadView('pdf.idosa-termo', compact('idosa'))
            ->setOptions([
                'isRemoteEnabled' => false,
            ])
            ->setPaper('a4');

        return $pdf->stream('termo-'.$idosa->id.'.pdf');
    }

    public function completo(Idosa $idosa)
    {
        $idosa->load([
            'planoIndividual',
            'termos.responsavel',
            'ultimoTermo.responsavel',
        ]);

        $pdf = Pdf::loadView('pdf.idosa-completo', compact('idosa'))
            ->setOptions([
                'isRemoteEnabled' => false,
            ])
            ->setPaper('a4');

        return $pdf->stream('prontuario-'.$idosa->id.'.pdf');
    }
}