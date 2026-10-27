<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - ONG Santa Luzia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
</head>
<body>

<header class="header">
    <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logotipo do Abrigo Santa Luzia" class="logo">

    <div class="header-right">
        <a href="{{ url('/') }}" style="text-decoration: none;color:white;">Voltar à página inicial</a>
    </div>
</header>

<section class="login-container">

    <div class="login-card fade-in">

        <h2>Entrar no sistema</h2>
        <p class="subtitulo">Acesse sua conta</p>

        {{-- ERRO GERAL (login inválido) --}}
        @if(session('status'))
            <div class="erro-geral">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- EMAIL --}}
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>

                @error('email')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

            {{-- SENHA --}}
            <div class="input-group">
                <label>Senha</label>

                <div class="senha-box">
                    <input id="senha" type="password" name="password" required>
                    <span onclick="toggleSenha()" class="eye">👁</span>
                </div>

                @error('password')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

            {{-- LEMBRAR --}}
            <div class="lembrar">
                <input type="checkbox" name="remember">
                <label>Lembrar de mim</label>
            </div>

            {{-- BOTÃO --}}
            <button type="submit" class="btn-login">Entrar</button>

            {{-- ESQUECI SENHA --}}
            @if (Route::has('password.request'))
                <div class="extra-links">
                    <a href="{{ route('password.request') }}">Esqueci minha senha</a>
                </div>
            @endif

        </form>
    </div>

</section>

<script>
function toggleSenha() {
    const input = document.getElementById("senha");
    input.type = input.type === "password" ? "text" : "password";
}
</script>

  <x-accessibility-feedback />
</body>
</html>