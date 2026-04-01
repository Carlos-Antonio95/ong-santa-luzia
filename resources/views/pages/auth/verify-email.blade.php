<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Verificação de Email - ONG Santa Luzia</title>

    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>

<header class="header">
    <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logo" class="logo">
</header>

<section class="login-container">

    <div class="login-card fade-in">

        <h2>Verifique seu e-mail</h2>
        <p class="subtitulo">
            Enviamos um link de verificação para o seu e-mail.  
            Clique nele para ativar sua conta.
        </p>

        {{-- SUCESSO --}}
        @if (session('status') == 'verification-link-sent')
            <div class="sucesso">
                Um novo link de verificação foi enviado para seu e-mail.
            </div>
        @endif

        {{-- REENVIAR EMAIL --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-login">
                Reenviar e-mail
            </button>
        </form>

        {{-- SAIR --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-secundario">
                Sair
            </button>
        </form>

    </div>

</section>

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
    margin-bottom: 10px;
}

.subtitulo {
    color: #666;
    margin-bottom: 20px;
    font-size: 14px;
}

/* BOTÃO PRINCIPAL */
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
    margin-bottom: 10px;
}

.btn-login:hover {
    background: #5f806c;
}

/* BOTÃO SECUNDÁRIO */
.btn-secundario {
    width: 100%;
    padding: 12px;
    background: #ccc;
    color: #000;
    border: none;
    border-radius: 10px;
    font-size: 14px;
    cursor: pointer;
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
</style>

</body>
</html>