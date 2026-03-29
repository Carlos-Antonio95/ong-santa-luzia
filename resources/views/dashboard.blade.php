<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Abrigo Santa Luzia</title>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    @if(session('success'))
    <div style="background:#2ecc71; color:white; padding:10px; text-align:center;">
        {{ session('success') }}
    </div>
@endif
<header class="header">
    <div class="logo-area">
        <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logo">
        <h1>Dashboard</h1>
    </div>

    <nav>
        <ul>
            <li><a href="#">Visão Geral</a></li>
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

        <!-- CARD IDOSOS -->
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

    <!-- LISTA -->
    <div id="lista-idosos" class="lista-idosos">

        <h2>Lista de Idosos</h2>

        <!-- BOTÃO NOVO -->
        <button class="btn-add" onclick="toggleForm()">+ Nova Idosa</button>

        <!-- FORMULÁRIO REAL -->
        <div id="form-container" class="form-container">
            <form method="POST" action="/idosas">
                @csrf

                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    <input type="text" name="nome" placeholder="Nome" required style="flex: 1; min-width: 200px;">
                    <input type="text" name="cpf" placeholder="CPF" required style="flex: 1; min-width: 200px;">
                    <input type="text" name="telefone" placeholder="Telefone" style="flex: 1; min-width: 200px;">
                    <input type="date" name="data_nascimento" placeholder="Data de Nascimento" style="flex: 1; min-width: 200px;">
                    <input type="text" name="estado_civil" placeholder="Estado Civil" style="flex: 1; min-width: 200px;">
                    <input type="text" name="rg" placeholder="RG" style="flex: 1; min-width: 200px;">
                    <input type="text" name="orgao_emissor" placeholder="Órgão Emissor" style="flex: 1; min-width: 200px;">
                    <input type="text" name="filiacao" placeholder="Filiação" style="flex: 1; min-width: 200px;">
                    <input type="text" name="naturalidade" placeholder="Naturalidade" style="flex: 1; min-width: 200px;">
                    <input type="text" name="deficiencia" placeholder="Deficiência" style="flex: 1; min-width: 200px;">
                    <input type="date" name="data_abrigamento" placeholder="Data de Abrigamento" style="flex: 1; min-width: 200px;">
                    <input type="text" name="endereco" placeholder="Endereço" style="flex: 1; min-width: 200px;">
                    <input type="text" name="bairro" placeholder="Bairro" style="flex: 1; min-width: 200px;">
                    <input type="text" name="cidade" placeholder="Cidade" style="flex: 1; min-width: 200px;">
                    <input type="text" name="nome_social" placeholder="Nome Social" style="flex: 1; min-width: 200px;">
                    <input type="text" name="apelido" placeholder="Apelido" style="flex: 1; min-width: 200px;">
                </div>

                <button type="submit" class="btn-add">Salvar</button>
            </form>
        </div>

        <!-- TABELA REAL -->
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Responsável</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($idosas as $idosa)
                <tr>
                    <td>{{ $idosa->nome }}</td>
                    <td>{{ $idosa->cpf }}</td>
                    <td>{{ $idosa->termos->first()?->responsavel?->nome }}</td>

                    <td>
                        <a href="/idosas/{{ $idosa->id }}">
                            <button class="edit">Abrir</button>
                        </a>

                        <a href="/idosas/{{ $idosa->id }}/plano">
                            <button class="edit">Plano</button>
                        </a>

                        <a href="/idosas/{{ $idosa->id }}/termo">
                            <button class="edit">Termo</button>
                        </a>

                        <form method="POST" action="/idosas/{{ $idosa->id }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="delete">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</section>

</main>

<!-- GRÁFICOS -->
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

// MOSTRAR LISTA
function toggleLista() {
    let lista = document.getElementById("lista-idosos");
    lista.style.display = lista.style.display === "block" ? "none" : "block";
}

// MOSTRAR FORM
function toggleForm() {
    let form = document.getElementById("form-container");
    form.style.display = form.style.display === "block" ? "none" : "block";
}

// GRÁFICO 1
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

// GRÁFICO 2
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