<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'Bike Maintenance') }} - He oblidat la contrasenya</title>
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
    .forgot-container {
        background: #fff;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        width: 100%;
        max-width: 400px;
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    h1 {
        font-size: 1.5rem;
        margin-bottom: 0.25rem;
        background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    p {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 1.5rem;
    }
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
        margin-bottom: 1rem;
    }
    flux:button:hover { background-color: #2563eb; }
    flux:link {
        color: #1d4ed8;
        font-size: 0.85rem;
        text-decoration: underline;
        cursor: pointer;
    }
</style>
</head>
<body>

<div class="forgot-container">
    <h1>He oblidat la contrasenya</h1>
    <p>Introdueix el teu correu electrònic per rebre un enllaç de restabliment de contrasenya.</p>

    <!-- Session Status -->
    <x-auth-session-status class="text-center mb-4" :status="session('status')" />

    <form method="POST" wire:submit="sendPasswordResetLink">
        <!-- Correu electrònic -->
        <flux:input
            wire:model="email"
            :label="'Correu electrònic'"
            type="email"
            required
            autofocus
            placeholder="exemple@correu.com"
        />

        <flux:button type="submit">Envia l’enllaç de restabliment</flux:button>
    </form>

    <div style="font-size:0.85rem; color:#555; margin-top:1rem;">
        <span>O, torna a </span>
        <flux:link :href="route('login')" wire:navigate>iniciar sessió</flux:link>
    </div>
</div>

</body>
</html>
