<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1, h2 { text-align: center; }
        .campo { margin-bottom: 8px; }
        .label { font-weight: bold; }
        .quebra { page-break-before: always; }
    </style>
</head>
<body>
    <h1>Prontuário Completo</h1>
    <h2>{{ $idosa->nome }}</h2>

    <div class="campo"><span class="label">CPF:</span> {{ $idosa->cpf }}</div>
    <div class="campo"><span class="label">Telefone:</span> {{ $idosa->telefone ?? '-' }}</div>
    <div class="campo"><span class="label">Cidade:</span> {{ $idosa->cidade ?? '-' }}</div>

    <div class="quebra"></div>
    <h2>Cadastro da Idosa</h2>
    <div class="campo"><span class="label">Nome:</span> {{ $idosa->nome }}</div>
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
        <p>Nenhum plano individual cadastrado.</p>
    @endif

    <div class="quebra"></div>
    <h2>Termos de Abrigamento</h2>
    @forelse($idosa->termos as $termo)
        <div style="margin-bottom: 20px;">
            <div class="campo"><span class="label">Data de início:</span> {{ optional($termo->data_inicio)->format('d/m/Y') ?? '-' }}</div>
            <div class="campo"><span class="label">Responsável:</span> {{ $termo->responsavel->nome ?? '-' }}</div>
            <div class="campo"><span class="label">CPF do responsável:</span> {{ $termo->responsavel->cpf ?? '-' }}</div>
            <div class="campo"><span class="label">Telefone:</span> {{ $termo->responsavel->telefone ?? '-' }}</div>
            <div class="campo"><span class="label">Observações:</span> {{ $termo->observacoes ?? '-' }}</div>
        </div>
        <hr>
    @empty
        <p>Nenhum termo cadastrado.</p>
    @endforelse
</body>
</html>