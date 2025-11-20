<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Bike Maintenance') }}</title>
<style>
    *, *::before, *::after {
        box-sizing: border-box;
    }

    body, html {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom right, #f5f5f5, #ffffff);
        color: #333;
    }

    a { text-decoration: none; }

    /* Header */
    header {
        display: flex;
        justify-content: space-between; 
        align-items: center;
        padding: 0.5rem 2rem;
        border-bottom: 1px solid #ddd;
        background-color: #fff;
        height: 50px;
        position: relative;
        z-index: 10;
    }

    header h1 { 
        margin: 0; 
        font-size: 1.2rem;
        background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    nav a { 
        margin-left: 1rem; 
        font-size: 0.85rem;
        cursor: pointer;
        transition: color 0.2s;
    }

    nav a.button {
        background-color: #1d4ed8;
        color: white;
        padding: 0.3rem 0.7rem;
        border-radius: 0.25rem;
        font-size: 0.85rem;
    }

    nav a.button:hover { background-color: #2563eb; }

    /* Hero */
    .hero-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0 1rem;
        flex: 1;
        min-height: calc(100vh - 100px);
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
        cursor: pointer;
        transition: all 0.2s;
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

    /* Footer */
    footer {
        text-align: center;
        font-size: 0.75rem;
        padding: 1rem 0;
        background: #fafafa;
        border-top: 1px solid #ddd;
        position: relative;
        z-index: 10;
    }

    .fonsHeaderFooter {
        background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
        background-size: 200% 200%;
        animation: oceanWave 35s ease-in-out infinite;
        position: relative;
        color: white;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', sans-serif;
    }

    .fonsHeaderFooter::before {
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 70% 50%, rgba(16, 185, 129, 0.08), transparent 70%);
        animation: underwater 25s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes oceanWave {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes underwater {
        0%, 100% { transform: translate(0, 0); opacity: 0.4; }
        50% { transform: translate(5px, 5px); opacity: 0.7; }
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        animation: fadeIn 0.2s ease-in-out;
    }

    .modal.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content {
        background: #fff;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 450px;
        max-height: 90vh;
        overflow-y: auto;
        text-align: center;
        animation: slideUp 0.3s ease-in-out;
    }

    @keyframes slideUp {
        from { 
            opacity: 0;
            transform: translateY(30px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .modal-header h1 {
        font-size: 1.5rem;
        margin: 0 0 0.25rem 0;
        background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .modal-header p {
        font-size: 0.9rem;
        color: #555;
        margin: 0;
    }

    .close-btn {
        position: absolute;
        right: 0;
        top: -10px;
        font-size: 2rem;
        cursor: pointer;
        color: #999;
        border: none;
        background: none;
        padding: 0;
        line-height: 1;
    }

    .close-btn:hover { color: #333; }

    form > * + * { margin-top: 1rem; }

    .form-group {
        text-align: left;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
        font-weight: 500;
        color: #333;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 0.375rem;
        font-size: 0.9rem;
        font-family: Arial, sans-serif;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #1d4ed8;
        box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.1);
    }

    .form-group.checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-group.checkbox input {
        width: auto;
    }

    .form-group.checkbox label {
        margin-bottom: 0;
    }

    .error {
        color: #dc2626;
        font-size: 0.8rem;
        margin-top: 0.25rem;
        display: none;
    }

    .error.show {
        display: block;
    }

    button[type="submit"] {
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
        font-size: 0.9rem;
    }

    button[type="submit"]:hover { background-color: #2563eb; }

    button[type="submit"]:disabled {
        background-color: #9ca3af;
        cursor: not-allowed;
    }

    .divider {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 1.5rem 0;
        color: #999;
        font-size: 0.85rem;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #ddd;
    }

    .oauth-buttons {
        display: flex;
        gap: 1rem;
    }

    .oauth-btn {
        flex: 1;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 0.375rem;
        background: #fff;
        cursor: pointer;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .oauth-btn:hover {
        border-color: #1d4ed8;
        background: #f3f4f6;
    }

    .oauth-btn.google:hover { color: #1f2937; }
    .oauth-btn.github:hover { color: #1f2937; }

    .switch-modal {
        text-align: center;
        font-size: 0.85rem;
        color: #555;
        margin-top: 1rem;
    }

    .switch-modal button {
        background: none;
        border: none;
        color: #1d4ed8;
        cursor: pointer;
        font-weight: 600;
        text-decoration: underline;
        font-size: 0.85rem;
    }

    .switch-modal button:hover { color: #2563eb; }

    .forgot-password-link {
        text-align: right;
        margin-top: -0.5rem;
    }

    .forgot-password-link a {
        font-size: 0.8rem;
        color: #1d4ed8;
        text-decoration: underline;
        cursor: pointer;
    }

    .forgot-password-link a:hover { color: #2563eb; }
</style>
</head>
<body>
    <!-- Header -->
    <header class="fonsHeaderFooter">
        <h1>{{ config('app.name', 'Bike Maintenance') }}</h1>
        <nav>
            <a onclick="openModal('loginModal')">{{ __('messages.login', 'Login') }}</a>
            <a class="button" onclick="openModal('registerModal')">{{ __('messages.register', 'Register') }}</a>
        </nav>
    </header>

    <!-- Hero -->
    <div class="hero-container">
        <h2>{{ __('messages.hero_title', 'Keep Your Bike Perfect') }}</h2>
        <p>{{ __('messages.hero_text', 'Track maintenance, monitor kilometers, and extend your bike\'s lifespan') }}</p>
        <div class="buttons">
            <a class="primary" onclick="openModal('registerModal')">{{ __('messages.start_now', 'Start Now') }}</a>
            <a class="secondary" onclick="openModal('loginModal')">{{ __('messages.already_account', 'Sign In') }}</a>
        </div>

        <div class="features">
            <div class="feature-card">
                <div class="icon">🚴‍♂️</div>
                {{ __('messages.feature_kilometers', 'Track Kilometers') }}
            </div>
            <div class="feature-card">
                <div class="icon">🛠️</div>
                {{ __('messages.feature_maintenance', 'Maintenance Log') }}
            </div>
            <div class="feature-card">
                <div class="icon">⚡</div>
                {{ __('messages.feature_biketype', 'Bike Types') }}
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close-btn" onclick="closeModal('loginModal')">&times;</button>
                <h1>Inicia sessió</h1>
                <p>Accedeix al teu compte</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="login-email">Correu electrònic</label>
                    <input type="email" id="login-email" name="email" placeholder="exemple@correu.com" required autofocus>
                    <div class="error" id="login-email-error"></div>
                </div>

                <div class="form-group">
                    <label for="login-password">Contrasenya</label>
                    <input type="password" id="login-password" name="password" placeholder="Contrasenya" required>
                    <div class="forgot-password-link">
                        <a href="{{ route('password.request') }}" onclick="event.preventDefault(); closeModal('loginModal');">Has oblidat la contrasenya?</a>
                    </div>
                </div>

                <div class="form-group checkbox">
                    <input type="checkbox" id="login-remember" name="remember">
                    <label for="login-remember">Recorda'm</label>
                </div>

                <button type="submit">Inicia sessió</button>
            </form>

            <div class="divider">o</div>

            <div class="oauth-buttons">
                <a href="{{ route('oauth.redirect', 'google') }}" class="oauth-btn google">Google</a>
                <a href="{{ route('oauth.redirect', 'github') }}" class="oauth-btn github">GitHub</a>
            </div>

            <div class="switch-modal">
                No tens compte?
                <button onclick="switchModals('loginModal', 'registerModal')">Registra't</button>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close-btn" onclick="closeModal('registerModal')">&times;</button>
                <h1>Crea un compte</h1>
                <p>Uneix-te a la comunitat</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="register-name">Nom complet</label>
                    <input type="text" id="register-name" name="name" placeholder="Nom complet" required autofocus>
                    <div class="error" id="register-name-error"></div>
                </div>

                <div class="form-group">
                    <label for="register-email">Correu electrònic</label>
                    <input type="email" id="register-email" name="email" placeholder="exemple@correu.com" required>
                    <div class="error" id="register-email-error"></div>
                </div>

                <div class="form-group">
                    <label for="register-password">Contrasenya</label>
                    <input type="password" id="register-password" name="password" placeholder="Contrasenya" required>
                    <div class="error" id="register-password-error"></div>
                </div>

                <div class="form-group">
                    <label for="register-password-confirm">Confirma la contrasenya</label>
                    <input type="password" id="register-password-confirm" name="password_confirmation" placeholder="Confirma la contrasenya" required>
                    <div class="error" id="register-password-confirm-error"></div>
                </div>

                <button type="submit">Crea el compte</button>
            </form>

            <div class="divider">o</div>

            <div class="oauth-buttons">
                <a href="{{ route('oauth.redirect', 'google') }}" class="oauth-btn google">Google</a>
                <a href="{{ route('oauth.redirect', 'github') }}" class="oauth-btn github">GitHub</a>
            </div>

            <div class="switch-modal">
                Ja tens compte?
                <button onclick="switchModals('registerModal', 'loginModal')">Inicia sessió</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="fonsHeaderFooter">
        &copy; {{ date('Y') }} {{ config('app.name', 'Bike Maintenance') }} · Guillem Masdeu de Maria
    </footer>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }

        function switchModals(fromModalId, toModalId) {
            closeModal(fromModalId);
            openModal(toModalId);
        }

        // Cerrar modal al hacer clic fuera
        window.addEventListener('click', (event) => {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });

        // Mostrar errores del servidor si existen
        document.addEventListener('DOMContentLoaded', () => {
            @if ($errors->any())
                @if ($errors->bag('default')->has('email'))
                    openModal('loginModal');
                    document.getElementById('login-email-error').textContent = "{{ $errors->first('email') }}";
                    document.getElementById('login-email-error').classList.add('show');
                @endif

                @if ($errors->bag('register')->has('email') || $errors->bag('register')->has('name'))
                    openModal('registerModal');
                    @if ($errors->bag('register')->has('name'))
                        document.getElementById('register-name-error').textContent = "{{ $errors->first('name') }}";
                        document.getElementById('register-name-error').classList.add('show');
                    @endif
                    @if ($errors->bag('register')->has('email'))
                        document.getElementById('register-email-error').textContent = "{{ $errors->first('email') }}";
                        document.getElementById('register-email-error').classList.add('show');
                    @endif
                @endif
            @endif
        });
    </script>
</body>
</html>