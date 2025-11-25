<section class="w-full">
    <?php echo $__env->make('partials.settings-heading', ['heading' => 'Perfil', 'subheading' => 'Actualitza el teu nom i correu electrònic'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <section class="w-full mb-6">
        <a href="<?php echo e(route('home')); ?>">
            <flux:button variant="outline" icon="arrow-left">
                <?php echo e(__('Volver a Inici')); ?>

            </flux:button>
        </a>
    </section>

    <?php if (isset($component)) { $__componentOriginal951a5936e8413b65cd052beecc1fba57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal951a5936e8413b65cd052beecc1fba57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.settings.layout','data' => ['heading' => __('Perfil'),'subheading' => __('Actualitza el teu nom i correu electrònic')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('settings.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Perfil')),'subheading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Actualitza el teu nom i correu electrònic'))]); ?>

        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6" enctype="multipart/form-data">
            
            
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-full overflow-hidden border border-zinc-300 dark:border-zinc-700">
                    <!--[if BLOCK]><![endif]--><?php if(auth()->user()->profile_photo_path): ?>
                        <img src="<?php echo e(asset('storage/' . auth()->user()->profile_photo_path)); ?>" alt="Foto de perfil" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="flex items-center justify-center w-full h-full bg-zinc-200 dark:bg-zinc-700 text-zinc-500">
                            <?php echo e(strtoupper(substr(auth()->user()->name,0,1))); ?>

                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
                <flux:input wire:model="profile_photo" :label="__('Foto de perfil')" type="file" accept="image/*"/>
            </div>

            
            <flux:input wire:model="name" :label="__('Nom')" type="text" required autofocus autocomplete="name" />

            
            <div>
                <flux:input wire:model="email" :label="__('Correu electrònic')" type="email" required autocomplete="email" />

                <!--[if BLOCK]><![endif]--><?php if(auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail()): ?>
                    <div>
                        <flux:text class="mt-4">
                            <?php echo e(__('El teu correu electrònic no està verificat.')); ?>


                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                <?php echo e(__('Fes clic aquí per rebre de nou l\'email de verificació.')); ?>

                            </flux:link>
                        </flux:text>

                        <!--[if BLOCK]><![endif]--><?php if(session('status') === 'verification-link-sent'): ?>
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                <?php echo e(__('S\'ha enviat un nou enllaç de verificació al teu correu electrònic.')); ?>

                            </flux:text>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            
            <div class="flex items-center gap-4">
                <flux:button variant="primary" type="submit" class="w-full"><?php echo e(__('Desa')); ?></flux:button>

                <?php if (isset($component)) { $__componentOriginala665a74688c74e9ee80d4fedd2b98434 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala665a74688c74e9ee80d4fedd2b98434 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-message','data' => ['class' => 'me-3','on' => 'profile-updated']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'me-3','on' => 'profile-updated']); ?>
                    <?php echo e(__('Desat.')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala665a74688c74e9ee80d4fedd2b98434)): ?>
<?php $attributes = $__attributesOriginala665a74688c74e9ee80d4fedd2b98434; ?>
<?php unset($__attributesOriginala665a74688c74e9ee80d4fedd2b98434); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala665a74688c74e9ee80d4fedd2b98434)): ?>
<?php $component = $__componentOriginala665a74688c74e9ee80d4fedd2b98434; ?>
<?php unset($__componentOriginala665a74688c74e9ee80d4fedd2b98434); ?>
<?php endif; ?>
            </div>
        </form>

        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.delete-user-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3686427182-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal951a5936e8413b65cd052beecc1fba57)): ?>
<?php $attributes = $__attributesOriginal951a5936e8413b65cd052beecc1fba57; ?>
<?php unset($__attributesOriginal951a5936e8413b65cd052beecc1fba57); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal951a5936e8413b65cd052beecc1fba57)): ?>
<?php $component = $__componentOriginal951a5936e8413b65cd052beecc1fba57; ?>
<?php unset($__componentOriginal951a5936e8413b65cd052beecc1fba57); ?>
<?php endif; ?>
</section>
<?php /**PATH C:\daw\dwm\bike_maintenance\resources\views/livewire/settings/profile.blade.php ENDPATH**/ ?>