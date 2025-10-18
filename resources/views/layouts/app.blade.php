<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Bike Maintenance') }}</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <!-- Header con avatar y menú desplegable -->
    <header class="flex justify-between items-center p-4 border-b border-gray-300 bg-white relative">
        <!-- Logo / nombre -->
        <h1 class="text-lg font-semibold">{{ config('app.name', 'Bike Maintenance') }}</h1>

        <!-- Avatar y dropdown -->
        @auth
        <div class="relative" x-data="{ open: false }">
            <!-- Avatar -->
            <button @click="open = !open" class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-300 focus:outline-none">
                @if (Auth::user()->profile_photo_path)
                    <img 
                        src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                        alt="Avatar de {{ Auth::user()->name }}" 
                        class="w-full h-full object-cover"
                    >
                @else
                    <img 
                        src="{{ asset('images/default-avatar.png') }}" 
                        alt="Avatar per defecte" 
                        class="w-full h-full object-cover"
                    >
                @endif
            </button>

            <!-- Dropdown -->
            <div 
                x-show="open" 
                @click.away="open = false"
                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50"
                style="display: none;"
            >
                <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    ✏️ Editar perfil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                        🚪 Tancar sessió
                    </button>
                </form>
            </div>
        </div>
        @endauth
    </header>

    <!-- Main content -->
    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center text-sm p-2 border-t border-gray-300 bg-gray-50">
        &copy; {{ date('Y') }} {{ config('app.name', 'Bike Maintenance') }} · Fet amb ❤️ amb Laravel
    </footer>

    <!-- Alpine.js para el dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
