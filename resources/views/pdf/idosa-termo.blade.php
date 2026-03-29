<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        .campo { margin-bottom: 10px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Termo de Abrigamento</h1>

    @if($idosa->ultimoTermo)
        <div class="campo"><span class="label">Data de início:</span> {{ optional($idosa->ultimoTermo->data_inicio)->format('d/m/Y') ?? '-' }}</div>
        <div class="campo"><span class="label">Responsável:</span> {{ $idosa->ultimoTermo->responsavel->nome ?? '-' }}</div>
        <div class="campo"><span class="label">CPF:</span> {{ $idosa->ultimoTermo->responsavel->cpf ?? '-' }}</div>
        <div class="campo"><span class="label">Telefone:</span> {{ $idosa->ultimoTermo->responsavel->telefone ?? '-' }}</div>
        <div class="campo"><span class="label">Observações:</span> {{ $idosa->ultimoTermo->observacoes ?? '-' }}</div>
        <div class="campo"><span class="label">Assinado responsável:</span> {{ $idosa->ultimoTermo->assinado_responsavel ? 'Sim' : 'Não' }}</div>
        <div class="campo"><span class="label">Assinado psicólogo:</span> {{ $idosa->ultimoTermo->assinado_psicologo ? 'Sim' : 'Não' }}</div>
        <div class="campo"><span class="label">Assinado assistente social:</span> {{ $idosa->ultimoTermo->assinado_assistente_social ? 'Sim' : 'Não' }}</div>
    @else
        <p>Nenhum termo cadastrado.</p>
    @endif
</body>
</html>