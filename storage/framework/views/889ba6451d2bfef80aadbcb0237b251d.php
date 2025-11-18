<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo e(config('app.name', 'Bike Maintenance')); ?> - Verifica el correu</title>
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom right, #f5f5f5, #ffffff);
        color: #333;
        overflow: hidden; /* sense scroll */
    }
    .verify-container {
        background: #fff;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        width: 100%;
        max-width: 400px;
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .verify-container h1 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .verify-container p {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 1.5rem;
    }
    flux:button {
        display: block;
        width: 100%;
        background-color: #1d4ed8;
        color: white;
        padding: 0.75rem;
        border-radius: 0.375rem;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
        margin-bottom: 1rem;
    }
    flux:button:hover { background-color: #2563eb; }
    flux:link {
        color: #1d4ed8;
        font-size: 0.85rem;
        text-decoration: underline;
        cursor: pointer;
    }
    .status-message {
        font-size: 0.85rem;
        margin-bottom: 1rem;
    }
    .status-success { color: #16a34a; font-weight: 500; }
</style>
</head>
<body>

<div class="verify-container">
    <h1>Verifica el teu correu electrònic</h1>
    <p>Si us plau, verifica la teva adreça de correu electrònic fent clic al link que t’hem enviat.</p>

    <!--[if BLOCK]><![endif]--><?php if(session('status') == 'verification-link-sent'): ?>
        <div class="status-message status-success">
            S’ha enviat un nou link de verificació al correu electrònic que vas proporcionar durant el registre.
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['wire:click' => 'sendVerification']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'sendVerification']); ?>Torna a enviar el correu de verificació <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::link','data' => ['wire:click' => 'logout']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'logout']); ?>Tancar sessió <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477)): ?>
<?php $attributes = $__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477; ?>
<?php unset($__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477)): ?>
<?php $component = $__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477; ?>
<?php unset($__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477); ?>
<?php endif; ?>
</div>

</bod
<?php /**PATH C:\daw\dwm\bike_maintenance\resources\views/livewire/auth/verify-email.blade.php ENDPATH**/ ?>