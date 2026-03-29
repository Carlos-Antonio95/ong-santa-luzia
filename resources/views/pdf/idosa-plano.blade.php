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
    <h1>Plano Individual de Atendimento</h1>

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
</body>
</html>