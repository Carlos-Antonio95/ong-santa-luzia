<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - ONG Santa Luzia</title>

    <link rel="stylesheet" href="{{ asset('css/cadastro.css') }}?v={{ time() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
</head>
<body>

<header class="topo-simples">
    <div class="topo-conteudo">
        <div class="topo-logo">
            <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logo">
        </div>

        <a href="{{ route('dashboard') }}" class="btn-voltar">
            ← Dashboard
        </a>
    </div>
</header>

<section class="login-container">

    <div class="login-card fade-in">

        <h2>Criar conta</h2>
        <p class="subtitulo">Preencha os dados abaixo</p>

        @if(session('status'))
            <div class="erro-geral">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.user.store') }}">
            @csrf

            <div class="input-group">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nome completo" required>

                @error('name')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required>

                @error('email')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <div class="senha-box">
                    <input id="senha" type="password" name="password" placeholder="Senha" required>
                    <span onclick="toggleSenha('senha')" class="eye">👁</span>
                </div>

                @error('password')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <div class="senha-box">
                    <input id="confirmarSenha" type="password" name="password_confirmation" placeholder="Confirmar senha" required>
                    <span onclick="toggleSenha('confirmarSenha')" class="eye">👁</span>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Criar conta
            </button>

            <div class="extra-links">
                <a href="{{ route('login') }}">Já tenho conta</a>
            </div>
        </form>

    </div>

</section>

<script>
function toggleSenha(id) {
    const input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
}
</script>

<x-accessibility-feedback />
</body>
</html>