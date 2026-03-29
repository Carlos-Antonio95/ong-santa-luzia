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
    <h1>Cadastro da Idosa Residente</h1>

    <div class="campo"><span class="label">Nome:</span> {{ $idosa->nome }}</div>
    <div class="campo"><span class="label">Nome social:</span> {{ $idosa->nome_social ?? '-' }}</div>
    <div class="campo"><span class="label">Apelido:</span> {{ $idosa->apelido ?? '-' }}</div>
    <div class="campo"><span class="label">CPF:</span> {{ $idosa->cpf ?? '-' }}</div>
    <div class="campo"><span class="label">RG:</span> {{ $idosa->rg ?? '-' }}</div>
    <div class="campo"><span class="label">Órgão emissor:</span> {{ $idosa->orgao_emissor ?? '-' }}</div>
    <div class="campo"><span class="label">Estado civil:</span> {{ $idosa->estado_civil ?? '-' }}</div>
    <div class="campo"><span class="label">Data de nascimento:</span> {{ $idosa->data_nascimento?->format('d/m/Y') ?? '-' }}</div>
    <div class="campo"><span class="label">Filiação:</span> {{ $idosa->filiacao ?? '-' }}</div>
    <div class="campo"><span class="label">Naturalidade:</span> {{ $idosa->naturalidade ?? '-' }}</div>
    <div class="campo"><span class="label">Deficiência:</span> {{ $idosa->deficiencia ?? '-' }}</div>
    <div class="campo"><span class="label">Data de abrigamento:</span> {{ $idosa->data_abrigamento?->format('d/m/Y') ?? '-' }}</div>
    <div class="campo"><span class="label">Telefone:</span> {{ $idosa->telefone ?? '-' }}</div>
    <div class="campo"><span class="label">Endereço:</span> {{ $idosa->endereco ?? '-' }}</div>
    <div class="campo"><span class="label">Bairro:</span> {{ $idosa->bairro ?? '-' }}</div>
    <div class="campo"><span class="label">Cidade:</span> {{ $idosa->cidade ?? '-' }}</div>
</body>
</html>