@extends('layouts.app') //SE O LAYOUT PRINCIPAL FOR DIFERENTE DE LAYOUTS.APP SUBSTITUA PELO LAYOUT CERTO

@section('content')
<div class="container">
    <h1>Configurações do Usuário</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="theme" class="form-label">Tema</label>
            <select name="settings[theme]" id="theme" class="form-control">
                <option value="light" {{ ($settings['theme'] ?? 'light') == 'light' ? 'selected' : '' }}>Claro</option>
                <option value="dark" {{ ($settings['theme'] ?? 'light') == 'dark' ? 'selected' : '' }}>Escuro</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="notifications" class="form-label">Notificações por E-mail</label>
            <select name="settings[email_notifications]" id="notifications" class="form-control">
                <option value="1" {{ ($settings['email_notifications'] ?? '1') == '1' ? 'selected' : '' }}>Ativadas</option>
                <option value="0" {{ ($settings['email_notifications'] ?? '1') == '0' ? 'selected' : '' }}>Desativadas</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="language" class="form-label">Idioma</label>
            <select name="settings[language]" id="language" class="form-control">
                <option value="pt" {{ ($settings['language'] ?? 'pt') == 'pt' ? 'selected' : '' }}>Português</option>
                <option value="en" {{ ($settings['language'] ?? 'pt') == 'en' ? 'selected' : '' }}>Inglês</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Configurações</button>
    </form>
</div>
@endsection