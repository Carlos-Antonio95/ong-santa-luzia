<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessão expirada - ONG Santa Luzia</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f4f6f8;
            color: #111827;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topo {
            background: linear-gradient(90deg, #2F3E36, #2F3E36);
            padding: 12px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.12);
        }

        .topo .conteudo {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .logo {
            height: 55px;
            max-width: 100%;
        }

        .voltar {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
            transition: 0.3s;
        }

        .voltar:hover {
            color: #2563EB;
        }

        .container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .card {
            background: #fff;
            width: 100%;
            max-width: 950px;
            border-radius: 20px;
            border: 1px solid #E5E7EB;
            box-shadow: 0 12px 35px rgba(0,0,0,0.12);
            padding: 35px 25px;
            animation: fadeIn 0.8s ease-in-out;
        }

        .conteudo-erro {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 35px;
        }

        .texto {
            flex: 1;
        }

        .codigo {
            font-size: 78px;
            font-weight: 800;
            color: #2F3E36;
            margin: 0 0 10px;
        }

        h1 {
            margin: 0 0 12px;
            font-size: 32px;
        }

        p {
            margin: 0 0 24px;
            font-size: 16px;
            line-height: 1.7;
            color: #4B5563;
            max-width: 480px;
        }

        .acoes {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            transform: scale(1);
        }

        .btn:hover {
            transform: scale(1.03);
        }

        .btn-principal {
            background: #2F3E36;
            color: #fff;
        }

        .btn-principal:hover {
            background: #2563EB;
        }

        .btn-secundario {
            background: #E5E7EB;
            color: #111827;
        }

        .btn-secundario:hover {
            background: #D1D5DB;
        }

        .imagem-area {
            flex: 1;
            text-align: center;
        }

        .erro-ilustracao {
            width: 100%;
            max-width: 360px;
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

        @media (max-width: 900px) {
            .conteudo-erro {
                flex-direction: column-reverse;
                text-align: center;
            }

            p {
                max-width: 100%;
            }

            .acoes {
                justify-content: center;
            }
        }

        @media (max-width: 600px) {
            .logo {
                height: 42px;
            }

            .voltar {
                font-size: 13px;
                width: 100%;
                text-align: center;
            }

            .card {
                padding: 25px 18px;
            }

            .codigo {
                font-size: 58px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 14px;
            }

            .erro-ilustracao {
                max-width: 260px;
            }
        }
    </style>
</head>
<body>

<header class="topo">
    <div class="conteudo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" class="logo">
        </a>

        <a href="{{ url('/') }}" class="voltar">Voltar à página principal</a>
    </div>
</header>

<main class="container">
    <div class="card">
        <div class="conteudo-erro">

            <div class="texto">
                <p class="codigo">419</p>

                <h1>Sessão expirada</h1>

                <p>
                    Por segurança, sua sessão foi encerrada automaticamente.
                    Basta recarregar a página e tentar novamente.
                </p>

                <div class="acoes">
                    <a href="{{ url()->current() }}" class="btn btn-principal">
                        Recarregar página
                    </a>

                    <a href="{{ url('/') }}" class="btn btn-secundario">
                        Ir para o início
                    </a>
                </div>
            </div>

            <div class="imagem-area">
                <img src="{{ asset('imagens/erro-419.png') }}" alt="Sessão expirada" class="erro-ilustracao">
            </div>

        </div>
    </div>
</main>

</body>
</html>