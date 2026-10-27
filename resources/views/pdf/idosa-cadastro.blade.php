<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro da Idosa</title>

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

    <!-- ✅ MARCA D'ÁGUA -->
    <div class="watermark">
         <img src="{{ public_path('imagens/logo-marca-dagua.png') }}" alt="Marca d'água">
    </div>

    <div class="header">
        <div class="titulo">Cadastro da Idosa Residente</div>
        <div class="subtitulo">ONG Santa Luzia</div>
    </div>

    <!-- DADOS -->
    <div class="campo"><span class="label">Nome:</span> {{ $idosa->nome ?? '-' }}</div>
    <div class="campo"><span class="label">Nome social:</span> {{ $idosa->nome_social ?? '-' }}</div>
    <div class="campo"><span class="label">Apelido:</span> {{ $idosa->apelido ?? '-' }}</div>
    <div class="campo"><span class="label">CPF:</span> {{ $idosa->cpf ?? '-' }}</div>
    <div class="campo"><span class="label">RG:</span> {{ $idosa->rg ?? '-' }}</div>
    <div class="campo"><span class="label">Órgão emissor:</span> {{ $idosa->orgao_emissor ?? '-' }}</div>
    <div class="campo"><span class="label">Estado civil:</span> {{ $idosa->estado_civil ?? '-' }}</div>
    <div class="campo"><span class="label">Data de nascimento:</span> {{ $idosa->data_nascimento?->format('d/m/Y') ?? '-' }}</div>
    <div class="campo"><span class="label">Filiação:</span> {{ $idosa->filiacao ?? '-' }}</div>
    <div class="campo"><span class="label">Naturalidade:</span> {{ $idosa->naturalidade ?? '-' }}</div>
    <div class="campo"><span class="label">Grau de dependência:</span> {{ $idosa->deficiencia ?? '-' }}</div>
    <div class="campo"><span class="label">Data de abrigamento:</span> {{ $idosa->data_abrigamento?->format('d/m/Y') ?? '-' }}</div>
    <div class="campo"><span class="label">Telefone:</span> {{ $idosa->telefone ?? '-' }}</div>
    <div class="campo"><span class="label">Endereço:</span> {{ $idosa->endereco ?? '-' }}</div>
    <div class="campo"><span class="label">Bairro:</span> {{ $idosa->bairro ?? '-' }}</div>
    <div class="campo"><span class="label">Cidade:</span> {{ $idosa->cidade ?? '-' }}</div>

    <div class="footer">
        Documento gerado em {{ now()->format('d/m/Y H:i') }} • ONG Santa Luzia
    </div>

</body>
</html>