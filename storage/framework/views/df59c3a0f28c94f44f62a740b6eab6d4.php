<div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
    
    <?php if(auth()->guard()->check()): ?>
    <aside class="fixed inset-y-0 left-0 w-64 border-r border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800 flex flex-col">
        <div class="p-4">
            <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-2">
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
                <span class="font-bold text-lg text-gray-800 dark:text-gray-100">Bicicletes</span>
            </a>
        </div>

        <nav class="flex-1 px-2 space-y-1 mt-4">
            <a href="<?php echo e(route('home')); ?>" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Inici</a>
            <?php if(Route::has('dashboard')): ?>
            <a href="<?php echo e(route('dashboard')); ?>" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Tauler</a>
            <?php endif; ?>
        </nav>

        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-2">
                <span class="bg-gray-300 dark:bg-gray-600 rounded-full w-8 h-8 flex items-center justify-center font-bold text-gray-800 dark:text-gray-100">
                    <?php echo e(strtoupper(substr(auth()->user()->name,0,1))); ?>

                </span>
                <div class="flex flex-col">
                    <span class="text-sm font-semibold text-gray-800 dark:text-gray-100"><?php echo e(auth()->user()->name); ?></span>
                    <span class="text-xs text-gray-500 dark:text-gray-400"><?php echo e(auth()->user()->email); ?></span>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="<?php echo e(route('settings.profile')); ?>" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Configuració</a>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Tancar sessió</button>
                </form>
            </div>
        </div>
    </aside>
    <?php endif; ?>

    
    <div class="flex-1 lg:pl-64 min-h-screen p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100"><?php echo e($heading); ?></h1>
            <p class="text-gray-600 dark:text-gray-400"><?php echo e($subheading); ?></p>
        </div>

        <div class="space-y-10">
            <?php echo e($slot); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\daw\dwm\bike_maintenance\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>