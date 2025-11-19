<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Features;
use Livewire\Component;
use App\Models\User;

class TwoFactor extends Component
{
    public ?User $user = null;
    public bool $twoFactorEnabled = false;
    public bool $passwordConfirmed = false;
    public bool $requiresConfirmation = false;
    public bool $showVerificationStep = false;
    public ?string $manualSetupKey = null;
    
    // Variables para el layout
    public string $heading = 'Autenticación de dos factores';
    public string $subheading = 'Gestiona la seguridad de tu cuenta';

    // Configuración del modal
    public array $modalConfig = [
        'show' => false,
        'action' => null,
        'title' => '',
        'message' => '',
        'description' => '',
        'buttonText' => '',
    ];

    /**
     * Inicializa el componente con el usuario actual.
     */
    public function mount(): void
    {
        $currentUser = Auth::user();

        if (!$currentUser instanceof User) {
            $this->user = null;
            $this->twoFactorEnabled = false;
            return;
        }

        $this->user = $currentUser;
        $this->twoFactorEnabled = !empty($currentUser->two_factor_secret);
        $this->requiresConfirmation = !empty($currentUser->two_factor_confirmed);
        $this->passwordConfirmed = session()->has('auth.password_confirmed_at');

        // IMPORTANTE: Usa el método interno sin abortar
        if ($this->twoFactorEnabled && !$this->requiresConfirmation && !$this->passwordConfirmed) {
            $this->performDisable();
        }

        // Genera la clave manual si está habilitado
        if ($this->twoFactorEnabled && $currentUser->two_factor_secret) {
            try {
                $secret = decrypt($currentUser->two_factor_secret);
                $this->manualSetupKey = $this->base32Encode($secret);
            } catch (\Exception $e) {
                $this->manualSetupKey = null;
            }
        }
    }

    /**
     * Muestra el modal de confirmación.
     */
    public function confirmAction(string $action): void
    {
        if ($action === 'enable') {
            $this->modalConfig = [
                'show' => true,
                'action' => 'enable',
                'title' => 'Habilitar autenticación de dos factores',
                'message' => '¿Estás seguro de que deseas habilitar la autenticación de dos factores?',
                'description' => 'Una vez habilitada, necesitarás tu dispositivo de autenticación cada vez que inicies sesión.',
                'buttonText' => 'Habilitar',
            ];
        } elseif ($action === 'disable') {
            $this->modalConfig = [
                'show' => true,
                'action' => 'disable',
                'title' => 'Deshabilitar autenticación de dos factores',
                'message' => '¿Estás seguro de que deseas deshabilitar la autenticación de dos factores?',
                'description' => 'Esto reducirá la seguridad de tu cuenta.',
                'buttonText' => 'Deshabilitar',
            ];
        }
    }

    /**
     * Cierra el modal.
     */
    public function closeModal(): void
    {
        $this->modalConfig = [
            'show' => false,
            'action' => null,
            'title' => '',
            'message' => '',
            'description' => '',
            'buttonText' => '',
        ];
    }

    /**
     * Confirma y ejecuta la acción.
     */
    public function confirmAndExecute(): void
    {
        $action = $this->modalConfig['action'] ?? null;

        if ($action === 'enable') {
            $this->enable();
        } elseif ($action === 'disable') {
            $this->disable(); // Acción del usuario: puede abortar
        }

        $this->closeModal();
    }

    /**
     * Habilita 2FA.
     */
    public function enable(): void
    {
        if (!Features::enabled(Features::twoFactorAuthentication())) {
            return;
        }

        if ($this->user === null || $this->user->two_factor_secret) {
            return;
        }

        $secret = random_bytes(32);
        $this->user->forceFill([
            'two_factor_secret' => encrypt($secret),
        ])->save();

        $this->twoFactorEnabled = true;
        $this->showVerificationStep = true;
        $this->manualSetupKey = $this->base32Encode($secret);
    }

    /**
     * Deshabilita 2FA (acción del usuario) - PUEDE ABORTAR
     */
    public function disable(): void
    {
        if (!$this->user || !$this->user->two_factor_secret) {
            abort(403, 'La autenticación de dos factores no está habilitada.');
        }

        $this->performDisable();
    }

    /**
     * Limpia datos de 2FA SIN abortar (uso interno)
     */
    private function performDisable(): void
    {
        if (!$this->user) {
            return;
        }

        $this->user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed' => false,
        ])->save();

        $this->twoFactorEnabled = false;
        $this->showVerificationStep = false;
        $this->manualSetupKey = null;
    }

    /**
     * Codifica en base32.
     */
    private function base32Encode(string $data): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $encoded = '';
        $bits = '';

        foreach (str_split($data) as $char) {
            $bits .= str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
        }

        foreach (str_split($bits, 5) as $chunk) {
            $encoded .= $chars[bindec(str_pad($chunk, 5, '0'))];
        }

        return $encoded;
    }

    /**
     * Renderiza la vista.
     */
    public function render()
    {
        return view('livewire.settings.two-factor');
    }
}