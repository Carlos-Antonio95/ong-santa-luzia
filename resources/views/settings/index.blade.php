<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - Abrigo Santa Luzia</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

<header class="header" role="banner">
    <a href="{{ route('dashboard') }}" class="logo-area" aria-label="Voltar ao Dashboard">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Abrigo Santa Luzia">
        <h1>Abrigo Santa Luzia</h1>
    </a>
    <nav aria-label="Menu principal">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        </ul>
    </nav>
</header>

<main style="max-width:640px; margin:40px auto; padding:0 20px;">
    <h2 style="margin-bottom:24px;">Configurações do Usuário</h2>

    @if(session('success_config'))
        <div role="alert" style="
            background:#dfffe5; border:1px solid #2ecc71;
            color:#1a5c38; border-radius:8px;
            padding:12px 16px; margin-bottom:20px; font-weight:600;
        ">{{ session('success_config') }}</div>
    @endif

    <div style="background:#fff; border-radius:20px; box-shadow:0 5px 20px rgba(0,0,0,.1); padding:30px;">
        <form action="{{ route('settings.update') }}" method="POST" novalidate>
            @csrf

            <div class="form-section">
                <p class="form-section-title">Aparência</p>

                <div class="campo-form">
                    <label for="cfg-tema">Tema</label>
                    <select id="cfg-tema" name="settings[theme]">
                        <option value="light" {{ ($settings['theme'] ?? 'light') === 'light' ? 'selected' : '' }}>Claro</option>
                        <option value="dark"  {{ ($settings['theme'] ?? 'light') === 'dark'  ? 'selected' : '' }}>Escuro</option>
                    </select>
                </div>
            </div>

            <div class="form-section">
                <p class="form-section-title">Notificações</p>

                <div class="campo-form">
                    <label for="cfg-notif">Notificações por E-mail</label>
                    <select id="cfg-notif" name="settings[email_notifications]">
                        <option value="1" {{ ($settings['email_notifications'] ?? '1') === '1' ? 'selected' : '' }}>Ativadas</option>
                        <option value="0" {{ ($settings['email_notifications'] ?? '1') === '0' ? 'selected' : '' }}>Desativadas</option>
                    </select>
                </div>
            </div>

            <div class="form-section">
                <p class="form-section-title">Idioma</p>

                <div class="campo-form">
                    <label for="cfg-idioma">Idioma do Sistema</label>
                    <select id="cfg-idioma" name="settings[language]">
                        <option value="pt" {{ ($settings['language'] ?? 'pt') === 'pt' ? 'selected' : '' }}>Português</option>
                        <option value="en" {{ ($settings['language'] ?? 'pt') === 'en' ? 'selected' : '' }}>Inglês</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-add">Salvar Configurações</button>
                <a href="{{ route('dashboard') }}" class="btn-acao danger">Cancelar</a>
            </div>
        </form>
    </div>
</main>

</body>
</html>
