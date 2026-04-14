<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - ONG Santa Luzia</title>

    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>

<header class="header">
    <img src="{{ asset('imagens/logo-abrigo-santa-luzia.png') }}" alt="Logotipo do Abrigo Santa Luzia" class="logo">
</header>

<section class="hero">
    <img src="{{ asset('imagens/hero.jpg') }}" alt="Imagem de acolhimento do Abrigo Santa Luzia" class="hero-img">

    <div class="hero-texto">
        <h1>Bem-vindo de volta 💚</h1>
        <p>Faça login para acessar o sistema</p>
    </div>
</section>

<div style="display:flex; justify-content:center; margin-top:40px;">
    <form method="POST" action="{{ route('login.store') }}" style="width:300px;">
        @csrf

        <input type="email" name="email" placeholder="Email" required class="botao" style="width:100%; margin-bottom:10px;">

        <input type="password" name="password" placeholder="Senha" required class="botao" style="width:100%; margin-bottom:10px;">

        <button type="submit" class="botao" style="width:100%;">Entrar</button>
    </form>
</div>

    <x-accessibility-feedback />
</body>
</html>