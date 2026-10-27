<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha - ONG Santa Luzia</title>

    <link rel="stylesheet" href="{{ asset('css/alterar-senha.css') }}?v={{ time() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
</head>
<body>

<!-- HEADER SIMPLES -->
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

<!-- CONTEÚDO -->
<section class="login-container">

    <div class="login-card fade-in">

        <h2>Alterar senha</h2>
        <p class="subtitulo">
            Atualize sua senha de acesso com segurança.
        </p>

        {{-- SUCESSO --}}
        @if(session('success'))
            <div class="sucesso">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.change') }}">
            @csrf

            {{-- SENHA ATUAL --}}
            <div class="input-group">
                <label>Senha atual</label>

                <div class="senha-box">
                    <input id="senhaAtual" type="password" name="current_password" required>
                    <span onclick="toggleSenha('senhaAtual')" class="eye">👁</span>
                </div>

                @error('current_password')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

            {{-- NOVA SENHA --}}
            <div class="input-group">
                <label>Nova senha</label>

                <div class="senha-box">
                    <input id="novaSenha" type="password" name="password" required>
                    <span onclick="toggleSenha('novaSenha')" class="eye">👁</span>
                </div>

                @error('password')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

            {{-- CONFIRMAR --}}
            <div class="input-group">
                <label>Confirmar nova senha</label>

                <div class="senha-box">
                    <input id="confirmarSenha" type="password" name="password_confirmation" required>
                    <span onclick="toggleSenha('confirmarSenha')" class="eye">👁</span>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Atualizar senha
            </button>

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