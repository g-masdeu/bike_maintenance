<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OAuthAccount;
use App\Models\OAuth2FASession;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirect($provider)
    {
        // Validar proveedor
        if (!in_array($provider, ['google', 'github'])) {
            return redirect('/')->with('error', 'Proveedor no válido');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            // Obtener usuario del proveedor OAuth
            $socialUser = Socialite::driver($provider)->user();

            // Buscar si ya existe cuenta OAuth
            $oauthAccount = OAuthAccount::where('provider', $provider)
                ->where('provider_id', $socialUser->getId())
                ->first();

            // Si existe, loguear directamente
            if ($oauthAccount) {
                $user = $oauthAccount->user;
                
                // Si tiene 2FA habilitado, crear sesión de verificación
                if ($user->has2FAEnabled()) {
                    return $this->create2FASession($user, $provider, $socialUser);
                }

                // Si no tiene 2FA, loguear directamente
                Auth::login($user);
                return redirect()->route('dashboard')->with('success', 'Sesión iniciada');
            }

            // Si no existe, crear nueva cuenta
            return $this->createNewUser($socialUser, $provider);

        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Error en autenticación OAuth');
        }
    }

    private function createNewUser($socialUser, $provider)
    {
        // Crear sesión 2FA temporal
        // El usuario aún no tiene 2FA habilitado, pero lo configurará después
        $sessionToken = Str::random(32);

        OAuth2FASession::create([
            'session_token' => $sessionToken,
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'provider_email' => $socialUser->getEmail(),
            'provider_name' => $socialUser->getName(),
        ]);

        // Redirigir a pantalla de registro/2FA
        return redirect()->route('oauth.verify-2fa', $sessionToken)
            ->with('new_user', true);
    }

    private function create2FASession($user, $provider, $socialUser)
    {
        $sessionToken = Str::random(32);

        OAuth2FASession::create([
            'session_token' => $sessionToken,
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'provider_email' => $socialUser->getEmail(),
            'provider_name' => $socialUser->getName(),
        ]);

        return redirect()->route('oauth.verify-2fa', $sessionToken);
    }
}