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
    <a class="logo-area" href="{{ route('dashboard') }}">
        <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logotipo do Abrigo Santa Luzia">
        <h1>Dashboard</h1>
         </a>
   

    <button class="hamburger" onclick="toggleMenu()">☰</button>

    <nav>
        <ul id="nav-menu">
            <li><a href="{{ route('home') }}">Página Inicial</a></li>
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
        <button type="submit">
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

                {{-- Dados Pessoais --}}
                <div class="form-section">
                    <h4 class="form-section-title">Dados Pessoais</h4>
                    <div class="grupo-campos">
                        <div class="campo-form">
                            <label for="ni-nome">Nome completo <span class="req">*</span></label>
                            <input type="text" id="ni-nome" name="nome" value="{{ old('nome') }}" required autocomplete="name" class="{{ $errors->has('nome') ? 'erro' : '' }}">
                            @error('nome')<span class="erro-campo">{{ $message }}</span>@enderror
                        </div>
                        <div class="campo-form">
                            <label for="ni-cpf">CPF <span class="req">*</span></label>
                            <input type="text" id="ni-cpf" name="cpf" value="{{ old('cpf') }}" required class="{{ $errors->has('cpf') ? 'erro' : '' }}">
                            @error('cpf')<span class="erro-campo">{{ $message }}</span>@enderror
                        </div>
                        <div class="campo-form">
                            <label for="ni-nascimento">Data de nascimento</label>
                            <input type="date" id="ni-nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}">
                        </div>
                        <div class="campo-form">
                            <label for="ni-estado-civil">Estado civil</label>
                            <select id="ni-estado-civil" name="estado_civil">
                                <option value="">Selecione...</option>
                                @foreach(['Solteira','Casada','Divorciada','Viúva','União Estável','Separada','Outro'] as $ec)
                                    <option value="{{ $ec }}" {{ old('estado_civil') === $ec ? 'selected' : '' }}>{{ $ec }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="campo-form">
                            <label for="ni-rg">RG</label>
                            <input type="text" id="ni-rg" name="rg" value="{{ old('rg') }}">
                        </div>
                        <div class="campo-form">
                            <label for="ni-orgao">Órgão emissor</label>
                            <input type="text" id="ni-orgao" name="orgao_emissor" value="{{ old('orgao_emissor') }}">
                        </div>
                        <div class="campo-form">
                            <label for="ni-filiacao">Filiação</label>
                            <input type="text" id="ni-filiacao" name="filiacao" value="{{ old('filiacao') }}">
                        </div>
                        <div class="campo-form">
                            <label for="ni-naturalidade">Naturalidade</label>
                            <input type="text" id="ni-naturalidade" name="naturalidade" value="{{ old('naturalidade') }}">
                        </div>
                        <div class="campo-form">
                            <label for="ni-nome-social">Nome social</label>
                            <input type="text" id="ni-nome-social" name="nome_social" value="{{ old('nome_social') }}">
                        </div>
                        <div class="campo-form">
                            <label for="ni-apelido">Apelido</label>
                            <input type="text" id="ni-apelido" name="apelido" value="{{ old('apelido') }}">
                        </div>
                    </div>
                </div>

                {{-- Contato e Endereço --}}
                <div class="form-section">
                    <h4 class="form-section-title">Contato e Endereço</h4>
                    <div class="grupo-campos">
                        <div class="campo-form">
                            <label for="ni-telefone">Telefone</label>
                            <input type="text" id="ni-telefone" name="telefone" value="{{ old('telefone') }}" autocomplete="tel">
                        </div>
                        <div class="campo-form">
                            <label for="cep-nova">CEP</label>
                            <input type="text" id="cep-nova" name="cep" value="{{ old('cep') }}" onblur="buscarCep(this)" maxlength="9" placeholder="00000-000">
                        </div>
                        <div class="campo-form">
                            <label for="ni-endereco">Endereço</label>
                            <input type="text" id="ni-endereco" name="endereco" value="{{ old('endereco') }}">
                        </div>
                        <div class="campo-form">
                            <label for="ni-bairro">Bairro</label>
                            <input type="text" id="ni-bairro" name="bairro" value="{{ old('bairro') }}">
                        </div>
                        <div class="campo-form">
                            <label for="ni-cidade">Cidade</label>
                            <input type="text" id="ni-cidade" name="cidade" value="{{ old('cidade') }}">
                        </div>
                    </div>
                </div>

                {{-- Situação --}}
                <div class="form-section">
                    <h4 class="form-section-title">Situação no Abrigo</h4>
                    <div class="grupo-campos">
                        <div class="campo-form">
                            <label for="ni-deficiencia">Deficiência / necessidade especial</label>
                            <input type="text" id="ni-deficiencia" name="deficiencia" value="{{ old('deficiencia') }}" placeholder="Ex.: mobilidade reduzida">
                        </div>
                        <div class="campo-form">
                            <label for="ni-abrigamento">Data de abrigamento</label>
                            <input type="date" id="ni-abrigamento" name="data_abrigamento" value="{{ old('data_abrigamento') }}">
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-add">Salvar Nova Idosa</button>
                    <button type="button" class="btn-acao dark" onclick="toggleFormIdosa()">Cancelar</button>
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

                        <div class="form-section">
                            <h4 class="form-section-title">Dados Pessoais</h4>
                            <div class="grupo-campos">
                                <div class="campo-form">
                                    <label for="ei-nome">Nome completo <span class="req">*</span></label>
                                    <input type="text" id="ei-nome" name="nome" value="{{ old('nome', $idosaSelecionada->nome) }}" required autocomplete="name" class="{{ $errors->has('nome') ? 'erro' : '' }}">
                                    @error('nome')<span class="erro-campo">{{ $message }}</span>@enderror
                                </div>
                                <div class="campo-form">
                                    <label for="ei-cpf">CPF <span class="req">*</span></label>
                                    <input type="text" id="ei-cpf" name="cpf" value="{{ old('cpf', $idosaSelecionada->cpf) }}" required class="{{ $errors->has('cpf') ? 'erro' : '' }}">
                                    @error('cpf')<span class="erro-campo">{{ $message }}</span>@enderror
                                </div>
                                <div class="campo-form">
                                    <label for="ei-nascimento">Data de nascimento</label>
                                    <input type="date" id="ei-nascimento" name="data_nascimento" value="{{ old('data_nascimento', optional($idosaSelecionada->data_nascimento)->format('Y-m-d')) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="ei-estado-civil">Estado civil</label>
                                    <select id="ei-estado-civil" name="estado_civil">
                                        <option value="">Selecione...</option>
                                        @foreach(['Solteira','Casada','Divorciada','Viúva','União Estável','Separada','Outro'] as $ec)
                                            <option value="{{ $ec }}" {{ old('estado_civil', $idosaSelecionada->estado_civil) === $ec ? 'selected' : '' }}>{{ $ec }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="campo-form">
                                    <label for="ei-rg">RG</label>
                                    <input type="text" id="ei-rg" name="rg" value="{{ old('rg', $idosaSelecionada->rg) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="ei-orgao">Órgão emissor</label>
                                    <input type="text" id="ei-orgao" name="orgao_emissor" value="{{ old('orgao_emissor', $idosaSelecionada->orgao_emissor) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="ei-filiacao">Filiação</label>
                                    <input type="text" id="ei-filiacao" name="filiacao" value="{{ old('filiacao', $idosaSelecionada->filiacao) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="ei-naturalidade">Naturalidade</label>
                                    <input type="text" id="ei-naturalidade" name="naturalidade" value="{{ old('naturalidade', $idosaSelecionada->naturalidade) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="ei-nome-social">Nome social</label>
                                    <input type="text" id="ei-nome-social" name="nome_social" value="{{ old('nome_social', $idosaSelecionada->nome_social) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="ei-apelido">Apelido</label>
                                    <input type="text" id="ei-apelido" name="apelido" value="{{ old('apelido', $idosaSelecionada->apelido) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="form-section-title">Contato e Endereço</h4>
                            <div class="grupo-campos">
                                <div class="campo-form">
                                    <label for="ei-telefone">Telefone</label>
                                    <input type="text" id="ei-telefone" name="telefone" value="{{ old('telefone', $idosaSelecionada->telefone) }}" autocomplete="tel">
                                </div>
                                <div class="campo-form">
                                    <label for="cep-editar">CEP</label>
                                    <input type="text" id="cep-editar" name="cep" value="{{ old('cep', '') }}" onblur="buscarCep(this)" maxlength="9" placeholder="00000-000">
                                </div>
                                <div class="campo-form">
                                    <label for="ei-endereco">Endereço</label>
                                    <input type="text" id="ei-endereco" name="endereco" value="{{ old('endereco', $idosaSelecionada->endereco) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="ei-bairro">Bairro</label>
                                    <input type="text" id="ei-bairro" name="bairro" value="{{ old('bairro', $idosaSelecionada->bairro) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="ei-cidade">Cidade</label>
                                    <input type="text" id="ei-cidade" name="cidade" value="{{ old('cidade', $idosaSelecionada->cidade) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="form-section-title">Situação no Abrigo</h4>
                            <div class="grupo-campos">
                                <div class="campo-form">
                                    <label for="ei-deficiencia">Deficiência / necessidade especial</label>
                                    <input type="text" id="ei-deficiencia" name="deficiencia" value="{{ old('deficiencia', $idosaSelecionada->deficiencia) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="ei-abrigamento">Data de abrigamento</label>
                                    <input type="date" id="ei-abrigamento" name="data_abrigamento" value="{{ old('data_abrigamento', optional($idosaSelecionada->data_abrigamento)->format('Y-m-d')) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-add">Salvar Cadastro</button>
                            <a href="{{ route('dashboard') }}" class="btn-acao danger">Cancelar</a>
                        </div>
                    </form>
                </div>

                <div id="aba-plano" class="aba-edicao">
                    <form method="POST" action="{{ route('plano.storeOrUpdate', $idosaSelecionada->id) }}">
                        @csrf

                        <div class="form-section">
                            <h4 class="form-section-title">Dados de Ingresso</h4>
                            <div class="grupo-campos">
                                <div class="campo-form">
                                    <label for="pi-data-ingresso">Data de ingresso</label>
                                    <input type="date" id="pi-data-ingresso" name="data_ingresso" value="{{ old('data_ingresso', optional($idosaSelecionada->planoIndividual?->data_ingresso)->format('Y-m-d')) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="pi-prontuario">Nº do prontuário</label>
                                    <input type="text" id="pi-prontuario" name="numero_prontuario" value="{{ old('numero_prontuario', $idosaSelecionada->planoIndividual?->numero_prontuario) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="pi-origem">Origem da residência</label>
                                    <input type="text" id="pi-origem" name="origem_residencia" value="{{ old('origem_residencia', $idosaSelecionada->planoIndividual?->origem_residencia) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="pi-motivo">Motivo da institucionalização</label>
                                    <textarea id="pi-motivo" name="motivo_institucionalizacao">{{ old('motivo_institucionalizacao', $idosaSelecionada->planoIndividual?->motivo_institucionalizacao) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="form-section-title">Situação Social e Econômica</h4>
                            <div class="grupo-campos">
                                <div class="campo-form">
                                    <label for="pi-renda">Renda (R$)</label>
                                    <input type="number" step="0.01" min="0" id="pi-renda" name="renda" value="{{ old('renda', $idosaSelecionada->planoIndividual?->renda) }}" placeholder="0,00">
                                </div>
                                <div class="campo-form">
                                    <label for="pi-escolaridade">Escolaridade</label>
                                    <select id="pi-escolaridade" name="escolaridade">
                                        <option value="">Selecione...</option>
                                        @foreach(['Sem instrução','Fundamental incompleto','Fundamental completo','Médio incompleto','Médio completo','Superior incompleto','Superior completo','Pós-graduação'] as $esc)
                                            <option value="{{ $esc }}" {{ old('escolaridade', $idosaSelecionada->planoIndividual?->escolaridade) === $esc ? 'selected' : '' }}>{{ $esc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="campo-form">
                                    <label for="pi-profissao">Profissão</label>
                                    <input type="text" id="pi-profissao" name="profissao" value="{{ old('profissao', $idosaSelecionada->planoIndividual?->profissao) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="pi-religiao">Religião</label>
                                    <input type="text" id="pi-religiao" name="religiao" value="{{ old('religiao', $idosaSelecionada->planoIndividual?->religiao) }}">
                                </div>
                            </div>
                            <div class="linha-check" style="margin-top:10px;">
                                <label>
                                    <input type="checkbox" name="administra_financeiro" value="1"
                                        {{ old('administra_financeiro', $idosaSelecionada->planoIndividual?->administra_financeiro) ? 'checked' : '' }}>
                                    Administra o próprio financeiro
                                </label>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="form-section-title">Saúde</h4>
                            <div class="grupo-campos">
                                <div class="campo-form">
                                    <label for="pi-diagnostico">Diagnóstico médico</label>
                                    <textarea id="pi-diagnostico" name="diagnostico_medico">{{ old('diagnostico_medico', $idosaSelecionada->planoIndividual?->diagnostico_medico) }}</textarea>
                                </div>
                                <div class="campo-form">
                                    <label for="pi-grau">Grau de dependência</label>
                                    <select id="pi-grau" name="grau_dependencia">
                                        <option value="">Selecione...</option>
                                        @foreach(['Independente','Parcialmente dependente','Totalmente dependente'] as $gd)
                                            <option value="{{ $gd }}" {{ old('grau_dependencia', $idosaSelecionada->planoIndividual?->grau_dependencia) === $gd ? 'selected' : '' }}>{{ $gd }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="campo-form">
                                    <label for="pi-medicacao">Descrição da medicação</label>
                                    <textarea id="pi-medicacao" name="descricao_medicacao">{{ old('descricao_medicacao', $idosaSelecionada->planoIndividual?->descricao_medicacao) }}</textarea>
                                </div>
                                <div class="campo-form">
                                    <label for="pi-restricao">Restrição alimentar</label>
                                    <textarea id="pi-restricao" name="restricao_alimentar">{{ old('restricao_alimentar', $idosaSelecionada->planoIndividual?->restricao_alimentar) }}</textarea>
                                </div>
                            </div>
                            <div class="linha-check" style="margin-top:10px;">
                                <label>
                                    <input type="checkbox" name="possui_plano_saude" value="1"
                                        {{ old('possui_plano_saude', $idosaSelecionada->planoIndividual?->possui_plano_saude) ? 'checked' : '' }}>
                                    Possui plano de saúde
                                </label>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="form-section-title">Rotina</h4>
                            <div class="grupo-campos">
                                <div class="campo-form">
                                    <label for="pi-rotina">Descrição da rotina</label>
                                    <textarea id="pi-rotina" name="rotina" style="min-height:110px;">{{ old('rotina', $idosaSelecionada->planoIndividual?->rotina) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-add">Salvar Plano Individual</button>
                            <button type="button" class="btn-acao dark" onclick="mostrarAbaIdosa('aba-dados')">Cancelar</button>
                        </div>
                    </form>
                </div>

                <div id="aba-termo" class="aba-edicao">
                    <form method="POST" action="{{ route('termo.storeOrUpdate', $idosaSelecionada->id) }}">
                        @csrf

                        <div class="form-section">
                            <h4 class="form-section-title">Dados do Responsável</h4>
                            <div class="grupo-campos">
                                <div class="campo-form">
                                    <label for="tr-resp-nome">Nome do responsável <span class="req">*</span></label>
                                    <input type="text" id="tr-resp-nome" name="responsavel_nome" value="{{ old('responsavel_nome', $idosaSelecionada->ultimoTermo?->responsavel?->nome) }}" required class="{{ $errors->has('responsavel_nome') ? 'erro' : '' }}">
                                    @error('responsavel_nome')<span class="erro-campo">{{ $message }}</span>@enderror
                                </div>
                                <div class="campo-form">
                                    <label for="tr-resp-cpf">CPF do responsável <span class="req">*</span></label>
                                    <input type="text" id="tr-resp-cpf" name="responsavel_cpf" value="{{ old('responsavel_cpf', $idosaSelecionada->ultimoTermo?->responsavel?->cpf) }}" required class="{{ $errors->has('responsavel_cpf') ? 'erro' : '' }}">
                                    @error('responsavel_cpf')<span class="erro-campo">{{ $message }}</span>@enderror
                                </div>
                                <div class="campo-form">
                                    <label for="tr-resp-rg">RG do responsável</label>
                                    <input type="text" id="tr-resp-rg" name="responsavel_rg" value="{{ old('responsavel_rg', $idosaSelecionada->ultimoTermo?->responsavel?->rg) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="tr-resp-orgao">Órgão emissor</label>
                                    <input type="text" id="tr-resp-orgao" name="responsavel_orgao_emissor" value="{{ old('responsavel_orgao_emissor', $idosaSelecionada->ultimoTermo?->responsavel?->orgao_emissor) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="tr-resp-tel">Telefone do responsável</label>
                                    <input type="text" id="tr-resp-tel" name="responsavel_telefone" value="{{ old('responsavel_telefone', $idosaSelecionada->ultimoTermo?->responsavel?->telefone) }}" autocomplete="tel">
                                </div>
                                <div class="campo-form">
                                    <label for="tr-resp-end">Endereço do responsável</label>
                                    <input type="text" id="tr-resp-end" name="responsavel_endereco" value="{{ old('responsavel_endereco', $idosaSelecionada->ultimoTermo?->responsavel?->endereco) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="form-section-title">Termo de Abrigamento</h4>
                            <div class="grupo-campos">
                                <div class="campo-form">
                                    <label for="tr-data-inicio">Data de início</label>
                                    <input type="date" id="tr-data-inicio" name="data_inicio" value="{{ old('data_inicio', optional($idosaSelecionada->ultimoTermo?->data_inicio)->format('Y-m-d')) }}">
                                </div>
                                <div class="campo-form">
                                    <label for="tr-observacoes">Observações</label>
                                    <textarea id="tr-observacoes" name="observacoes">{{ old('observacoes', $idosaSelecionada->ultimoTermo?->observacoes) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="form-section-title">Assinaturas</h4>
                            <div class="linha-check">
                                <label>
                                    <input type="checkbox" name="assinado_responsavel" value="1"
                                        {{ old('assinado_responsavel', $idosaSelecionada->ultimoTermo?->assinado_responsavel) ? 'checked' : '' }}>
                                    Responsável assinou
                                </label>
                                <label>
                                    <input type="checkbox" name="assinado_psicologo" value="1"
                                        {{ old('assinado_psicologo', $idosaSelecionada->ultimoTermo?->assinado_psicologo) ? 'checked' : '' }}>
                                    Psicólogo assinou
                                </label>
                                <label>
                                    <input type="checkbox" name="assinado_assistente_social" value="1"
                                        {{ old('assinado_assistente_social', $idosaSelecionada->ultimoTermo?->assinado_assistente_social) ? 'checked' : '' }}>
                                    Assistente social assinou
                                </label>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-add">Salvar Termo de Abrigamento</button>
                            <button type="button" class="btn-acao dark" onclick="mostrarAbaIdosa('aba-dados')">Cancelar</button>
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
                                    <a href="{{ route('idosas.show', $idosa->id) }}" class="btn-acao edit">Abrir</a>
                                    <a href="{{ route('dashboard', ['idosa' => $idosa->id]) }}" class="btn-acao edit">Editar</a>

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
                    <div class="form-section">
                        <h4 class="form-section-title">Dados do Doador</h4>
                        <div class="grupo-campos">
                            <div class="campo-form">
                                <label for="nd-nome">Nome <span class="req">*</span></label>
                                <input type="text" id="nd-nome" name="nome" value="{{ old('nome') }}" required class="{{ $errors->has('nome') ? 'erro' : '' }}">
                                @error('nome')<span class="erro-campo">{{ $message }}</span>@enderror
                            </div>
                            <div class="campo-form">
                                <label for="nd-tipo">Tipo</label>
                                <select id="nd-tipo" name="tipo">
                                    <option value="Pessoa Física" {{ old('tipo') == 'Pessoa Física' ? 'selected' : '' }}>Pessoa Física</option>
                                    <option value="Empresa" {{ old('tipo') == 'Empresa' ? 'selected' : '' }}>Empresa</option>
                                </select>
                            </div>
                            <div class="campo-form">
                                <label for="nd-cpf">CPF / CNPJ</label>
                                <input type="text" id="nd-cpf" name="cpf" value="{{ old('cpf') }}">
                            </div>
                            <div class="campo-form">
                                <label for="nd-telefone">Telefone</label>
                                <input type="text" id="nd-telefone" name="telefone" value="{{ old('telefone') }}" autocomplete="tel">
                            </div>
                            <div class="campo-form">
                                <label for="nd-email">E-mail</label>
                                <input type="email" id="nd-email" name="email" value="{{ old('email') }}" autocomplete="email">
                            </div>
                            <div class="campo-form" style="min-width:100%;">
                                <label for="nd-observacoes">Observações</label>
                                <textarea id="nd-observacoes" name="observacoes">{{ old('observacoes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aba Doação -->
                <div id="aba-novo-doador-doacao" class="aba-edicao">
                    <p class="form-hint">Preencha os campos abaixo para registrar uma doação junto ao cadastro. Todos são opcionais.</p>
                    <div class="form-section">
                        <h4 class="form-section-title">Dados da Doação (opcional)</h4>
                        <div class="grupo-campos">
                            <div class="campo-form">
                                <label for="nd-doacao-valor">Valor (R$)</label>
                                <input type="number" step="0.01" min="0.01" id="nd-doacao-valor" name="doacao_valor" value="{{ old('doacao_valor') }}" placeholder="0,00">
                            </div>
                            <div class="campo-form">
                                <label for="nd-doacao-data">Data da doação</label>
                                <input type="date" id="nd-doacao-data" name="doacao_data" value="{{ old('doacao_data') }}">
                            </div>
                            <div class="campo-form">
                                <label for="nd-doacao-forma">Forma de pagamento</label>
                                <input type="text" id="nd-doacao-forma" name="doacao_forma_pagamento" value="{{ old('doacao_forma_pagamento') }}" placeholder="Ex.: Pix, Dinheiro">
                            </div>
                            <div class="campo-form">
                                <label for="nd-doacao-tipo">Tipo de doação</label>
                                <select id="nd-doacao-tipo" name="doacao_tipo">
                                    @foreach(['Financeira','Alimentos','Roupas','Medicamentos','Higiene','Outros'] as $td)
                                        <option value="{{ $td }}" {{ old('doacao_tipo') == $td ? 'selected' : '' }}>{{ $td }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="campo-form" style="min-width:100%;">
                                <label for="nd-doacao-desc">Descrição</label>
                                <textarea id="nd-doacao-desc" name="doacao_descricao">{{ old('doacao_descricao') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-add">Salvar Novo Doador</button>
                    <button type="button" class="btn-acao dark" onclick="toggleFormDoador()">Cancelar</button>
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

                        <div class="form-section">
                            <p class="form-section-title">Identificação</p>
                            <div style="display:flex; gap:16px; flex-wrap:wrap;">
                                <div class="campo-form" style="flex:2; min-width:200px;">
                                    <label for="edit-doador-nome">Nome <span class="req" aria-hidden="true">*</span></label>
                                    <input type="text" id="edit-doador-nome" name="nome"
                                           value="{{ old('nome', $doadorSelecionado->nome) }}"
                                           required class="{{ $errors->has('nome') ? 'erro' : '' }}">
                                    @error('nome') <span class="erro-campo">&#9888; {{ $message }}</span> @enderror
                                </div>
                                <div class="campo-form" style="flex:1; min-width:160px;">
                                    <label for="edit-doador-tipo">Tipo</label>
                                    <select id="edit-doador-tipo" name="tipo">
                                        @foreach(['Pessoa Física','Empresa'] as $t)
                                            <option value="{{ $t }}" {{ old('tipo', $doadorSelecionado->tipo) == $t ? 'selected' : '' }}>{{ $t }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo') <span class="erro-campo">&#9888; {{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <p class="form-section-title">Contato</p>
                            <div style="display:flex; gap:16px; flex-wrap:wrap;">
                                <div class="campo-form">
                                    <label for="edit-doador-cpf">CPF</label>
                                    <input type="text" id="edit-doador-cpf" name="cpf"
                                           value="{{ old('cpf', $doadorSelecionado->cpf) }}"
                                           placeholder="000.000.000-00" maxlength="14"
                                           class="{{ $errors->has('cpf') ? 'erro' : '' }}">
                                    @error('cpf') <span class="erro-campo">&#9888; {{ $message }}</span> @enderror
                                </div>
                                <div class="campo-form">
                                    <label for="edit-doador-telefone">Telefone</label>
                                    <input type="text" id="edit-doador-telefone" name="telefone"
                                           value="{{ old('telefone', $doadorSelecionado->telefone) }}"
                                           placeholder="(00) 00000-0000" maxlength="15"
                                           class="{{ $errors->has('telefone') ? 'erro' : '' }}">
                                    @error('telefone') <span class="erro-campo">&#9888; {{ $message }}</span> @enderror
                                </div>
                                <div class="campo-form" style="flex:2;">
                                    <label for="edit-doador-email">E-mail</label>
                                    <input type="email" id="edit-doador-email" name="email"
                                           value="{{ old('email', $doadorSelecionado->email) }}"
                                           class="{{ $errors->has('email') ? 'erro' : '' }}">
                                    @error('email') <span class="erro-campo">&#9888; {{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <p class="form-section-title">Observações</p>
                            <div class="campo-form">
                                <label for="edit-doador-obs">Observações</label>
                                <textarea id="edit-doador-obs" name="observacoes">{{ old('observacoes', $doadorSelecionado->observacoes) }}</textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-add">Salvar Doador</button>
                            <a href="{{ route('dashboard') }}" class="btn-acao danger">Cancelar</a>
                        </div>
                    </form>
                </div>

                <div id="aba-doador-doacoes" class="aba-edicao">
                    <form method="POST" action="{{ route('doacoes.store', $doadorSelecionado->id) }}">
                        @csrf

                        <div class="form-section">
                            <p class="form-section-title">Nova Doação</p>
                            <p class="form-hint">Preencha os dados da doação recebida.</p>
                            <div style="display:flex; gap:16px; flex-wrap:wrap;">
                                <div class="campo-form">
                                    <label for="doacao-valor">Valor <span class="req" aria-hidden="true">*</span></label>
                                    <input type="number" id="doacao-valor" name="valor"
                                           step="0.01" min="0.01" placeholder="0,00" required
                                           class="{{ $errors->has('valor') ? 'erro' : '' }}">
                                    @error('valor') <span class="erro-campo">&#9888; {{ $message }}</span> @enderror
                                </div>
                                <div class="campo-form">
                                    <label for="doacao-data">Data <span class="req" aria-hidden="true">*</span></label>
                                    <input type="date" id="doacao-data" name="data_doacao"
                                           value="{{ date('Y-m-d') }}" required
                                           class="{{ $errors->has('data_doacao') ? 'erro' : '' }}">
                                    @error('data_doacao') <span class="erro-campo">&#9888; {{ $message }}</span> @enderror
                                </div>
                                <div class="campo-form">
                                    <label for="doacao-tipo">Tipo de Doação</label>
                                    <select id="doacao-tipo" name="tipo_doacao">
                                        @foreach(['Financeira','Alimentos','Roupas','Medicamentos','Higiene','Outros'] as $td)
                                            <option value="{{ $td }}" {{ old('tipo_doacao') == $td ? 'selected' : '' }}>{{ $td }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="campo-form">
                                    <label for="doacao-forma">Forma de Pagamento</label>
                                    <input type="text" id="doacao-forma" name="forma_pagamento"
                                           value="{{ old('forma_pagamento') }}"
                                           placeholder="Ex.: Transferência, Dinheiro...">
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <p class="form-section-title">Detalhes</p>
                            <div class="campo-form">
                                <label for="doacao-descricao">Descrição</label>
                                <textarea id="doacao-descricao" name="descricao" placeholder="Descrição da doação">{{ old('descricao') }}</textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-add">Salvar Doação</button>
                            <button type="button" class="btn-acao dark" onclick="mostrarAbaDoador('aba-doador-cadastro')">Cancelar</button>
                        </div>
                    </form>

                    <div class="tabela-wrapper" style="margin-top:20px;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Valor</th>
                                    <th>Forma</th>
                                    <th>Tipo</th>
                                    <th>Descrição</th>
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
                                    <a href="{{ route('dashboard', ['doador' => $doador->id]) }}" class="btn-acao edit">Editar</a>
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

                    <div class="form-section">
                        <p class="form-section-title">Dados Pessoais</p>
                        <div style="display:flex; gap:16px; flex-wrap:wrap;">
                            <div class="campo-form" style="flex:2; min-width:200px;">
                                <label for="novo-vol-nome">Nome <span class="req" aria-hidden="true">*</span></label>
                                <input type="text" id="novo-vol-nome" name="nome"
                                       value="{{ old('nome') }}" required
                                       class="{{ $errors->has('nome') ? 'erro' : '' }}">
                                @error('nome') <span class="erro-campo">&#9888; {{ $message }}</span> @enderror
                            </div>
                            <div class="campo-form">
                                <label for="novo-vol-nasc">Data de Nascimento</label>
                                <input type="date" id="novo-vol-nasc" name="data_nascimento"
                                       value="{{ old('data_nascimento') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <p class="form-section-title">Contato</p>
                        <div style="display:flex; gap:16px; flex-wrap:wrap;">
                            <div class="campo-form" style="flex:2;">
                                <label for="novo-vol-email">E-mail <span class="req" aria-hidden="true">*</span></label>
                                <input type="email" id="novo-vol-email" name="email"
                                       value="{{ old('email') }}" required
                                       class="{{ $errors->has('email') ? 'erro' : '' }}">
                                @error('email') <span class="erro-campo">&#9888; {{ $message }}</span> @enderror
                            </div>
                            <div class="campo-form">
                                <label for="novo-vol-tel">Telefone</label>
                                <input type="text" id="novo-vol-tel" name="telefone"
                                       value="{{ old('telefone') }}"
                                       placeholder="(00) 00000-0000" maxlength="15">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <p class="form-section-title">Perfil</p>
                        <div class="campo-form" style="margin-bottom:12px;">
                            <label for="novo-vol-skills">Habilidades / Skills</label>
                            <input type="text" id="novo-vol-skills" name="skills"
                                   value="{{ old('skills') }}"
                                   placeholder="Ex.: cozinha, enfermagem, música...">
                        </div>
                        <div class="campo-form">
                            <label for="novo-vol-obs">Observações</label>
                            <textarea id="novo-vol-obs" name="observacoes">{{ old('observacoes') }}</textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-add">Salvar Novo Voluntário</button>
                        <button type="button" class="btn-acao dark" onclick="toggleFormVoluntario()">Cancelar</button>
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

                            <div class="form-section">
                                <p class="form-section-title">Dados Pessoais</p>
                                <div style="display:flex; gap:16px; flex-wrap:wrap;">
                                    <div class="campo-form" style="flex:2; min-width:200px;">
                                        <label for="edit-vol-nome">Nome <span class="req" aria-hidden="true">*</span></label>
                                        <input type="text" id="edit-vol-nome" name="nome"
                                               value="{{ old('nome', $voluntarioSelecionado->nome) }}" required
                                               class="{{ $errors->has('nome') ? 'erro' : '' }}">
                                        @error('nome') <span class="erro-campo">&#9888; {{ $message }}</span> @enderror
                                    </div>
                                    <div class="campo-form">
                                        <label for="edit-vol-nasc">Data de Nascimento</label>
                                        <input type="date" id="edit-vol-nasc" name="data_nascimento"
                                               value="{{ old('data_nascimento', optional($voluntarioSelecionado->data_nascimento)->format('Y-m-d')) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <p class="form-section-title">Contato</p>
                                <div style="display:flex; gap:16px; flex-wrap:wrap;">
                                    <div class="campo-form" style="flex:2;">
                                        <label for="edit-vol-email">E-mail <span class="req" aria-hidden="true">*</span></label>
                                        <input type="email" id="edit-vol-email" name="email"
                                               value="{{ old('email', $voluntarioSelecionado->email) }}" required
                                               class="{{ $errors->has('email') ? 'erro' : '' }}">
                                        @error('email') <span class="erro-campo">&#9888; {{ $message }}</span> @enderror
                                    </div>
                                    <div class="campo-form">
                                        <label for="edit-vol-tel">Telefone</label>
                                        <input type="text" id="edit-vol-tel" name="telefone"
                                               value="{{ old('telefone', $voluntarioSelecionado->telefone) }}"
                                               placeholder="(00) 00000-0000" maxlength="15">
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <p class="form-section-title">Perfil</p>
                                <div class="campo-form" style="margin-bottom:12px;">
                                    <label for="edit-vol-skills">Habilidades / Skills</label>
                                    <input type="text" id="edit-vol-skills" name="skills"
                                           value="{{ old('skills', $voluntarioSelecionado->skills) }}"
                                           placeholder="Ex.: cozinha, enfermagem, música...">
                                </div>
                                <div class="campo-form">
                                    <label for="edit-vol-obs">Observações</label>
                                    <textarea id="edit-vol-obs" name="observacoes">{{ old('observacoes', $voluntarioSelecionado->observacoes) }}</textarea>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-add">Salvar Voluntário</button>
                                <a href="{{ route('dashboard') }}" class="btn-acao danger">Cancelar</a>
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
                                        <a href="{{ route('dashboard', ['voluntario' => $voluntario->id]) }}" class="btn-acao edit">Editar</a>
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
function mostrarNotificacao(mensagem, tipo) {
    tipo = tipo || 'info';
    let notif = document.getElementById('app-notificacao');
    if (!notif) {
        notif = document.createElement('div');
        notif.id = 'app-notificacao';
        notif.setAttribute('role', 'alert');
        notif.setAttribute('aria-live', 'polite');
        notif.style.cssText = [
            'position:fixed', 'top:20px', 'right:20px', 'z-index:9999',
            'padding:12px 20px', 'border-radius:8px', 'font-weight:700',
            'max-width:360px', 'box-shadow:0 4px 12px rgba(0,0,0,.2)',
            'transition:opacity .3s', 'display:none'
        ].join(';');
        document.body.appendChild(notif);
    }
    const cores = {
        sucesso: { bg: '#2ecc71', cor: '#fff' },
        erro:    { bg: '#e74c3c', cor: '#fff' },
        aviso:   { bg: '#f39c12', cor: '#fff' },
        info:    { bg: '#3498db', cor: '#fff' }
    };
    const c = cores[tipo] || cores.info;
    notif.style.background = c.bg;
    notif.style.color = c.cor;
    notif.textContent = mensagem;
    notif.style.opacity = '1';
    notif.style.display = 'block';
    clearTimeout(notif._timer);
    notif._timer = setTimeout(() => {
        notif.style.opacity = '0';
        setTimeout(() => { notif.style.display = 'none'; }, 300);
    }, 4500);
}

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

    // Re-aplica máscaras quando abas são abertas (inputs podem estar ocultos no init)
    document.querySelectorAll('.btn-tab, .aba-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (window.MascarasFormulario) {
                setTimeout(window.MascarasFormulario.init, 50);
            }
        });
    });
    document.querySelectorAll('.btn-add[onclick]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (window.MascarasFormulario) {
                setTimeout(window.MascarasFormulario.init, 50);
            }
        });
    });
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
                mostrarNotificacao('CEP não encontrado. Verifique o número e tente novamente.', 'aviso');
                return;
            }

            if (enderecoInput) enderecoInput.value = data.logradouro || '';
            if (bairroInput) bairroInput.value = data.bairro || '';
            if (cidadeInput) cidadeInput.value = data.localidade || '';
        })
        .catch(() => {
            mostrarNotificacao('Não foi possível consultar o CEP. Tente novamente mais tarde.', 'erro');
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


function toggleMenu() {
    const menu = document.getElementById('nav-menu');
    menu.classList.toggle('show');
    const hamburger = document.querySelector('.hamburger');
    hamburger.classList.toggle('active');
}

// Fechar menu ao clicar em link
document.addEventListener('DOMContentLoaded', function() {
    const menuLinks = document.querySelectorAll('#nav-menu a, #nav-menu button');
    menuLinks.forEach(link => {
        link.addEventListener('click', function() {
            const menu = document.getElementById('nav-menu');
            menu.classList.remove('show');
            const hamburger = document.querySelector('.hamburger');
            hamburger.classList.remove('active');
        });
    });
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

    <x-accessibility-feedback />
</body>
</html>