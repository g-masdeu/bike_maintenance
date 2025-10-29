@extends('layouts.app')

@section('content')
<div class="bg-gray-100 dark:bg-gray-900 px-4 py-4">
  
  {{-- Header con botón y título --}}
  <div class="max-w-6xl mx-auto mb-4">
    <div class="flex items-center justify-between">
      {{-- Botón de volver --}}
      <a href="{{ route('home') }}">
        <flux:button variant="outline" icon="arrow-left">
          {{ __('Tornar') }}
        </flux:button>
      </a>

      {{-- Título centrado --}}
      <div class="absolute left-1/2 transform -translate-x-1/2 text-center">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Perfil</h1>
      </div>

      {{-- Espaciador invisible para mantener balance --}}
      <div class="w-24"></div>
    </div>
  </div>

  {{-- Contenedor principal - Grid de 2 columnas --}}
  <div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      
      {{-- Columna izquierda: Imagen de perfil --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 flex flex-col items-center justify-center">
        <div class="text-center">
          <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Imatge de perfil</h2>
          
          <form action="{{ route('settings.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
              <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-gray-200 dark:border-gray-600 shadow-lg mb-3">
                <img src="{{ auth()->user()->profile_photo_url ?? asset('default-avatar.png') }}" 
                     alt="Profile" 
                     class="w-full h-full object-cover"
                     id="profilePreview">
              </div>
              
              <label for="profile_photo" class="cursor-pointer inline-block">
                <span class="px-6 py-2.5 bg-gradient-to-r from-gray-400 to-gray-600 text-white 
                           rounded-lg shadow-lg hover:opacity-90 transition-all duration-300 font-medium
                           inline-block">
                  Canviar imatge
                </span>
                <input type="file" 
                       id="profile_photo"
                       name="profile_photo" 
                       accept="image/*"
                       class="hidden"
                       onchange="previewImage(event)">
              </label>
              <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                JPG, PNG o GIF (màx. 2MB)
              </p>
            </div>
          </form>
        </div>
      </div>

      {{-- Columna derecha: Información personal --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 flex flex-col justify-center">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Informació personal</h2>
        
        <div class="space-y-4">
          {{-- Nom --}}
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Nom
            </label>
            <input type="text" 
                   id="name"
                   name="name" 
                   value="{{ auth()->user()->name }}" 
                   required
                   form="profileForm"
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 
                          bg-white dark:bg-gray-700 
                          text-gray-900 dark:text-gray-100
                          focus:ring-2 focus:ring-gray-400 focus:border-transparent
                          transition-all duration-200">
          </div>

          {{-- Correu electrònic --}}
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Correu electrònic
            </label>
            <input type="email" 
                   id="email"
                   name="email" 
                   value="{{ auth()->user()->email }}" 
                   required
                   form="profileForm"
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 
                          bg-white dark:bg-gray-700 
                          text-gray-900 dark:text-gray-100
                          focus:ring-2 focus:ring-gray-400 focus:border-transparent
                          transition-all duration-200">
          </div>

          {{-- Botones de acción --}}
          <div class="flex justify-end gap-3 pt-3">
            <a href="{{ route('home') }}" 
               class="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 
                      rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 
                      transition-all duration-300 font-medium">
              Cancel·lar
            </a>
            <button type="submit" 
                    form="profileForm"
                    class="px-6 py-2.5 bg-gradient-to-r from-gray-400 to-gray-600 text-white 
                           rounded-lg shadow-lg hover:opacity-90 
                           transition-all duration-300 font-medium">
              Desar canvis
            </button>
          </div>
        </div>
      </div>

    </div>
  </div>

  {{-- Script para preview de imagen --}}
  <script>
    function previewImage(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('profilePreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
      }
    }
  </script>

</div>
@endsection