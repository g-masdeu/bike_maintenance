<div style="max-width: 400px; margin: 50px auto; text-align: center; font-family: Arial;">
    <h2>Verificación de Dos Factores</h2>
    
    @if (session('error'))
        <div style="color: red; margin-bottom: 1rem;">
            {{ session('error') }}
        </div>
    @endif

    <p>{{ $providerName }}, introduce tu código de autenticación</p>

    <form method="POST" action="{{ route('oauth.verify-2fa.check', $sessionToken) }}">
        @csrf
        
        <input 
            type="text" 
            name="otp_code" 
            placeholder="000000" 
            maxlength="6"
            pattern="[0-9]{6}"
            style="padding: 10px; width: 100%; font-size: 1.2rem; text-align: center;"
            required
            autofocus
        >
        
        <button 
            type="submit" 
            style="width: 100%; padding: 10px; margin-top: 1rem; background: #1d4ed8; color: white; border: none; border-radius: 5px; cursor: pointer;"
        >
            Verificar
        </button>
    </form>

    @if ($isNewUser)
        <p style="margin-top: 2rem; color: #666;">
            Después de verificar, podrás configurar 2FA en tu perfil
        </p>
    @endif
</div>