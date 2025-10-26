@extends('layouts.app')

@section('content')
<script>
// Funció que obre un modal per actualitzar els kms de la bicicleta
function openModal(id, currentKm) {
  const modal = document.getElementById('modal');
  modal.classList.remove('hidden', 'opacity-0', 'pointer-events-none');
  document.getElementById('bikeId').value = id;
  document.getElementById('newKm').value = currentKm;
}

// Funció per tancar el modal d'actualitzar
function closeModal() {
  const modal = document.getElementById('modal');
  modal.classList.add('hidden');
}

// Enviar dades al backend
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('updateKmForm');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const id = document.getElementById('bikeId').value;
      const newKm = document.getElementById('newKm').value;

      fetch(`/api/bicicletas/${id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        credentials: 'same-origin',
        body: JSON.stringify({ kms_actuals: newKm })
      })
      .then(res => res.json())
      .then(data => {
        console.log('Bicicleta actualitzada:', data);
        closeModal();
        location.reload();
      })
      .catch(err => console.error(err));
    });
  }
});

// Funció per veure la bici
function verBicicleta(id) {
  const modal = document.getElementById('modalVer');
  const detalle = document.getElementById('detalleBicicleta');

  modal.classList.remove('hidden');
  detalle.innerHTML = 'Carregant...';

  fetch(`/api/bicicletas/${id}`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        credentials: 'same-origin',
    })
    .then(res => res.json())
    .then(data => {
      detalle.innerHTML = `
        <p><strong>Model:</strong> ${data.model}</p>
        <p><strong>Marca:</strong> ${data.marca.name}</p>
        <p><strong>Tipus:</strong> ${data.tipo.name}</p>
        <p><strong>Kms actuals:</strong> ${data.kms_actuals}</p>
        <p><strong>Kms últim manteniment:</strong> ${data.kms_ultimo_mantenimiento}</p>
      `;
    })
    .catch(() => {
      detalle.innerHTML = '<p class="text-red-500">Error carregant les dades</p>';
    });
}

// Tancar modal veure bici
function closeModalVer() {
  document.getElementById('modalVer').classList.add('hidden');
}
</script>

<div class="flex flex-col items-center justify-start bg-gray-100 dark:bg-gray-900 py-10 px-4">

  {{-- Títol i botó Afegir bicicleta --}}
  <div class="w-full max-w-5xl mb-6 flex justify-between items-center">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100">Les teves bicicletes</h1>
    <a href="{{ route('bicicletas.create') }}" 
       class="px-4 py-2 bg-gradient-to-r from-gray-400 to-gray-600 text-white rounded-lg shadow-lg hover:opacity-90 transition-all duration-300">
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
          <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
            <button type="button"
                    onclick="verBicicleta({{ $bicicleta->id }})"
                    class="px-4 py-2 bg-gradient-to-r from-gray-400 to-gray-600 text-white rounded-lg shadow-lg hover:opacity-90 transition-all duration-300">
              Veure
            </button>

            <button type="button" 
                    onClick="openModal({{ $bicicleta->id }}, {{ $bicicleta->kms_actuals }})"
                    class="px-4 py-1 bg-gradient-to-r from-gray-400 to-gray-600 text-white rounded-lg shadow-lg hover:opacity-90 transition-all duration-300">
              Actualitzar km
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<!-- MODAL: Actualitzar km -->
<div id="modal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-80 relative">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Actualitzar quilòmetres</h2>

    <form id="updateKmForm">
      <input type="hidden" id="bikeId">
      <label for="newKm" class="block text-gray-700 dark:text-gray-200 mb-2">Nou valor (km)</label>
      <input type="number" id="newKm" class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100 mb-4" required>

      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeModal()" 
                class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">
          Cancel·lar
        </button>
        <button type="submit" 
                class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white rounded hover:opacity-90 transition">
          Guardar
        </button>
      </div>
    </form>

    <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
  </div>
</div>

<!-- MODAL: Ver Bicicleta -->
<div id="modalVer" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96 relative">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Detalls de la bicicleta</h2>
    <div id="detalleBicicleta" class="text-gray-700 dark:text-gray-200">
      Carregant...
    </div>
    <button onclick="closeModalVer()" 
            class="absolute top-2 right-3 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
  </div>
</div>
@endsection
