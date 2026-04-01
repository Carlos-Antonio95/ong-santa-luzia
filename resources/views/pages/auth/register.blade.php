<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - ONG Santa Luzia</title>

    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>

<header class="header">
    <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logo" class="logo">
</header>

<section class="login-container">

    <div class="login-card fade-in">

        <h2>Criar conta</h2>
        <p class="subtitulo">Preencha os dados abaixo</p>

        {{-- ERRO GERAL --}}
        @if(session('status'))
            <div class="erro-geral">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.user.store') }}">
            @csrf

            {{-- NOME --}}
            <div class="input-group">
                <label>Nome completo</label>
                <input type="text" name="name" value="{{ old('name') }}" required>

                @error('name')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

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

            {{-- CONFIRMAR SENHA --}}
            <div class="input-group">
                <label>Confirmar senha</label>

                <div class="senha-box">
                    <input id="confirmarSenha" type="password" name="password_confirmation" required>
                    <span onclick="toggleSenha2()" class="eye">👁</span>
                </div>
            </div>

            {{-- BOTÃO --}}
            <button type="submit" class="btn-login">Criar conta</button>

            {{-- LINK --}}
            <div class="extra-links">
                <a href="{{ route('login') }}">Já tenho conta</a>
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

<style>
/* CONTAINER */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 70vh;
}

/* CARD */
.login-card {
    background: #ffffff;
    padding: 30px;
    border-radius: 15px;
    width: 350px;
    box-shadow: 0px 10px 30px rgba(0,0,0,0.2);
    text-align: center;
}

.login-card h2 {
    margin-bottom: 5px;
}

.subtitulo {
    color: #666;
    margin-bottom: 20px;
}

/* INPUTS */
.input-group {
    text-align: left;
    margin-bottom: 15px;
}

.input-group label {
    font-size: 14px;
    font-weight: bold;
}

.input-group input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    margin-top: 5px;
}

/* SENHA */
.senha-box {
    position: relative;
}

.eye {
    position: absolute;
    right: 10px;
    top: 35%;
    cursor: pointer;
}

/* BOTÃO */
.btn-login {
    width: 100%;
    padding: 12px;
    background: #7FA38A;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-login:hover {
    background: #5f806c;
}

/* ERRO */
.erro {
    color: #e53935;
    font-size: 13px;
    margin-top: 5px;
    display: block;
}

/* ERRO GERAL */
.erro-geral {
    background: #ffdddd;
    color: #a00;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
}

/* LINKS */
.extra-links {
    margin-top: 10px;
    font-size: 14px;
}

.extra-links a {
    color: #2196f3;
    text-decoration: none;
}

/* ANIMAÇÃO */
.fade-in {
    animation: fadeIn 0.8s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

input:invalid {
    border: 1px solid red;
}
</style>

</body>
</html>