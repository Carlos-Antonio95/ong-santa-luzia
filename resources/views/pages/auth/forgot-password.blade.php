<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha - ONG Santa Luzia</title>

    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>

<header class="header">
    <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Logo" class="logo">
</header>

<section class="login-container">

    <div class="login-card fade-in">

        <h2>Esqueceu a senha?</h2>
        <p class="subtitulo">Digite seu e-mail para receber o link de redefinição</p>

        {{-- STATUS / SUCESSO --}}
        @if (session('status'))
            <div class="sucesso">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- EMAIL --}}
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
    font-size: 14px;
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
    margin-top: 12px;
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