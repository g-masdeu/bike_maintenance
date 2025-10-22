@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Detalle de Bicicleta</h1>

    <div id="detalle-bicicleta">
        <!-- Aquí se cargarán los datos por JS -->
        Cargando...
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const contenedor = document.getElementById('detalle-bicicleta');

    fetch(`/api/bicicletas/{{ $bicicleta->id }}`)
        .then(res => res.json())
        .then(data => {
            contenedor.innerHTML = `
                <p><strong>Modelo:</strong> ${data.model}</p>
                <p><strong>Marca:</strong> ${data.marca.name}</p>
                <p><strong>Tipo:</strong> ${data.tipo.name}</p>
                <p><strong>Kms actuales:</strong> ${data.kms_actuals}</p>
                <p><strong>Kms último mantenimiento:</strong> ${data.kms_ultimo_mantenimiento}</p>
            `;
        });
});
</script>
@endsection
