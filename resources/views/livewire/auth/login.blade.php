<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'Bike Maintenance') }}</title>
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
    .login-container {
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
    .login-container h1 {
        font-size: 1.5rem;
        margin-bottom: 0.25rem;
        background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .login-container p {
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
    .forgot-password {
        font-size: 0.8rem;
        color: #1d4ed8;
        text-decoration: underline;
    }
    .remember-me { display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #555; justify-content: start; }
    .signup-link {
        text-align: center;
        font-size: 0.85rem;
        color: #555;
        margin-top: 1rem;
    }
    .signup-link flux:link { color: #1d4ed8; text-decoration: underline; }
</style>
</head>
<body>

<div class="login-container">
    <h1>Inicia sessió al teu compte</h1>
    <p>Introdueix el teu correu electrònic i contrasenya per accedir</p>

    <!-- Session Status -->
    <x-auth-session-status class="text-center mb-4" :status="session('status')" />

    <form method="POST" wire:submit="login">
        <!-- Correu electrònic -->
        <flux:input
            wire:model="email"
            :label="'Correu electrònic'"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="exemple@correu.com"
        />

        <!-- Contrasenya -->
        <div style="position: relative;">
            <flux:input
                wire:model="password"
                :label="'Contrasenya'"
                type="password"
                required
                autocomplete="current-password"
                placeholder="Contrasenya"
                viewable
            />
            @if (Route::has('password.request'))
                <flux:link class="forgot-password" :href="route('password.request')" wire:navigate style="position: absolute; top: 0; right: 0;">
                    Has oblidat la contrasenya?
                </flux:link>
            @endif
        </div>

        <!-- Recorda'm -->
        <div class="remember-me">
            <flux:checkbox wire:model="remember" :label="'Recorda\'m'" />
        </div>

        <!-- Botó Iniciar Sessió -->
        <flux:button type="submit">Inicia sessió</flux:button>
    </form>

    <!-- Enllaç a registre -->
    @if (Route::has('register'))
        <div class="signup-link">
            <span>No tens compte?</span>
            <flux:link :href="route('register')" wire:navigate>Registra't</flux:link>
        </div>
    @endif
</div>

</body>
</html>
