<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Abrigo Santa Luzia</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body>

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

        <!-- CARD -->
<!-- CARD -->
<div class="box" onclick="toggleLista()">
    <h3 id="contador-idosos">0</h3>
    <p>👵 Idosos acolhidos</p>
</div>

<!-- LISTA -->
<div id="lista-idosos" class="lista-idosos">

    <h2>Lista de Idosos</h2>

    <!-- SELEÇÃO DE TIPO DE FICHA -->
    <div class="new-idoso-control" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px; justify-content: center; flex-wrap: nowrap;">
      <label for="tipo-ficha" style="font-weight: 700; margin-right: 8px;">Escolha o tipo de ficha:</label>
      <select id="tipo-ficha" style="padding: 8px 10px; border-radius: 8px; border: 1px solid #ccc;">
        <option value="FichaDeCadastroSimples.html">Simples</option>
        <option value="FichaDeCadastroCompleta.html">Completa</option>
        <option value="FichaDeCadastroDetalhada.html">Detalhada</option>
      </select>
      <button class="btn-add" onclick="irParaFicha()">+ Adicionar Idoso</button>
    </div>

    <!-- FORMULÁRIO (ESCONDIDO) -->
    <div id="form-container" class="form-container">
        <input type="text" id="nome" placeholder="Nome">
        <input type="number" id="idade" placeholder="Idade">
        <input type="text" id="cpf" placeholder="CPF">
        <input type="text" id="responsavel" placeholder="Responsável">

        <button onclick="salvar()">Salvar</button>
    </div>

    <!-- TABELA -->
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>CPF</th>
                <th>Responsável</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody id="corpo-tabela"></tbody>
    </table>

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

</section>


</main>

<div class="chart-section">
  <h2 style="text-align:center; margin-top: 30px;">Doações por Mês (Ano atual)</h2>
  <div class="chart-wrapper">
    <canvas id="grafico"></canvas>
  </div>
</div>

<div class="chart-section">
  <h2 style="text-align:center; margin-top: 30px;">Comparativo de Doações (Ano anterior x Ano atual)</h2>
  <div class="chart-wrapper">
    <canvas id="grafico-doacoes"></canvas>
  </div>
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>