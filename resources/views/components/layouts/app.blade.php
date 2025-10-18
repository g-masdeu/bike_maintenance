<div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
    {{-- Sidebar --}}
    @auth
    <aside class="fixed inset-y-0 left-0 w-64 border-r border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800 flex flex-col">
        <div class="p-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <x-app-logo />
                <span class="font-bold text-lg text-gray-800 dark:text-gray-100">Bicicletes</span>
            </a>
        </div>

        <nav class="flex-1 px-2 space-y-1 mt-4">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Inici</a>
            @if(Route::has('dashboard'))
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Tauler</a>
            @endif
        </nav>

        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-2">
                <span class="bg-gray-300 dark:bg-gray-600 rounded-full w-8 h-8 flex items-center justify-center font-bold text-gray-800 dark:text-gray-100">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </span>
                <div class="flex flex-col">
                    <span class="text-sm font-semibold text-gray-800 dark:text-gray-100">{{ auth()->user()->name }}</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</span>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('settings.profile') }}" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Configuració</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Tancar sessió</button>
                </form>
            </div>
        </div>
    </aside>
    @endauth

    {{-- Contingut principal --}}
    <div class="flex-1 lg:pl-64 min-h-screen p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $heading }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ $subheading }}</p>
        </div>

        <div class="space-y-10">
            {{ $slot }}
        </div>
    </div>
</div>
