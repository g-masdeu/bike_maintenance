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
    
    // Configuración del modal de confirmación
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
            // No hay usuario autenticado: inicializa propiedades por defecto
            $this->user = null;
            $this->twoFactorEnabled = false;
            $this->passwordConfirmed = false;
            $this->requiresConfirmation = false;
            return;
        }

        $this->user = $currentUser;

        // Determina si la acción requiere confirmación
        $this->requiresConfirmation = $currentUser->two_factor_confirmed ?? false;

        // Determina si tiene 2FA habilitado
        $this->twoFactorEnabled = (bool) $currentUser->two_factor_secret;

        // Determina si la contraseña ha sido confirmada recientemente (Fortify)
        $this->passwordConfirmed = session()->has('auth.password_confirmed_at');
        
        // Si el usuario tiene 2FA habilitado pero no confirmado y no hay confirmación de contraseña,
        // deshabilitar el 2FA (confirmación abandonada)
        if ($this->twoFactorEnabled && !$this->requiresConfirmation && !$this->passwordConfirmed) {
            $this->disable();
        }
        
        // Si ya tiene la clave secreta, generar la clave manual
        if ($this->twoFactorEnabled && $this->user->two_factor_secret) {
            try {
                $secret = decrypt($this->user->two_factor_secret);
                $this->manualSetupKey = $this->base32Encode($secret);
            } catch (\Exception $e) {
                $this->manualSetupKey = null;
            }
        }
    }

    /**
     * Muestra el modal de confirmación antes de realizar una acción.
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
                'description' => 'Esto reducirá la seguridad de tu cuenta y ya no necesitarás un segundo factor para acceder.',
                'buttonText' => 'Deshabilitar',
            ];
        }
    }

    /**
     * Cierra el modal de confirmación.
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
     * Confirma y ejecuta la acción pendiente.
     */
    public function confirmAndExecute(): void
    {
        $action = $this->modalConfig['action'] ?? null;

        if ($action === 'enable') {
            $this->enable();
        } elseif ($action === 'disable') {
            $this->disable();
        }

        $this->closeModal();
    }

    /**
     * Habilita la autenticación de dos factores para el usuario.
     * Solo si la característica de Fortify está activada.
     */
    public function enable(): void
    {
        if (!Features::enabled(Features::twoFactorAuthentication())) {
            return;
        }

        if ($this->user === null || $this->user->two_factor_secret) {
            // Ya tiene 2FA habilitado o no hay usuario
            return;
        }

        // Genera una clave secreta de 2FA y guarda en la base de datos
        $secret = random_bytes(32);
        $this->user->forceFill([
            'two_factor_secret' => encrypt($secret),
        ])->save();

        // Actualiza la propiedad pública para reflejar el cambio en la vista
        $this->twoFactorEnabled = true;
        
        // Muestra el paso de verificación para escanear el QR
        $this->showVerificationStep = true;
        
        // Genera la clave de configuración manual
        $this->manualSetupKey = $this->base32Encode($secret);
    }

    /**
     * Deshabilita la autenticación de dos factores para el usuario.
     */
    public function disable(): void
    {
        if ($this->user === null || !$this->user->two_factor_secret) {
            // 2FA ya está deshabilitado o no hay usuario
            return;
        }

        // Borra secret y códigos de recuperación
        $this->user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ])->save();

        $this->twoFactorEnabled = false;
        $this->showVerificationStep = false;
        $this->manualSetupKey = null;
    }

    /**
     * Codifica un string en base32.
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
     * Renderiza la vista Livewire del componente.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.settings.two-factor');
    }
}