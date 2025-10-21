@extends('layouts.app')

@section('content')
<section class="w-full mb-6">
    <a href="{{ route('home') }}">
        <flux:button variant="outline" icon="arrow-left">
            {{ __('Tornar a l\'inici') }}
        </flux:button>
    </a>
</section>
<div class="h-full bg-gray-100 dark:bg-gray-900 p-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">Perfil</h1>
    <p class="text-gray-600 dark:text-gray-400 mb-6">Actualitza el teu nom, correu electrònic i imatge de perfil.</p>

    <form action="{{ route('settings.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-xl">
        @csrf
        @method('PUT')

        {{-- Imagen de perfil --}}
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-full overflow-hidden border border-gray-300 dark:border-gray-600">
                <img src="{{ auth()->user()->profile_photo_url ?? asset('default-avatar.png') }}" alt="Profile" class="w-full h-full object-cover">
            </div>
            <div>
                <label class="block text-gray-700 dark:text-gray-300 mb-1">Canvia la imatge</label>
                <input type="file" name="profile_photo" accept="image/*" class="text-sm text-gray-600 dark:text-gray-400">
            </div>
        </div>

        {{-- Nom --}}
        <div>
            <label class="block text-gray-700 dark:text-gray-300">Nom</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}" required
                   class="w-full mt-1 p-2 border rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
        </div>

        {{-- Correu electrònic --}}
        <div>
            <label class="block text-gray-700 dark:text-gray-300">Correu electrònic</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}" required
                   class="w-full mt-1 p-2 border rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Desa
        </button>
    </form>
</div>
@endsection
