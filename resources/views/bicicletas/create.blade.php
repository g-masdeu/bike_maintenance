@extends('layouts.app')

@section('content')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const tipoSelect = document.getElementById('tipo_id');
    const marcaSelect = document.getElementById('marca_id');
    const modeloSelect = document.getElementById('modelo_id');

    // Función para limpiar select
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
            console.log('Tipos:', tipos);
            tipos.forEach(tipo => {
                const option = document.createElement('option');
                option.value = tipo.id; // columna 'nom' de la tabla
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
                console.log('Marcas:', marcas);
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

        // 🔹 Cambiado a ruta con segmentos
        console.log("Marca --> " + marcaId);
        console.log("Tipo --> " + tipo);
        fetch(`/api/modelos/${marcaId}/${encodeURIComponent(tipo)}`, { credentials: 'same-origin' })
            .then(res => res.json())
            .then(modelos => {
                console.log('Modelos:', modelos);
                modelos.forEach(modelo => {
                    const option = document.createElement('option');
                    option.value = modelo.nom;
                    option.textContent = modelo.nom;
                    modeloSelect.appendChild(option);
                });
            });
    });

    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const data = {
            tipo_id: document.getElementById('tipo_id').value,
            marca_id: document.getElementById('marca_id').value,
            model: document.getElementById('modelo_id').value,
            data_compra: document.getElementById('data_compra').value,
            kms_actuals: document.getElementById('kms_actuals').value,
            kms_ultimo_mantenimiento: document.getElementById('kms_actuals').value // inicial igual a actual
        };

        fetch('/api/bicicletas', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(response => console.log('Bicicleta creada:', response))
        .catch(err => console.error(err));
    });

});
</script>

<div class="max-w-md mx-auto mt-3 p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h1 class="text-2xl text-center font-semibold mb-4 text-gray-800 dark:text-gray-100">Afegir una bicicleta nova</h1>

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
            <label for="modelo" class="block text-gray-700 dark:text-gray-200">Model</label>
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

        <div class="flex justify-center">
            <button type="submit" 
                class="px-4 py-2 bg-gradient-to-r from-green-400 to-green-600 text-white rounded-lg shadow-lg hover:opacity-90 transition-all duration-300">
                Afegir
            </button>
        </div>
    </form>
</div>
@endsection
