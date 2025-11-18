<!DOCTYPE html>
<html lang="ca" class="dark">
<head>
    <?php echo $__env->make('partials.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>
<body class="min-h-screen bg-gray-100 dark:bg-gray-900">

    <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->check()): ?>
    
    <div class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 hidden lg:flex flex-col">
        
        <div class="flex items-center justify-center h-16 border-b border-gray-200 dark:border-gray-700">
            <a href="<?php echo e(route('home')); ?>">
                <?php if (isset($component)) { $__componentOriginal7b17d80ff7900603fe9e5f0b453cc7c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7b17d80ff7900603fe9e5f0b453cc7c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7b17d80ff7900603fe9e5f0b453cc7c3)): ?>
<?php $attributes = $__attributesOriginal7b17d80ff7900603fe9e5f0b453cc7c3; ?>
<?php unset($__attributesOriginal7b17d80ff7900603fe9e5f0b453cc7c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7b17d80ff7900603fe9e5f0b453cc7c3)): ?>
<?php $component = $__componentOriginal7b17d80ff7900603fe9e5f0b453cc7c3; ?>
<?php unset($__componentOriginal7b17d80ff7900603fe9e5f0b453cc7c3); ?>
<?php endif; ?>
            </a>
        </div>

        
        <nav class="flex-1 px-4 py-6 space-y-2">
            <h2 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-2">Plataforma</h2>
            <a href="<?php echo e(route('home')); ?>" class="flex items-center px-2 py-2 text-sm font-medium rounded hover:bg-gray-200 dark:hover:bg-gray-700 <?php echo e(request()->routeIs('home') ? 'bg-gray-200 dark:bg-gray-700' : ''); ?>">
                <svg class="w-5 h-5 mr-3 text-gray-500 dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2L2 8v10h6v-6h4v6h6V8L10 2z" /></svg>
                Inici
            </a>
            <!--[if BLOCK]><![endif]--><?php if(Route::has('dashboard')): ?>
            <a href="<?php echo e(route('home')); ?>" class="flex items-center px-2 py-2 text-sm font-medium rounded hover:bg-gray-200 dark:hover:bg-gray-700 <?php echo e(request()->routeIs('home') ? 'bg-gray-200 dark:bg-gray-700' : ''); ?>">
                <svg class="w-5 h-5 mr-3 text-gray-500 dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3h12v14H4V3z" /></svg>
                Tauler
            </a>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </nav>

        
        <nav class="px-4 py-6 border-t border-gray-200 dark:border-gray-700 space-y-2">
            <a href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="flex items-center px-2 py-2 text-sm font-medium rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                Repositori
            </a>
            <a href="https://laravel.com/docs/starter-kits#livewire" target="_blank" class="flex items-center px-2 py-2 text-sm font-medium rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                Documentació
            </a>
        </nav>

        
        <div class="px-4 py-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-3">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                    <?php echo e(strtoupper(substr(auth()->user()->name,0,1))); ?>

                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white"><?php echo e(auth()->user()->name); ?></p>
                    <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e(auth()->user()->email); ?></p>
                </div>
            </div>

            <div class="mt-4 space-y-2">
                <!--[if BLOCK]><![endif]--><?php if(Route::has('settings.profile')): ?>
                <a href="<?php echo e(route('settings.profile')); ?>" class="flex items-center px-2 py-2 text-sm font-medium rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                    Configuració
                </a>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full text-left px-2 py-2 text-sm font-medium rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                        Tancar sessió
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <header class="lg:hidden flex items-center justify-between p-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->check()): ?>
        <button id="mobile-menu-toggle" class="text-gray-500 dark:text-gray-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <div class="flex items-center space-x-3">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                <?php echo e(strtoupper(substr(auth()->user()->name,0,1))); ?>

            </div>
            <span class="text-sm font-medium text-gray-900 dark:text-white"><?php echo e(auth()->user()->name); ?></span>
        </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </header>

    
    <main class="p-4 lg:ml-64">
        <?php echo e($slot ?? ''); ?>

    </main>

    
    <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

    <script>
        // Toggle menú mòbil
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', () => {
            document.querySelector('.lg\\:flex')?.classList.toggle('hidden');
        });
    </script>
</body>
</html>
<?php /**PATH C:\daw\dwm\bike_maintenance\resources\views/components/settings/layout.blade.php ENDPATH**/ ?>