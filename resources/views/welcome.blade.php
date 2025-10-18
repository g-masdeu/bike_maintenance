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
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 2rem;
        border-bottom: 1px solid #ddd;
        background-color: #fff;
        height: 50px;
    }
    header h1 { margin: 0; font-size: 1.2rem; }
    nav a { margin-left: 1rem; font-size: 0.85rem; }
    nav a.button {
        background-color: #1d4ed8;
        color: white;
        padding: 0.3rem 0.7rem;
        border-radius: 0.25rem;
        font-size: 0.85rem;
    }
    nav a.button:hover { background-color: #2563eb; }

    .hero-container {
        height: calc(100% - 50px); /* resta del header */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0 1rem;
    }

    .hero-container h2 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .hero-container p {
        font-size: 1rem;
        margin-bottom: 1rem;
        max-width: 400px;
    }
    .hero-container .buttons a {
        display: inline-block;
        margin: 0.3rem;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        font-weight: bold;
        font-size: 0.9rem;
    }
    .hero-container .buttons a.primary {
        background-color: #1d4ed8;
        color: white;
    }
    .hero-container .buttons a.primary:hover { background-color: #2563eb; }
    .hero-container .buttons a.secondary {
        border: 2px solid #1d4ed8;
        color: #1d4ed8;
    }
    .hero-container .buttons a.secondary:hover { background-color: #e0e7ff; }

    .features {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }
    .feature-card {
        background: #fff;
        border-radius: 0.25rem;
        padding: 0.5rem 1rem;
        max-width: 120px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        font-size: 0.75rem;
    }
    .feature-card .icon { font-size: 1.5rem; margin-bottom: 0.3rem; }

    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: center;
        font-size: 0.75rem;
        padding: 0.3rem 0;
        background: #fafafa;
        border-top: 1px solid #ddd;
    }
</style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>{{ config('app.name', 'Bike Maintenance') }}</h1>
        <nav>
            <a href="{{ route('login') }}">Accedir</a>
            <a href="{{ route('register') }}" class="button">Registrar-se</a>
        </nav>
    </header>

    <!-- Hero + Features en una sola secció vertical -->
    <div class="hero-container">
        <h2>Gestiona les teves bicicletes</h2>
        <p>Controla el kilometratge, mantingues un registre de manteniments i rep alertes segons el tipus de bicicleta.</p>
        <div class="buttons">
            <a href="{{ route('register') }}" class="primary">Comença ara</a>
            <a href="{{ route('login') }}" class="secondary">Ja tens compte?</a>
        </div>

        <div class="features">
            <div class="feature-card">
                <div class="icon">🚴‍♂️</div>
                Kilometres
            </div>
            <div class="feature-card">
                <div class="icon">🛠️</div>
                Manteniment
            </div>
            <div class="feature-card">
                <div class="icon">⚡</div>
                Tipus Bike
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} {{ config('app.name', 'Bike Maintenance') }} · Fet amb ❤️ amb Laravel
    </footer>

</body>
</html>
