<x-layouts.auth>
    <div style="min-height:100vh; display:flex; align-items:center; justify-content:center; background: linear-gradient(to bottom right, #f5f5f5, #ffffff); font-family: Arial, sans-serif; padding:1rem;">
        <div class="twofa-container" style="background:#fff; padding:2rem; border-radius:0.5rem; box-shadow:0 4px 10px rgba(0,0,0,0.05); width:100%; max-width:400px; text-align:center; position:relative;">
            
            <div
                x-cloak
                x-data="{
                    showRecoveryInput: @js($errors->has('recovery_code')),
                    code: '',
                    recovery_code: '',
                    toggleInput() {
                        this.showRecoveryInput = !this.showRecoveryInput;
                        this.code = '';
                        this.recovery_code = '';
                        $dispatch('clear-2fa-auth-code');
                        $nextTick(() => {
                            this.showRecoveryInput
                                ? this.$refs.recovery_code?.focus()
                                : $dispatch('focus-2fa-auth-code');
                        });
                    },
                }"
            >
                <div x-show="!showRecoveryInput">
                    <h1 style="font-size:1.5rem; margin-bottom:0.25rem; background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Codi d’autenticació
                    </h1>
                    <p style="font-size:0.9rem; color:#555; margin-bottom:1.5rem;">
                        Introdueix el codi proporcionat per la teva aplicació d’autenticació.
                    </p>
                </div>

                <div x-show="showRecoveryInput">
                    <h1 style="font-size:1.5rem; margin-bottom:0.25rem; background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Codi de recuperació
                    </h1>
                    <p style="font-size:0.9rem; color:#555; margin-bottom:1.5rem;">
                        Confirma l’accés al teu compte introduint un dels codis d’emergència.
                    </p>
                </div>

                <form method="POST" action="{{ route('two-factor.login.store') }}">
                    @csrf

                    <div class="space-y-5" style="text-align:center;">
                        <div x-show="!showRecoveryInput">
                            <div style="display:flex; justify-content:center; margin:1.25rem 0;">
                                <x-input-otp
                                    name="code"
                                    digits="6"
                                    autocomplete="one-time-code"
                                    x-model="code"
                                />
                            </div>

                            @error('code')
                                <flux:text color="red">{{ $message }}</flux:text>
                            @enderror
                        </div>

                        <div x-show="showRecoveryInput">
                            <div style="margin:1.25rem 0;">
                                <flux:input
                                    type="text"
                                    name="recovery_code"
                                    x-ref="recovery_code"
                                    x-bind:required="showRecoveryInput"
                                    autocomplete="one-time-code"
                                    x-model="recovery_code"
                                />
                            </div>

                            @error('recovery_code')
                                <flux:text color="red">{{ $message }}</flux:text>
                            @enderror
                        </div>

                        <flux:button type="submit" variant="primary" style="width:100%; background-color:#1d4ed8; color:white; padding:0.75rem; border-radius:0.375rem; font-weight:bold; border:none; cursor:pointer; transition:0.2s;">
                            Continua
                        </flux:button>
                    </div>

                    <div style="margin-top:1.25rem; font-size:0.85rem; color:#555; text-align:center;">
                        <span style="opacity:0.5;">o pots</span>
                        <div style="display:inline; font-weight:500; text-decoration:underline; cursor:pointer; opacity:0.8;">
                            <span x-show="!showRecoveryInput" @click="toggleInput()">iniciar sessió amb un codi de recuperació</span>
                            <span x-show="showRecoveryInput" @click="toggleInput()">iniciar sessió amb un codi d’autenticació</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.auth>
