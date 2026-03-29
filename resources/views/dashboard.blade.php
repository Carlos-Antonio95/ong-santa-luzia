<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Abrigo Santa Luzia</title>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .status-ok {
            color: #2ecc71;
            font-weight: bold;
        }

        .status-pendente {
            color: #e74c3c;
            font-weight: bold;
        }

        .painel-edicao {
            margin-top: 30px;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .painel-edicao h2 {
            margin-top: 0;
            color: #2ecc71;
        }

        .abas-botoes {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .aba-edicao {
            display: none;
        }

        .aba-edicao.ativa {
            display: block;
        }

        .grupo-campos {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .grupo-campos input,
        .grupo-campos textarea,
        .grupo-campos select {
            flex: 1;
            min-width: 220px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: inherit;
        }

        .grupo-campos textarea {
            min-height: 100px;
            resize: vertical;
        }

        .linha-checkbox {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin: 15px 0;
        }

        .linha-checkbox label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .mensagem-erro {
            background: #e74c3c;
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 10px;
        }

        .resumo-selecao {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .resumo-box {
            background: #f7f7f7;
            padding: 12px 16px;
            border-left: 5px solid #2ecc71;
            border-radius: 8px;
            min-width: 180px;
        }

        .chart-section {
            width: 90%;
            max-width: 1100px;
            margin: 30px auto;
        }

        .chart-wrapper {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .acoes-linha {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .acoes-linha a,
        .acoes-linha form {
            display: inline-block;
        }

        .btn-tab {
            background: #2ecc71;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-tab.inativa {
            background: #95a5a6;
        }
    </style>
</head>

<body>

@if(session('success'))
    <div style="background:#2ecc71; color:white; padding:10px; text-align:center;">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mensagem-erro">
        Existem campos com erro no formulário. Verifique e tente novamente.
    </div>
@endif

<header class="header">
    <div class="logo-area">
        <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logo">
        <h1>Dashboard</h1>
    </div>

    <nav>
        <ul>
            <li><a href="{{ route('dashboard') }}">Visão Geral</a></li>
            <li><a href="#">Usuários</a></li>
            <li><a href="#">Configurações</a></li>
            <li><a href="#">Sair</a></li>
        </ul>
    </nav>
</header>

<main>
<section class="dashboard">

    <h2>Nosso Impacto</h2>

    <div class="dashboard-container">
        <div class="box" onclick="toggleLista()">
            <h3>{{ $idosas->count() }}</h3>
            <p>👵 Idosos acolhidos</p>
        </div>

        <div class="box">
            <h3>1280+</h3>
            <p>🍽️ Refeições por mês</p>
        </div>

        <div class="box">
            <h3>315</h3>
            <p>❤️ Doadores</p>
        </div>

        <div class="box">
            <h3>20</h3>
            <p>🤝 Voluntários</p>
        </div>
    </div>

    <div id="lista-idosos" class="lista-idosos" style="{{ $idosaSelecionada || $errors->any() ? 'display:block;' : '' }}">
        <h2>Lista de Idosos</h2>

        <button class="btn-add" type="button" onclick="toggleForm()">+ Nova Idosa</button>

        <div id="form-container" class="form-container" style="{{ old('form_tipo') === 'nova_idosa' ? 'display:block;' : '' }}">
            <form method="POST" action="{{ route('idosas.store') }}">
                @csrf
                <input type="hidden" name="form_tipo" value="nova_idosa">

                <div class="grupo-campos">
                    <input type="text" name="nome" placeholder="Nome" value="{{ old('nome') }}" required>
                    <input type="text" name="cpf" placeholder="CPF" value="{{ old('cpf') }}" required>
                    <input type="text" name="telefone" placeholder="Telefone" value="{{ old('telefone') }}">
                    <input type="text" name="cep" id="cep-nova" placeholder="CEP" value="{{ old('cep') }}" onblur="buscarCep(this)">
                    <input type="date" name="data_nascimento" value="{{ old('data_nascimento') }}">
                    <input type="text" name="estado_civil" placeholder="Estado Civil" value="{{ old('estado_civil') }}">
                    <input type="text" name="rg" placeholder="RG" value="{{ old('rg') }}">
                    <input type="text" name="orgao_emissor" placeholder="Órgão Emissor" value="{{ old('orgao_emissor') }}">
                    <input type="text" name="filiacao" placeholder="Filiação" value="{{ old('filiacao') }}">
                    <input type="text" name="naturalidade" placeholder="Naturalidade" value="{{ old('naturalidade') }}">
                    <input type="text" name="deficiencia" placeholder="Deficiência" value="{{ old('deficiencia') }}">
                    <input type="date" name="data_abrigamento" value="{{ old('data_abrigamento') }}">
                    <input type="text" name="endereco" placeholder="Endereço" value="{{ old('endereco') }}">
                    <input type="text" name="bairro" placeholder="Bairro" value="{{ old('bairro') }}">
                    <input type="text" name="cidade" placeholder="Cidade" value="{{ old('cidade') }}">
                    <input type="text" name="nome_social" placeholder="Nome Social" value="{{ old('nome_social') }}">
                    <input type="text" name="apelido" placeholder="Apelido" value="{{ old('apelido') }}">
                </div>

                <div style="margin-top:15px;">
                    <button type="submit" class="btn-add">Salvar Nova Idosa</button>
                </div>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Responsável</th>
                    <th>Cadastro</th>
                    <th>Plano</th>
                    <th>Termo</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse($idosas as $idosa)
                    <tr>
                        <td>{{ $idosa->nome }}</td>
                        <td>{{ $idosa->cpf }}</td>
                        <td>{{ $idosa->ultimoTermo?->responsavel?->nome ?? '-' }}</td>
                        <td><span class="status-ok">✅</span></td>
                        <td>
                            @if($idosa->planoIndividual)
                                <span class="status-ok">✅</span>
                            @else
                                <span class="status-pendente">❌</span>
                            @endif
                        </td>
                        <td>
                            @if($idosa->ultimoTermo)
                                <span class="status-ok">✅</span>
                            @else
                                <span class="status-pendente">❌</span>
                            @endif
                        </td>
                        <td>
                            <div class="acoes-linha">
                                <a href="{{ route('idosas.show', $idosa->id) }}">
                                    <button class="edit" type="button">Abrir</button>
                                </a>

                                <a href="{{ route('dashboard', ['idosa' => $idosa->id]) }}">
                                    <button class="edit" type="button">Editar</button>
                                </a>

                                <form method="POST" action="{{ route('idosas.destroy', $idosa->id) }}" onsubmit="return confirm('Deseja realmente excluir esta idosa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete" type="submit">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;">Nenhuma idosa cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($idosaSelecionada)
            <div class="painel-edicao">
                <h2>Editando: {{ $idosaSelecionada->nome }}</h2>

                <div class="resumo-selecao">
                    <div class="resumo-box">
                        <strong>CPF</strong><br>
                        {{ $idosaSelecionada->cpf }}
                    </div>

                    <div class="resumo-box">
                        <strong>Plano Individual</strong><br>
                        {{ $idosaSelecionada->planoIndividual ? 'Preenchido' : 'Pendente' }}
                    </div>

                    <div class="resumo-box">
                        <strong>Termo</strong><br>
                        {{ $idosaSelecionada->ultimoTermo ? 'Preenchido' : 'Pendente' }}
                    </div>

                    <div class="resumo-box">
                        <strong>Responsável Atual</strong><br>
                        {{ $idosaSelecionada->ultimoTermo?->responsavel?->nome ?? '-' }}
                    </div>
                </div>

                <div class="abas-botoes">
                    <button type="button" class="btn-tab" id="btn-aba-dados" onclick="mostrarAba('aba-dados')">Cadastro da Idosa</button>
                    <button type="button" class="btn-tab inativa" id="btn-aba-plano" onclick="mostrarAba('aba-plano')">Plano Individual</button>
                    <button type="button" class="btn-tab inativa" id="btn-aba-termo" onclick="mostrarAba('aba-termo')">Termo de Abrigamento</button>
                </div>

                <div id="aba-dados" class="aba-edicao ativa">
                    <form method="POST" action="{{ route('idosas.update', $idosaSelecionada->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grupo-campos">
                            <input type="text" name="nome" value="{{ old('nome', $idosaSelecionada->nome) }}" placeholder="Nome" required>
                            <input type="text" name="cpf" value="{{ old('cpf', $idosaSelecionada->cpf) }}" placeholder="CPF" required>
                            <input type="text" name="telefone" value="{{ old('telefone', $idosaSelecionada->telefone) }}" placeholder="Telefone">
                            <input type="text" name="cep" id="cep-editar" placeholder="CEP" value="{{ old('cep', '') }}" onblur="buscarCep(this)">
                            <input type="date" name="data_nascimento" value="{{ old('data_nascimento', optional($idosaSelecionada->data_nascimento)->format('Y-m-d')) }}">
                            <input type="text" name="estado_civil" value="{{ old('estado_civil', $idosaSelecionada->estado_civil) }}" placeholder="Estado Civil">
                            <input type="text" name="rg" value="{{ old('rg', $idosaSelecionada->rg) }}" placeholder="RG">
                            <input type="text" name="orgao_emissor" value="{{ old('orgao_emissor', $idosaSelecionada->orgao_emissor) }}" placeholder="Órgão Emissor">
                            <input type="text" name="filiacao" value="{{ old('filiacao', $idosaSelecionada->filiacao) }}" placeholder="Filiação">
                            <input type="text" name="naturalidade" value="{{ old('naturalidade', $idosaSelecionada->naturalidade) }}" placeholder="Naturalidade">
                            <input type="text" name="deficiencia" value="{{ old('deficiencia', $idosaSelecionada->deficiencia) }}" placeholder="Deficiência">
                            <input type="date" name="data_abrigamento" value="{{ old('data_abrigamento', optional($idosaSelecionada->data_abrigamento)->format('Y-m-d')) }}">
                            <input type="text" name="endereco" value="{{ old('endereco', $idosaSelecionada->endereco) }}" placeholder="Endereço">
                            <input type="text" name="bairro" value="{{ old('bairro', $idosaSelecionada->bairro) }}" placeholder="Bairro">
                            <input type="text" name="cidade" value="{{ old('cidade', $idosaSelecionada->cidade) }}" placeholder="Cidade">
                            <input type="text" name="nome_social" value="{{ old('nome_social', $idosaSelecionada->nome_social) }}" placeholder="Nome Social">
                            <input type="text" name="apelido" value="{{ old('apelido', $idosaSelecionada->apelido) }}" placeholder="Apelido">
                        </div>

                        <div style="margin-top:15px;">
                            <button type="submit" class="btn-add">Salvar Cadastro</button>
                        </div>
                    </form>
                </div>

                <div id="aba-plano" class="aba-edicao">
                    <form method="POST" action="{{ route('plano.storeOrUpdate', $idosaSelecionada->id) }}">
                        @csrf

                        <div class="grupo-campos">
                            <input type="date" name="data_ingresso" value="{{ old('data_ingresso', optional($idosaSelecionada->planoIndividual?->data_ingresso)->format('Y-m-d')) }}">
                            <input type="text" name="numero_prontuario" value="{{ old('numero_prontuario', $idosaSelecionada->planoIndividual?->numero_prontuario) }}" placeholder="Número do prontuário">
                            <input type="text" name="origem_residencia" value="{{ old('origem_residencia', $idosaSelecionada->planoIndividual?->origem_residencia) }}" placeholder="Origem da residência">
                            <input type="number" step="0.01" name="renda" value="{{ old('renda', $idosaSelecionada->planoIndividual?->renda) }}" placeholder="Renda">
                            <input type="text" name="escolaridade" value="{{ old('escolaridade', $idosaSelecionada->planoIndividual?->escolaridade) }}" placeholder="Escolaridade">
                            <input type="text" name="profissao" value="{{ old('profissao', $idosaSelecionada->planoIndividual?->profissao) }}" placeholder="Profissão">
                            <input type="text" name="religiao" value="{{ old('religiao', $idosaSelecionada->planoIndividual?->religiao) }}" placeholder="Religião">
                            <input type="text" name="grau_dependencia" value="{{ old('grau_dependencia', $idosaSelecionada->planoIndividual?->grau_dependencia) }}" placeholder="Grau de dependência">
                        </div>

                        <div class="linha-checkbox">
                            <label>
                                <input type="checkbox" name="administra_financeiro" value="1"
                                    {{ old('administra_financeiro', $idosaSelecionada->planoIndividual?->administra_financeiro) ? 'checked' : '' }}>
                                Administra financeiro
                            </label>

                            <label>
                                <input type="checkbox" name="possui_plano_saude" value="1"
                                    {{ old('possui_plano_saude', $idosaSelecionada->planoIndividual?->possui_plano_saude) ? 'checked' : '' }}>
                                Possui plano de saúde
                            </label>
                        </div>

                        <div class="grupo-campos">
                            <textarea name="motivo_institucionalizacao" placeholder="Motivo da institucionalização">{{ old('motivo_institucionalizacao', $idosaSelecionada->planoIndividual?->motivo_institucionalizacao) }}</textarea>
                            <textarea name="diagnostico_medico" placeholder="Diagnóstico médico">{{ old('diagnostico_medico', $idosaSelecionada->planoIndividual?->diagnostico_medico) }}</textarea>
                            <textarea name="descricao_medicacao" placeholder="Descrição da medicação">{{ old('descricao_medicacao', $idosaSelecionada->planoIndividual?->descricao_medicacao) }}</textarea>
                            <textarea name="restricao_alimentar" placeholder="Restrição alimentar">{{ old('restricao_alimentar', $idosaSelecionada->planoIndividual?->restricao_alimentar) }}</textarea>
                            <textarea name="rotina" placeholder="Rotina">{{ old('rotina', $idosaSelecionada->planoIndividual?->rotina) }}</textarea>
                        </div>

                        <div style="margin-top:15px;">
                            <button type="submit" class="btn-add">Salvar Plano Individual</button>
                        </div>
                    </form>
                </div>

                <div id="aba-termo" class="aba-edicao">
                    <form method="POST" action="{{ route('termo.storeOrUpdate', $idosaSelecionada->id) }}">
                        @csrf

                        <div class="grupo-campos">
                            <input type="text" name="responsavel_nome" value="{{ old('responsavel_nome', $idosaSelecionada->ultimoTermo?->responsavel?->nome) }}" placeholder="Nome do responsável" required>
                            <input type="text" name="responsavel_cpf" value="{{ old('responsavel_cpf', $idosaSelecionada->ultimoTermo?->responsavel?->cpf) }}" placeholder="CPF do responsável" required>
                            <input type="text" name="responsavel_rg" value="{{ old('responsavel_rg', $idosaSelecionada->ultimoTermo?->responsavel?->rg) }}" placeholder="RG do responsável">
                            <input type="text" name="responsavel_orgao_emissor" value="{{ old('responsavel_orgao_emissor', $idosaSelecionada->ultimoTermo?->responsavel?->orgao_emissor) }}" placeholder="Órgão emissor">
                            <input type="text" name="responsavel_telefone" value="{{ old('responsavel_telefone', $idosaSelecionada->ultimoTermo?->responsavel?->telefone) }}" placeholder="Telefone do responsável">
                            <input type="text" name="responsavel_endereco" value="{{ old('responsavel_endereco', $idosaSelecionada->ultimoTermo?->responsavel?->endereco) }}" placeholder="Endereço do responsável">
                            <input type="date" name="data_inicio" value="{{ old('data_inicio', optional($idosaSelecionada->ultimoTermo?->data_inicio)->format('Y-m-d')) }}">
                        </div>

                        <div class="linha-checkbox">
                            <label>
                                <input type="checkbox" name="assinado_responsavel" value="1"
                                    {{ old('assinado_responsavel', $idosaSelecionada->ultimoTermo?->assinado_responsavel) ? 'checked' : '' }}>
                                Assinado responsável
                            </label>

                            <label>
                                <input type="checkbox" name="assinado_psicologo" value="1"
                                    {{ old('assinado_psicologo', $idosaSelecionada->ultimoTermo?->assinado_psicologo) ? 'checked' : '' }}>
                                Assinado psicólogo
                            </label>

                            <label>
                                <input type="checkbox" name="assinado_assistente_social" value="1"
                                    {{ old('assinado_assistente_social', $idosaSelecionada->ultimoTermo?->assinado_assistente_social) ? 'checked' : '' }}>
                                Assinado assistente social
                            </label>
                        </div>

                        <div class="grupo-campos">
                            <textarea name="observacoes" placeholder="Observações">{{ old('observacoes', $idosaSelecionada->ultimoTermo?->observacoes) }}</textarea>
                        </div>

                        <div style="margin-top:15px;">
                            <button type="submit" class="btn-add">Salvar Termo de Abrigamento</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</section>
</main>

<div class="chart-section">
    <h2 style="text-align:center; margin-top: 30px;">Doações por Mês</h2>
    <div class="chart-wrapper">
        <canvas id="grafico"></canvas>
    </div>
</div>

<div class="chart-section">
    <h2 style="text-align:center; margin-top: 30px;">Comparativo de Doações</h2>
    <div class="chart-wrapper">
        <canvas id="grafico-doacoes"></canvas>
    </div>
</div>

<script>
function toggleLista() {
    let lista = document.getElementById("lista-idosos");
    lista.style.display = lista.style.display === "block" ? "none" : "block";
}

function toggleForm() {
    let form = document.getElementById("form-container");
    form.style.display = form.style.display === "block" ? "none" : "block";
}
function mostrarAba(id) {
    // Esconde todas as abas
    document.querySelectorAll('.aba-edicao').forEach(function(aba) {
        aba.classList.remove('ativa');
    });

    // Mostra a aba selecionada
    document.getElementById(id).classList.add('ativa');

    // Resetar botões
    document.getElementById('btn-aba-dados').classList.add('inativa');
    document.getElementById('btn-aba-plano').classList.add('inativa');
    document.getElementById('btn-aba-termo').classList.add('inativa');

    // Ativar botão correto
    if (id === 'aba-dados') {
        document.getElementById('btn-aba-dados').classList.remove('inativa');
    }

    if (id === 'aba-plano') {
        document.getElementById('btn-aba-plano').classList.remove('inativa');
    }

    if (id === 'aba-termo') {
        document.getElementById('btn-aba-termo').classList.remove('inativa');
    }
}
document.addEventListener('DOMContentLoaded', function () {
    const aba = "{{ request('aba', 'dados') }}";

    if (aba === 'plano') {
        mostrarAba('aba-plano');
    } else if (aba === 'termo') {
        mostrarAba('aba-termo');
    } else {
        mostrarAba('aba-dados');
    }
});

function buscarCep(input) {
    const cepLimpo = input.value.replace(/\D/g, '');
    if (!cepLimpo || cepLimpo.length !== 8) {
        return;
    }

    const form = input.closest('form');
    if (!form) {
        return;
    }

    const enderecoInput = form.querySelector('input[name="endereco"]');
    const bairroInput = form.querySelector('input[name="bairro"]');
    const cidadeInput = form.querySelector('input[name="cidade"]');

    fetch(`https://viacep.com.br/ws/${cepLimpo}/json/`)
        .then(response => response.json())
        .then(data => {
            if (data.erro) {
                alert('CEP não encontrado. Verifique o número e tente novamente.');
                return;
            }

            if (enderecoInput) enderecoInput.value = data.logradouro || '';
            if (bairroInput) bairroInput.value = data.bairro || '';
            if (cidadeInput) cidadeInput.value = data.localidade || '';
        })
        .catch(() => {
            alert('Não foi possível consultar o CEP. Tente novamente mais tarde.');
        });
}

new Chart(document.getElementById('grafico'), {
    type: 'bar',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
        datasets: [{
            label: 'Doações',
            data: [120, 190, 300, 250, 220]
        }]
    }
});

new Chart(document.getElementById('grafico-doacoes'), {
    type: 'line',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
        datasets: [
            {
                label: '2024',
                data: [100, 150, 200, 180, 210]
            },
            {
                label: '2025',
                data: [120, 190, 300, 250, 220]
            }
        ]
    }
});
</script>

</body>
</html>