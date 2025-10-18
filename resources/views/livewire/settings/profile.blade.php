<section class="w-full">
    @include('partials.settings-heading', ['heading' => 'Perfil', 'subheading' => 'Actualitza el teu nom i correu electrònic'])

    {{-- Botón volver a inicio --}}
    <section class="w-full mb-6">
        <a href="{{ route('home') }}">
            <flux:button variant="outline" icon="arrow-left">
                {{ __('Volver a Inici') }}
            </flux:button>
        </a>
    </section>

    <x-settings.layout :heading="__('Perfil')" :subheading="__('Actualitza el teu nom i correu electrònic')">

        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6" enctype="multipart/form-data">
            
            {{-- Imagen de perfil --}}
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-full overflow-hidden border border-zinc-300 dark:border-zinc-700">
                    @if(auth()->user()->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Foto de perfil" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center w-full h-full bg-zinc-200 dark:bg-zinc-700 text-zinc-500">
                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                        </div>
                    @endif
                </div>
                <flux:input wire:model="profile_photo" :label="__('Foto de perfil')" type="file" accept="image/*"/>
            </div>

            {{-- Nombre --}}
            <flux:input wire:model="name" :label="__('Nom')" type="text" required autofocus autocomplete="name" />

            {{-- Email --}}
            <div>
                <flux:input wire:model="email" :label="__('Correu electrònic')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('El teu correu electrònic no està verificat.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Fes clic aquí per rebre de nou l\'email de verificació.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('S\'ha enviat un nou enllaç de verificació al teu correu electrònic.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Botón guardar --}}
            <div class="flex items-center gap-4">
                <flux:button variant="primary" type="submit" class="w-full">{{ __('Desa') }}</flux:button>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Desat.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
