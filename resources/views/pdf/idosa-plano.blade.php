<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Plano Individual</title>

    <style>
        @page {
            margin: 40px 30px 55px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1f2020;
            position: relative;
        }

        .watermark {
            position: fixed;
            top: 220px;
            left: 165px;
            width: 400px;
            text-align: center;
            z-index: -1;
            opacity: 0.3;
        }

        .watermark img {
            width: 100%;
            height: auto;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 2px solid #2ecc71;
            padding-bottom: 10px;
        }

        .titulo {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .subtitulo {
            text-align: center;
            font-size: 11px;
            color: #666;
        }

        .campo {
            margin-bottom: 8px;
            padding: 6px 0;
            border-bottom: 1px solid #f3f3f3;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 180px;
        }

        .footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            right: 0;
            font-size: 10px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>

    <!-- MARCA D'ÁGUA -->
    <div class="watermark">
        <img src="{{ asset('imagens/logo-marca-dagua.png') }}" alt="Marca d'água">
    </div>

    <!-- HEADER PADRÃO -->
    <div class="header">
        <div class="titulo">Plano Individual de Atendimento</div>
        <div class="subtitulo">ONG Santa Luzia</div>
    </div>

    @if($idosa->planoIndividual)

        <div class="campo"><span class="label">Data de ingresso:</span> {{ optional($idosa->planoIndividual->data_ingresso)->format('d/m/Y') ?? '-' }}</div>

        <div class="campo"><span class="label">Nº prontuário:</span> {{ $idosa->planoIndividual->numero_prontuario ?? '-' }}</div>

        <div class="campo"><span class="label">Origem da residência:</span> {{ $idosa->planoIndividual->origem_residencia ?? '-' }}</div>

        <div class="campo"><span class="label">Motivo da institucionalização:</span> {{ $idosa->planoIndividual->motivo_institucionalizacao ?? '-' }}</div>

        <div class="campo"><span class="label">Renda:</span> {{ $idosa->planoIndividual->renda ?? '-' }}</div>

        <div class="campo"><span class="label">Administra financeiro:</span> {{ $idosa->planoIndividual->administra_financeiro ? 'Sim' : 'Não' }}</div>

        <div class="campo"><span class="label">Escolaridade:</span> {{ $idosa->planoIndividual->escolaridade ?? '-' }}</div>

        <div class="campo"><span class="label">Profissão:</span> {{ $idosa->planoIndividual->profissao ?? '-' }}</div>

        <div class="campo"><span class="label">Religião:</span> {{ $idosa->planoIndividual->religiao ?? '-' }}</div>

        <div class="campo"><span class="label">Diagnóstico médico:</span> {{ $idosa->planoIndividual->diagnostico_medico ?? '-' }}</div>

        <div class="campo"><span class="label">Grau de dependência:</span> {{ $idosa->planoIndividual->grau_dependencia ?? '-' }}</div>

        <div class="campo"><span class="label">Plano de saúde:</span> {{ $idosa->planoIndividual->possui_plano_saude ? 'Sim' : 'Não' }}</div>

        <div class="campo"><span class="label">Medicação:</span> {{ $idosa->planoIndividual->descricao_medicacao ?? '-' }}</div>

        <div class="campo"><span class="label">Restrição alimentar:</span> {{ $idosa->planoIndividual->restricao_alimentar ?? '-' }}</div>

        <div class="campo"><span class="label">Rotina:</span> {{ $idosa->planoIndividual->rotina ?? '-' }}</div>

    @else
        <p>Nenhum plano individual cadastrado.</p>
    @endif

    <!-- FOOTER -->
    <div class="footer">
        Documento gerado em {{ now()->format('d/m/Y H:i') }} • ONG Santa Luzia
    </div>

</body>
</html>