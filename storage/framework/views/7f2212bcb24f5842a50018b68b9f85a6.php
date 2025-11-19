

<?php $__env->startSection('content'); ?>
<div class="bg-gray-100 dark:bg-gray-900 px-4 py-4">
  
  
  <div class="max-w-6xl mx-auto mb-4">
    <div class="flex items-center justify-between">
      
      <a href="<?php echo e(route('home')); ?>">
        <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['variant' => 'outline','icon' => 'arrow-left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'outline','icon' => 'arrow-left']); ?>
          <?php echo e(__('Tornar')); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
      </a>

      
      <div class="absolute left-1/2 transform -translate-x-1/2 text-center">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Perfil</h1>
      </div>

      
      <div class="w-24"></div>
    </div>
  </div>

  
  <div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
      
      
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 flex flex-col items-center justify-center">
        <div class="text-center">
          <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Imatge de perfil</h2>
          
          <form action="<?php echo e(route('settings.profile.update')); ?>" method="POST" enctype="multipart/form-data" id="profileForm">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="mb-4">
              <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-gray-200 dark:border-gray-600 shadow-lg mb-3">
                <img src="<?php echo e(auth()->user()->profile_photo_url ?? asset('default-avatar.png')); ?>" 
                     alt="Profile" 
                     class="w-full h-full object-cover"
                     id="profilePreview">
              </div>
              
              <label for="profile_photo" class="cursor-pointer inline-block">
                <span class="px-6 py-2.5 bg-gradient-to-r from-gray-400 to-gray-600 text-white 
                           rounded-lg shadow-lg hover:opacity-90 transition-all duration-300 font-medium
                           inline-block">
                  Canviar imatge
                </span>
                <input type="file" 
                       id="profile_photo"
                       name="profile_photo" 
                       accept="image/*"
                       class="hidden"
                       onchange="previewImage(event)">
              </label>
              <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                JPG, PNG o GIF (màx. 2MB)
              </p>
            </div>
          </form>
        </div>
      </div>

      
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 flex flex-col justify-center">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Informació personal</h2>
        
        <div class="space-y-4">
          
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Nom
            </label>
            <input type="text" 
                   id="name"
                   name="name" 
                   value="<?php echo e(auth()->user()->name); ?>" 
                   required
                   form="profileForm"
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 
                          bg-white dark:bg-gray-700 
                          text-gray-900 dark:text-gray-100
                          focus:ring-2 focus:ring-gray-400 focus:border-transparent
                          transition-all duration-200">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Correu electrònic
            </label>
            <input type="email" 
                   id="email"
                   name="email" 
                   value="<?php echo e(auth()->user()->email); ?>" 
                   required
                   form="profileForm"
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 
                          bg-white dark:bg-gray-700 
                          text-gray-900 dark:text-gray-100
                          focus:ring-2 focus:ring-gray-400 focus:border-transparent
                          transition-all duration-200">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          
          <div class="flex justify-end gap-3 pt-3">
            <a href="<?php echo e(route('home')); ?>" 
               class="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 
                      rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 
                      transition-all duration-300 font-medium">
              Cancel·lar
            </a>
            <button type="submit" 
                    form="profileForm"
                    class="px-6 py-2.5 bg-gradient-to-r from-gray-400 to-gray-600 text-white 
                           rounded-lg shadow-lg hover:opacity-90 
                           transition-all duration-300 font-medium">
              Desar canvis
            </button>
          </div>
        </div>
      </div>

    </div>

    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
      <div class="max-w-2xl mx-auto">
        <div class="flex items-center gap-3 mb-6">
          <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
          </svg>
          <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Canviar contrasenya</h2>
        </div>

        
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.password', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-4229844604-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
      </div>
    </div>

  </div>

  
  <script>
    // Preview de imagen
    function previewImage(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('profilePreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
      }
    }
  </script>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\daw\dwm\bike_maintenance\resources\views/profile/edit.blade.php ENDPATH**/ ?>