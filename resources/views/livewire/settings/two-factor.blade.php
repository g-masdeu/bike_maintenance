<x-layouts.app :heading="$heading" :subheading="$subheading">
    <section class="w-full">
        @include('partials.settings-heading')
        
        <div class="flex flex-col w-full mx-auto space-y-6 text-sm" wire:cloak>
            {{-- Usa $this->twoFactorEnabled para acceder a la propiedad del componente --}}
            @if($this->twoFactorEnabled)
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <flux:badge color="green">{{ __('Enabled') }}</flux:badge>
                    </div>

                    <flux:text>
                        {{ __('With two-factor authentication enabled, you will be prompted for a secure, random pin during login...') }}
                    </flux:text>

                    <livewire:settings.two-factor.recovery-codes :requiresConfirmation="$this->requiresConfirmation"/>

                    <div class="flex justify-start">
                        <flux:button variant="danger" wire:click="disable">
                            {{ __('Disable 2FA') }}
                        </flux:button>
                    </div>
                </div>
            @else
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <flux:badge color="red">{{ __('Disabled') }}</flux:badge>
                    </div>

                    <flux:text variant="subtle">
                        {{ __('When you enable two-factor authentication, you will be prompted for a secure pin during login...') }}
                    </flux:text>

                    <flux:button variant="primary" wire:click="enable">
                        {{ __('Enable 2FA') }}
                    </flux:button>
                </div>
            @endif
        </div>

        {{-- Modal --}}
        <flux:modal name="two-factor-setup-modal" class="max-w-md md:min-w-md" wire:model="modalConfig.show">
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">{{ $modalConfig['title'] }}</h3>
                <p>{{ $modalConfig['message'] }}</p>
                <p class="text-sm text-gray-600">{{ $modalConfig['description'] }}</p>
                
                <div class="flex gap-3 justify-end">
                    <flux:button variant="ghost" wire:click="closeModal">{{ __('Cancel') }}</flux:button>
                    <flux:button variant="{{ $modalConfig['action'] === 'disable' ? 'danger' : 'primary' }}" 
                                wire:click="confirmAndExecute">
                        {{ $modalConfig['buttonText'] }}
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    </section>
</x-layouts.app>