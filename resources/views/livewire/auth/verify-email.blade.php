<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'Bike Maintenance') }} - Verifica el correu</title>
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
    .verify-container {
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
    .verify-container h1 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .verify-container p {
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
    .status-message {
        font-size: 0.85rem;
        margin-bottom: 1rem;
    }
    .status-success { color: #16a34a; font-weight: 500; }
</style>
</head>
<body>

<div class="verify-container">
    <h1>Verifica el teu correu electrònic</h1>
    <p>Si us plau, verifica la teva adreça de correu electrònic fent clic al link que t’hem enviat.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="status-message status-success">
            S’ha enviat un nou link de verificació al correu electrònic que vas proporcionar durant el registre.
        </div>
    @endif

    <flux:button wire:click="sendVerification">Torna a enviar el correu de verificació</flux:button>

    <flux:link wire:click="logout">Tancar sessió</flux:link>
</div>

</bod
