<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - ONG Santa Luzia</title>

    <link rel="stylesheet" href="{{ asset('css/reset-password.css') }}?v={{ time() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
</head>
<body>

<header class="header topo-recuperacao">
    <div class="header-container">
        <a href="{{ url('/') }}" class="logo-link" aria-label="Página principal">
            <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logo ONG Santa Luzia" class="logo-pequena">
        </a>

        <a href="{{ route('login') }}" class="voltar-site">
            Voltar para o login
        </a>
    </div>
</header>

<section class="login-container">

    <div class="login-card fade-in">

        <h2>Redefinir senha</h2>
        <p class="subtitulo">Digite sua nova senha abaixo</p>

        @if(session('status'))
            <div class="sucesso">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <div class="input-group">
                <label>E-mail</label>
                <input type="email" name="email" value="{{ request('email') }}" required>

                @error('email')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label>Nova senha</label>

                <div class="senha-box">
                    <input id="senha" type="password" name="password" required>
                    <span onclick="toggleSenha()" class="eye">👁</span>
                </div>

                @error('password')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label>Confirmar senha</label>

                <div class="senha-box">
                    <input id="confirmarSenha" type="password" name="password_confirmation" required>
                    <span onclick="toggleSenha2()" class="eye">👁</span>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Redefinir senha
            </button>

            <div class="extra-links">
                <a href="{{ route('login') }}">Voltar para o login</a>
            </div>
        </form>

    </div>

</section>

<script>
function toggleSenha() {
    const input = document.getElementById("senha");
    input.type = input.type === "password" ? "text" : "password";
}

function toggleSenha2() {
    const input = document.getElementById("confirmarSenha");
    input.type = input.type === "password" ? "text" : "password";
}
</script>

<x-accessibility-feedback />
</body>
</html>