<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-gray-100 dark:bg-gray-900">

    @auth
    {{-- Sidebar --}}
    <flux:sidebar sticky stashable class="border-e border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">

        {{-- Toggle mòbil --}}
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        {{-- Navegació principal --}}
        <flux:navlist variant="outline">
            <flux:navlist.group :heading="'Plataforma'" class="grid">
                <flux:navlist.item icon="home" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                    {{ __('Inici') }}
                </flux:navlist.item>
                @if(Route::has('dashboard'))
                <flux:navlist.item icon="view-grid" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                    {{ __('Tauler') }}
                </flux:navlist.item>
                @endif
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        {{-- Recursos externs --}}
        <flux:navlist variant="outline">
            <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repositori') }}
            </flux:navlist.item>
            <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentació') }}
            </flux:navlist.item>
        </flux:navlist>

        {{-- Menú usuari desktop --}}
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile
                :name="auth()->user()->name"
                :initials="method_exists(auth()->user(), 'initials') ? auth()->user()->initials() : strtoupper(substr(auth()->user()->name,0,1))"
                icon:trailing="chevrons-up-down"
            />

            <flux:menu class="w-[220px]">
                <div class="p-2 text-sm">
                    <span class="font-semibold">{{ auth()->user()->name }}</span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</span>
                </div>

                <flux:menu.separator />

                @if(Route::has('settings.profile'))
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Configuració') }}
                    </flux:menu.item>
                @endif

                <flux:menu.separator />

                @if(Route::has('logout'))
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Tancar sessió') }}
                    </flux:menu.item>
                </form>
                @endif
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>
    @endauth

    {{-- Header mòbil --}}
    <flux:header class="lg:hidden">
        @auth
        <flux:sidebar.toggle icon="bars-2" inset="left" />
        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile
                :initials="method_exists(auth()->user(), 'initials') ? auth()->user()->initials() : strtoupper(substr(auth()->user()->name,0,1))"
                icon-trailing="chevron-down"
            />

            <flux:menu>
                <div class="p-2 text-sm">
                    <span class="font-semibold">{{ auth()->user()->name }}</span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</span>
                </div>

                <flux:menu.separator />

                @if(Route::has('settings.profile'))
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Configuració') }}
                    </flux:menu.item>
                @endif

                <flux:menu.separator />

                @if(Route::has('logout'))
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Tancar sessió') }}
                    </flux:menu.item>
                </form>
                @endif
            </flux:menu>
        </flux:dropdown>
        @endauth
    </flux:header>

    {{-- Contingut principal --}}
    <main class="p-4 lg:ml-64">
        {{ $slot }}
    </main>

    @fluxScripts
</body>
</html>
