<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Termo de Abrigamento</title>

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

        /* MARCA D'ÁGUA */
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

        /* HEADER */
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

        /* CAMPOS */
        .campo {
            margin-bottom: 8px;
            padding: 6px 0;
            border-bottom: 1px solid #f3f3f3;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 200px;
        }

        /* FOOTER */
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

    <!-- HEADER -->
    <div class="header">
        <div class="titulo">Termo de Abrigamento</div>
        <div class="subtitulo">ONG Santa Luzia</div>
    </div>

    <!-- DADOS -->
    @if($idosa->ultimoTermo)

        <div class="campo">
            <span class="label">Data de início:</span>
            {{ optional($idosa->ultimoTermo->data_inicio)->format('d/m/Y') ?? '-' }}
        </div>

        <div class="campo">
            <span class="label">Responsável:</span>
            {{ $idosa->ultimoTermo->responsavel->nome ?? '-' }}
        </div>

        <div class="campo">
            <span class="label">CPF:</span>
            {{ $idosa->ultimoTermo->responsavel->cpf ?? '-' }}
        </div>

        <div class="campo">
            <span class="label">Telefone:</span>
            {{ $idosa->ultimoTermo->responsavel->telefone ?? '-' }}
        </div>

        <div class="campo">
            <span class="label">Observações:</span>
            {{ $idosa->ultimoTermo->observacoes ?? '-' }}
        </div>

        <div class="campo">
            <span class="label">Assinado responsável:</span>
            {{ $idosa->ultimoTermo->assinado_responsavel ? 'Sim' : 'Não' }}
        </div>

        <div class="campo">
            <span class="label">Assinado psicólogo:</span>
            {{ $idosa->ultimoTermo->assinado_psicologo ? 'Sim' : 'Não' }}
        </div>

        <div class="campo">
            <span class="label">Assinado assistente social:</span>
            {{ $idosa->ultimoTermo->assinado_assistente_social ? 'Sim' : 'Não' }}
        </div>

    @else
        <p>Nenhum termo cadastrado.</p>
    @endif

    <!-- FOOTER -->
    <div class="footer">
        Documento gerado em {{ now()->format('d/m/Y H:i') }} • ONG Santa Luzia
    </div>

</body>
</html>