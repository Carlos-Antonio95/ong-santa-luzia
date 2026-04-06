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

        .bloco-lista {
            margin-top: 25px;
            background: rgb(255, 255, 255);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .tabela-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: white;
            
        }

        table th,
        table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
            vertical-align: middle;
        }

        table th {
            background: #f8f8f8;
            color:rgb(0, 0, 0);
        }

        .btn-add {
            background: #2ecc71;
            color: white;
            border: none;
            padding: 10px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .edit {
            background: #3498db;
            color: rgb(0, 0, 0);
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
        }

        .delete {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
        }

        .form-container {
            margin-top: 20px;
            margin-bottom: 20px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
        }
        .menu-usuario {
    position: relative;
    display: inline-block;
}

.menu-link {
    color: white;
    text-decoration: none;
    font-weight: bold;
    cursor: pointer;
}

.submenu {
    display: none;
    position: absolute;
    top: 35px;
    right: 0;
    background: white;
    min-width: 220px;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    z-index: 999;
    overflow: hidden;
}

.submenu a {
    display: block;
    padding: 12px 16px;
    color: #222;
    text-decoration: none;
    font-weight: 600;
    border-bottom: 1px solid #eee;
}

.submenu a:last-child {
    border-bottom: none;
}

.submenu a:hover {
    background: #f5f5f5;
}

.submenu.show {
    display: block;
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
            <li>
                <div class="menu-usuario">
    <a href="#" onclick="toggleDropdown(event)" class="menu-link">Usuários</a>

    <div class="submenu" id="submenuUsuarios">
        <div style="padding:12px 16px; font-weight:600; color:#2ecc71; border-bottom:1px solid #eee;">Olá, {{ explode(' ', Auth::user()->name)[0] }}</div>
        <a href="{{ route('password.confirm') }}">Alterar Senha</a>
        <a href="{{ route('register.user') }}">Registrar Novo Usuário</a>
    </div>
</div>
            </li>
            <li>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="
            background: none;
            border: none;
            color: rgb(255, 255, 255);
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
            font-size: 16px;
        ">
            Sair
        </button>
    </form>
</li>
        </ul>
    </nav>
</header>

<main>
<section class="dashboard">

    <h2>Nosso Impacto</h2>

    <div class="dashboard-container">
        <div class="box" onclick="toggleListaIdosos()" style="cursor:pointer;">
            <h3>{{ $idosas->count() }}</h3>
            <p>👵 Idosos acolhidos</p>
        </div>


        <div class="box" onclick="toggleListaDoadores()" style="cursor:pointer;">
            <h3>{{ $doadores->count() }}</h3>
            <p>❤️ Doadores</p>
        </div>

        <div class="box" onclick="toggleListaVoluntarios()" style="cursor:pointer;">
            <h3>{{ $voluntarios->count() }}</h3>
            <p>🤝 Voluntários</p>
        </div>
    </div>

    {{-- LISTA DE IDOSAS --}}
    <div id="lista-idosos" class="bloco-lista" style="{{ $idosaSelecionada || old('form_tipo') === 'nova_idosa' ? 'display:block;' : 'display:none;' }}">
        <h2>Lista de Idosos</h2>

        <button class="btn-add" type="button" onclick="toggleFormIdosa()">+ Nova Idosa</button>

        <div id="form-container-idosa" class="form-container" style="{{ old('form_tipo') === 'nova_idosa' ? 'display:block;' : 'display:none;' }}">
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

        <div class="tabela-wrapper">
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
                    <button type="button" class="btn-tab" id="btn-aba-dados" onclick="mostrarAbaIdosa('aba-dados')">Cadastro da Idosa</button>
                    <button type="button" class="btn-tab inativa" id="btn-aba-plano" onclick="mostrarAbaIdosa('aba-plano')">Plano Individual</button>
                    <button type="button" class="btn-tab inativa" id="btn-aba-termo" onclick="mostrarAbaIdosa('aba-termo')">Termo de Abrigamento</button>
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
        </div>

    </div>

    {{-- LISTA DE DOADORES --}}
    <div id="lista-doadores" class="bloco-lista" style="{{ $doadorSelecionado || old('form_tipo') === 'novo_doador' ? 'display:block;' : 'display:none;' }}">
        <h2>Lista de Doadores</h2>

        <button class="btn-add" type="button" onclick="toggleFormDoador()">+ Novo Doador</button>

        <div id="form-container-doador" class="form-container" style="{{ old('form_tipo') === 'novo_doador' ? 'display:block;' : 'display:none;' }}">
            <form method="POST" action="{{ route('doadores.store') }}">
                @csrf
                <input type="hidden" name="form_tipo" value="novo_doador">
                <input type="hidden" name="criar_doacao" id="criar_doacao" value="0">

                <!-- Abas -->
                <div class="abas-botoes" style="margin-bottom: 15px;">
                    <button type="button" class="btn-tab ativa" id="btn-novo-doador-cadastro" onclick="mostrarAbaNovoDador('aba-novo-doador-cadastro')">Cadastro</button>
                    <button type="button" class="btn-tab inativa" id="btn-novo-doador-doacao" onclick="mostrarAbaNovoDador('aba-novo-doador-doacao')">Doação (Opcional)</button>
                </div>

                <!-- Aba Cadastro -->
                <div id="aba-novo-doador-cadastro" class="aba-edicao ativa">
                    <div class="grupo-campos">
                        <input type="text" name="nome" placeholder="Nome do doador" value="{{ old('nome') }}" required>
                        <input type="text" name="cpf" placeholder="CPF" value="{{ old('cpf') }}">
                        <input type="text" name="telefone" placeholder="Telefone" value="{{ old('telefone') }}">
                        <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}">
                        <select name="tipo">
                            <option value="Pessoa Física" {{ old('tipo') == 'Pessoa Física' ? 'selected' : '' }}>Pessoa Física</option>
                            <option value="Empresa" {{ old('tipo') == 'Empresa' ? 'selected' : '' }}>Empresa</option>
                        </select>
                    </div>

                    <div class="grupo-campos">
                        <textarea name="observacoes" placeholder="Observações">{{ old('observacoes') }}</textarea>
                    </div>
                </div>

                <!-- Aba Doação -->
                <div id="aba-novo-doador-doacao" class="aba-edicao">
                    <p style="color: #666; margin-bottom: 10px; font-size: 0.9em;">Preencha os dados abaixo se deseja registrar uma doação junto ao cadastro do doador. Todos os campos desta seção são opcionais.</p>
                    
                    <div class="grupo-campos">
                        <input type="number" step="0.01" min="0.01" name="doacao_valor" placeholder="Valor da doação" value="{{ old('doacao_valor') }}">
                        <input type="date" name="doacao_data" value="{{ old('doacao_data') }}">
                        <input type="text" name="doacao_forma_pagamento" placeholder="Forma de pagamento" value="{{ old('doacao_forma_pagamento') }}">
                        <select name="doacao_tipo">
                        <option value="Financeira" {{ old('doacao_tipo') == 'Financeira' ? 'selected' : '' }}>Financeira</option>
                        <option value="Alimentos" {{ old('doacao_tipo') == 'Alimentos' ? 'selected' : '' }}>Alimentos</option>
                        <option value="Roupas" {{ old('doacao_tipo') == 'Roupas' ? 'selected' : '' }}>Roupas</option>
                        <option value="Medicamentos" {{ old('doacao_tipo') == 'Medicamentos' ? 'selected' : '' }}>Medicamentos</option>
                        <option value="Higiene" {{ old('doacao_tipo') == 'Higiene' ? 'selected' : '' }}>Higiene</option>
                        <option value="Outros" {{ old('doacao_tipo') == 'Outros' ? 'selected' : '' }}>Outros</option>
                    </select>
                    </div>

                    <div class="grupo-campos">
                        <textarea name="doacao_descricao" placeholder="Descrição da doação">{{ old('doacao_descricao') }}</textarea>
                    </div>
                </div>

                <div style="margin-top:15px;">
                    <button type="submit" class="btn-add">Salvar Novo Doador</button>
                </div>
            </form>
        </div>

        <div class="tabela-wrapper">
             @if($doadorSelecionado)
            <div class="painel-edicao">
                <h2>Editando Doador: {{ $doadorSelecionado->nome }}</h2>

                <div class="resumo-selecao">
                    <div class="resumo-box">
                        <strong>Telefone</strong><br>
                        {{ $doadorSelecionado->telefone ?? '-' }}
                    </div>

                    <div class="resumo-box">
                        <strong>E-mail</strong><br>
                        {{ $doadorSelecionado->email ?? '-' }}
                    </div>

                    <div class="resumo-box">
                        <strong>Total Doado</strong><br>
                        R$ {{ number_format($doadorSelecionado->doacoes->sum('valor'), 2, ',', '.') }}
                    </div>

                    <div class="resumo-box">
                        <strong>Qtd. Doações</strong><br>
                        {{ $doadorSelecionado->doacoes->count() }}
                    </div>
                </div>

                <div class="abas-botoes">
                    <button type="button" class="btn-tab" id="btn-aba-doador-cadastro" onclick="mostrarAbaDoador('aba-doador-cadastro')">Cadastro do Doador</button>
                    <button type="button" class="btn-tab inativa" id="btn-aba-doador-doacoes" onclick="mostrarAbaDoador('aba-doador-doacoes')">Doações</button>
                </div>

                <div id="aba-doador-cadastro" class="aba-edicao ativa">
                    <form method="POST" action="{{ route('doadores.update', $doadorSelecionado->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grupo-campos">
                            <input type="text" name="nome" value="{{ old('nome', $doadorSelecionado->nome) }}" placeholder="Nome" required>
                            <input type="text" name="cpf" value="{{ old('cpf', $doadorSelecionado->cpf) }}" placeholder="CPF">
                            <input type="text" name="telefone" value="{{ old('telefone', $doadorSelecionado->telefone) }}" placeholder="Telefone">
                            <input type="email" name="email" value="{{ old('email', $doadorSelecionado->email) }}" placeholder="E-mail">
                            <select name="tipo">
                                <option value="Pessoa Física" {{ old('tipo', $doadorSelecionado->tipo) == 'Pessoa Física' ? 'selected' : '' }}>Pessoa Física</option>
                                <option value="Empresa" {{ old('tipo', $doadorSelecionado->tipo) == 'Empresa' ? 'selected' : '' }}>Empresa</option>
                            </select>
                        </div>

                        <div class="grupo-campos">
                            <textarea name="observacoes" placeholder="Observações">{{ old('observacoes', $doadorSelecionado->observacoes) }}</textarea>
                        </div>

                        <div style="margin-top:15px;">
                            <button type="submit" class="btn-add">Salvar Doador</button>
                        </div>
                    </form>
                </div>

                <div id="aba-doador-doacoes" class="aba-edicao">
                    <form method="POST" action="{{ route('doacoes.store', $doadorSelecionado->id) }}">
                        @csrf

                        <div class="grupo-campos">
                            <input type="number" step="0.01" min="0.01" name="valor" placeholder="Valor da doação" required>
                            <input type="date" name="data_doacao" value="{{ date('Y-m-d') }}" required>
                            <input type="text" name="forma_pagamento" placeholder="Forma de pagamento">
                            <select name="tipo_doacao">
                                <option value="Financeira">Financeira</option>
                                <option value="Alimentos">Alimentos</option>
                                <option value="Roupas">Roupas</option>
                                <option value="Medicamentos">Medicamentos</option>
                                <option value="Higiene">Higiene</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>

                        <div class="grupo-campos">
                            <textarea name="descricao" placeholder="Descrição da doação"></textarea>
                        </div>

                        <div style="margin-top:15px;">
                            <button type="submit" class="btn-add">Salvar Doação</button>
                        </div>
                    </form>

                    <div class="tabela-wrapper" style="margin-top:20px;">
                        <table>
                            <thead>
                                <tr>
                                    <th style="color:black;">Data</th>
                                    <th style="color:black;">Valor</th>
                                    <th style="color:black;">Forma</th>
                                    <th style="color:black;">Tipo</th>
                                    <th style="color:black;">Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($doadorSelecionado->doacoes->sortByDesc('data_doacao') as $doacao)
                                    <tr>
                                        <td>{{ optional($doacao->data_doacao)->format('d/m/Y') }}</td>
                                        <td>R$ {{ number_format($doacao->valor, 2, ',', '.') }}</td>
                                        <td>{{ $doacao->forma_pagamento ?? '-' }}</td>
                                        <td>{{ $doacao->tipo_doacao ?? '-' }}</td>
                                        <td>{{ $doacao->descricao ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align:center;">Nenhuma doação cadastrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
            <table>
                <thead>
                    <tr>
                        <th style="color:black;">Nome</th>
                        <th style="color:black;">Telefone</th>
                        <th style="color:black;">Tipo</th>
                        <th style="color:black;">Total Doado</th>
                        <th style="color:black;">Qtd. Doações</th>
                        <th style="color:black;">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($doadores as $doador)
                        <tr>
                            <td>{{ $doador->nome }}</td>
                            <td>{{ $doador->telefone ?? '-' }}</td>
                            <td>{{ $doador->tipo ?? '-' }}</td>
                            <td>R$ {{ number_format($doador->doacoes_sum_valor ?? 0, 2, ',', '.') }}</td>
                            <td>{{ $doador->doacoes->count() }}</td>
                            <td>
                                <div class="acoes-linha">
                                    <a href="{{ route('dashboard', ['doador' => $doador->id]) }}">
                                        <button class="edit" type="button">Editar</button>
                                    </a>

                                    <form method="POST" action="{{ route('doadores.destroy', $doador->id) }}" onsubmit="return confirm('Deseja realmente excluir este doador?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete" type="submit">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">Nenhum doador cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        
    </div>
    {{-- LISTA DE VOLUNTARIOS --}}
        <div id="lista-voluntarios" class="bloco-lista" style="{{ $voluntarioSelecionado || old('form_tipo') === 'novo_voluntario' ? 'display:block;' : 'display:none;' }}">
            <h2>Lista de Voluntários</h2>

            <button class="btn-add" type="button" onclick="toggleFormVoluntario()">+ Novo Voluntário</button>

            <div id="form-container-voluntario" class="form-container" style="{{ old('form_tipo') === 'novo_voluntario' ? 'display:block;' : 'display:none;' }}">
                <form method="POST" action="{{ route('voluntarios.store') }}">
                    @csrf
                    <input type="hidden" name="form_tipo" value="novo_voluntario">

                    <div class="grupo-campos">
                        <input type="text" name="nome" placeholder="Nome" value="{{ old('nome') }}" required>
                        <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
                        <input type="text" name="telefone" placeholder="Telefone" value="{{ old('telefone') }}">
                        <input type="date" name="data_nascimento" value="{{ old('data_nascimento') }}">
                        <input type="text" name="skills" placeholder="Habilidades / skills" value="{{ old('skills') }}">
                    </div>

                    <div class="grupo-campos">
                        <textarea name="observacoes" placeholder="Observações">{{ old('observacoes') }}</textarea>
                    </div>

                    <div style="margin-top:15px;">
                        <button type="submit" class="btn-add">Salvar Novo Voluntário</button>
                    </div>
                </form>
            </div>

            <div class="tabela-wrapper">
                @if($voluntarioSelecionado)
                    <div class="painel-edicao">
                        <h2>Editando Voluntário: {{ $voluntarioSelecionado->nome }}</h2>

                        <div class="resumo-selecao">
                            <div class="resumo-box">
                                <strong>E-mail</strong><br>
                                {{ $voluntarioSelecionado->email ?? '-' }}
                            </div>
                            <div class="resumo-box">
                                <strong>Telefone</strong><br>
                                {{ $voluntarioSelecionado->telefone ?? '-' }}
                            </div>
                            <div class="resumo-box">
                                <strong>Data Nascimento</strong><br>
                                {{ optional($voluntarioSelecionado->data_nascimento)->format('d/m/Y') ?? '-' }}
                            </div>
                        </div>

                        <form method="POST" action="{{ route('voluntarios.update', $voluntarioSelecionado->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="grupo-campos">
                                <input type="text" name="nome" value="{{ old('nome', $voluntarioSelecionado->nome) }}" placeholder="Nome" required>
                                <input type="email" name="email" value="{{ old('email', $voluntarioSelecionado->email) }}" placeholder="E-mail" required>
                                <input type="text" name="telefone" value="{{ old('telefone', $voluntarioSelecionado->telefone) }}" placeholder="Telefone">
                                <input type="date" name="data_nascimento" value="{{ old('data_nascimento', optional($voluntarioSelecionado->data_nascimento)->format('Y-m-d')) }}">
                                <input type="text" name="skills" value="{{ old('skills', $voluntarioSelecionado->skills) }}" placeholder="Habilidades / skills">
                            </div>

                            <div class="grupo-campos">
                                <textarea name="observacoes" placeholder="Observações">{{ old('observacoes', $voluntarioSelecionado->observacoes) }}</textarea>
                            </div>

                            <div style="margin-top:15px;">
                                <button type="submit" class="btn-add">Salvar Voluntário</button>
                            </div>
                        </form>
                    </div>
                @endif

                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Habilidades</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($voluntarios as $voluntario)
                            <tr>
                                <td>{{ $voluntario->nome }}</td>
                                <td>{{ $voluntario->email }}</td>
                                <td>{{ $voluntario->telefone ?? '-' }}</td>
                                <td>{{ $voluntario->skills ? (strlen($voluntario->skills) > 60 ? substr($voluntario->skills, 0, 60).'...' : $voluntario->skills) : '-' }}</td>
                                <td>
                                    <div class="acoes-linha">
                                        <a href="{{ route('dashboard', ['voluntario' => $voluntario->id]) }}">
                                            <button class="edit" type="button">Editar</button>
                                        </a>
                                        <form method="POST" action="{{ route('voluntarios.destroy', $voluntario->id) }}" onsubmit="return confirm('Deseja realmente excluir este voluntário?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete" type="submit">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;">Nenhum voluntário cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
function toggleListaIdosos() {
    const lista = document.getElementById("lista-idosos");
    if (!lista) return;
    const atual = window.getComputedStyle(lista).display;
    lista.style.display = atual === "none" ? "block" : "none";
}

function toggleFormIdosa() {
    const form = document.getElementById("form-container-idosa");
    if (!form) return;
    const atual = window.getComputedStyle(form).display;
    form.style.display = atual === "none" ? "block" : "none";
}

function toggleListaDoadores() {
    const lista = document.getElementById("lista-doadores");
    if (!lista) return;
    const atual = window.getComputedStyle(lista).display;
    lista.style.display = atual === "none" ? "block" : "none";
}

function toggleFormDoador() {
    const form = document.getElementById("form-container-doador");
    if (!form) return;
    const atual = window.getComputedStyle(form).display;
    form.style.display = atual === "none" ? "block" : "none";
}

function toggleListaVoluntarios() {
    const lista = document.getElementById("lista-voluntarios");
    if (!lista) return;
    const atual = window.getComputedStyle(lista).display;
    lista.style.display = atual === "none" ? "block" : "none";
}

function toggleFormVoluntario() {
    const form = document.getElementById("form-container-voluntario");
    if (!form) return;
    const atual = window.getComputedStyle(form).display;
    form.style.display = atual === "none" ? "block" : "none";
}

function mostrarAbaIdosa(id) {
    document.querySelectorAll('#aba-dados, #aba-plano, #aba-termo').forEach(function(aba) {
        if (aba) aba.classList.remove('ativa');
    });

    document.getElementById(id).classList.add('ativa');

    document.getElementById('btn-aba-dados').classList.add('inativa');
    document.getElementById('btn-aba-plano').classList.add('inativa');
    document.getElementById('btn-aba-termo').classList.add('inativa');

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

function mostrarAbaDoador(id) {
    document.querySelectorAll('#aba-doador-cadastro, #aba-doador-doacoes').forEach(function(aba) {
        if (aba) aba.classList.remove('ativa');
    });

    document.getElementById(id).classList.add('ativa');

    document.getElementById('btn-aba-doador-cadastro').classList.add('inativa');
    document.getElementById('btn-aba-doador-doacoes').classList.add('inativa');

    if (id === 'aba-doador-cadastro') {
        document.getElementById('btn-aba-doador-cadastro').classList.remove('inativa');
    }

    if (id === 'aba-doador-doacoes') {
        document.getElementById('btn-aba-doador-doacoes').classList.remove('inativa');
    }
}

function mostrarAbaNovoDador(id) {
    document.querySelectorAll('#aba-novo-doador-cadastro, #aba-novo-doador-doacao').forEach(function(aba) {
        if (aba) aba.classList.remove('ativa');
    });

    document.getElementById(id).classList.add('ativa');

    document.getElementById('btn-novo-doador-cadastro').classList.add('inativa');
    document.getElementById('btn-novo-doador-doacao').classList.add('inativa');

    if (id === 'aba-novo-doador-cadastro') {
        document.getElementById('btn-novo-doador-cadastro').classList.remove('inativa');
    }

    if (id === 'aba-novo-doador-doacao') {
        document.getElementById('btn-novo-doador-doacao').classList.remove('inativa');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const aba = "{{ request('aba', 'dados') }}";
    const temIdosaSelecionada = @json((bool) $idosaSelecionada);
    const temDoadorSelecionado = @json((bool) $doadorSelecionado);

    if (temIdosaSelecionada) {
        if (aba === 'plano') {
            mostrarAbaIdosa('aba-plano');
        } else if (aba === 'termo') {
            mostrarAbaIdosa('aba-termo');
        } else {
            mostrarAbaIdosa('aba-dados');
        }
    }

    if (temDoadorSelecionado) {
        mostrarAbaDoador('aba-doador-cadastro');
    }
    if (temVoluntarioSelecionado) {
        const lista = document.getElementById('lista-voluntarios');
        if (lista) {
            lista.style.display = 'block';
        }
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

const labelsMeses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

const dadosMesAtual = @json($dadosMesAtual ?? array_fill(0, 12, 0));
const dadosAnoPassado = @json($dadosAnoPassado ?? array_fill(0, 12, 0));

new Chart(document.getElementById('grafico'), {
    type: 'bar',
    data: {
        labels: labelsMeses,
        datasets: [{
            label: 'Doações em {{ now()->year }}',
            data: dadosMesAtual
        }]
    }
});

new Chart(document.getElementById('grafico-doacoes'), {
    type: 'line',
    data: {
        labels: labelsMeses,
        datasets: [
            {
                label: '{{ now()->year - 1 }}',
                data: dadosAnoPassado
            },
            {
                label: '{{ now()->year }}',
                data: dadosMesAtual
            }
        ]
    }
});


function toggleDropdown(event) {
    event.preventDefault();
    document.getElementById('submenuUsuarios').classList.toggle('show');
}

document.addEventListener('click', function(event) {
    const menu = document.querySelector('.menu-usuario');
    const submenu = document.getElementById('submenuUsuarios');

    if (!menu.contains(event.target)) {
        submenu.classList.remove('show');
    }
});

</script>

</body>
</html>