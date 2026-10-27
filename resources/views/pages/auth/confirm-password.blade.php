<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Senha - ONG Santa Luzia</title>

    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
</head>
<body>

<header class="topo-simples">
    <div class="topo-conteudo">
        <div class="topo-logo">
            <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logo do Abrigo Santa Luzia">
        </div>

        <a href="{{ route('dashboard') }}" class="btn-voltar-dashboard">
            Voltar ao Dashboard
        </a>
    </div>
</header>

<section class="login-container">

    <div class="login-card fade-in">

        <h2>Confirmar senha</h2>
        <p class="subtitulo">
            Esta é uma área segura do sistema. Confirme sua senha para continuar.
        </p>

        @if(session('status'))
            <div class="sucesso">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.confirm.store') }}">
            @csrf

            <div class="input-group">
                <label>Senha</label>

                <div class="senha-box">
                    <input id="senha" type="password" name="password" required autocomplete="current-password">
                    <span onclick="toggleSenha()" class="eye">👁</span>
                </div>

                @error('password')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                Confirmar
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
</script>

<style>
body {
    margin: 0;
    background: #f4f6f8;
    font-family: Arial, sans-serif;
}

/* HEADER SIMPLES */
.topo-simples {
    width: 100%;
    background: linear-gradient(90deg, #1f2020, #2ecc71);
    padding: 12px 20px;
    box-sizing: border-box;
}

.topo-conteudo {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
}

.topo-logo img {
    height: 55px;
    width: auto;
    display: block;
}

.btn-voltar-dashboard {
    background: #ffffff;
    color: #2ecc71;
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: bold;
    transition: 0.3s;
    white-space: nowrap;
}

.btn-voltar-dashboard:hover {
    background: #f1f1f1;
}

/* CONTAINER */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 90px);
    padding: 30px 15px;
    box-sizing: border-box;
}

/* CARD */
.login-card {
    background: #ffffff;
    padding: 30px;
    border-radius: 15px;
    width: 100%;
    max-width: 380px;
    box-shadow: 0px 10px 30px rgba(0,0,0,0.2);
    text-align: center;
}

.login-card h2 {
    margin-bottom: 5px;
}

.subtitulo {
    color: #666;
    margin-bottom: 20px;
    font-size: 14px;
    line-height: 1.5;
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
    padding-right: 40px;
    border-radius: 8px;
    border: 1px solid #ccc;
    margin-top: 5px;
    box-sizing: border-box;
}

/* SENHA */
.senha-box {
    position: relative;
}

.eye {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-25%);
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

/* SUCESSO */
.sucesso {
    background: #ddffdd;
    color: #2e7d32;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 14px;
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

/* RESPONSIVO */
@media (max-width: 768px) {
    .topo-conteudo {
        flex-direction: row;
        align-items: center;
    }

    .topo-logo img {
        height: 45px;
    }

    .btn-voltar-dashboard {
        font-size: 14px;
        padding: 9px 14px;
    }

    .login-card {
        padding: 25px 20px;
    }
}

@media (max-width: 480px) {
    .topo-simples {
        padding: 10px 12px;
    }

    .topo-logo img {
        height: 40px;
    }

    .btn-voltar-dashboard {
        font-size: 13px;
        padding: 8px 12px;
    }

    .login-container {
        padding: 20px 12px;
    }
}
</style>

<x-accessibility-feedback />
</body>
</html>