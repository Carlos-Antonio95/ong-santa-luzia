<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil da Idosa - {{ $idosa->nome }}</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <style>
        .perfil-container {
            width: 90%;
            max-width: 1100px;
            margin: 30px auto;
        }

        .perfil-topo {
            background: white;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 25px;
        }

        .perfil-topo h2 {
            margin: 0 0 10px 0;
            color: #2ecc71;
        }

        .perfil-info-rapida {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }

        .info-card {
            background: #f4f6f8;
            border-left: 5px solid #2ecc71;
            padding: 12px 15px;
            border-radius: 10px;
            min-width: 180px;
            flex: 1;
        }

        .acoes {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn-acao {
            background: #2ecc71;
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: bold;
            display: inline-block;
        }

        .btn-secundario {
            background: #3498db;
        }

        .btn-voltar {
            background: #1f2020;
        }

        .abas {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .aba-btn {
            background: #e9ecef;
            border: none;
            padding: 12px 18px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .aba-btn.ativa {
            background: #2ecc71;
            color: white;
        }

        .aba-conteudo {
            display: none;
            background: white;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 25px;
        }

        .aba-conteudo.ativa {
            display: block;
        }

        .grid-dados {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 15px;
        }

        .campo {
            background: #f9f9f9;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #eee;
        }

        .campo strong {
            display: block;
            margin-bottom: 6px;
            color: #1f2020;
        }

        .termo-card {
            background: #f9f9f9;
            border-left: 5px solid #2ecc71;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .vazio {
            color: #777;
            font-style: italic;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="logo-area">
        <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logo">
        <h1>Perfil da Idosa</h1>
    </div>

    <nav>
        <ul>
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/idosas/{{ $idosa->id }}/edit">Editar Cadastro</a></li>
            <li><a href="/idosas/{{ $idosa->id }}/plano">Plano</a></li>
            <li><a href="/idosas/{{ $idosa->id }}/termo">Termo</a></li>
        </ul>
    </nav>
</header>

<div class="perfil-container">

    <div class="perfil-topo">
        <h2>{{ $idosa->nome }}</h2>
        <p><strong>CPF:</strong> {{ $idosa->cpf }}</p>

        <div class="perfil-info-rapida">
            <div class="info-card">
                <strong>Idade</strong>
                {{ $idosa->idade ?? '-' }} anos
            </div>

            <div class="info-card">
                <strong>Telefone</strong>
                {{ $idosa->telefone ?? '-' }}
            </div>

            <div class="info-card">
                <strong>Cidade</strong>
                {{ $idosa->cidade ?? '-' }}
            </div>

            <div class="info-card">
                <strong>Plano Individual</strong>
                {{ $idosa->planoIndividual ? 'Preenchido' : 'Pendente' }}
            </div>
        </div>

        <div class="acoes">
            <a href="/dashboard" class="btn-acao btn-voltar">Voltar</a>
            <a href="/idosas/{{ $idosa->id }}/edit" class="btn-acao btn-secundario">Editar Dados</a>
            <a href="/idosas/{{ $idosa->id }}/plano" class="btn-acao">Abrir Plano</a>
            <a href="/idosas/{{ $idosa->id }}/termo" class="btn-acao">Novo Termo</a>
        </div>
    </div>

    <div class="abas">
        <button class="aba-btn ativa" onclick="abrirAba('dados', this)">Dados Pessoais</button>
        <button class="aba-btn" onclick="abrirAba('plano', this)">Plano Individual</button>
        <button class="aba-btn" onclick="abrirAba('termos', this)">Termos</button>
    </div>

    <div id="dados" class="aba-conteudo ativa">
        <div class="grid-dados">
            <div class="campo"><strong>Nome</strong>{{ $idosa->nome ?? '-' }}</div>
            <div class="campo"><strong>Nome social</strong>{{ $idosa->nome_social ?? '-' }}</div>
            <div class="campo"><strong>Apelido</strong>{{ $idosa->apelido ?? '-' }}</div>
            <div class="campo"><strong>Data de nascimento</strong>{{ $idosa->data_nascimento?->format('d/m/Y') ?? '-' }}</div>
            <div class="campo"><strong>Estado civil</strong>{{ $idosa->estado_civil ?? '-' }}</div>
            <div class="campo"><strong>RG</strong>{{ $idosa->rg ?? '-' }}</div>
            <div class="campo"><strong>Órgão emissor</strong>{{ $idosa->orgao_emissor ?? '-' }}</div>
            <div class="campo"><strong>CPF</strong>{{ $idosa->cpf ?? '-' }}</div>
            <div class="campo"><strong>Filiação</strong>{{ $idosa->filiacao ?? '-' }}</div>
            <div class="campo"><strong>Naturalidade</strong>{{ $idosa->naturalidade ?? '-' }}</div>
            <div class="campo"><strong>Deficiência</strong>{{ $idosa->deficiencia ?? '-' }}</div>
            <div class="campo"><strong>Data de abrigamento</strong>{{ $idosa->data_abrigamento?->format('d/m/Y') ?? '-' }}</div>
            <div class="campo"><strong>Telefone</strong>{{ $idosa->telefone ?? '-' }}</div>
            <div class="campo"><strong>Endereço</strong>{{ $idosa->endereco ?? '-' }}</div>
            <div class="campo"><strong>Bairro</strong>{{ $idosa->bairro ?? '-' }}</div>
            <div class="campo"><strong>Cidade</strong>{{ $idosa->cidade ?? '-' }}</div>
        </div>
    </div>

    <div id="plano" class="aba-conteudo">
        @if($idosa->planoIndividual)
            <div class="grid-dados">
                <div class="campo"><strong>Data de ingresso</strong>{{ $idosa->planoIndividual->data_ingresso ?? '-' }}</div>
                <div class="campo"><strong>Nº prontuário</strong>{{ $idosa->planoIndividual->numero_prontuario ?? '-' }}</div>
                <div class="campo"><strong>Origem da residência</strong>{{ $idosa->planoIndividual->origem_residencia ?? '-' }}</div>
                <div class="campo"><strong>Motivo da institucionalização</strong>{{ $idosa->planoIndividual->motivo_institucionalizacao ?? '-' }}</div>
                <div class="campo"><strong>Renda</strong>{{ $idosa->planoIndividual->renda ?? '-' }}</div>
                <div class="campo"><strong>Administra financeiro</strong>{{ $idosa->planoIndividual->administra_financeiro ? 'Sim' : 'Não' }}</div>
                <div class="campo"><strong>Escolaridade</strong>{{ $idosa->planoIndividual->escolaridade ?? '-' }}</div>
                <div class="campo"><strong>Profissão</strong>{{ $idosa->planoIndividual->profissao ?? '-' }}</div>
                <div class="campo"><strong>Religião</strong>{{ $idosa->planoIndividual->religiao ?? '-' }}</div>
                <div class="campo"><strong>Diagnóstico médico</strong>{{ $idosa->planoIndividual->diagnostico_medico ?? '-' }}</div>
                <div class="campo"><strong>Grau de dependência</strong>{{ $idosa->planoIndividual->grau_dependencia ?? '-' }}</div>
                <div class="campo"><strong>Plano de saúde</strong>{{ $idosa->planoIndividual->possui_plano_saude ? 'Sim' : 'Não' }}</div>
                <div class="campo"><strong>Medicação</strong>{{ $idosa->planoIndividual->descricao_medicacao ?? '-' }}</div>
                <div class="campo"><strong>Restrição alimentar</strong>{{ $idosa->planoIndividual->restricao_alimentar ?? '-' }}</div>
                <div class="campo"><strong>Rotina</strong>{{ $idosa->planoIndividual->rotina ?? '-' }}</div>
            </div>
        @else
            <p class="vazio">Nenhum plano individual cadastrado.</p>
        @endif
    </div>

    <div id="termos" class="aba-conteudo">
        @forelse($idosa->termos as $termo)
            <div class="termo-card">
                <p><strong>Data de início:</strong> {{ $termo->data_inicio ?? '-' }}</p>
                <p><strong>Responsável:</strong> {{ $termo->responsavel->nome ?? '-' }}</p>
                <p><strong>CPF do responsável:</strong> {{ $termo->responsavel->cpf ?? '-' }}</p>
                <p><strong>Telefone do responsável:</strong> {{ $termo->responsavel->telefone ?? '-' }}</p>
                <p><strong>Observações:</strong> {{ $termo->observacoes ?? '-' }}</p>
                <p><strong>Assinado responsável:</strong> {{ $termo->assinado_responsavel ? 'Sim' : 'Não' }}</p>
                <p><strong>Assinado psicólogo:</strong> {{ $termo->assinado_psicologo ? 'Sim' : 'Não' }}</p>
                <p><strong>Assinado assistente social:</strong> {{ $termo->assinado_assistente_social ? 'Sim' : 'Não' }}</p>
            </div>
        @empty
            <p class="vazio">Nenhum termo de abrigamento cadastrado.</p>
        @endforelse
    </div>

</div>

<script>
    function abrirAba(id, botao) {
        document.querySelectorAll('.aba-conteudo').forEach(aba => {
            aba.classList.remove('ativa');
        });

        document.querySelectorAll('.aba-btn').forEach(btn => {
            btn.classList.remove('ativa');
        });

        document.getElementById(id).classList.add('ativa');
        botao.classList.add('ativa');
    }
</script>

</body>
</html>