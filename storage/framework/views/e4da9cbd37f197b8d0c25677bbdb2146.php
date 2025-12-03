<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - <?php echo e(config('app.name')); ?></title>
    <style>
        body, html { margin: 0; padding: 0; height: 100%; font-family: Arial, sans-serif; background: linear-gradient(to bottom right, #f5f5f5, #ffffff); color: #333; }
        .auth-container { background: #fff; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.1); width: 100%; max-width: 400px; margin: auto; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; }
        h1 { font-size: 1.5rem; margin-bottom: 0.5rem; background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .form-group { margin-bottom: 1rem; text-align: left; }
        label { display: block; margin-bottom: 0.25rem; font-size: 0.85rem; font-weight: bold; }
        input[type="email"], input[type="password"] { width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; font-size: 0.9rem; box-sizing: border-box; }
        input:focus { border-color: #1d4ed8; outline: none; box-shadow: 0 0 0 3px rgba(29,78,216,0.1); }
        button { width: 100%; background-color: #1d4ed8; color: white; padding: 0.75rem; border-radius: 0.375rem; font-weight: bold; border: none; cursor: pointer; margin-top: 1rem; }
        button:hover { background-color: #2563eb; }
        .link { font-size: 0.85rem; color: #555; margin-top: 1rem; }
        .link a { color: #1d4ed8; text-decoration: underline; }
        .forgot { text-align: right; font-size: 0.8rem; margin-top: 0.25rem; }
        .forgot a { color: #1d4ed8; text-decoration: none; }
        .remember { display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; margin-top: 0.5rem; }
        .error { color: red; font-size: 0.8rem; margin-top: 0.25rem; }
    </style>
</head>
<body>
    <div class="auth-container">
        <h1>Inicia sessió</h1>
        <p style="color: #666; font-size: 0.9rem; margin-bottom: 1.5rem;">Accedeix al teu compte</p>

        <!-- Status Session -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
            <div style="color: green; font-size: 0.9rem; margin-bottom: 1rem;">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Correu electrònic</label>
                <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus autocomplete="username" placeholder="exemple@correu.com">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Contrasenya</label>
                <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Contrasenya">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('password.request')): ?>
                    <div class="forgot">
                        <a href="<?php echo e(route('password.request')); ?>" wire:navigate>Has oblidat la contrasenya?</a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Remember Me -->
            <div class="remember">
                <input type="checkbox" id="remember_me" name="remember">
                <label for="remember_me" style="margin:0; font-weight: normal;">Recorda'm</label>
            </div>

            <button type="submit">Inicia sessió</button>
        </form>

        <div class="link">
            No tens compte? <a href="<?php echo e(route('register')); ?>" wire:navigate>Registra't</a>
        </div>
    </div>
</body>
</html><?php /**PATH C:\daw\dwm\bike_maintenance\resources\views/livewire/auth/login.blade.php ENDPATH**/ ?>