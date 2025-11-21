<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'Bike Maintenance') }} - Registra't</title>
<style>
    *, *::before, *::after {
        box-sizing: border-box;
    }

    body, html {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    a { 
        text-decoration: none; 
    }

    .register-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 2.5rem;
        border-radius: 1rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        width: 100%;
        max-width: 420px;
        margin: 1rem;
    }

    .register-container h1 {
        font-size: 1.75rem;
        margin: 0 0 0.5rem 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-align: center;
    }

    .register-container > p {
        font-size: 0.9rem;
        color: #666;
        margin: 0 0 1.5rem 0;
        text-align: center;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-group input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background: #f9fafb;
    }

    .form-group input:focus {
        outline: none;
        border-color: #667eea;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-group input::placeholder {
        color: #9ca3af;
    }

    .error-message {
        color: #dc2626;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }

    .submit-btn {
        display: block;
        width: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.875rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-top: 1.5rem;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -10px rgba(102, 126, 234, 0.5);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .divider {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 1.5rem 0;
        color: #9ca3af;
        font-size: 0.85rem;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }

    .google-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        width: 100%;
        padding: 0.875rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.5rem;
        background: #fff;
        cursor: pointer;
        font-size: 0.95rem;
        font-weight: 500;
        color: #374151;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .google-btn:hover {
        border-color: #667eea;
        background: #f9fafb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .google-btn img {
        width: 20px;
        height: 20px;
    }

    .login-link {
        text-align: center;
        font-size: 0.9rem;
        color: #666;
        margin-top: 1.5rem;
    }

    .login-link a {
        color: #667eea;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .login-link a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    @media (max-width: 480px) {
        .register-container {
            padding: 1.5rem;
            margin: 0.5rem;
        }

        .register-container h1 {
            font-size: 1.5rem;
        }
    }
</style>
</head>
<body>

<div class="register-container">
    <h1>Crea un compte</h1>
    <p>Introdueix les teves dades per crear el teu compte</p>

    <!-- Session Status -->
    <x-auth-session-status class="text-center mb-4" :status="session('status')" />

    <form method="POST" wire:submit="register">
        @csrf

        <!-- Nom -->
        <div class="form-group">
            <label for="name">Nom complet</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                wire:model="name"
                placeholder="Nom complet" 
                required 
                autofocus 
                autocomplete="name"
            >
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Correu electrònic -->
        <div class="form-group">
            <label for="email">Correu electrònic</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                wire:model="email"
                placeholder="exemple@correu.com" 
                required 
                autocomplete="email"
            >
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Contrasenya -->
        <div class="form-group">
            <label for="password">Contrasenya</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                wire:model="password"
                placeholder="Contrasenya" 
                required 
                autocomplete="new-password"
            >
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirma contrasenya -->
        <div class="form-group">
            <label for="password_confirmation">Confirma la contrasenya</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                wire:model="password_confirmation"
                placeholder="Confirma la contrasenya" 
                required 
                autocomplete="new-password"
            >
            @error('password_confirmation')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botó Crear Compte -->
        <button type="submit" class="submit-btn">Crea el compte</button>
    </form>

    <!-- Divider -->
    <div class="divider">o continua amb</div>

    <!-- Google OAuth -->
    <a href="{{ route('oauth.redirect', 'google') }}" class="google-btn">
        <img src="/img/logo_google.png" alt="Google">
        Registra't amb Google
    </a>

    <!-- Enllaç a login -->
    <div class="login-link">
        Ja tens compte? <a href="{{ route('login') }}" wire:navigate>Inicia sessió</a>
    </div>
</div>

</body>
</html>