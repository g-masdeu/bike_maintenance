<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'heading' => config('app.name', 'Bike Maintenance'),
    'subheading' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'heading' => config('app.name', 'Bike Maintenance'),
    'subheading' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($heading); ?></title>

    <style>
        .fonsHeaderFooter {
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            background-size: 200% 200%;
            animation: oceanWave 35s ease-in-out infinite;
            position: relative;
            color: white;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .fonsHeaderFooter::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 70% 50%, rgba(16, 185, 129, 0.08), transparent 70%);
            animation: underwater 25s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes oceanWave {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes underwater {

            0%,
            100% {
                transform: translate(0, 0);
                opacity: 0.4;
            }

            50% {
                transform: translate(5px, 5px);
                opacity: 0.7;
            }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body class="min-h-screen flex flex-col antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <!-- Header -->
    <header class="fonsHeaderFooter flex justify-between items-center p-4 border-b border-white/20 relative">
        <div class="flex flex-col">
            <h1 class="text-lg font-semibold"><?php echo e($heading); ?></h1>

            <?php if($subheading): ?>
                <p class="text-sm opacity-90"><?php echo e($subheading); ?></p>
            <?php endif; ?>
        </div>

        <?php if(auth()->guard()->check()): ?>
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-10 h-10 rounded-full overflow-hidden border-2 border-white/50 focus:outline-none focus:ring-2 focus:ring-white/70 transition-all hover:border-white"
                    aria-label="Menú de usuario" aria-expanded="false" x-bind:aria-expanded="open.toString()">

                    <?php if(Auth::user()->profile_photo_path): ?>
                        <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo_path)); ?>"
                            alt="Avatar de <?php echo e(Auth::user()->name); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <img src="<?php echo e(asset('images/default-avatar.png')); ?>" alt="Avatar por defecto"
                            class="w-full h-full object-cover"
                            onerror="this.src='https://ui-avatars.com/api/?name=<?php echo e(urlencode(Auth::user()->name)); ?>&background=0D8ABC&color=fff'">
                    <?php endif; ?>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95" @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                    style="display: none;">

                    <div class="py-1">
                        <a href="<?php echo e(route('settings.profile')); ?>"
                            class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">
                            <span>✏️</span>
                            <span>Editar perfil</span>
                        </a>

                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="border-t border-gray-200">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="flex items-center gap-2 w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">
                                <span>🚪</span>
                                <span>Tancar sessió</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </header>

    <!-- Contenido principal -->
    <main class="flex-grow container mx-auto p-4">
        <?php if(session('success')): ?>
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php echo e($slot ?? ''); ?>

    </main>

    <!-- Footer -->
    <footer class="fonsHeaderFooter text-center text-sm p-2 border-t border-white/20">
        &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name', 'Bike Maintenance')); ?> · Guillem Masdeu de Maria
    </footer>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html>
<?php /**PATH C:\daw\dwm\bike_maintenance\resources\views/layouts/app.blade.php ENDPATH**/ ?>