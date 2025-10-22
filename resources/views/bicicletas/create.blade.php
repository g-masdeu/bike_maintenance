@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Afegir nova bicicleta</h1>

    <form action="{{ route('bicicletas.store') }}" method="POST">
        @csrf

        <!-- TIPO BICI -->
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200">Tipus</label>
            <select name="tipo_id" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100" required>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- MARCA BICI -->
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200">Marca</label>
            <select name="marca_id" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100" required>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- MODELO BICI -->
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200">Model</label>
            <input type="text" name="model" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200">Data de compra</label>
            <input type="date" name="data_compra" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100" required>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Afegir</button>
    </form>
</div>
@endsection
