<x-layouts.auth>
    <div style="min-height:100vh; display:flex; align-items:center; justify-content:center; background: linear-gradient(to bottom right, #f5f5f5, #ffffff); font-family: Arial, sans-serif; padding:1rem;">
        <div class="confirm-container" style="background:#fff; padding:2rem; border-radius:0.5rem; box-shadow:0 4px 10px rgba(0,0,0,0.05); width:100%; max-width:400px; text-align:center; position:relative;">
            
            <h1 style="font-size:1.5rem; margin-bottom:0.25rem; background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Confirma la contrasenya
            </h1>
            <p style="font-size:0.9rem; color:#555; margin-bottom:1.5rem;">
                Aquesta és una àrea segura de l'aplicació. Si us plau, confirma la teva contrasenya abans de continuar.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="text-center mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.confirm.store') }}">
                @csrf

                <flux:input
                    name="password"
                    :label="'Contrasenya'"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Contrasenya"
                    viewable
                />

                <flux:button type="submit" variant="primary" style="width:100%; background-color:#1d4ed8; color:white; padding:0.75rem; border-radius:0.375rem; font-weight:bold; border:none; cursor:pointer; transition:0.2s;">
                    Confirma
                </flux:button>
            </form>
        </div>
    </div>
</x-layouts.auth>
