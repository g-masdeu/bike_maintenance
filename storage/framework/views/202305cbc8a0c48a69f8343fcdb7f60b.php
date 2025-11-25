<?php if (isset($component)) { $__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.auth','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.auth'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div style="min-height:100vh; display:flex; align-items:center; justify-content:center; background: linear-gradient(to bottom right, #f5f5f5, #ffffff); font-family: Arial, sans-serif; padding:1rem;">
        <div class="confirm-container" style="background:#fff; padding:2rem; border-radius:0.5rem; box-shadow:0 4px 10px rgba(0,0,0,0.05); width:100%; max-width:400px; text-align:center; position:relative;">
            
            <h1 style="font-size:1.5rem; margin-bottom:0.25rem; background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Confirma la contrasenya
            </h1>
            <p style="font-size:0.9rem; color:#555; margin-bottom:1.5rem;">
                Aquesta és una àrea segura de l'aplicació. Si us plau, confirma la teva contrasenya abans de continuar.
            </p>

            <!-- Session Status -->
            <?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'text-center mb-4','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-center mb-4','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>

            <form method="POST" action="<?php echo e(route('password.confirm.store')); ?>">
                <?php echo csrf_field(); ?>

                <flux:input
                    name="password"
                    :label="'Contrasenya'"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Contrasenya"
                    viewable
                />

                <flux:button type="submit" variant="primary" style="width:100%; background-color:#1d4ed8; color:white; padding:0.75rem; border-radius:0.375rem; font-weight:bold; border:none; cursor:pointer; transition:0.2s;">
                    Confirma
                </flux:button>
            </form>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162)): ?>
<?php $attributes = $__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162; ?>
<?php unset($__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162)): ?>
<?php $component = $__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162; ?>
<?php unset($__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162); ?>
<?php endif; ?>
<?php /**PATH C:\daw\dwm\bike_maintenance\resources\views/livewire/auth/confirm-password.blade.php ENDPATH**/ ?>