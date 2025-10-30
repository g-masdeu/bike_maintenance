@extends('layouts.app')

@section('content')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const tipoSelect = document.getElementById('tipo_id');
    const marcaSelect = document.getElementById('marca_id');
    const modeloSelect = document.getElementById('modelo_id');

    const resetSelect = (select, placeholder) => {
        select.innerHTML = `<option value="">${placeholder}</option>`;
    }

    resetSelect(tipoSelect, 'Selecciona un tipo');
    resetSelect(marcaSelect, 'Selecciona una marca');
    resetSelect(modeloSelect, 'Selecciona un modelo');

    // Fetch tipos
    fetch('/api/tipos', { credentials: 'same-origin' })
        .then(res => res.json())
        .then(tipos => {
            tipos.forEach(tipo => {
                const option = document.createElement('option');
                option.value = tipo.id;
                option.textContent = tipo.nom;
                tipoSelect.appendChild(option);
            });
        });

    // Fetch marcas al cambiar tipo
    tipoSelect.addEventListener('change', () => {
        const tipo = tipoSelect.value;
        resetSelect(marcaSelect, 'Selecciona una marca');
        resetSelect(modeloSelect, 'Selecciona un modelo');

        if (!tipo) return;

        fetch('/api/marcas', { credentials: 'same-origin' })
            .then(res => res.json())
            .then(marcas => {
                marcas.forEach(marca => {
                    const option = document.createElement('option');
                    option.value = marca.id;
                    option.textContent = marca.nom;
                    marcaSelect.appendChild(option);
                });
            });
    });

    // Fetch modelos al cambiar marca
    marcaSelect.addEventListener('change', () => {
        const tipo = tipoSelect.value;
        const marcaId = marcaSelect.value;

        resetSelect(modeloSelect, 'Selecciona un modelo');

        if (!tipo || !marcaId) return;

        fetch(`/api/modelos/${marcaId}/${encodeURIComponent(tipo)}`, { credentials: 'same-origin' })
            .then(res => res.json())
            .then(modelos => {
                modelos.forEach(modelo => {
                    const option = document.createElement('option');
                    option.value = modelo.nom;
                    option.textContent = modelo.nom;
                    modeloSelect.appendChild(option);
                });
            });
    });

});
</script>

<div class="max-w-md mx-auto mt-3 p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h1 class="text-2xl text-center font-semibold mb-4 text-gray-800 dark:text-gray-100">Afegir una bicicleta nova</h1>

    <!-- FORMULARIO NORMAL -->
    <form action="{{ route('bicicletas.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="tipo_id" class="block text-gray-700 dark:text-gray-200">Tipus</label>
            <select id="tipo_id" name="tipo_id" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100" required>
                <option value="">Selecciona un tipus</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="marca_id" class="block text-gray-700 dark:text-gray-200">Marca</label>
            <select id="marca_id" name="marca_id" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100" required>
                <option value="">Selecciona una marca</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="modelo_id" class="block text-gray-700 dark:text-gray-200">Model</label>
            <select id="modelo_id" name="model" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100" required>
                <option value="">Selecciona un modelo</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="data_compra" class="block text-gray-700 dark:text-gray-200">Data de compra</label>
            <input type="date" name="data_compra" id="data_compra" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100" required>
        </div>

        <div class="mb-4">
            <label for="kms_actuals" class="block text-gray-700 dark:text-gray-200">Kilometres actuals</label>
            <input type="number" name="kms_actuals" id="kms_actuals" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100" value="0">
        </div>

        <!-- ESPECIFICACIONES -->
        <div class="mb-4">
            <label for="tipo_freno" class="block text-gray-700 dark:text-gray-200">Tipo de freno</label>
            <select name="tipo_freno" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100">
                <option value="">Selecciona un tipo</option>
                <option value="disco_hidraulico">Disco hidráulico</option>
                <option value="disco_mecanico">Disco mecánico</option>
                <option value="zapata">Zapata</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="suspension" class="block text-gray-700 dark:text-gray-200">Suspensión</label>
            <select name="suspension" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100">
                <option value="">Selecciona un tipo</option>
                <option value="delantera">Delantera</option>
                <option value="full">Full</option>
                <option value="ninguna">Ninguna</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="rodado" class="block text-gray-700 dark:text-gray-200">Rodado (pulgadas)</label>
            <input type="number" name="rodado" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100">
        </div>

        <div class="mb-4">
            <label for="material_cuadro" class="block text-gray-700 dark:text-gray-200">Material del cuadro</label>
            <select name="material_cuadro" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100">
                <option value="">Selecciona un material</option>
                <option value="aluminio">Aluminio</option>
                <option value="carbono">Carbono</option>
                <option value="acero">Acero</option>
                <option value="titanio">Titanio</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="tipo_transmision" class="block text-gray-700 dark:text-gray-200">Tipo de transmisión</label>
            <select name="tipo_transmision" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100">
                <option value="">Selecciona un tipo</option>
                <option value="1x">1x</option>
                <option value="2x">2x</option>
                <option value="3x">3x</option>
            </select>
        </div>

        <div class="flex justify-center">
            <button type="submit" 
                class="px-4 py-2 bg-gradient-to-r from-green-400 to-green-600 text-white rounded-lg shadow-lg hover:opacity-90 transition-all duration-300">
                Afegir
            </button>
        </div>
    </form>
</div>
@endsection
