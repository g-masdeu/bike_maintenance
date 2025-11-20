<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OAuthAccount;
use App\Models\OAuth2FASession;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class OAuth2FAController extends Controller
{
    public function showVerify($sessionToken)
    {
        $session = OAuth2FASession::where('session_token', $sessionToken)
            ->first();

        if (!$session || $session->isExpired()) {
            return redirect('/')->with('error', 'Sesión expirada');
        }

        $isNewUser = request()->has('new_user');

        return view('auth.oauth-2fa-verify', [
            'sessionToken' => $sessionToken,
            'providerName' => $session->provider_name,
            'providerEmail' => $session->provider_email,
            'isNewUser' => $isNewUser,
        ]);
    }

    public function verify($sessionToken)
    {
        $session = OAuth2FASession::where('session_token', $sessionToken)->first();

        if (!$session || $session->isExpired()) {
            return back()->with('error', 'Sesión expirada');
        }

        // Intentos máximos
        if ($session->attempts >= 5) {
            $session->delete();
            return redirect('/')->with('error', 'Demasiados intentos');
        }

        $otp = request('otp_code');

        // Obtener usuario por OAuth
        $oauthAccount = OAuthAccount::where('provider', $session->provider)
            ->where('provider_id', $session->provider_id)
            ->first();

        // Si es usuario nuevo, crear cuenta
        if (!$oauthAccount) {
            $user = $this->createNewUser($session);
            $oauthAccount = OAuthAccount::create([
                'user_id' => $user->id,
                'provider' => $session->provider,
                'provider_id' => $session->provider_id,
                'email' => $session->provider_email,
            ]);
        }

        $user = $oauthAccount->user;

        // Verificar 2FA (si está habilitado)
        if ($user->has2FAEnabled()) {
            if (!$this->verify2FA($user, $otp)) {
                $session->increment('attempts');
                return back()->with('error', 'Código OTP incorrecto');
            }
        }

        // Limpiar sesión y loguear usuario
        $session->delete();
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Autenticado correctamente');
    }

    private function createNewUser($session)
    {
        return User::create([
            'name' => $session->provider_name,
            'email' => $session->provider_email,
            'password' => bcrypt(Str::random(32)), // Contraseña aleatoria (OAuth)
        ]);
    }

    private function verify2FA($user, $otp): bool
    {
        // Aquí usa la librería que prefieras: Google Authenticator (TOTP) o SMS
        // Para este ejemplo, asumimos Google Authenticator
        
        // Opción 1: Usar PHPGangsta_GoogleAuthenticator
        // $authenticator = new \PHPGangsta_GoogleAuthenticator();
        // return $authenticator->verifyCode($user->two_factor_secret, $otp, 2);
        
        // Por ahora retorna true (lo implementas luego)
        return true;
    }
}