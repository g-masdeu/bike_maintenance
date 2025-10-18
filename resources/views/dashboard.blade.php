@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-start bg-gray-100 dark:bg-gray-900 py-10 px-4">

    {{-- Títol i botó Afegir bicicleta --}}
    <div class="w-full max-w-5xl mb-6 flex justify-between items-center">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100">Les teves bicicletes</h1>
        <a href="{{ route('bicicletas.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Afegir bicicleta
        </a>
    </div>

    {{-- Estadístiques ràpides --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10 w-full max-w-5xl">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold">{{ $bicicletas->count() }}</div>
            <div class="text-gray-500 dark:text-gray-400">Bicicletes totals</div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold">{{ $bicicletas->sum('kms_actuals') }} km</div>
            <div class="text-gray-500 dark:text-gray-400">Quilòmetres totals</div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold">
                {{ $bicicletas->filter(fn($b) => $b->kms_actuals - $b->kms_ultimo_mantenimiento >= 500)->count() }}
            </div>
            <div class="text-gray-500 dark:text-gray-400">Manteniment pendent</div>
        </div>
    </div>

    {{-- Llista bicicletes --}}
    <div class="w-full max-w-5xl">
        <div class="grid gap-4">
            @foreach($bicicletas as $bicicleta)
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <div class="font-bold text-lg text-gray-900 dark:text-gray-100">{{ $bicicleta->model }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $bicicleta->marca->name }} | {{ $bicicleta->tipo->name }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $bicicleta->kms_actuals }} km recorreguts</div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('bicicletas.show', $bicicleta) }}" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-500">Veure</a>
                        <a href="#" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-500">Actualitzar km</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
