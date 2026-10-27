3!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Prontuário Completo</title>

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

        h2 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 16px;
            color: #1f2020;
            border-bottom: 1px solid #dcdcdc;
            padding-bottom: 6px;
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

        .quebra {
            page-break-before: always;
        }

        .bloco-termo {
            margin-bottom: 20px;
        }

        hr {
            border: 0;
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }

        .sem-registro {
            color: #666;
            font-style: italic;
            margin-top: 10px;
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

    <!-- CABEÇALHO -->
    <div class="header">
        <div class="titulo">Prontuário Completo</div>
        <div class="subtitulo">ONG Santa Luzia</div>
    </div>

    <!-- CAPA / RESUMO -->
    <h2>{{ $idosa->nome }}</h2>

    <div class="campo"><span class="label">CPF:</span> {{ $idosa->cpf ?? '-' }}</div>
    <div class="campo"><span class="label">Telefone:</span> {{ $idosa->telefone ?? '-' }}</div>
    <div class="campo"><span class="label">Cidade:</span> {{ $idosa->cidade ?? '-' }}</div>

    <!-- CADASTRO -->
    <div class="quebra"></div>
    <h2>Cadastro da Idosa</h2>

    <div class="campo"><span class="label">Nome:</span> {{ $idosa->nome ?? '-' }}</div>
    <div class="campo"><span class="label">Nome social:</span> {{ $idosa->nome_social ?? '-' }}</div>
    <div class="campo"><span class="label">Apelido:</span> {{ $idosa->apelido ?? '-' }}</div>
    <div class="campo"><span class="label">Data de nascimento:</span> {{ $idosa->data_nascimento?->format('d/m/Y') ?? '-' }}</div>
    <div class="campo"><span class="label">Estado civil:</span> {{ $idosa->estado_civil ?? '-' }}</div>
    <div class="campo"><span class="label">RG:</span> {{ $idosa->rg ?? '-' }}</div>
    <div class="campo"><span class="label">Órgão emissor:</span> {{ $idosa->orgao_emissor ?? '-' }}</div>
    <div class="campo"><span class="label">Filiação:</span> {{ $idosa->filiacao ?? '-' }}</div>
    <div class="campo"><span class="label">Naturalidade:</span> {{ $idosa->naturalidade ?? '-' }}</div>
    <div class="campo"><span class="label">Deficiência:</span> {{ $idosa->deficiencia ?? '-' }}</div>
    <div class="campo"><span class="label">Data de abrigamento:</span> {{ $idosa->data_abrigamento?->format('d/m/Y') ?? '-' }}</div>
    <div class="campo"><span class="label">Endereço:</span> {{ $idosa->endereco ?? '-' }}</div>
    <div class="campo"><span class="label">Bairro:</span> {{ $idosa->bairro ?? '-' }}</div>
    <div class="campo"><span class="label">Cidade:</span> {{ $idosa->cidade ?? '-' }}</div>
    <div class="campo"><span class="label">Telefone:</span> {{ $idosa->telefone ?? '-' }}</div>

    <!-- PLANO INDIVIDUAL -->
    <div class="quebra"></div>
    <h2>Plano Individual</h2>

    @if($idosa->planoIndividual)
        <div class="campo"><span class="label">Data de ingresso:</span> {{ optional($idosa->planoIndividual->data_ingresso)->format('d/m/Y') ?? '-' }}</div>
        <div class="campo"><span class="label">Nº prontuário:</span> {{ $idosa->planoIndividual->numero_prontuario ?? '-' }}</div>
        <div class="campo"><span class="label">Origem da residência:</span> {{ $idosa->planoIndividual->origem_residencia ?? '-' }}</div>
        <div class="campo"><span class="label">Motivo:</span> {{ $idosa->planoIndividual->motivo_institucionalizacao ?? '-' }}</div>
        <div class="campo"><span class="label">Renda:</span> {{ $idosa->planoIndividual->renda ?? '-' }}</div>
        <div class="campo"><span class="label">Escolaridade:</span> {{ $idosa->planoIndividual->escolaridade ?? '-' }}</div>
        <div class="campo"><span class="label">Profissão:</span> {{ $idosa->planoIndividual->profissao ?? '-' }}</div>
        <div class="campo"><span class="label">Diagnóstico médico:</span> {{ $idosa->planoIndividual->diagnostico_medico ?? '-' }}</div>
        <div class="campo"><span class="label">Rotina:</span> {{ $idosa->planoIndividual->rotina ?? '-' }}</div>
    @else
        <p class="sem-registro">Nenhum plano individual cadastrado.</p>
    @endif

    <!-- TERMOS -->
    <div class="quebra"></div>
    <h2>Termos de Abrigamento</h2>

    @forelse($idosa->termos as $termo)
        <div class="bloco-termo">
            <div class="campo"><span class="label">Data de início:</span> {{ optional($termo->data_inicio)->format('d/m/Y') ?? '-' }}</div>
            <div class="campo"><span class="label">Responsável:</span> {{ $termo->responsavel->nome ?? '-' }}</div>
            <div class="campo"><span class="label">CPF do responsável:</span> {{ $termo->responsavel->cpf ?? '-' }}</div>
            <div class="campo"><span class="label">Telefone:</span> {{ $termo->responsavel->telefone ?? '-' }}</div>
            <div class="campo"><span class="label">Observações:</span> {{ $termo->observacoes ?? '-' }}</div>
        </div>

        @if(!$loop->last)
            <hr>
        @endif
    @empty
        <p class="sem-registro">Nenhum termo cadastrado.</p>
    @endforelse

    <!-- RODAPÉ -->
    <div class="footer">
        Documento gerado em {{ now()->format('d/m/Y H:i') }} • ONG Santa Luzia
    </div>

</body>
</html>