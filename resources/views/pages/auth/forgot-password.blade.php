<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - ONG Santa Luzia</title>

    <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}?v={{ time() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
</head>
<body>

<header class="header topo-recuperacao">
    <div class="header-container">
        <a href="{{ url('/') }}" class="logo-link" aria-label="Página principal">
            <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logo ONG Santa Luzia" class="logo-pequena">
        </a>

        <a href="{{ url('/') }}" class="voltar-site">
            Voltar à página principal
        </a>
    </div>
</header>

<section class="login-container">

    <div class="login-card fade-in">

        <h2>Esqueceu a senha?</h2>
        <p class="subtitulo">Digite seu e-mail para receber o link de redefinição</p>

        @if (session('status'))
            <div class="sucesso">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="input-group">
                <label>E-mail</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>

                @error('email')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                Enviar link de recuperação
            </button>

            <div class="extra-links">
                <span>Ou voltar para </span>
                <a href="{{ route('login') }}">o login</a>
            </div>
        </form>

    </div>

</section>

<x-accessibility-feedback />
</body>
</html>