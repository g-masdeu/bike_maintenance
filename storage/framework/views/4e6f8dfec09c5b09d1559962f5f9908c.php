<?php $__env->startSection('content'); ?>
<div class="flex flex-col items-center justify-start bg-gray-100 dark:bg-gray-900 py-10 px-4">

    
    <div class="w-full max-w-5xl mb-6 flex justify-between items-center">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100">Tus bicicletas</h1>
        <a href="<?php echo e(route('bicicletas.create')); ?>"
            class="px-4 py-2 bg-gradient-to-r from-gray-400 to-gray-600 text-white rounded-lg shadow-lg hover:opacity-90 transition-all duration-300">
            Añadir bicicleta
        </a>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10 w-full max-w-5xl">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold"><?php echo e($bicicletas->count()); ?></div>
            <div class="text-gray-500 dark:text-gray-400">Bicicletas totales</div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold"><?php echo e($bicicletas->sum('kms_actuals')); ?> km</div>
            <div class="text-gray-500 dark:text-gray-400">Kilómetros totales</div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold">
                <?php echo e($bicicletas->filter(fn($b) => $b->kms_actuals - $b->kms_ultimo_mantenimiento >= 500)->count()); ?>

            </div>
            <div class="text-gray-500 dark:text-gray-400">Mantenimiento pendiente</div>
        </div>
    </div>

    
    <div class="w-full max-w-5xl">
        <div class="grid gap-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $bicicletas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bicicleta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <div class="font-bold text-lg text-gray-900 dark:text-gray-100">
                            <?php echo e($bicicleta->marca?->nom ?? 'Sin marca'); ?>

                            <?php echo e($bicicleta->model); ?>

                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            <?php echo e($bicicleta->tipo?->nom ?? 'Sin tipo'); ?>

                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo e($bicicleta->kms_actuals); ?> km
                            recorridos</div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                        <button
                            class="btn-veure-bici px-4 py-2 bg-gradient-to-r from-gray-400 to-gray-600 text-white rounded-lg shadow-lg hover:opacity-90 transition-all duration-300"
                            data-id="<?php echo e($bicicleta->id); ?>">
                            Ver
                        </button>
                        <button
                            class="btn-actualitzar-km px-4 py-1 bg-gradient-to-r from-gray-400 to-gray-600 text-white rounded-lg shadow-lg hover:opacity-90 transition-all duration-300"
                            data-id="<?php echo e($bicicleta->id); ?>" data-kms="<?php echo e($bicicleta->kms_actuals); ?>">
                            Actualizar km
                        </button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- MODAL: Actualizar km -->
    <div id="modal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-80 relative">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Actualizar kilómetros</h2>

            <form id="updateKmForm">
                <input type="hidden" id="bikeId">
                <label for="newKm" class="block text-gray-700 dark:text-gray-200 mb-2">Nuevo valor (km)</label>
                <input type="number" id="newKm"
                    class="w-full px-3 py-2 rounded border dark:bg-gray-700 dark:text-gray-100 mb-4" required>

                <div class="flex justify-end gap-2">
                    <button
                        class="btn-close-modal px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white rounded hover:opacity-90 transition">
                        Guardar
                    </button>
                </div>
            </form>

            <button
                class="btn-close-modal absolute top-2 right-3 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
    </div>

    <!-- MODAL: Ver bicicleta -->
    <div id="modalVer" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96 relative">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Detalles de la bicicleta</h2>
            <div id="detalleBicicleta" class="text-gray-700 dark:text-gray-200">Cargando...</div>
            <button
                class="btn-close-modal-ver absolute top-2 right-3 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // --- MODAL ACTUALIZAR KMS ---
    const modalUpdate = document.getElementById('modal');
    const updateForm = document.getElementById('updateKmForm');
    const bikeIdInput = document.getElementById('bikeId');
    const newKmInput = document.getElementById('newKm');

    document.querySelectorAll('.btn-actualitzar-km').forEach(btn => {
        btn.addEventListener('click', () => {
            bikeIdInput.value = btn.dataset.id;
            newKmInput.value = btn.dataset.kms;
            modalUpdate.classList.remove('hidden');
        });
    });

    document.querySelectorAll('.btn-close-modal').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            modalUpdate.classList.add('hidden');
        });
    });

    if (updateForm) {
        updateForm.addEventListener('submit', e => {
            e.preventDefault();
            const id = bikeIdInput.value;
            const newKm = newKmInput.value;

            fetch(`/api/bicicletas/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                credentials: 'include',
                body: JSON.stringify({ kms_actuals: newKm })
            })
            .then(res => res.json())
            .then(data => location.reload())
            .catch(err => console.error(err));
        });
    }

    // --- MODAL VER BICICLETA ---
    const modalView = document.getElementById('modalVer');
    const detalle = document.getElementById('detalleBicicleta');

    document.querySelectorAll('.btn-veure-bici').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            modalView.classList.remove('hidden');
            detalle.innerHTML = 'Cargando...';

            fetch(`/api/bicicletas/${id}`, {
                method: 'GET',
                headers: { 'Accept': 'application/json' },
                credentials: 'include'
            })
            .then(res => res.json())
            .then(data => {
                detalle.innerHTML = `
                    <p><strong>Modelo:</strong> ${data.model}</p>
                    <p><strong>Marca:</strong> ${data.marca.nom}</p>
                    <p><strong>Tipo:</strong> ${data.tipo.nom}</p>
                    <p><strong>Kms actuales:</strong> ${data.kms_actuals}</p>
                    <p><strong>Kms último mantenimiento:</strong> ${data.kms_ultimo_mantenimiento}</p>
                `;
            })
            .catch(err => {
                console.error(err);
                detalle.innerHTML = '<p class="text-red-500">Error cargando los datos</p>';
            });
        });
    });

    document.querySelectorAll('.btn-close-modal-ver').forEach(btn => {
        btn.addEventListener('click', () => modalView.classList.add('hidden'));
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\daw\dwm\bike_maintenance\resources\views/dashboard.blade.php ENDPATH**/ ?>