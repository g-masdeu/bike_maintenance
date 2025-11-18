

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

        <form action="<?php echo e(route('settings.password.update')); ?>" method="POST" id="passwordForm">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          
          <div class="space-y-4">
            
            <div>
              <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Contrasenya actual
              </label>
              <div class="relative" x-data="{ show: false }">
                <input :type="show ? 'text' : 'password'" 
                       id="current_password"
                       name="current_password" 
                       required
                       autocomplete="current-password"
                       class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 
                              text-gray-900 dark:text-gray-100
                              focus:ring-2 focus:ring-gray-400 focus:border-transparent
                              transition-all duration-200">
                <button type="button" 
                        @click="show = !show"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                  <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                  <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                  </svg>
                </button>
              </div>
              <?php $__errorArgs = ['current_password'];
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
              <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Nova contrasenya
              </label>
              <div class="relative" x-data="{ show: false }">
                <input :type="show ? 'text' : 'password'" 
                       id="password"
                       name="password" 
                       required
                       autocomplete="new-password"
                       x-ref="passwordInput"
                       @input="checkPasswordStrength($event.target.value)"
                       class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 
                              text-gray-900 dark:text-gray-100
                              focus:ring-2 focus:ring-gray-400 focus:border-transparent
                              transition-all duration-200">
                <button type="button" 
                        @click="show = !show"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                  <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                  <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                  </svg>
                </button>
              </div>
              
              
              <div x-data="{ strength: 0, text: '' }" class="mt-2">
                <div class="flex gap-1 mb-1">
                  <div class="h-1 flex-1 rounded-full bg-gray-200 dark:bg-gray-700" 
                       :class="{ 'bg-red-500': strength >= 1 }"></div>
                  <div class="h-1 flex-1 rounded-full bg-gray-200 dark:bg-gray-700" 
                       :class="{ 'bg-orange-500': strength >= 2 }"></div>
                  <div class="h-1 flex-1 rounded-full bg-gray-200 dark:bg-gray-700" 
                       :class="{ 'bg-yellow-500': strength >= 3 }"></div>
                  <div class="h-1 flex-1 rounded-full bg-gray-200 dark:bg-gray-700" 
                       :class="{ 'bg-green-500': strength >= 4 }"></div>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-400" x-text="text"></p>
              </div>

              <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                Mínim 8 caràcters, inclou majúscules, minúscules, números i símbols
              </p>
              <?php $__errorArgs = ['password'];
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
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Confirmar nova contrasenya
              </label>
              <div class="relative" x-data="{ show: false }">
                <input :type="show ? 'text' : 'password'" 
                       id="password_confirmation"
                       name="password_confirmation" 
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 
                              text-gray-900 dark:text-gray-100
                              focus:ring-2 focus:ring-gray-400 focus:border-transparent
                              transition-all duration-200">
                <button type="button" 
                        @click="show = !show"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                  <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                  <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                  </svg>
                </button>
              </div>
              <?php $__errorArgs = ['password_confirmation'];
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

            
            <div class="flex justify-end pt-4">
              <button type="submit" 
                      class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-blue-700 text-white 
                             rounded-lg shadow-lg hover:opacity-90 
                             transition-all duration-300 font-medium
                             flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Canviar contrasenya
              </button>
            </div>
          </div>
        </form>
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

    // Verificador de fortaleza de contraseña
    function checkPasswordStrength(password) {
      let strength = 0;
      let text = '';

      if (password.length === 0) {
        return { strength: 0, text: '' };
      }

      if (password.length >= 8) strength++;
      if (password.length >= 12) strength++;
      if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
      if (/\d/.test(password)) strength++;
      if (/[^a-zA-Z\d]/.test(password)) strength++;

      const texts = [
        'Molt feble',
        'Feble',
        'Acceptable',
        'Forta',
        'Molt forta'
      ];

      // Ajustar strength a máximo 4 para el display
      const displayStrength = Math.min(strength, 4);
      text = texts[displayStrength];

      // Actualizar Alpine.js data
      const component = document.querySelector('[x-data*="strength"]').__x.$data;
      component.strength = displayStrength;
      component.text = text;
    }
  </script>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\daw\dwm\bike_maintenance\resources\views/profile/edit.blade.php ENDPATH**/ ?>