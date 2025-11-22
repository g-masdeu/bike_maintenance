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
    /**
     * Redirige al proveedor OAuth (Google o GitHub)
     */
    public function redirect($provider)
    {
        if (!in_array($provider, ['google', 'github'])) {
            return redirect('/')->with('error', 'Proveedor no válido');
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Callback OAuth
     */
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            \Log::info('OAuth callback iniciado', [
                'provider' => $provider,
                'user_id' => $socialUser->getId(),
                'email' => $socialUser->getEmail()
            ]);

            // Buscar cuenta OAuth existente
            $oauthAccount = OAuthAccount::where('provider', $provider)
                ->where('provider_id', $socialUser->getId())
                ->first();

            if ($oauthAccount) {
                // Usuario existente: login directo
                Auth::login($oauthAccount->user);
                return redirect()->route('dashboard');
            }

            // Usuario nuevo: crear y loguear
            return $this->createNewUser($socialUser, $provider);

        } catch (\Exception $e) {
            \Log::error('OAuth ERROR', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect('/')->with('error', "OAuth Error: {$e->getMessage()}");
        }
    }

    /**
     * Crear un usuario nuevo desde OAuth y loguearlo
     */
    private function createNewUser($socialUser, $provider)
    {
        // Crear usuario temporal (con contraseña aleatoria)
        $user = User::create([
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'password' => bcrypt(Str::random(16)),
        ]);

        // Crear registro OAuth vinculado
        OAuthAccount::create([
            'user_id' => $user->id,
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
        ]);

        // Loguear al usuario
        Auth::login($user);

        // Crear sesión 2FA temporal
        $sessionToken = Str::random(32);
        OAuth2FASession::create([
            'session_token' => $sessionToken,
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'provider_email' => $socialUser->getEmail(),
            'provider_name' => $socialUser->getName(),
        ]);

        // Redirigir a pantalla de 2FA (usuario ya logueado)
        return redirect()->route('oauth.verify-2fa', $sessionToken)
            ->with('new_user', true);
    }

    /**
     * Crear sesión 2FA adicional si es necesario
     */
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
