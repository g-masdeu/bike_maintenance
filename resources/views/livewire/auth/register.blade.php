<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'Bike Maintenance') }} - Registra't</title>
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom right, #f5f5f5, #ffffff);
        color: #333;
        overflow: hidden; /* sense scroll */
    }
    a { text-decoration: none; }
    .register-container {
        background: #fff;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        width: 100%;
        max-width: 400px;
        text-align: center;
        margin: auto;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .register-container h1 {
        font-size: 1.5rem;
        margin-bottom: 0.25rem;
        background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .register-container p {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 1.5rem;
    }
    form > * { margin-bottom: 1rem; }
    flux:button {
        display: block;
        width: 100%;
        background-color: #1d4ed8;
        color: white;
        padding: 0.75rem;
        border-radius: 0.375rem;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }
    flux:button:hover { background-color: #2563eb; }
    .login-link {
        text-align: center;
        font-size: 0.85rem;
        color: #555;
        margin-top: 1rem;
    }
    .login-link flux:link { color: #1d4ed8; text-decoration: underline; }
</style>
</head>
<body>

<div class="register-container">
    <h1>Crea un compte</h1>
    <p>Introdueix les teves dades per crear el teu compte</p>

    <!-- Session Status -->
    <x-auth-session-status class="text-center mb-4" :status="session('status')" />

    <form method="POST" wire:submit="register">
        <!-- Nom -->
        <flux:input
            wire:model="name"
            :label="'Nom complet'"
            type="text"
            required
            autofocus
            autocomplete="name"
            placeholder="Nom complet"
        />

        <!-- Correu electrònic -->
        <flux:input
            wire:model="email"
            :label="'Correu electrònic'"
            type="email"
            required
            autocomplete="email"
            placeholder="exemple@correu.com"
        />

        <!-- Contrasenya -->
        <flux:input
            wire:model="password"
            :label="'Contrasenya'"
            type="password"
            required
            autocomplete="new-password"
            placeholder="Contrasenya"
            viewable
        />

        <!-- Confirma contrasenya -->
        <flux:input
            wire:model="password_confirmation"
            :label="'Confirma la contrasenya'"
            type="password"
            required
            autocomplete="new-password"
            placeholder="Confirma la contrasenya"
            viewable
        />

        <!-- Botó Crear Compte -->
        <flux:button type="submit">Crea el compte</flux:button>
    </form>

    <!-- Enllaç a login -->
    <div class="login-link">
        <span>Ja tens compte?</span>
        <flux:link :href="route('login')" wire:navigate>Inicia sessió</flux:link>
    </div>
</div>

</body>
</html>
